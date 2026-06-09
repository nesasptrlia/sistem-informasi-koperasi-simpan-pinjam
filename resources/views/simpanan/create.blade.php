@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold text-dark">➕ Tambah Simpanan</h2>
            <p class="text-muted">Isi form berikut untuk menambahkan data simpanan</p>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('simpanan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="tanggal" class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                </div>
                <div class="mb-3">
                    <label for="anggota_id" class="form-label fw-semibold">Anggota <span class="text-danger">*</span></label>
                    <select class="form-select" name="anggota_id" id="anggota_id" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($anggotas as $anggota)
                            <option value="{{ $anggota->id }}" {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
                                {{ $anggota->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenis_simpanan" class="form-label fw-semibold">Jenis Simpanan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="jenis_simpanan" id="jenis_simpanan" value="{{ old('jenis_simpanan') }}" placeholder="Contoh: Simpanan Wajib, Sukarela" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label fw-semibold">Jumlah (Rp) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success fw-semibold">💾 Simpan</button>
                    <a href="{{ route('simpanan.index') }}" class="btn btn-secondary fw-semibold">↩️ Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
