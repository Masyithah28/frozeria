@extends('layouts.app')

@section('content')
<div class="breadcrumb">
    <a href="{{ route('kategori.index') }}">← Kembali</a>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">Tambah Kategori</span>
</div>

<div class="card" style="max-width:560px">
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Nama Kategori <span class="req">*</span></label>
            <input type="text" name="nama_kategori" class="form-input"
                value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
            @error('nama_kategori')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi (opsional)</label>
            <textarea name="deskripsi" class="form-textarea" rows="3"
                placeholder="Deskripsi kategori...">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            @error('deskripsi')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:8px">
            <a href="{{ route('kategori.index') }}" class="btn btn-ghost">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
        </div>
    </form>
</div>
@endsection
