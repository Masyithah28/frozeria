@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="page-title">Daftar Kategori</div>
</div>

<div class="table-wrap">
    <div style="padding: 16px 16px 0;">
        <form method="GET" action="{{ route('kategori.index') }}" class="search-row">
            <input type="text" name="search" class="input search-input"
                placeholder="Cari kategori..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Kategori</th>
                <th>Jumlah Barang</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategoris as $kat)
            <tr>
                <td style="font-weight:500">{{ $kat->nama_kategori }}</td>
                <td>
                    <span class="badge badge-blue">{{ $kat->barangs_count }} barang</span>
                </td>
                <td style="color:var(--muted)">{{ $kat->created_at->format('j M Y') }}</td>
                <td>
                    <div class="table-actions">
                        <a href="{{ route('kategori.edit', $kat->id) }}" class="btn btn-sm btn-edit">Edit</a>
                        <button class="btn btn-sm btn-del"
                            onclick="confirmDelete('{{ route('kategori.destroy', $kat->id) }}', '{{ addslashes($kat->nama_kategori) }}')">
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">
                    <div class="empty-state">
                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        <p>Tidak ada kategori ditemukan</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="padding:14px 16px;border-top:1px solid var(--border);color:var(--muted);font-size:13px">
        {{ $kategoris->count() }} kategori terdaftar
    </div>
</div>
@endsection
