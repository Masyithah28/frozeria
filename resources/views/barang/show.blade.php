@extends('layouts.app')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('dashboard') }}">← Kembali</a>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">Detail Barang</span>
    <div style="margin-left:auto;display:flex;gap:8px">
        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-edit btn-sm">Edit Barang</a>
        <button class="btn btn-danger btn-sm"
            onclick="confirmDelete('{{ route('barang.destroy', $barang->id) }}', '{{ addslashes($barang->nama_barang) }}')">
            Hapus
        </button>
    </div>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div class="detail-foto">
            @if($barang->foto && file_exists(public_path('storage/foto/' . $barang->foto)))
                <img src="{{ asset('storage/foto/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}">
            @else
                <svg width="40" height="40" fill="none" stroke="var(--muted)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            @endif
        </div>
        <div>
            <div class="detail-name">{{ $barang->nama_barang }}</div>
            @php
                $catClass = match($barang->kategori->nama_kategori ?? '') {
                    'Ayam' => 'cat-Ayam', 'Sapi' => 'cat-Sapi',
                    'Seafood' => 'cat-Seafood', 'Sayuran' => 'cat-Sayuran',
                    default => 'cat-default'
                };
            @endphp
            <span class="badge {{ $catClass }}">{{ $barang->kategori->nama_kategori ?? '-' }}</span>
        </div>
    </div>

    <div class="section-title">Informasi Stok & Harga</div>
    <div class="detail-grid" style="margin-bottom:20px">
        <div class="detail-field">
            <div class="field-label">Jumlah Stok</div>
            <div class="field-value" style="color:{{ $barang->jumlah_stok == 0 ? 'var(--danger)' : ($barang->jumlah_stok < 20 ? 'var(--warning)' : 'var(--text)') }}">
                {{ $barang->jumlah_stok }} {{ $barang->satuan }}
            </div>
        </div>
        <div class="detail-field">
            <div class="field-label">Stok Minimum</div>
            <div class="field-value">{{ $barang->stok_minimum }} {{ $barang->satuan }}</div>
        </div>
        <div class="detail-field">
            <div class="field-label">Harga Jual</div>
            <div class="field-value">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</div>
        </div>
        <div class="detail-field">
            <div class="field-label">Harga Beli</div>
            <div class="field-value">Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</div>
        </div>
        <div class="detail-field">
            <div class="field-label">Berat / Ukuran</div>
            <div class="field-value">{{ $barang->berat_ukuran ?? '-' }}</div>
        </div>
        <div class="detail-field">
            <div class="field-label">Lokasi Simpan</div>
            <div class="field-value">{{ $barang->lokasi_simpan ?? '-' }}</div>
        </div>
        @if($barang->deskripsi)
        <div class="detail-field full">
            <div class="field-label">Deskripsi</div>
            <div class="field-value" style="font-size:14px;font-weight:400;color:var(--muted);line-height:1.6">
                {{ $barang->deskripsi }}
            </div>
        </div>
        @endif
    </div>

    <div style="font-size:12px;color:var(--muted)">
        Ditambahkan: {{ $barang->created_at->format('d M Y, H:i') }} &nbsp;|&nbsp;
        Diperbarui: {{ $barang->updated_at->format('d M Y, H:i') }}
    </div>
</div>
@endsection
