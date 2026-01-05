<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanRuangan extends Model
{
    protected $table = 'peminjaman_ruangan';
    protected $primaryKey = 'ID_PEMINJAMAN';
    public $timestamps = false;

    protected $fillable = [
        'ID_RUANGAN',
        'ID_KEGIATAN',
        'ID_WAKTU',
        'ID_USER',
        'STATUS'
    ];

    // Relasi ke Kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'ID_KEGIATAN', 'id_kegiatan');
    }

    // Relasi ke Ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ID_RUANGAN', 'ID_RUANGAN');
    }

    // Relasi ke Pengguna (user)
    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'ID_USER', 'ID_USER');
    }

    // Relasi ke Pengguna (alias)
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'ID_USER', 'ID_USER');
    }

    // Relasi ke Waktu
    public function waktu()
    {
        return $this->belongsTo(Waktu::class, 'ID_WAKTU', 'ID_WAKTU');
    }

    public function getStatusNormalizedAttribute()
    {
        return strtolower($this->STATUS ?? '');
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status_normalized) {
            'menunggu', 'pending' => 'Menunggu',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            'selesai' => 'Selesai',
            default => $this->STATUS ?: 'Menunggu',
        };
    }

    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status_normalized) {
            'disetujui' => 'bg-green-100 text-green-800',
            'ditolak' => 'bg-red-100 text-red-800',
            'selesai' => 'bg-gray-100 text-gray-800',
            default => 'bg-yellow-100 text-yellow-800',
        };
    }
}
