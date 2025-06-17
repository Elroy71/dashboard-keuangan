<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\Vendor; // Ganti Recurring dengan Vendor
use App\Services\CurrencyService;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class aStatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        // 1. Menggunakan periode default yang konsisten (3 bulan terakhir)
        $defaultStartDate = now()->subMonths(2)->startOfMonth();
        $defaultEndDate = now()->endOfMonth();

        $startDate = filled($this->filters['startDate'] ?? null)
            ? Carbon::parse($this->filters['startDate'])
            : $defaultStartDate;

        $endDate = filled($this->filters['endDate'] ?? null)
            ? Carbon::parse($this->filters['endDate'])
            : $defaultEndDate;

        $totalPengeluaran = Transaction::whereBetween('date_transaction', [$startDate, $endDate])
            ->sum('amount');

        $rate = CurrencyService::getRate('IDR', 'USD');
        $totalPengeluaranUsd = $totalPengeluaran * $rate;
        
        // --- Query utama untuk mendapatkan data recurring, digunakan untuk semua perhitungan forecast ---
        $latestTransactions = Transaction::with('vendor')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                        ->from('transactions')
                        ->groupBy('vendor_id');
            })
            ->whereHas('vendor', function ($query) {
                $query->where('is_active', true)->whereNotNull('recurring_type');
            })
            ->get();

        // --- Perhitungan Forecast 3 Bulan ke Depan (Stat 2) - TIDAK DIUBAH ---
        $futureStartMonth = now()->addMonth()->startOfMonth();
        $futureEndMonth = now()->addMonths(3)->endOfMonth();
        $futureForecast = 0;

        for ($date = $futureStartMonth->copy(); $date->lte($futureEndMonth); $date->addMonth()) {
            $monthly = 0;
            foreach ($latestTransactions as $transaction) {
                $vendor = $transaction->vendor;
                $start = Carbon::parse($vendor->vendor_start);
                $end = $vendor->vendor_end ? Carbon::parse($vendor->vendor_end) : null;

                if ($start->gt($date->copy()->endOfMonth()) || ($end && $end->lt($date->copy()->startOfMonth()))) continue;

                if (strtolower($vendor->recurring_type) === 'bulanan') {
                    $monthly += $transaction->amount;
                } elseif (strtolower($vendor->recurring_type) === 'tahunan' && $date->format('m') === $start->format('m')) {
                    $monthly += $transaction->amount;
                }
            }
            $futureForecast += $monthly;
        }
        $futureForecastUsd = $futureForecast * $rate;

        // ======================================================================
        // --- PERHITUNGAN BARU: Realisasi Pengeluaran Recurring 3 Bulan ke Belakang ---
        // ======================================================================
        $pastStartMonth = now()->subMonths(2)->startOfMonth(); // 3 bulan lalu, dari awal bulan
        $pastEndMonth = now()->endOfMonth();
        $pastSpending = 0;

        // Kita tidak perlu loop, cukup query langsung ke tabel transaksi
        $pastSpending = Transaction::whereHas('vendor', function ($query) {
                $query->where('is_active', true)->whereNotNull('recurring_type');
            })
            ->whereBetween('date_transaction', [$pastStartMonth, $pastEndMonth])
            ->sum('amount');

        // ======================================================================
        // --- PERHITUNGAN BARU: Selisih ---
        // =================================----------------=====================
        $difference = $futureForecast - $pastSpending;
        $differenceUsd = $difference * $rate;

        return [
            // Stat 1: TIDAK DIUBAH
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($totalPengeluaran, 0, ',', '.'))
                ->description('$' . number_format($totalPengeluaranUsd, 2))
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            // Stat 2: TIDAK DIUBAH
            Stat::make('Forecast 3 Bulan ke Depan', 'Rp ' . number_format($futureForecast, 0, ',', '.'))
                ->description('$' . number_format($futureForecastUsd, 2))
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('warning'),

            // Stat 3: DIUBAH MENJADI SELISIH FORECAST
            Stat::make('Periode Difference', 'Rp ' . number_format($difference, 0, ',', '.'))
                ->description('$' . number_format($differenceUsd, 2))
                ->descriptionIcon('heroicon-m-arrows-up-down')
                ->color($difference > 0 ? 'success' : ($difference < 0 ? 'danger' : 'gray')),
        ];
    }
}