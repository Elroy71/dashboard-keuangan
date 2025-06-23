<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use App\Services\CurrencyService; // Pastikan Anda punya service ini
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Get; // Import class Get
use Filament\Forms\Set; // Import class Set
use Filament\Tables\Filters\SelectFilter;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use Filament\Tables\Columns\ToggleColumn; // <-- Jangan lupa import di atas
use Filament\Tables\Filters\TernaryFilter; // <-- Jangan lupa import di atas
use Filament\Tables\Columns\BadgeColumn; // <-- Jangan lupa import di atas


class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Kita tidak perlu Card di sini agar lebih simpel, tapi ini selera
                Forms\Components\Select::make('vendor_id')
                    ->relationship('vendor', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\DatePicker::make('date_transaction')
                    ->default(now())
                    ->required(),


                // --- PERUBAHAN UTAMA DIMULAI DARI SINI ---
                Forms\Components\Select::make('currency')
                    ->label('Mata Uang')
                    ->options([
                        'IDR' => 'Rupiah (IDR)',
                        'USD' => 'Dollar (USD)',
                    ])
                    ->default('IDR')
                    ->live() // Menggantikan reactive() untuk kejelasan
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label('Jumlah (Rupiah)')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(fn (Get $get): bool => $get('currency') === 'IDR') // Wajib diisi HANYA jika currency adalah IDR
                    ->readOnly(fn (Get $get): bool => $get('currency') !== 'IDR') // Non-aktif JIKA currency BUKAN IDR
                    ->live(onBlur: true) // Update saat keluar dari field
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                        if (is_numeric($state)) {
                            $rate = CurrencyService::getRate('IDR', 'USD');
                            $set('amount_dollar', round($state * $rate, 2));
                        }
                    }),

                Forms\Components\TextInput::make('amount_dollar')
                    ->label('Jumlah (Dollar)')
                    ->numeric()
                    ->prefix('$')
                    ->required(fn (Get $get): bool => $get('currency') === 'USD') // Wajib diisi HANYA jika currency adalah USD
                    ->readOnly(fn (Get $get): bool => $get('currency') !== 'USD') // Hanya bisa dibaca JIKA currency BUKAN USD
                    ->live(onBlur: true) // Update saat keluar dari field
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                        if (is_numeric($state)) {
                            $rate = CurrencyService::getRate('USD', 'IDR');
                            $set('amount', round($state * $rate, 0));
                        }
                    }),

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->columnSpanFull(),
                
                Forms\Components\Toggle::make('is_paid')
                    ->label('Tandai Sebagai Sudah Lunas')
                    ->default(true) // Saat buat manual, asumsikan sudah lunas
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex(),

                Tables\Columns\TextColumn::make('date_transaction')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('vendor.name')
                    ->searchable()
                    ->sortable()
                    ->description(function ($record) {
                        if ($record->vendor?->is_active) {
                            return $record->vendor->recurring_type;
                        }
                        return null;
                    }),
                
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),

                // --- PERUBAHAN TABEL: TAMPILKAN KEDUA NILAI ---
                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah (IDR)')
                    ->money('IDR') // Gunakan helper money dari Filament
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount_dollar')
                    ->label('Jumlah (USD)')
                    ->money('USD') // Gunakan helper money dari Filament
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Invoice'),

                BadgeColumn::make('is_paid') // ... dari langkah sebelumnya
                    ->label('Status'),


                ToggleColumn::make('is_paid')
                    ->label('Lunas?'),
            ])->defaultSort('date_transaction', 'desc')



                    // --- MULAI PENAMBAHAN FILTER DI SINI ---
            ->filters([
                // Filter 1: Berdasarkan Rentang Tanggal
                DateRangeFilter::make('date_transaction')
                    ->label('Rentang Tanggal'),

                // Filter 2: Berdasarkan Kategori
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                // Filter 3: Berdasarkan Vendor
                SelectFilter::make('vendor_id')
                    ->label('Vendor')
                    ->relationship('vendor', 'name')
                    ->searchable()
                    ->preload(),

                // ... filter Anda yang sudah ada ...
                DateRangeFilter::make('date_transaction')
                    ->label('Rentang Tanggal'),
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('vendor_id')
                    ->label('Vendor')
                    ->relationship('vendor', 'name')
                    ->searchable()
                    ->preload(),

                // --- TAMBAHKAN FILTER STATUS INI ---
                TernaryFilter::make('is_paid')
                    ->label('Status Pelunasan')
                    ->trueLabel('Lunas')
                    ->falseLabel('Belum Lunas')
                    ->native(false),
            ])
            // --- AKHIR PENAMBAHAN FILTER ---
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'), // Aktifkan kembali
            'edit' => Pages\EditTransaction::route('/{record}/edit'), // Aktifkan kembali
        ];
    }    

    public static function canViewAny(): bool
    {
        return auth()->user()->role === 'admin';
    }
}