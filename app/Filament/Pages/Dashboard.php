<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\TopTransactionsWidget; // <-- IMPORT WIDGET BARU KITA
use App\Filament\Widgets\aStatsOverview;
use App\Filament\Widgets\cWidgetExpenseChart;
use App\Filament\Widgets\dWidgetCostCategoryChart;
use App\Filament\Widgets\fWidgetForecastChart;
use App\Filament\Widgets\eWidgetCostRecurringChart;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        DatePicker::make('startDate')
                            ->label('Tanggal Mulai')
                            // Mengatur tanggal default: awal bulan, 2 bulan yg lalu
                            // Contoh: Jika hari ini 17 Juni, maka defaultnya 1 April
                            ->default(now()->subMonths(2)->startOfMonth())
                            ->maxDate(fn (Get $get) => $get('endDate') ?: now()),

                        DatePicker::make('endDate')
                            ->label('Tanggal Akhir')
                            // Mengatur tanggal default: hari ini
                            ->default(now())
                            ->minDate(fn (Get $get) => $get('startDate'))
                            ->maxDate(now()),
                    ])
                    ->columns(2), // Diubah menjadi 2 kolom agar pas
            ]);
    }

    public function getWidgets(): array
    {
        return [
            aStatsOverview::class,
            cWidgetExpenseChart::class,
            dWidgetCostCategoryChart::class,
            eWidgetCostRecurringChart::class,
            fWidgetForecastChart::class,

            // Pastikan widget tabel TIDAK ada di sini agar tidak tampil dua kali
        ];
    }



    // --- TAMBAHKAN METHOD INI ---
    public function getFooterWidgets(): array
    {
        return [
            // Daftarkan widget tabel kita di sini
            TopTransactionsWidget::class,
        ];
    }
}