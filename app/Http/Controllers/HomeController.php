<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PeminjamanRuangan;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $userId = Auth::id();

        $totalPeminjaman = PeminjamanRuangan::where('ID_USER', $userId)->count();
        $menunggu = PeminjamanRuangan::where('ID_USER', $userId)
            ->whereIn('STATUS', ['menunggu', 'Menunggu', 'pending', 'Pending'])
            ->count();
        $disetujui = PeminjamanRuangan::where('ID_USER', $userId)
            ->whereIn('STATUS', ['disetujui', 'Disetujui'])
            ->count();
        $selesai = PeminjamanRuangan::where('ID_USER', $userId)
            ->whereIn('STATUS', ['selesai', 'Selesai'])
            ->count();

        return view('dashboard', compact('totalPeminjaman', 'menunggu', 'disetujui', 'selesai'));
    }
}
