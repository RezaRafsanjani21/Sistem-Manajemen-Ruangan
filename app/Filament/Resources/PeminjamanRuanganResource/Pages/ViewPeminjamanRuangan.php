<?php

namespace App\Filament\Resources\PeminjamanRuanganResource\Pages;

use App\Filament\Resources\PeminjamanRuanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;

class ViewPeminjamanRuangan extends ViewRecord
{
    protected static string $resource = PeminjamanRuanganResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Peminjaman')
                    ->schema([
                        TextEntry::make('ID_PEMINJAMAN')
                            ->label('ID Peminjaman'),
                        TextEntry::make('user.NAMA_USER')
                            ->label('Pemohon'),
                        TextEntry::make('STATUS')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'menunggu' => 'warning',
                                'disetujui' => 'success',
                                'ditolak' => 'danger',
                                'selesai' => 'secondary',
                            }),
                    ])->columns(3),
                Section::make('Detail Ruangan')
                    ->schema([
                        TextEntry::make('ruangan.NAMA_RUANGAN')
                            ->label('Nama Ruangan'),
                        TextEntry::make('ruangan.LOKASI')
                            ->label('Lokasi'),
                        TextEntry::make('ruangan.KAPASITAS')
                            ->label('Kapasitas')
                            ->suffix(' orang'),
                        TextEntry::make('ruangan.FASILITAS')
                            ->label('Fasilitas')
                            ->columnSpanFull(),
                    ])->columns(3),
                Section::make('Detail Kegiatan')
                    ->schema([
                        TextEntry::make('kegiatan.NAMA_KEGIATAN')
                            ->label('Nama Kegiatan'),
                        TextEntry::make('kegiatan.PENANGGUNG_JAWAB')
                            ->label('Penanggung Jawab'),
                        TextEntry::make('kegiatan.KETERANGAN')
                            ->label('Keterangan')
                            ->columnSpanFull(),
                    ])->columns(2),
                Section::make('Jadwal')
                    ->schema([
                        TextEntry::make('waktu.TANGGAL')
                            ->label('Tanggal')
                            ->date('l, d F Y'),
                        TextEntry::make('waktu.JAM_MULAI')
                            ->label('Jam Mulai')
                            ->time('H:i'),
                        TextEntry::make('waktu.JAM_SELESAI')
                            ->label('Jam Selesai')
                            ->time('H:i'),
                    ])->columns(3),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
