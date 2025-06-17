<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;

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
}