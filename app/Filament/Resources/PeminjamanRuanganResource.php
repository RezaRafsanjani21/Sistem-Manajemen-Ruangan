<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeminjamanRuanganResource\Pages;
use App\Models\PeminjamanRuangan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class PeminjamanRuanganResource extends Resource
{
    protected static ?string $model = PeminjamanRuangan::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Peminjaman Ruangan';
    protected static ?string $modelLabel = 'Peminjaman';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ID_RUANGAN')
                    ->label('Ruangan')
                    ->relationship('ruangan', 'NAMA_RUANGAN')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('ID_KEGIATAN')
                    ->label('Kegiatan')
                    ->relationship('kegiatan', 'NAMA_KEGIATAN')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('ID_WAKTU')
                    ->label('Waktu')
                    ->relationship('waktu', 'TANGGAL')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('ID_USER')
                    ->label('User')
                    ->relationship('user', 'NAMA_USER')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('STATUS')
                    ->label('Status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                        'selesai' => 'Selesai',
                    ])
                    ->required()
                    ->default('menunggu'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ID_PEMINJAMAN')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.NAMA_USER')
                    ->label('Pemohon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ruangan.NAMA_RUANGAN')
                    ->label('Ruangan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kegiatan.NAMA_KEGIATAN')
                    ->label('Kegiatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu.TANGGAL')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('STATUS')
                    ->label('Status')
                    ->colors([
                        'warning' => 'menunggu',
                        'success' => 'disetujui',
                        'danger' => 'ditolak',
                        'secondary' => 'selesai',
                    ]),
            ])
            ->defaultSort('ID_PEMINJAMAN', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('STATUS')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                        'selesai' => 'Selesai',
                    ]),
                Tables\Filters\SelectFilter::make('ID_RUANGAN')
                    ->label('Ruangan')
                    ->relationship('ruangan', 'NAMA_RUANGAN'),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (PeminjamanRuangan $record) {
                        $record->STATUS = 'disetujui';
                        $record->save();
                        
                        Notification::make()
                            ->title('Peminjaman Disetujui')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (PeminjamanRuangan $record) => $record->STATUS === 'menunggu'),
                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (PeminjamanRuangan $record) {
                        $record->STATUS = 'ditolak';
                        $record->save();
                        
                        Notification::make()
                            ->title('Peminjaman Ditolak')
                            ->warning()
                            ->send();
                    })
                    ->visible(fn (PeminjamanRuangan $record) => $record->STATUS === 'menunggu'),
                Tables\Actions\Action::make('complete')
                    ->label('Selesai')
                    ->icon('heroicon-o-check-badge')
                    ->color('secondary')
                    ->requiresConfirmation()
                    ->action(function (PeminjamanRuangan $record) {
                        $record->STATUS = 'selesai';
                        $record->save();
                        
                        Notification::make()
                            ->title('Peminjaman Selesai')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (PeminjamanRuangan $record) => $record->STATUS === 'disetujui'),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPeminjamanRuangans::route('/'),
            'create' => Pages\CreatePeminjamanRuangan::route('/create'),
            'edit' => Pages\EditPeminjamanRuangan::route('/{record}/edit'),
            'view' => Pages\ViewPeminjamanRuangan::route('/{record}'),
        ];
    }
}
