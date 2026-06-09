<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;
use App\Models\Anggota;

class SimpananController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $simpanan = Simpanan::with('anggota')
            ->when($keyword, fn($q) => $q->whereHas('anggota', fn($q2) => $q2->where('nama', 'like', "%{$keyword}%")))
            ->orderByDesc('tanggal')
            ->paginate(10)
            ->withQueryString();

        $anggotas = Anggota::orderBy('nama')->get();

        return view('simpanan.index', compact('simpanan', 'anggotas'));
    }

    public function create()
    {
        $anggotas = Anggota::orderBy('nama')->get();
        return view('simpanan.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis_simpanan' => 'required|string|max:50',
            'jumlah' => 'required|numeric|min:0',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'anggota_id.required' => 'Anggota wajib dipilih.',
            'jenis_simpanan.required' => 'Jenis simpanan wajib diisi.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh negatif.',
        ]);

        Simpanan::create($validated);

        return redirect()->route('simpanan.index')->with('success', 'Data simpanan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $simpanan = Simpanan::with('anggota')->findOrFail($id);
        return view('simpanan.show', compact('simpanan'));
    }

    public function edit(string $id)
    {
        $simpanan = Simpanan::findOrFail($id);
        $anggotas = Anggota::orderBy('nama')->get();
        return view('simpanan.edit', compact('simpanan', 'anggotas'));
    }

    public function update(Request $request, string $id)
    {
        $simpanan = Simpanan::findOrFail($id);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis_simpanan' => 'required|string|max:50',
            'jumlah' => 'required|numeric|min:0',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'anggota_id.required' => 'Anggota wajib dipilih.',
            'jenis_simpanan.required' => 'Jenis simpanan wajib diisi.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh negatif.',
        ]);

        $simpanan->update($validated);

        return redirect()->route('simpanan.index')->with('success', 'Data simpanan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $simpanan = Simpanan::findOrFail($id);
        $simpanan->delete();

        return redirect()->route('simpanan.index')->with('success', 'Data simpanan berhasil dihapus.');
    }
}
