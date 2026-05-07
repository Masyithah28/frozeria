<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Kategori;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $ayam    = Kategori::where('nama_kategori', 'Ayam')->first()->id;
        $seafood = Kategori::where('nama_kategori', 'Seafood')->first()->id;
        $sapi    = Kategori::where('nama_kategori', 'Sapi')->first()->id;
        $sayuran = Kategori::where('nama_kategori', 'Sayuran')->first()->id;
        $siap    = Kategori::where('nama_kategori', 'Siap saji')->first()->id;

        $barangs = [
            // Ayam
            ['nama_barang' => 'Ayam nugget crispy',       'kategori_id' => $ayam,    'jumlah_stok' => 12, 'satuan' => 'pcs',  'stok_minimum' => 20, 'harga_jual' => 35000,  'harga_beli' => 28000, 'berat_ukuran' => '500 gram', 'lokasi_simpan' => 'Rak A-3', 'deskripsi' => 'Nugget ayam dengan lapisan tepung crispy, cocok untuk camilan atau bekal. Tersedia dalam kemasan 500 gr berisi ±20 pcs.'],
            ['nama_barang' => 'Sosis ayam jumbo',          'kategori_id' => $ayam,    'jumlah_stok' => 8,  'satuan' => 'pack', 'stok_minimum' => 15, 'harga_jual' => 22000,  'harga_beli' => 17000, 'berat_ukuran' => '200 gram', 'lokasi_simpan' => 'Rak A-1', 'deskripsi' => 'Sosis ayam ukuran jumbo, rasa gurih dan lezat. 1 pack berisi 5 batang.'],
            ['nama_barang' => 'Chicken karaage',           'kategori_id' => $ayam,    'jumlah_stok' => 6,  'satuan' => 'pack', 'stok_minimum' => 10, 'harga_jual' => 42000,  'harga_beli' => 33000, 'berat_ukuran' => '350 gram', 'lokasi_simpan' => 'Rak A-2', 'deskripsi' => 'Ayam goreng ala Jepang bumbu karaage, siap goreng langsung dari freezer.'],
            ['nama_barang' => 'Fillet ayam crispy',        'kategori_id' => $ayam,    'jumlah_stok' => 14,  'satuan' => 'pack', 'stok_minimum' => 15, 'harga_jual' => 38000,  'harga_beli' => 29000, 'berat_ukuran' => '400 gram', 'lokasi_simpan' => 'Rak A-4', 'deskripsi' => 'Potongan fillet ayam berlapis tepung crispy, cocok untuk burger.'],
            ['nama_barang' => 'Chicken popcorn',           'kategori_id' => $ayam,    'jumlah_stok' => 0,   'satuan' => 'pack', 'stok_minimum' => 10, 'harga_jual' => 30000,  'harga_beli' => 23000, 'berat_ukuran' => '300 gram', 'lokasi_simpan' => 'Rak A-5', 'deskripsi' => 'Potongan ayam kecil ala popcorn chicken, gurih dan renyah.'],
            ['nama_barang' => 'Ayam geprek frozen',        'kategori_id' => $ayam,    'jumlah_stok' => 14,  'satuan' => 'pack', 'stok_minimum' => 10, 'harga_jual' => 28000,  'harga_beli' => 21000, 'berat_ukuran' => '250 gram', 'lokasi_simpan' => 'Rak A-6', 'deskripsi' => 'Ayam geprek frozen dengan bumbu sambal kering, tinggal goreng dan sajikan.'],
            ['nama_barang' => 'Bakso ayam urat',           'kategori_id' => $ayam,    'jumlah_stok' => 7,  'satuan' => 'pack', 'stok_minimum' => 20, 'harga_jual' => 18000,  'harga_beli' => 13000, 'berat_ukuran' => '250 gram', 'lokasi_simpan' => 'Rak A-7', 'deskripsi' => 'Bakso ayam urat kenyal dan gurih, cocok untuk sup atau mie.'],
            
            // Seafood
            ['nama_barang' => 'Dim sum udang',             'kategori_id' => $seafood, 'jumlah_stok' => 0,   'satuan' => 'box',  'stok_minimum' => 10, 'harga_jual' => 45000,  'harga_beli' => 36000, 'berat_ukuran' => '200 gram', 'lokasi_simpan' => 'Rak B-1', 'deskripsi' => 'Dim sum udang premium siap kukus, 1 box berisi 8 pcs.'],
            ['nama_barang' => 'Udang tempura',             'kategori_id' => $seafood, 'jumlah_stok' => 4,  'satuan' => 'pack', 'stok_minimum' => 10, 'harga_jual' => 55000,  'harga_beli' => 43000, 'berat_ukuran' => '250 gram', 'lokasi_simpan' => 'Rak B-2', 'deskripsi' => 'Udang berlapis tepung tempura, goreng langsung dari freezer.'],
            ['nama_barang' => 'Otak-otak ikan',            'kategori_id' => $seafood, 'jumlah_stok' => 12,  'satuan' => 'pack', 'stok_minimum' => 10, 'harga_jual' => 20000,  'harga_beli' => 15000, 'berat_ukuran' => '200 gram', 'lokasi_simpan' => 'Rak B-6', 'deskripsi' => 'Otak-otak ikan dengan bumbu rempah, panggang atau kukus.'],
            ['nama_barang' => 'Kepiting rajungan frozen',  'kategori_id' => $seafood, 'jumlah_stok' => 18,  'satuan' => 'pack', 'stok_minimum' => 5,  'harga_jual' => 85000,  'harga_beli' => 70000, 'berat_ukuran' => '500 gram', 'lokasi_simpan' => 'Rak B-7', 'deskripsi' => 'Daging kepiting rajungan segar yang telah dibekukan.'],
            ['nama_barang' => 'Shrimp dumpling',           'kategori_id' => $seafood, 'jumlah_stok' => 15,  'satuan' => 'pack', 'stok_minimum' => 10, 'harga_jual' => 42000,  'harga_beli' => 33000, 'berat_ukuran' => '180 gram', 'lokasi_simpan' => 'Rak B-8', 'deskripsi' => 'Dumpling isi udang ala Hongkong, kukus atau panggang.'],

            // Sapi
            ['nama_barang' => 'Sosis sapi premium',        'kategori_id' => $sapi,    'jumlah_stok' => 15,  'satuan' => 'pack', 'stok_minimum' => 15, 'harga_jual' => 28000,  'harga_beli' => 21000, 'berat_ukuran' => '200 gram', 'lokasi_simpan' => 'Rak C-1', 'deskripsi' => 'Sosis sapi premium dengan tekstur lembut dan rasa gurih, 1 pack 5 pcs.'],
            ['nama_barang' => 'Bakso urat sapi',           'kategori_id' => $sapi,    'jumlah_stok' => 20,  'satuan' => 'pack', 'stok_minimum' => 20, 'harga_jual' => 22000,  'harga_beli' => 16000, 'berat_ukuran' => '250 gram', 'lokasi_simpan' => 'Rak C-2', 'deskripsi' => 'Bakso sapi dengan potongan urat, kenyal dan berasa daging asli.'],
            ['nama_barang' => 'Daging sapi giling',        'kategori_id' => $sapi,    'jumlah_stok' => 0,   'satuan' => 'pack', 'stok_minimum' => 10, 'harga_jual' => 52000,  'harga_beli' => 42000, 'berat_ukuran' => '500 gram', 'lokasi_simpan' => 'Rak C-4', 'deskripsi' => 'Daging sapi giling halus, siap masak untuk berbagai olahan.'],

            // Sayuran
            ['nama_barang' => 'Edamame beku',              'kategori_id' => $sayuran, 'jumlah_stok' => 15,   'satuan' => 'pack', 'stok_minimum' => 10, 'harga_jual' => 19000,  'harga_beli' => 14000, 'berat_ukuran' => '300 gram', 'lokasi_simpan' => 'Rak D-1', 'deskripsi' => 'Edamame beku siap rebus, kaya protein nabati.'],
            ['nama_barang' => 'Jagung manis',              'kategori_id' => $sayuran, 'jumlah_stok' => 5,  'satuan' => 'pack', 'stok_minimum' => 15, 'harga_jual' => 12000,  'harga_beli' => 8000,  'berat_ukuran' => '400 gram', 'lokasi_simpan' => 'Rak D-2', 'deskripsi' => 'Biji jagung manis beku, siap tumis atau campuran masakan.'],

            // Siap saji
            ['nama_barang' => 'Pizza frozen personal',     'kategori_id' => $siap,    'jumlah_stok' => 20,  'satuan' => 'pcs',  'stok_minimum' => 10, 'harga_jual' => 28000,  'harga_beli' => 21000, 'berat_ukuran' => '150 gram', 'lokasi_simpan' => 'Rak E-2', 'deskripsi' => 'Pizza frozen ukuran personal dengan berbagai topping.'],
            ['nama_barang' => 'Kebab frozen',              'kategori_id' => $siap,    'jumlah_stok' => 0,   'satuan' => 'pack', 'stok_minimum' => 10, 'harga_jual' => 25000,  'harga_beli' => 18000, 'berat_ukuran' => '200 gram', 'lokasi_simpan' => 'Rak E-6', 'deskripsi' => 'Kebab daging sapi dan sayuran dalam tortilla, tinggal panggang.'],
        ];

        foreach ($barangs as $b) {
            Barang::create($b);
        }
    }
}
