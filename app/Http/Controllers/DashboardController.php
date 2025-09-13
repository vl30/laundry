<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pengguna;
use App\Models\KategoriLayanan;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        $statistik = [
            'totalTransaksi' => Transaksi::count(),
            'totalPelanggan' => Pengguna::where('tipe_pengguna', 'pelanggan')->count(),
            'transaksiHariIni' => Transaksi::whereDate('created_at', Carbon::today())->count(),
            'pendapatanBulanIni' => Transaksi::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('status_transaksi', 'selesai')
                ->sum('total_harga'),
            'transaksiSelesai' => Transaksi::where('status_transaksi', 'selesai')->count(),
            'pendapatanPerBulan' => $this->getPendapatanPerBulan(),
        ];

        $transaksiTerbaru = Transaksi::with(['pelanggan', 'kategoriLayanan'])
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('Dashboard', [
            'statistik' => $statistik,
            'transaksiTerbaru' => $transaksiTerbaru
        ]);
    }

    private function getPendapatanPerBulan()
    {
        $currentYear = Carbon::now()->year;
        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = [
                'bulan' => Carbon::create()->month($i)->format('F'),
                'total' => 0
            ];
        }

        $data = DB::table('transaksi')
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('SUM(total_harga) as total'))
            ->where('status_transaksi', 'selesai')
            ->whereYear('created_at', $currentYear)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        foreach ($data as $item) {
            $months[$item->bulan]['total'] = $item->total;
        }

        return array_values($months);
    }
}
