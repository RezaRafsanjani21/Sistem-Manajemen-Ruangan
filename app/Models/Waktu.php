<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Waktu extends Model
{
    use HasFactory;

    protected $table = 'waktu';
    protected $primaryKey = 'ID_WAKTU';
    public $timestamps = false;

    protected $fillable = [
        'TANGGAL',
        'JAM_MULAI',
        'JAM_SELESAI',
    ];

    protected $casts = [
        'TANGGAL' => 'datetime',
        'JAM_MULAI' => 'datetime',
        'JAM_SELESAI' => 'datetime',
    ];

    public function peminjaman()
    {
        return $this->hasMany(PeminjamanRuangan::class, 'ID_WAKTU', 'ID_WAKTU');
    }
}
