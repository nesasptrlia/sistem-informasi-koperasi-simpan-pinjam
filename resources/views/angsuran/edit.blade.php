@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold text-dark">✏️ Edit Data Angsuran</h2>
            <p class="text-muted">Perbarui data angsuran dengan form berikut</p>
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
            <form action="{{ route('angsuran.update', $angsuran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="tanggal_bayar" class="form-label fw-semibold">Tanggal Bayar <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="tanggal_bayar" id="tanggal_bayar" value="{{ old('tanggal_bayar', $angsuran->tanggal_bayar) }}" required>
                </div>
                <div class="mb-3">
                    <label for="anggota_id" class="form-label fw-semibold">Anggota <span class="text-danger">*</span></label>
                    <select class="form-select" name="anggota_id" id="anggota_id" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($anggotas as $anggota)
                            <option value="{{ $anggota->id }}" {{ old('anggota_id', $angsuran->anggota_id) == $anggota->id ? 'selected' : '' }}>
                                {{ $anggota->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah_bayar" class="form-label fw-semibold">Jumlah Bayar (Rp) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" name="jumlah_bayar" id="jumlah_bayar" value="{{ old('jumlah_bayar', $angsuran->jumlah_bayar) }}" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning fw-semibold">💾 Perbarui</button>
                    <a href="{{ route('angsuran.index') }}" class="btn btn-secondary fw-semibold">↩️ Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
