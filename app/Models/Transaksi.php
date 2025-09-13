<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'id_pelanggan',
        'id_kasir',
        'id_kategori_layanan',
        'berat_kg',
        'total_harga',
        'status_transaksi',
        'status_pembayaran',
        'tanggal_masuk',
        'tanggal_estimasi_selesai',
        'tanggal_selesai',
        'tanggal_diambil',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'berat_kg' => 'decimal:2',
            'total_harga' => 'decimal:2',
            'tanggal_masuk' => 'datetime',
            'tanggal_estimasi_selesai' => 'datetime',
            'tanggal_selesai' => 'datetime',
            'tanggal_diambil' => 'datetime',
        ];
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pengguna::class, 'id_pelanggan');
    }

    public function kasir()
    {
        return $this->belongsTo(Pengguna::class, 'id_kasir');
    }

    public function kategoriLayanan()
    {
        return $this->belongsTo(KategoriLayanan::class, 'id_kategori_layanan');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_transaksi');
    }
}
