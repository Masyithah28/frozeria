<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'jumlah_stok',
        'satuan',
        'stok_minimum',
        'harga_jual',
        'harga_beli',
        'berat_ukuran',
        'lokasi_simpan',
        'deskripsi',
        'foto',
    ];

    protected $casts = [
        'kategori_id' => 'integer',
        'harga_jual' => 'decimal:2',
        'harga_beli' => 'decimal:2',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function isStokHabis()
    {
        return $this->jumlah_stok == 0;
    }

    public function isStokMenipis()
    {
        return $this->jumlah_stok > 0 && $this->jumlah_stok < 15;
    }

    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/foto/' . $this->foto);
        }
        return null;
    }

    public function getHargaJualFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga_jual, 0, ',', '.');
    }

    public function getHargaBeliFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga_beli, 0, ',', '.');
    }
}
