<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Anggota;

class PinjamanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $pinjaman = Pinjaman::with('anggota')
            ->when($keyword, fn($q) => $q->whereHas('anggota', fn($q2) => $q2->where('nama', 'like', "%{$keyword}%")))
            ->orderByDesc('tanggal_pinjaman')
            ->paginate(10)
            ->withQueryString();

        $anggotas = Anggota::orderBy('nama')->get();

        return view('pinjaman.index', compact('pinjaman', 'anggotas'));
    }

    public function create()
    {
        $anggotas = Anggota::orderBy('nama')->get();
        return view('pinjaman.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pinjaman' => 'required|date',
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah_pinjaman' => 'required|numeric|min:0',
            'lama_angsuran' => 'required|integer|min:1',
        ], [
            'tanggal_pinjaman.required' => 'Tanggal pinjaman wajib diisi.',
            'anggota_id.required' => 'Anggota wajib dipilih.',
            'jumlah_pinjaman.required' => 'Jumlah pinjaman wajib diisi.',
            'jumlah_pinjaman.numeric' => 'Jumlah pinjaman harus berupa angka.',
            'jumlah_pinjaman.min' => 'Jumlah pinjaman tidak boleh negatif.',
            'lama_angsuran.required' => 'Lama angsuran wajib diisi.',
            'lama_angsuran.integer' => 'Lama angsuran harus berupa angka.',
            'lama_angsuran.min' => 'Lama angsuran minimal 1 bulan.',
        ]);

        Pinjaman::create($validated);

        return redirect()->route('pinjaman.index')->with('success', 'Data pinjaman berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $pinjaman = Pinjaman::with('anggota')->findOrFail($id);
        return view('pinjaman.show', compact('pinjaman'));
    }

    public function edit(string $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $anggotas = Anggota::orderBy('nama')->get();
        return view('pinjaman.edit', compact('pinjaman', 'anggotas'));
    }

    public function update(Request $request, string $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        $validated = $request->validate([
            'tanggal_pinjaman' => 'required|date',
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah_pinjaman' => 'required|numeric|min:0',
            'lama_angsuran' => 'required|integer|min:1',
        ], [
            'tanggal_pinjaman.required' => 'Tanggal pinjaman wajib diisi.',
            'anggota_id.required' => 'Anggota wajib dipilih.',
            'jumlah_pinjaman.required' => 'Jumlah pinjaman wajib diisi.',
            'jumlah_pinjaman.numeric' => 'Jumlah pinjaman harus berupa angka.',
            'jumlah_pinjaman.min' => 'Jumlah pinjaman tidak boleh negatif.',
            'lama_angsuran.required' => 'Lama angsuran wajib diisi.',
            'lama_angsuran.integer' => 'Lama angsuran harus berupa angka.',
            'lama_angsuran.min' => 'Lama angsuran minimal 1 bulan.',
        ]);

        $pinjaman->update($validated);

        return redirect()->route('pinjaman.index')->with('success', 'Data pinjaman berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->delete();

        return redirect()->route('pinjaman.index')->with('success', 'Data pinjaman berhasil dihapus.');
    }
}
