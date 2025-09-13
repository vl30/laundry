<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLayanan extends Model
{
    use HasFactory;

    protected $table = 'kategori_layanan';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'harga_per_kg',
        'estimasi_hari',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'harga_per_kg' => 'decimal:2',
            'aktif' => 'boolean',
        ];
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_kategori_layanan');
    }
}
