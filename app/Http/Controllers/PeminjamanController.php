<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use App\Models\Kegiatan;
use App\Models\Waktu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = PeminjamanRuangan::with(['ruangan', 'kegiatan', 'waktu'])
            ->where('ID_USER', Auth::id())
            ->get();

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $ruangan = Ruangan::where('STATUS', 'tersedia')->get();
        $kegiatan = Kegiatan::all();

        return view('peminjaman.create', compact('ruangan', 'kegiatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_RUANGAN' => 'required|exists:ruangan,ID_RUANGAN',
            'NAMA_KEGIATAN' => 'required|string|max:30',
            'PENANGGUNG_JAWAB' => 'required|string|max:30',
            'KETERANGAN' => 'nullable|string',
            'TANGGAL' => 'required|date',
            'JAM_MULAI' => 'required|date_format:H:i',
            'JAM_SELESAI' => 'required|date_format:H:i|after:JAM_MULAI',
        ]);

        // Validasi: minimal 2 jam
        $jamMulai = Carbon::parse($request->TANGGAL . ' ' . $request->JAM_MULAI);
        $jamSelesai = Carbon::parse($request->TANGGAL . ' ' . $request->JAM_SELESAI);
        $durasi = $jamMulai->diffInHours($jamSelesai);

        if ($durasi < 2) {
            return back()->withErrors(['JAM_SELESAI' => 'Durasi peminjaman minimal 2 jam'])->withInput();
        }

        // Validasi: jam 08:00 - 17:00
        $waktuMulai = Carbon::parse($request->JAM_MULAI);
        $waktuSelesai = Carbon::parse($request->JAM_SELESAI);
        
        if ($waktuMulai->hour < 8 || $waktuSelesai->hour > 17 || ($waktuSelesai->hour == 17 && $waktuSelesai->minute > 0)) {
            return back()->withErrors(['JAM_MULAI' => 'Peminjaman hanya diperbolehkan antara pukul 08:00 - 17:00'])->withInput();
        }

        DB::beginTransaction();
        try {
            // Buat atau ambil kegiatan
            $kegiatan = Kegiatan::create([
                'NAMA_KEGIATAN' => $request->NAMA_KEGIATAN,
                'PENANGGUNG_JAWAB' => $request->PENANGGUNG_JAWAB,
                'KETERANGAN' => $request->KETERANGAN,
            ]);

            // Buat waktu
            $waktu = Waktu::create([
                'TANGGAL' => $request->TANGGAL,
                'JAM_MULAI' => $jamMulai,
                'JAM_SELESAI' => $jamSelesai,
            ]);

            // Buat peminjaman
            PeminjamanRuangan::create([
                'ID_RUANGAN' => $request->ID_RUANGAN,
                'ID_KEGIATAN' => $kegiatan->id_kegiatan,
                'ID_WAKTU' => $waktu->ID_WAKTU,
                'ID_USER' => Auth::id(),
                'STATUS' => 'menunggu',
            ]);

            DB::commit();

            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $peminjaman = PeminjamanRuangan::with(['ruangan', 'kegiatan', 'waktu', 'user'])
            ->findOrFail($id);

        return view('peminjaman.show', compact('peminjaman'));
    }
}
