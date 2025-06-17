<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class cWidgetExpenseChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Tren Pengeluaran Bulanan'; // Judul lebih deskriptif
    protected static string $color = 'danger'; // Memberi warna merah pada header

    protected function getData(): array
    {
        // Variabel untuk tanggal default (3 bulan terakhir)
        $defaultStartDate = now()->subMonths(2)->startOfMonth();
        $defaultEndDate = now()->endOfMonth();

        // Mengambil tanggal dari filter halaman jika ada, jika tidak gunakan default
        $startDate = filled($this->filters['startDate'] ?? null)
            ? Carbon::parse($this->filters['startDate'])
            : $defaultStartDate;

        $endDate = filled($this->filters['endDate'] ?? null)
            ? Carbon::parse($this->filters['endDate'])
            : $defaultEndDate;

        // Mengambil data tren pengeluaran per bulan
        $data = Trend::query(Transaction::expenses()) // Menggunakan scope 'expenses' dari model
            ->dateColumn('date_transaction')
            ->between(
                start: $startDate,
                end: $endDate,
            )
            ->perMonth()
            ->sum('amount');

        // Menyiapkan variabel untuk data dan label chart
        $chartData = $data->map(fn (TrendValue $value) => $value->aggregate);
        $chartLabels = $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('M Y')); // Format: Jun 2025

        return [
            'datasets' => [
                [
                    'label' => 'Pengeluaran per bulan', // Label disesuaikan dengan data
                    'data' => $chartData,
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)', // Warna merah (danger) transparan
                    'borderColor' => 'rgb(239, 68, 68)', // Warna merah solid
                    'tension' => 0.4,
                    'fill' => true,
                ],
            ],
            'labels' => $chartLabels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Tipe grafik adalah line chart
    }
}