<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class PenggunaController extends Controller
{
    public function index()
    {
        $daftarPengguna = Pengguna::orderBy('created_at', 'desc')->paginate(10);

        return Inertia::render('Pengguna/DaftarPengguna', [
            'daftarPengguna' => $daftarPengguna
        ]);
    }

    public function create()
    {
        return Inertia::render('Pengguna/TambahPengguna');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna',
            'password' => 'required|string|min:8',
            'tipe_pengguna' => 'required|in:admin,kasir,pelanggan',
            'no_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipe_pengguna' => $request->tipe_pengguna,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function show(Pengguna $pengguna)
    {
        return Inertia::render('Pengguna/DetailPengguna', [
            'pengguna' => $pengguna
        ]);
    }

    public function edit(Pengguna $pengguna)
    {
        return Inertia::render('Pengguna/EditPengguna', [
            'pengguna' => $pengguna
        ]);
    }

    public function update(Request $request, Pengguna $pengguna)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna,email,' . $pengguna->id,
            'tipe_pengguna' => 'required|in:admin,kasir,pelanggan',
            'no_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $dataPengguna = [
            'nama' => $request->nama,
            'email' => $request->email,
            'tipe_pengguna' => $request->tipe_pengguna,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ];

        if ($request->password) {
            $dataPengguna['password'] = Hash::make($request->password);
        }

        $pengguna->update($dataPengguna);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
