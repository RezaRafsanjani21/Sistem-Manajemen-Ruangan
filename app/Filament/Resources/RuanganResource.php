<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RuanganResource\Pages;
use App\Models\Ruangan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RuanganResource extends Resource
{
    protected static ?string $model = Ruangan::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Ruangan';
    protected static ?string $modelLabel = 'Ruangan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('NAMA_RUANGAN')
                    ->label('Nama Ruangan')
                    ->required()
                    ->maxLength(25),
                Forms\Components\TextInput::make('KAPASITAS')
                    ->label('Kapasitas')
                    ->required()
                    ->numeric()
                    ->minValue(1),
                Forms\Components\TextInput::make('LOKASI')
                    ->label('Lokasi')
                    ->required()
                    ->maxLength(25),
                Forms\Components\Textarea::make('FASILITAS')
                    ->label('Fasilitas')
                    ->rows(3),
                Forms\Components\Select::make('STATUS')
                    ->label('Status')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'tidak tersedia' => 'Tidak Tersedia',
                        'dipakai' => 'Dipakai',
                    ])
                    ->required()
                    ->default('tersedia'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ID_RUANGAN')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('NAMA_RUANGAN')
                    ->label('Nama Ruangan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('KAPASITAS')
                    ->label('Kapasitas')
                    ->sortable()
                    ->suffix(' orang'),
                Tables\Columns\TextColumn::make('LOKASI')
                    ->label('Lokasi')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('STATUS')
                    ->label('Status')
                    ->colors([
                        'success' => 'tersedia',
                        'danger' => 'tidak tersedia',
                        'warning' => 'dipakai',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('STATUS')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'tidak tersedia' => 'Tidak Tersedia',
                        'dipakai' => 'Dipakai',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRuangans::route('/'),
            'create' => Pages\CreateRuangan::route('/create'),
            'edit' => Pages\EditRuangan::route('/{record}/edit'),
        ];
    }
}
