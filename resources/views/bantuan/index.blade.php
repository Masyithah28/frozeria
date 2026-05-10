@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="page-title">Panduan Penggunaan Sistem</div>
</div>

<div class="card">
    {{-- CARA TAMBAH BARANG --}}
    <div class="help-section">
        <div class="section-title">Cara menambah barang baru</div>
        <div class="help-step">
            <div class="help-num">1</div>
            <div>Buka halaman <strong>Dashboard</strong>, klik tombol <strong>+ Tambah Barang</strong> di kanan atas.</div>
        </div>
        <div class="help-step">
            <div class="help-num">2</div>
            <div>Unggah foto barang (opsional), lalu isi formulir: nama, kategori, satuan, jumlah stok, harga, dan lainnya.</div>
        </div>
        <div class="help-step">
            <div class="help-num">3</div>
            <div>Klik <strong>Simpan Barang</strong>. Barang akan muncul di daftar dashboard.</div>
        </div>
    </div>

    {{-- CARA UPDATE STOK --}}
    <div class="help-section">
        <div class="section-title">Cara update stok barang masuk</div>
        <div class="help-step">
            <div class="help-num">1</div>
            <div>Temukan barang di dashboard menggunakan kolom pencarian atau filter kategori.</div>
        </div>
        <div class="help-step">
            <div class="help-num">2</div>
            <div>Klik tombol <strong>Edit</strong> pada baris barang tersebut.</div>
        </div>
        <div class="help-step">
            <div class="help-num">3</div>
            <div>Ubah nilai <strong>Jumlah stok</strong> sesuai kondisi saat ini, lalu klik <strong>Simpan Barang</strong>.</div>
        </div>
    </div>

    {{-- CARA KELOLA KATEGORI --}}
    <div class="help-section">
        <div class="section-title">Cara mengelola kategori</div>
        <div class="help-step">
            <div class="help-num">1</div>
            <div>Buka halaman <strong>Kategori</strong> dari navigasi atas.</div>
        </div>
        <div class="help-step">
            <div class="help-num">2</div>
            <div>Tambah, edit, atau hapus kategori sesuai kebutuhan toko.</div>
        </div>
        <div class="help-step">
            <div class="help-num">3</div>
            <div>Menghapus kategori tidak akan menghapus barang — barang akan menjadi tidak berkategori.</div>
        </div>
    </div>

    {{-- SATUAN --}}
    <div class="help-section">
        <div class="section-title">Informasi satuan</div>
        <p style="color:var(--muted);font-size:13.5px;line-height:1.7">
            Satuan barang bisa bebas sesuai kebutuhan — misalnya <strong>pcs</strong>, <strong>pack</strong>,
            <strong>box</strong>, <strong>kg</strong>, <strong>liter</strong>, dan lain-lain.
        </p>
    </div>

    {{-- INDIKATOR STOK --}}
    <div class="help-section">
        <div class="section-title">Indikator stok di dashboard</div>
        <div style="display:flex;flex-direction:column;gap:10px;font-size:13.5px">
            <div style="display:flex;gap:12px;align-items:center">
                <span style="color:var(--danger);font-weight:700;min-width:80px">Merah</span>
                <span style="color:var(--muted)">Stok = 0 (habis). Segera lakukan pengadaan.</span>
            </div>
            <div style="display:flex;gap:12px;align-items:center">
                <span style="color:var(--warning);font-weight:700;min-width:80px">Kuning</span>
                <span style="color:var(--muted)">Stok &lt; 20 (menipis). Perlu diperhatikan.</span>
            </div>
            <div style="display:flex;gap:12px;align-items:center">
                <span style="color:var(--text);font-weight:700;min-width:80px">Normal</span>
                <span style="color:var(--muted)">Stok ≥ 20. Kondisi aman.</span>
            </div>
        </div>
    </div>

    {{-- DIVIDER --}}
    <div style="border-top:1px solid var(--border);margin:28px 0"></div>

    {{-- INFORMASI DEVELOPER --}}
    <div class="help-section">
        <div class="section-title">Informasi Developer</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="detail-field">
                <div class="field-label">Nama</div>
                <div class="field-value" style="font-size:15px">Masyithah Sophia Damayanti</div>
            </div>
            <div class="detail-field">
                <div class="field-label">NIM</div>
                <div class="field-value" style="font-size:15px">2241720011</div>
            </div>
            <div class="detail-field">
                <div class="field-label">Kelas</div>
                <div class="field-value" style="font-size:15px">TI - 4C</div>
            </div>
            <div class="detail-field">
                <div class="field-label">Nomor Telepon</div>
                <div class="field-value" style="font-size:15px">+62 858-5080-9571</div>
            </div>
            <div class="detail-field" style="grid-column:span 2">
                <div class="field-label">Alamat</div>
                <div class="field-value" style="font-size:14px;font-weight:400;color:var(--muted)">Jl. Veteran IX G no 22, Gresik.</div>
            </div>
            <div class="detail-field" style="grid-column:span 2">
                <div class="field-label">Email</div>
                <div class="field-value" style="font-size:15px">masyithahsophia@gmail.com</div>
            </div>
        </div>
    </div>
</div>
@endsection
