<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('id_pelanggan')->constrained('pengguna');
            $table->foreignId('id_kasir')->constrained('pengguna');
            $table->foreignId('id_kategori_layanan')->constrained('kategori_layanan');
            $table->decimal('berat_kg', 8, 2);
            $table->decimal('total_harga', 10, 2);
            $table->enum('status_transaksi', ['menunggu', 'dicuci', 'dijemur', 'disetrika', 'selesai', 'diambil']);
            $table->enum('status_pembayaran', ['belum_bayar', 'lunas']);
            $table->datetime('tanggal_masuk');
            $table->datetime('tanggal_estimasi_selesai');
            $table->datetime('tanggal_selesai')->nullable();
            $table->datetime('tanggal_diambil')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
