@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold text-dark">📊 Dashboard Koperasi Simpan Pinjam</h2>
            <p class="text-muted">Selamat datang kembali, Petugas! Berikut adalah ringkasan data koperasi saat ini.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100 shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-uppercase opacity-75 fw-bold small">Jumlah Anggota</h6>
                    <h2 class="fw-bold my-2">{{ $jumlah_anggota ?? 0 }}</h2>
                    <small class="opacity-75">Orang Terdaftar</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white h-100 shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-uppercase opacity-75 fw-bold small">Total Simpanan</h6>
                    <h2 class="fw-bold my-2">Rp {{ number_format($total_simpanan ?? 0, 0, ',', '.') }}</h2>
                    <small class="opacity-75">Dana Masuk</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white h-100 shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-uppercase opacity-75 fw-bold small">Total Pinjaman</h6>
                    <h2 class="fw-bold my-2">Rp {{ number_format($total_pinjaman ?? 0, 0, ',', '.') }}</h2>
                    <small class="opacity-75">Dana Dipinjamkan</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark h-100 shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-uppercase opacity-75 fw-bold small">Total Angsuran</h6>
                    <h2 class="fw-bold my-2">Rp {{ number_format($total_angsuran ?? 0, 0, ',', '.') }}</h2>
                    <small class="opacity-75">Dana Pengembalian</small>
                </div>
            </div>
        </div>
    </div>

@endsection