@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row mb-3 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark">👥 Data Anggota Koperasi</h2>
            <p class="text-muted small">Kelola data seluruh anggota aktif terdaftar</p>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-primary fw-semibold shadow-sm">+ Tambah Anggota</button>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('anggota.index') }}" method="GET" class="row g-2">
                <div class="col-md-10">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari nama anggota..." value="{{ request('keyword') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100 fw-semibold">🔍 Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="table-primary text-dark">
                    <tr>
                        <th class="ps-3">ID</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggota as $row)
                        <tr>
                            <td class="ps-3">{{ $row->id }}</td>
                            <td class="fw-semibold text-primary">{{ $row->nama }}</td>
                            <td>{{ $row->alamat }}</td>
                            <td>{{ $row->no_telepon }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning fw-semibold">📝 Edit</button>
                                <button class="btn btn-sm btn-danger fw-semibold">🗑️ Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">📭 Belum ada data anggota.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection