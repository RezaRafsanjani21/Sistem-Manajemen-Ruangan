<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_KEGIATAN',
        'PENANGGUNG_JAWAB',
        'KETERANGAN'
    ];

    public function peminjaman()
    {
        return $this->hasMany(PeminjamanRuangan::class, 'ID_KEGIATAN', 'id_kegiatan');
    }
}
