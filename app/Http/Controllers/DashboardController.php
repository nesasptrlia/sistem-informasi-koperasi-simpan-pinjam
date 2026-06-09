<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil statistik data untuk ditampilkan di kotak dashboard
        $jumlah_anggota = Anggota::count();
        $total_simpanan = Simpanan::sum('jumlah');
        $total_pinjaman = Pinjaman::sum('jumlah_pinjaman');
        $total_angsuran = Angsuran::sum('jumlah_bayar');

        return view('dashboard', compact('jumlah_anggota', 'total_simpanan', 'total_pinjaman', 'total_angsuran'));
    }
}