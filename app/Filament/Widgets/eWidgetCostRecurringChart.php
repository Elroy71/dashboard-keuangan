<?php

namespace App\Filament\Widgets;

use App\Models\Transaction; // Menggunakan Model Eloquent lebih dianjurkan
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class eWidgetCostRecurringChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Distribusi Pengeluaran Recurring';

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        // Menggunakan periode default yang konsisten (3 bulan terakhir)
        $defaultStartDate = now()->subMonths(2)->startOfMonth();
        $defaultEndDate = now()->endOfMonth();

        $startDate = filled($this->filters['startDate'] ?? null)
            ? Carbon::parse($this->filters['startDate'])
            : $defaultStartDate;

        $endDate = filled($this->filters['endDate'] ?? null)
            ? Carbon::parse($this->filters['endDate'])
            : $defaultEndDate;

        // --- QUERY DIUBAH TOTAL UNTUK KONEK KE VENDORS ---
        $data = Transaction::query()
            // Sambungkan ke tabel vendors
            ->join('vendors', 'transactions.vendor_id', '=', 'vendors.id')
            // Ambil hanya transaksi dari vendor yang status recurring-nya aktif
            ->where('vendors.is_active', true)
            ->whereNotNull('vendors.recurring_type')
            // Filter berdasarkan rentang tanggal
            ->whereBetween('transactions.date_transaction', [$startDate, $endDate])
            // Pilih tipe recurring dan jumlahkan totalnya
            ->select('vendors.recurring_type', DB::raw('SUM(transactions.amount) as total_amount'))
            ->groupBy('vendors.recurring_type')
            ->get();

        // Ambil data dan label secara dinamis dari hasil query
        $labels = $data->pluck('recurring_type');
        $totals = $data->pluck('total_amount');

        return [
            'datasets' => [
                [
                    'data' => $totals,
                    // Warna disesuaikan dengan permintaan Anda
                    'backgroundColor' => ['#FED16A', '#F3A26D'],
                    'hoverBackgroundColor' => ['#F3A26D', '#FED16A'], // Bisa dibalik untuk efek hover
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'usePointStyle' => true, // Membuat label legend bulat
                    ],
                ],
            ],
        ];
    }
}