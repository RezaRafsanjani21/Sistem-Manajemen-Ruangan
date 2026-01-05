<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Pengguna extends Authenticatable implements FilamentUser, HasName
{
    use Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'ID_USER';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_USER',
        'USERNAME',
        'PASSWORD',
        'ROLE',
    ];

    protected $hidden = ['PASSWORD'];

    // Override method untuk authentication
    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }

    public function getRememberTokenName()
    {
        return null; // Disable remember token
    }

    // Relasi ke PeminjamanRuangan
    public function peminjaman()
    {
        return $this->hasMany(PeminjamanRuangan::class, 'ID_USER', 'ID_USER');
    }

    // Mutator untuk auto-hash password saat create/update
    public function setPasswordAttribute($value)
    {
        // Jika password belum di-hash, hash dulu
        if (!str_starts_with($value, '$2y$')) {
            $this->attributes['PASSWORD'] = Hash::make($value);
        } else {
            $this->attributes['PASSWORD'] = $value;
        }
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->ROLE === 'admin';
    }

    public function getFilamentName(): string
    {
        return $this->NAMA_USER ?: $this->USERNAME;
    }
}
