<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorResource\Pages;
use App\Filament\Resources\VendorResource\RelationManagers;
use App\Models\Vendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?int $navigationSort = 2; // angka kecil = di atas
    protected static ?string $navigationGroup = 'Manajemen Data';
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            // BAGIAN 1: Informasi umum tentang Vendor
            Forms\Components\Section::make('Informasi Vendor')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Vendor')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(), // Ambil lebar penuh

                    // vendor_start dan vendor_end dipindahkan ke sini karena ini
                    // adalah informasi dasar vendor, bukan hanya untuk recurring.
                    Forms\Components\DatePicker::make('vendor_start')
                        ->label('Tanggal Mulai Kontrak')
                        ->required(),

                    Forms\Components\DatePicker::make('vendor_end')
                        ->label('Tanggal Akhir Kontrak'),
                ])
                ->columns(2), // Membuat layout menjadi 2 kolom

            // BAGIAN 2: Pengaturan khusus untuk tagihan berulang
            Forms\Components\Section::make('Pengaturan Tagihan Berulang (Recurring)')
                ->description('Aktifkan jika vendor ini memiliki tagihan rutin bulanan atau tahunan.')
                ->schema([
                    Forms\Components\Toggle::make('is_active')
                        ->label('Jadikan Vendor Recurring?')
                        ->live(), // Penting agar form langsung bereaksi

                    // recurring_type dipindahkan ke sini, di dalam grupnya.
                    // Field ini hanya akan muncul jika toggle di atas aktif.
                    Forms\Components\Select::make('recurring_type')
                        ->label('Jenis Tagihan')
                        ->options([
                            'Bulanan' => 'Bulanan',
                            'Tahunan' => 'Tahunan',
                        ])
                        ->required(fn (Get $get) => $get('is_active')) // Wajib diisi HANYA jika recurring aktif
                        ->visible(fn (Get $get) => $get('is_active')), // Terlihat HANYA jika recurring aktif
                ])
                ->columns(2),
        ]);

    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\IconColumn::make('is_active')->label('Recurring')->boolean(),
                Tables\Columns\TextColumn::make('recurring_type')->label('Jenis Tagihan'),
                Tables\Columns\TextColumn::make('vendor_start')->date()->sortable(),
                Tables\Columns\TextColumn::make('vendor_end')->date()->sortable(),
            ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->role === 'admin';
    }
}
