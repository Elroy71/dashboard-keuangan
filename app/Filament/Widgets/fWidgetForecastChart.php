<?php

namespace App\Filament\Widgets;

use App\Models\Transaction; // Menggunakan model Transaction
use App\Models\Vendor; // Menggunakan model Vendor
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class fWidgetForecastChart extends ChartWidget
{
    protected static ?string $heading = 'Forecast Pengeluaran per Bulan (Estimasi)';
    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        // --- 1. Mengambil data yang relevan dengan satu query efisien ---
        // Ambil transaksi terakhir dari setiap vendor yang status recurring-nya aktif.
        // Ini penting untuk mendapatkan 'amount' terakhir sebagai dasar forecast.
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

        // --- 2. Menyiapkan periode dan koleksi untuk chart ---
        // Logika periode 3 bulan ke depan tetap dipertahankan
        $startMonth = now()->addMonth()->startOfMonth();
        $endMonth = now()->addMonths(3)->endOfMonth();

        $labels = collect();
        $amounts = collect();

        // --- 3. Melakukan iterasi per bulan untuk menghitung forecast ---
        // Logika asli Anda dipertahankan, hanya sumber datanya yang diubah.
        for ($date = $startMonth->copy(); $date->lte($endMonth); $date->addMonth()) {
            $monthLabel = $date->format('M Y'); // Format: Jul 2025
            $labels->push($monthLabel);

            $monthlyForecast = 0;

            foreach ($latestTransactions as $transaction) {
                $vendor = $transaction->vendor; // Ambil data vendor dari relasi

                // Ambil properti dari vendor, bukan recurring
                $start = Carbon::parse($vendor->vendor_start);
                $end = $vendor->vendor_end ? Carbon::parse($vendor->vendor_end) : null;

                // Lewati jika recurring tidak aktif di bulan ini
                if ($start->gt($date->copy()->endOfMonth()) || ($end && $end->lt($date->copy()->startOfMonth()))) {
                    continue;
                }

                $amount = $transaction->amount; // Ambil amount dari transaksi terakhir
                $type = strtolower($vendor->recurring_type); // Ambil tipe dari vendor

                if ($type === 'bulanan') {
                    $monthlyForecast += $amount;
                } elseif ($type === 'tahunan') {
                    // Hanya tambahkan jika bulan anniversary sama dengan bulan iterasi
                    if ($date->format('m') === $start->format('m')) {
                        $monthlyForecast += $amount;
                    }
                }
            }

            $amounts->push(round($monthlyForecast));
        }

        return [
            'datasets' => [
                [
                    'label' => 'Estimasi Pengeluaran (Rp)',
                    'data' => $amounts,
                    'fill' => true,
                    'backgroundColor' => 'rgba(245, 158, 11, 0.2)',
                    'borderColor' => '#F59E0B', // Sesuai warna dari StatsOverview
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }
}