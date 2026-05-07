@extends('layouts.app')
@section('title', 'Detail Barang')

@section('content')
<div class="page-header">
    <div style="display:flex;align-items:center;">
        <a href="{{ route('barang.index') }}" class="page-back">< Kembali</a>
        <span class="page-title">Detail Barang</span>
    </div>
    <div style="display:flex;gap:8px;">
        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-outline">Edit Barang</a>
        <button class="btn btn-danger" onclick="openDeleteModal({{ $barang->id }}, '{{ addslashes($barang->nama_barang) }}')">Hapus</button>
    </div>
</div>

<div class="card">
    <div class="detail-card">
        <div class="detail-header">
            <div class="detail-foto">
                @if($barang->foto && file_exists(public_path('uploads/'.$barang->foto)))
                    <img src="{{ asset('uploads/'.$barang->foto) }}" alt="{{ $barang->nama_barang }}">
                @else
                    🖼
                @endif
            </div>
            <div>
                <div class="detail-name">{{ $barang->nama_barang }}</div>
                @if($barang->kategori)
                    <span class="badge">{{ $barang->kategori->nama_kategori }}</span>
                @endif
            </div>
        </div>

        <div class="detail-fields">
            <div class="detail-field">
                <div class="detail-field-label">Jumlah Stok</div>
                <div class="detail-field-value">
                    @if($barang->jumlah_stok == 0)
                        <span class="stok-habis">{{ $barang->jumlah_stok }} {{ $barang->satuan }}</span>
                    @elseif($barang->stok_minimum > 0 && $barang->jumlah_stok < $barang->stok_minimum)
                        <span class="stok-menipis">{{ $barang->jumlah_stok }} {{ $barang->satuan }}</span>
                    @else
                        {{ $barang->jumlah_stok }} {{ $barang->satuan }}
                    @endif
                </div>
            </div>
            <div class="detail-field">
                <div class="detail-field-label">Stok Minimum</div>
                <div class="detail-field-value">{{ $barang->stok_minimum ?? '—' }} {{ $barang->stok_minimum ? $barang->satuan : '' }}</div>
            </div>
            <div class="detail-field">
                <div class="detail-field-label">Harga Jual</div>
                <div class="detail-field-value">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</div>
            </div>
            <div class="detail-field">
                <div class="detail-field-label">Harga Beli</div>
                <div class="detail-field-value">Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</div>
            </div>
            <div class="detail-field">
                <div class="detail-field-label">Berat / Ukuran</div>
                <div class="detail-field-value">{{ $barang->berat_ukuran ?: '—' }}</div>
            </div>
            <div class="detail-field">
                <div class="detail-field-label">Lokasi Simpan</div>
                <div class="detail-field-value">{{ $barang->lokasi_simpan ?: '—' }}</div>
            </div>
            @if($barang->deskripsi)
            <div class="detail-field full">
                <div class="detail-field-label">Deskripsi</div>
                <div class="detail-field-value" style="font-weight:400;font-size:14px;line-height:1.6;">{{ $barang->deskripsi }}</div>
            </div>
            @endif
            <div class="detail-field">
                <div class="detail-field-label">Ditambahkan</div>
                <div class="detail-field-value" style="font-weight:400;font-size:14px;">{{ $barang->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div class="detail-field">
                <div class="detail-field-label">Terakhir Diperbarui</div>
                <div class="detail-field-value" style="font-weight:400;font-size:14px;">{{ $barang->updated_at->format('d M Y, H:i') }}</div>
            </div>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal-backdrop" id="deleteModal">
    <div class="modal">
        <div class="modal-icon">⚠️</div>
        <div class="modal-title">Hapus barang?</div>
        <div class="modal-body">
            Data <strong id="deleteItemName"></strong> akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.
        </div>
        <div class="modal-actions">
            <button class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openDeleteModal(id, name) {
    document.getElementById('deleteItemName').textContent = name;
    document.getElementById('deleteForm').action = '/barang/' + id;
    document.getElementById('deleteModal').classList.add('show');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('show');
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
</script>
@endsection