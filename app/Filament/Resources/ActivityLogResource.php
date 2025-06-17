<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model; // <-- TAMBAHKAN INI
use Spatie\Activitylog\Models\Activity;

class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'Sistem';
    protected static ?string $label = 'Log Aktivitas';
    protected static ?string $pluralLabel = 'Log Aktivitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('causer.name')
                    ->label('Dilakukan Oleh'),
                Forms\Components\TextInput::make('description')
                    ->label('Aktivitas'),
                Forms\Components\TextInput::make('subject_type')
                    ->label('Model Terkait'),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Waktu'),
                Forms\Components\KeyValue::make('properties.old')
                    ->label('Data Sebelum Diubah')
                    ->visible(fn ($state) => $state !== null),
                Forms\Components\KeyValue::make('properties.attributes')
                    ->label('Data Sesudah Diubah')
                    ->visible(fn ($state) => $state !== null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Aktivitas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Tipe Data')
                    ->formatStateUsing(fn ($state) => class_basename($state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('causer.name')
                    ->label('Oleh')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    // Pastikan method ini ada untuk mendaftarkan halaman
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
            'view' => Pages\ViewActivityLog::route('/{record}'),
        ];
    }

    // Fungsi ini untuk memastikan tidak ada tombol/halaman "Create"
    public static function canCreate(): bool
    {
        return false;
    }

    // --- INI BAGIAN YANG DIPERBAIKI ---
    // Type-hint diubah dari 'Activity' menjadi 'Model' agar sesuai dengan parent class
    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->role === 'admin';
    }
}