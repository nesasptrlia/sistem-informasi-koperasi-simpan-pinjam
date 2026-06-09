@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row mb-3 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark">🧾 Data Angsuran Anggota</h2>
            <p class="text-muted small">Kelola data seluruh angsuran anggota</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('angsuran.create') }}" class="btn btn-warning fw-semibold shadow-sm">+ Tambah Angsuran</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('angsuran.index') }}" method="GET" class="row g-2">
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
                <thead class="table-warning text-dark">
                    <tr>
                        <th class="ps-3">Tanggal Bayar</th>
                        <th>Nama Anggota</th>
                        <th>Jumlah Bayar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($angsuran as $row)
                        <tr>
                            <td class="ps-3">{{ \Carbon\Carbon::parse($row->tanggal_bayar)->format('d/m/Y') }}</td>
                            <td class="fw-semibold">{{ $row->anggota->nama ?? 'Tidak Diketahui' }}</td>
                            <td class="text-success fw-bold">Rp {{ number_format($row->jumlah_bayar, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('angsuran.edit', $row->id) }}" class="btn btn-sm btn-warning fw-semibold">📝 Edit</a>
                                <form action="{{ route('angsuran.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger fw-semibold">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">📭 Belum ada data angsuran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $angsuran->links() }}
    </div>
</div>
@endsection
