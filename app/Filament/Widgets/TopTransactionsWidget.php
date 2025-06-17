<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TopTransactionsWidget extends BaseWidget
{
    // Judul yang akan tampil di atas tabel
    protected static ?string $heading = '5 Transaksi Termahal';

    // Menentukan seberapa lebar widget ini di grid dashboard
    protected int | string | array $columnSpan = 'full';

    // Method ini untuk mengambil data dari database
    protected function getTableQuery(): Builder
    {
        // Ambil data transaksi, urutkan dari 'amount' terbesar, dan batasi 5 data teratas
        return Transaction::query()
            ->orderBy('amount', 'desc')
            ->limit(5);
    }

    // Method ini untuk mendefinisikan kolom-kolom tabel
    protected function getTableColumns(): array
    {
        return [
            // Kolom 1: Nomor urut otomatis
            Tables\Columns\TextColumn::make('no')
                ->label('No.')
                ->rowIndex(),

            // Kolom 2: Vendor dengan deskripsi kategori di bawahnya
            Tables\Columns\TextColumn::make('vendor.name')
                ->label('Vendor')
                ->searchable()
                ->sortable()
                ->description(fn (Transaction $record): string => $record->category->name ?? ''),

            // Kolom 3: Harga Rupiah
            Tables\Columns\TextColumn::make('amount')
                ->label('Harga (IDR)')
                ->money('IDR')
                ->sortable(),

            // Kolom 4: Harga Dollar
            Tables\Columns\TextColumn::make('amount_dollar')
                ->label('Harga (USD)')
                ->money('USD')
                ->sortable(),

            // Kolom 5: Status Recurring (menggunakan ikon)
            Tables\Columns\IconColumn::make('vendor.is_active')
                ->label('Recurring')
                ->boolean()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle'),
        ];
    }
    
    // Menonaktifkan fitur paginasi karena kita hanya menampilkan 5 data
    public function isTablePaginationEnabled(): bool
    {
        return false;
    }
}