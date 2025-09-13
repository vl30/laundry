<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pengguna;
use App\Models\KategoriLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Inertia\Inertia;

class TransaksiController extends Controller
{
    public function index()
    {
        $daftarTransaksi = Transaksi::with(['pelanggan', 'kasir', 'kategoriLayanan'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Transaksi/DaftarTransaksi', [
            'daftarTransaksi' => $daftarTransaksi
        ]);
    }

    public function create()
    {
        $daftarPelanggan = Pengguna::where('tipe_pengguna', 'pelanggan')->get();
        $daftarKategoriLayanan = KategoriLayanan::where('aktif', true)->get();

        return Inertia::render('Transaksi/TambahTransaksi', [
            'daftarPelanggan' => $daftarPelanggan,
            'daftarKategoriLayanan' => $daftarKategoriLayanan
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pengguna,id',
            'id_kategori_layanan' => 'required|exists:kategori_layanan,id',
            'berat_kg' => 'required|numeric|min:0.1',
            'catatan' => 'nullable|string',
        ]);

        $kategoriLayanan = KategoriLayanan::findOrFail($request->id_kategori_layanan);
        $totalHarga = $request->berat_kg * $kategoriLayanan->harga_per_kg;
        $tanggalMasuk = Carbon::now();
        $tanggalEstimasiSelesai = $tanggalMasuk->copy()->addDays($kategoriLayanan->estimasi_hari);

        Transaksi::create([
            'kode_transaksi' => 'VLT-' . Str::upper(Str::random(8)),
            'id_pelanggan' => $request->id_pelanggan,
            'id_kasir' => auth()->id(),
            'id_kategori_layanan' => $request->id_kategori_layanan,
            'berat_kg' => $request->berat_kg,
            'total_harga' => $totalHarga,
            'status_transaksi' => 'menunggu',
            'status_pembayaran' => 'belum_bayar',
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_estimasi_selesai' => $tanggalEstimasiSelesai,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['pelanggan', 'kasir', 'kategoriLayanan', 'pembayaran']);

        return Inertia::render('Transaksi/DetailTransaksi', [
            'transaksi' => $transaksi
        ]);
    }

    public function edit(Transaksi $transaksi)
    {
        $daftarPelanggan = Pengguna::where('tipe_pengguna', 'pelanggan')->get();
        $daftarKategoriLayanan = KategoriLayanan::where('aktif', true)->get();

        return Inertia::render('Transaksi/EditTransaksi', [
            'transaksi' => $transaksi,
            'daftarPelanggan' => $daftarPelanggan,
            'daftarKategoriLayanan' => $daftarKategoriLayanan
        ]);
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pengguna,id',
            'id_kategori_layanan' => 'required|exists:kategori_layanan,id',
            'berat_kg' => 'required|numeric|min:0',
            'status_transaksi' => 'required|in:menunggu,dicuci,dijemur,disetrika,selesai,diambil',
            'catatan' => 'nullable|string',
        ]);

        $kategoriLayanan = KategoriLayanan::find($validated['id_kategori_layanan']);
        $validated['total_harga'] = $validated['berat_kg'] * $kategoriLayanan->harga_per_kg;

        $transaksi->update($validated);

        return redirect()
            ->route('transaksi.show', $transaksi)
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }

    public function trackPesanan($kodePesanan)
    {
        $transaksi = Transaksi::with(['pelanggan', 'kasir', 'kategoriLayanan'])
            ->where('kode_transaksi', $kodePesanan)
            ->first();

        if (!$transaksi) {
            return response()->json(['error' => 'Pesanan tidak ditemukan'], 404);
        }

        $statusTimeline = [
            [
                'status' => 'menunggu',
                'label' => 'Pesanan Diterima',
                'time' => $transaksi->tanggal_masuk,
                'active' => $transaksi->status_transaksi === 'menunggu'
            ],
            [
                'status' => 'dicuci',
                'label' => 'Sedang Dicuci',
                'time' => null,
                'active' => $transaksi->status_transaksi === 'dicuci'
            ],
            [
                'status' => 'dijemur',
                'label' => 'Sedang Dijemur',
                'time' => null,
                'active' => $transaksi->status_transaksi === 'dijemur'
            ],
            [
                'status' => 'disetrika',
                'label' => 'Sedang Disetrika',
                'time' => null,
                'active' => $transaksi->status_transaksi === 'disetrika'
            ],
            [
                'status' => 'selesai',
                'label' => 'Siap Diambil',
                'time' => null,
                'active' => $transaksi->status_transaksi === 'selesai'
            ],
            [
                'status' => 'diambil',
                'label' => 'Sudah Diambil',
                'time' => null,
                'active' => $transaksi->status_transaksi === 'diambil'
            ]
        ];

        return response()->json([
            'transaksi' => $transaksi,
            'timeline' => $statusTimeline
        ]);
    }
}
