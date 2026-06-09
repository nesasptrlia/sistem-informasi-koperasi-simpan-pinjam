<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Angsuran;
use App\Models\Anggota;

class AngsuranController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $angsuran = Angsuran::with('anggota')
            ->when($keyword, fn($q) => $q->whereHas('anggota', fn($q2) => $q2->where('nama', 'like', "%{$keyword}%")))
            ->orderByDesc('tanggal_bayar')
            ->paginate(10)
            ->withQueryString();

        $anggotas = Anggota::orderBy('nama')->get();

        return view('angsuran.index', compact('angsuran', 'anggotas'));
    }

    public function create()
    {
        $anggotas = Anggota::orderBy('nama')->get();
        return view('angsuran.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_bayar' => 'required|date',
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah_bayar' => 'required|numeric|min:0',
        ], [
            'tanggal_bayar.required' => 'Tanggal bayar wajib diisi.',
            'anggota_id.required' => 'Anggota wajib dipilih.',
            'jumlah_bayar.required' => 'Jumlah bayar wajib diisi.',
            'jumlah_bayar.numeric' => 'Jumlah bayar harus berupa angka.',
            'jumlah_bayar.min' => 'Jumlah bayar tidak boleh negatif.',
        ]);

        Angsuran::create($validated);

        return redirect()->route('angsuran.index')->with('success', 'Data angsuran berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $angsuran = Angsuran::with('anggota')->findOrFail($id);
        return view('angsuran.show', compact('angsuran'));
    }

    public function edit(string $id)
    {
        $angsuran = Angsuran::findOrFail($id);
        $anggotas = Anggota::orderBy('nama')->get();
        return view('angsuran.edit', compact('angsuran', 'anggotas'));
    }

    public function update(Request $request, string $id)
    {
        $angsuran = Angsuran::findOrFail($id);

        $validated = $request->validate([
            'tanggal_bayar' => 'required|date',
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah_bayar' => 'required|numeric|min:0',
        ], [
            'tanggal_bayar.required' => 'Tanggal bayar wajib diisi.',
            'anggota_id.required' => 'Anggota wajib dipilih.',
            'jumlah_bayar.required' => 'Jumlah bayar wajib diisi.',
            'jumlah_bayar.numeric' => 'Jumlah bayar harus berupa angka.',
            'jumlah_bayar.min' => 'Jumlah bayar tidak boleh negatif.',
        ]);

        $angsuran->update($validated);

        return redirect()->route('angsuran.index')->with('success', 'Data angsuran berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $angsuran = Angsuran::findOrFail($id);
        $angsuran->delete();

        return redirect()->route('angsuran.index')->with('success', 'Data angsuran berhasil dihapus.');
    }
}
