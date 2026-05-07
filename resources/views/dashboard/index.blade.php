@extends('layouts.app')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <div class="label">Total Barang</div>
        <div class="value">{{ $totalBarang }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Total Kategori</div>
        <div class="value">{{ $totalKategori }}</div>
    </div>
    <div class="stat-card warning">
        <div class="label">Stok Menipis</div>
        <div class="value">{{ $stokMenipis }}</div>
    </div>
    <div class="stat-card danger">
        <div class="label">Stok Habis</div>
        <div class="value">{{ $stokHabis }}</div>
    </div>
</div>

<div class="table-wrap">
    <!-- Search & Filter -->
    <div style="padding: 16px 16px 0;">
        <form method="GET" action="{{ route('dashboard') }}" id="searchForm" class="search-row">
            <input
                type="text"
                name="search"
                class="input search-input"
                placeholder="Cari nama barang..."
                value="{{ request('search') }}"
                id="searchInput"
            >
            <select name="kategori" class="select" id="kategoriFilter" onchange="this.form.submit()">
                <option value="semua" {{ request('kategori') == 'semua' || !request('kategori') ? 'selected' : '' }}>Semua kategori</option>
                @foreach($kategoris as $kat)
                <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-sm">Cari</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $barang)
            <tr>
                <td style="font-weight:500">{{ $barang->nama_barang }}</td>
                <td>
                    @php
                        $catClass = 'cat-default';
                    @endphp
                    <span class="badge {{ $catClass }}">{{ $barang->kategori->nama_kategori ?? '-' }}</span>
                </td>
                {{-- <td>
                    @php
                        $catClass = match($barang->kategori->nama_kategori ?? '') {
                            'Ayam'    => 'cat-Ayam',
                            'Sapi'    => 'cat-Sapi',
                            'Seafood' => 'cat-Seafood',
                            'Sayuran' => 'cat-Sayuran',
                            'Siap saji' => 'cat-default',
                            default   => 'cat-default'
                        };
                    @endphp
                    <span class="badge {{ $catClass }}">{{ $barang->kategori->nama_kategori ?? '-' }}</span>
                </td> --}}
                <td>
                    @if($barang->jumlah_stok == 0)
                        <span style="color:var(--danger);font-weight:600">0</span>
                    @elseif($barang->jumlah_stok < 15)
                        <span style="color:var(--warning);font-weight:600">{{ $barang->jumlah_stok }}</span>
                    @else
                        {{ $barang->jumlah_stok }}
                    @endif
                </td>
                <td style="color:var(--muted)">{{ $barang->satuan }}</td>
                <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                <td>
                    <div class="table-actions">
                        <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-sm btn-detail">Detail</a>
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-edit">Edit</a>
                        <button
                            class="btn btn-sm btn-del"
                            onclick="confirmDelete('{{ route('barang.destroy', $barang->id) }}', '{{ addslashes($barang->nama_barang) }}')"
                        >Hapus</button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/></svg>
                        <p>Tidak ada barang ditemukan</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        <span class="pagination-info">
            Menampilkan {{ $barangs->firstItem() ?? 0 }}-{{ $barangs->lastItem() ?? 0 }} dari {{ $barangs->total() }} barang
        </span>
        <div class="pagination-links">
            @if($barangs->onFirstPage())
                <span class="page-btn disabled">‹ Prev</span>
            @else
                <a href="{{ $barangs->previousPageUrl() }}" class="page-btn">‹ Prev</a>
            @endif

            @foreach($barangs->getUrlRange(1, $barangs->lastPage()) as $page => $url)
                @if($page == $barangs->currentPage())
                    <span class="page-btn active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach

            @if($barangs->hasMorePages())
                <a href="{{ $barangs->nextPageUrl() }}" class="page-btn">Next ›</a>
            @else
                <span class="page-btn disabled">Next ›</span>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('searchInput').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('searchForm').submit();
    }
});
</script>
@endpush
