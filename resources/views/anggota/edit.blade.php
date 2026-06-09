@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold text-dark">✏️ Edit Data Anggota</h2>
            <p class="text-muted">Perbarui data anggota dengan form berikut</p>
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
            <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $anggota->nama) }}" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" required>{{ old('alamat', $anggota->alamat) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="no_telepon" class="form-label fw-semibold">No. Telepon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', $anggota->no_telepon) }}" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning fw-semibold">💾 Perbarui</button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-secondary fw-semibold">↩️ Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
