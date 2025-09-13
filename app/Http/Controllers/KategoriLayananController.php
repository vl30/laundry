<?php

namespace App\Http\Controllers;

use App\Models\KategoriLayanan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KategoriLayananController extends Controller
{
    public function index()
    {
        $daftarKategoriLayanan = KategoriLayanan::orderBy('created_at', 'desc')->paginate(10);

        return Inertia::render('KategoriLayanan/DaftarKategoriLayanan', [
            'daftarKategoriLayanan' => $daftarKategoriLayanan
        ]);
    }

    public function create()
    {
        return Inertia::render('KategoriLayanan/TambahKategoriLayanan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_kg' => 'required|numeric|min:0',
            'estimasi_hari' => 'required|integer|min:1',
        ]);

        KategoriLayanan::create($request->all());

        return redirect()->route('kategori-layanan.index')->with('success', 'Kategori layanan berhasil ditambahkan');
    }

    public function show(KategoriLayanan $kategoriLayanan)
    {
        return Inertia::render('KategoriLayanan/DetailKategoriLayanan', [
            'kategoriLayanan' => $kategoriLayanan
        ]);
    }

    public function edit(KategoriLayanan $kategoriLayanan)
    {
        return Inertia::render('KategoriLayanan/EditKategoriLayanan', [
            'kategoriLayanan' => $kategoriLayanan
        ]);
    }

    public function update(Request $request, KategoriLayanan $kategoriLayanan)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_kg' => 'required|numeric|min:0',
            'estimasi_hari' => 'required|integer|min:1',
        ]);

        $kategoriLayanan->update($request->all());

        return redirect()->route('kategori-layanan.index')->with('success', 'Kategori layanan berhasil diperbarui');
    }

    public function destroy(KategoriLayanan $kategoriLayanan)
    {
        $kategoriLayanan->delete();
        return redirect()->route('kategori-layanan.index')->with('success', 'Kategori layanan berhasil dihapus');
    }
}
