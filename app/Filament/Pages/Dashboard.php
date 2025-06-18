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
use Filament\Forms\Components\Select;
use Illuminate\Support\Carbon;


class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        // 1. Date Range Paling Atas
                        DatePicker::make('startDate')
                            ->label('Tanggal Mulai')
                            ->default(now()->subMonths(2)->startOfMonth())
                            ->maxDate(fn (Get $get) => $get('endDate') ?: now()),

                        DatePicker::make('endDate')
                            ->label('Tanggal Akhir')
                            ->default(now())
                            ->minDate(fn (Get $get) => $get('startDate'))
                            ->maxDate(now()),
                            
                        Select::make('year')
                        ->label('Tahun')
                        ->options(function () {
                            $years = [];
                            $current = now()->year;
                            for ($i = $current; $i >= $current - 5; $i--) {
                                $years[$i] = $i;
                            }
                            return $years;
                        })
                        ->default(now()->year)
                        ->reactive(),
                        
                        // 3. Dropdown Triwulan
                        Select::make('quarter')
                        ->label('Triwulan')
                        ->options([
                            'Q1' => 'Triwulan 1 (Jan - Mar)',
                            'Q2' => 'Triwulan 2 (Apr - Jun)',
                            'Q3' => 'Triwulan 3 (Jul - Sep)',
                            'Q4' => 'Triwulan 4 (Okt - Des)',
                            ])
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, Get $get) {
                                $year = $get('year') ?? now()->year;
                                
                                match ($state) {
                                    'Q1' => [
                                        $set('startDate', Carbon::create($year, 1, 1)->startOfDay()),
                                        $set('endDate', Carbon::create($year, 3, 31)->endOfDay()),
                                    ],
                                    'Q2' => [
                                        $set('startDate', Carbon::create($year, 4, 1)->startOfDay()),
                                        $set('endDate', Carbon::create($year, 6, 30)->endOfDay()),
                                    ],
                                    'Q3' => [
                                        $set('startDate', Carbon::create($year, 7, 1)->startOfDay()),
                                        $set('endDate', Carbon::create($year, 9, 30)->endOfDay()),
                                    ],
                                    'Q4' => [
                                        $set('startDate', Carbon::create($year, 10, 1)->startOfDay()),
                                        $set('endDate', Carbon::create($year, 12, 31)->endOfDay()),
                                    ],
                                    default => null,
                                };
                            }),
                        ])
                        ->columns(4),
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