@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold text-dark">✏️ Edit Data Pinjaman</h2>
            <p class="text-muted">Perbarui data pinjaman dengan form berikut</p>
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
            <form action="{{ route('pinjaman.update', $pinjaman->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="tanggal_pinjaman" class="form-label fw-semibold">Tanggal Pinjaman <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="tanggal_pinjaman" id="tanggal_pinjaman" value="{{ old('tanggal_pinjaman', $pinjaman->tanggal_pinjaman) }}" required>
                </div>
                <div class="mb-3">
                    <label for="anggota_id" class="form-label fw-semibold">Anggota <span class="text-danger">*</span></label>
                    <select class="form-select" name="anggota_id" id="anggota_id" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($anggotas as $anggota)
                            <option value="{{ $anggota->id }}" {{ old('anggota_id', $pinjaman->anggota_id) == $anggota->id ? 'selected' : '' }}>
                                {{ $anggota->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah_pinjaman" class="form-label fw-semibold">Jumlah Pinjaman (Rp) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" name="jumlah_pinjaman" id="jumlah_pinjaman" value="{{ old('jumlah_pinjaman', $pinjaman->jumlah_pinjaman) }}" required>
                </div>
                <div class="mb-3">
                    <label for="lama_angsuran" class="form-label fw-semibold">Lama Angsuran (Bulan) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="lama_angsuran" id="lama_angsuran" value="{{ old('lama_angsuran', $pinjaman->lama_angsuran) }}" min="1" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning fw-semibold">💾 Perbarui</button>
                    <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary fw-semibold">↩️ Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
