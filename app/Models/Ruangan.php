<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    protected $primaryKey = 'ID_RUANGAN';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_RUANGAN',
        'KAPASITAS',
        'LOKASI',
        'FASILITAS',
        'STATUS',
    ];

    public function peminjaman()
    {
        return $this->hasMany(PeminjamanRuangan::class, 'ID_RUANGAN', 'ID_RUANGAN');
    }
}
