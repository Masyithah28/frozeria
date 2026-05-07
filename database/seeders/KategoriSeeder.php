<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Ayam',     'deskripsi' => 'Produk olahan daging ayam beku seperti nugget, sosis, dan fillet.', 'created_at' => '2026-01-01'],
            ['nama_kategori' => 'Seafood',  'deskripsi' => 'Produk olahan hasil laut beku seperti udang, cumi, dan ikan.', 'created_at' => '2026-01-01'],
            ['nama_kategori' => 'Sapi',     'deskripsi' => 'Produk olahan daging sapi beku seperti bakso, burger, dan sosis.', 'created_at' => '2026-05-01'],
            ['nama_kategori' => 'Sayuran',  'deskripsi' => 'Produk sayuran beku seperti edamame, jagung, dan campuran sayur.', 'created_at' => '2026-10-01'],
            ['nama_kategori' => 'Siap saji','deskripsi' => 'Produk makanan beku siap saji seperti dimsum, gyoza, dan spring roll.', 'created_at' => '2026-12-01'],
        ];

        foreach ($kategoris as $kat) {
            Kategori::create([
                'nama_kategori' => $kat['nama_kategori'],
                'deskripsi'     => $kat['deskripsi'],
                'created_at'    => $kat['created_at'],
                'updated_at'    => $kat['created_at'],
            ]);
        }
    }
}
