<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            // $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->unsignedBigInteger('kategori_id')->nullable();
$table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('set null');
            $table->integer('jumlah_stok')->default(0);
            $table->string('satuan');
            $table->integer('stok_minimum')->default(0);
            $table->decimal('harga_jual', 15, 2)->default(0);
            $table->decimal('harga_beli', 15, 2)->default(0);
            $table->string('berat_ukuran')->nullable();
            $table->string('lokasi_simpan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
