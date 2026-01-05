<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenggunaResource\Pages;
use App\Models\Pengguna;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PenggunaResource extends Resource
{
    protected static ?string $model = Pengguna::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Pengguna';
    protected static ?string $modelLabel = 'Pengguna';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('NAMA_USER')
                    ->label('Nama')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('USERNAME')
                    ->label('Username')
                    ->required()
                    ->maxLength(20)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('PASSWORD')
                    ->label('Password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->maxLength(12),
                Forms\Components\Select::make('ROLE')
                    ->label('Role')
                    ->options([
                        'admin' => 'Admin',
                        'penanggung_jawab' => 'Penanggung Jawab',
                        'user' => 'User',
                    ])
                    ->required()
                    ->default('user'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ID_USER')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('NAMA_USER')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('USERNAME')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('ROLE')
                    ->label('Role')
                    ->colors([
                        'danger' => 'admin',
                        'warning' => 'penanggung_jawab',
                        'success' => 'user',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('ROLE')
                    ->options([
                        'admin' => 'Admin',
                        'penanggung_jawab' => 'Penanggung Jawab',
                        'user' => 'User',
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
            'index' => Pages\ListPenggunas::route('/'),
            'create' => Pages\CreatePengguna::route('/create'),
            'edit' => Pages\EditPengguna::route('/{record}/edit'),
        ];
    }
}
