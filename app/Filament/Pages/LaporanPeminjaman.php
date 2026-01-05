<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class LaporanPeminjaman extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static string $view = 'filament.pages.laporan-peminjaman';
    protected static ?string $navigationLabel = 'Laporan Peminjaman';
    protected static ?string $title = 'Laporan Peminjaman';
    protected static ?int $navigationSort = 4;

    public function getData()
    {
        return DB::table('view_peminjaman_5_tabel')->get();
    }

    public function getStats()
    {
        return [
            'total' => DB::table('peminjaman_ruangan')->count(),
            'menunggu' => DB::table('peminjaman_ruangan')->where('STATUS', 'menunggu')->count(),
            'disetujui' => DB::table('peminjaman_ruangan')->where('STATUS', 'disetujui')->count(),
            'selesai' => DB::table('peminjaman_ruangan')->where('STATUS', 'selesai')->count(),
        ];
    }
}
