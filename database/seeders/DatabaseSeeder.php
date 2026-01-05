<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah admin sudah ada
        $adminExists = DB::table('pengguna')
            ->where('USERNAME', 'admin')
            ->exists();

        if (!$adminExists) {
            DB::table('pengguna')->insert([
                'NAMA_USER' => 'Admin',
                'USERNAME' => 'admin',
                'PASSWORD' => 'admin123',
                'ROLE' => 'admin',
            ]);
        }
    }
}
