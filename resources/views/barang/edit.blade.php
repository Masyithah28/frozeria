@extends('layouts.app')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('barang.show', $barang->id) }}">← Kembali</a>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">Edit Barang</span>
</div>

<div class="card">
    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- FOTO --}}
        <div class="form-group">
            <label class="form-label">Foto Barang</label>
            <div class="foto-upload-area" id="uploadArea" onclick="document.getElementById('fotoInput').click()">
                @if($barang->foto && file_exists(public_path('storage/foto/' . $barang->foto)))
                    <img id="fotoPreview" class="foto-preview" src="{{ asset('storage/foto/' . $barang->foto) }}">
                    <div id="uploadPlaceholder" style="display:none">
                @else
                    <img id="fotoPreview" class="foto-preview" style="display:none">
                    <div id="uploadPlaceholder">
                @endif
                        <div class="icon">
                            <svg width="22" height="22" fill="none" stroke="var(--muted)" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p><span>Klik untuk memilih foto</span>, atau seret file ke sini</p>
                        <p class="size-hint">Format JPG, PNG — Maks. 3 MB</p>
                    </div>
            </div>
            <input type="file" id="fotoInput" name="foto" accept="image/jpg,image/jpeg,image/png" style="display:none">
            <button type="button" class="btn btn-ghost btn-sm" onclick="document.getElementById('fotoInput').click()">Ganti foto</button>
            @error('foto')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        {{-- NAMA BARANG --}}
        <div class="form-group">
            <label class="form-label">Nama Barang <span class="req">*</span></label>
            <input type="text" name="nama_barang" class="form-input" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
            @error('nama_barang')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Kategori <span class="req">*</span></label>
                <select name="kategori_id" class="form-select" required>
                    <option value="">Pilih kategori</option>
                    @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ old('kategori_id', $barang->kategori_id) == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                    @endforeach
                </select>
                @error('kategori_id')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Satuan <span class="req">*</span></label>
                <input type="text" name="satuan" class="form-input" value="{{ old('satuan', $barang->satuan) }}" required>
                @error('satuan')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Jumlah Stok <span class="req">*</span></label>
                <input type="number" name="jumlah_stok" class="form-input" value="{{ old('jumlah_stok', $barang->jumlah_stok) }}" min="0" required>
                @error('jumlah_stok')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Stok Minimum <span class="req">*</span></label>
                <input type="number" name="stok_minimum" class="form-input" value="20" readonly style="opacity:0.6;cursor:not-allowed;">
                @error('stok_minimum')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Harga Jual (Rp) <span class="req">*</span></label>
                <input type="number" name="harga_jual" class="form-input" value="{{ old('harga_jual', (int)$barang->harga_jual) }}" min="0" required>
                @error('harga_jual')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Harga Beli (Rp) <span class="req">*</span></label>
                <input type="number" name="harga_beli" class="form-input" value="{{ old('harga_beli', (int)$barang->harga_beli) }}" min="0" required>
                @error('harga_beli')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Berat / Ukuran</label>
                <input type="text" name="berat_ukuran" class="form-input" value="{{ old('berat_ukuran', $barang->berat_ukuran) }}" placeholder="cth. 500 gram">
                @error('berat_ukuran')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Lokasi Simpan</label>
                <input type="text" name="lokasi_simpan" class="form-input" value="{{ old('lokasi_simpan', $barang->lokasi_simpan) }}" placeholder="cth. Rak A-3">
                @error('lokasi_simpan')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-textarea" rows="3">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
            @error('deskripsi')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:8px">
            <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-ghost">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Barang</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
        document.getElementById('fotoPreview').src = ev.target.result;
        document.getElementById('fotoPreview').style.display = 'block';
        document.getElementById('uploadPlaceholder').style.display = 'none';
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
