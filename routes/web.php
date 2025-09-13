<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriLayananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Beranda');
})->name('beranda');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(PenggunaController::class)->group(function () {
        Route::get('/pengguna', 'index')->name('pengguna.index');
        Route::get('/pengguna/create', 'create')->name('pengguna.create');
        Route::post('/pengguna', 'store')->name('pengguna.store');
        Route::get('/pengguna/{pengguna}', 'show')->name('pengguna.show');
        Route::get('/pengguna/{pengguna}/edit', 'edit')->name('pengguna.edit');
        Route::put('/pengguna/{pengguna}', 'update')->name('pengguna.update');
        Route::delete('/pengguna/{pengguna}', 'destroy')->name('pengguna.destroy');
    });

    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/transaksi', 'index')->name('transaksi.index');
        Route::get('/transaksi/create', 'create')->name('transaksi.create');
        Route::post('/transaksi', 'store')->name('transaksi.store');
        Route::get('/transaksi/{transaksi}', 'show')->name('transaksi.show');
        Route::get('/transaksi/{transaksi}/edit', 'edit')->name('transaksi.edit');
        Route::put('/transaksi/{transaksi}', 'update')->name('transaksi.update');
        Route::delete('/transaksi/{transaksi}', 'destroy')->name('transaksi.destroy');
    });

    Route::controller(KategoriLayananController::class)->group(function () {
        Route::get('/kategori-layanan', 'index')->name('kategori-layanan.index');
        Route::get('/kategori-layanan/create', 'create')->name('kategori-layanan.create');
        Route::post('/kategori-layanan', 'store')->name('kategori-layanan.store');
        Route::get('/kategori-layanan/{kategoriLayanan}', 'show')->name('kategori-layanan.show');
        Route::get('/kategori-layanan/{kategoriLayanan}/edit', 'edit')->name('kategori-layanan.edit');
        Route::put('/kategori-layanan/{kategoriLayanan}', 'update')->name('kategori-layanan.update');
        Route::delete('/kategori-layanan/{kategoriLayanan}', 'destroy')->name('kategori-layanan.destroy');
    });
});

Route::get('/tracking/{kodePesanan}', [TransaksiController::class, 'trackPesanan']);
Route::get('/about', function () {
    return view('about');
});

Route::get('/test-db-connection', function() {
    if (request()->has('clear-cache')) {
        Artisan::call('config:clear');
        return response()->json([
            'status' => 'success',
            'message' => 'Cache berhasil dibersihkan'
        ]);
    }

    if (request()->has('migrate')) {
        try {
            Artisan::call('migrate');
            return response()->json([
                'status' => 'success',
                'message' => 'Migrasi berhasil dijalankan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menjalankan migrasi: ' . $e->getMessage()
            ]);
        }
    }

    try {
        $connection = DB::connection()->getPdo();
        $config = Config::get('database.connections.' . Config::get('database.default'));

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil terhubung ke database',
            'config' => [
                'connection' => Config::get('database.default'),
                'database' => $config['database'],
                'host' => $config['host'],
                'port' => $config['port'],
                'username' => $config['username']
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Tidak dapat terhubung ke database: ' . $e->getMessage(),
            'config' => [
                'connection' => Config::get('database.default'),
                'database' => Config::get('database.connections.' . Config::get('database.default') . '.database'),
                'host' => Config::get('database.connections.' . Config::get('database.default') . '.host'),
                'port' => Config::get('database.connections.' . Config::get('database.default') . '.port'),
                'username' => Config::get('database.connections.' . Config::get('database.default') . '.username')
            ]
        ]);
    }
});

Route::get('/test-db', function() {
    return view('test-db');
});
