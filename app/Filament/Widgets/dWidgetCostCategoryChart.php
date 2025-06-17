<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\DB;

class dWidgetCostCategoryChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Pengeluaran per Kategori';

    // Method getFilters() tidak diperlukan karena sudah ditangani oleh InteractsWithPageFilters
    
    protected function getData(): array
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

        // 2. Query yang lebih efisien dan langsung diurutkan
        $data = Transaction::query()
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->whereBetween('transactions.date_transaction', [$startDate, $endDate])
            ->select(
                'categories.name as category_name',
                DB::raw('SUM(transactions.amount) as total_amount')
            )
            ->groupBy('categories.name')
            ->orderByDesc('total_amount') // Mengurutkan dari pengeluaran terbesar
            ->limit(10) // Membatasi hanya 10 kategori teratas agar chart tidak ramai
            ->get();

        // 3. Memproses data menjadi label dan total dengan lebih ringkas
        $labels = $data->pluck('category_name');
        $totals = $data->pluck('total_amount');

        return [
            'datasets' => [
                [
                    'label' => 'Total Pengeluaran (Rp)',
                    'data' => $totals,
                    // 4. Menggunakan multi-warna agar setiap bar berbeda
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                        '#FF9F40', '#C9CBCF', '#FFCD56', '#2E8B57', '#DAA520',
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}