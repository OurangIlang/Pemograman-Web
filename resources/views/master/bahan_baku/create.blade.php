@extends('layouts.app')

@section('title', 'Tambah Bahan Baku - PT Ken Mandiri Teknik')
@section('active', 'bahan_baku')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-plus mr-2" style="color: #000000;"></i>Tambah <span>Bahan Baku</span></h4>
      <p>Isi data bahan baku baru</p>
    </div>
    <a href="{{ route('bahan_baku.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('bahan_baku.store') }}" method="POST">
      @csrf
      <div class="form-element">
        <label>ID Bahan Baku</label>
        <input type="text" class="form-control" value="{{ $nextId }}" readonly>
        <small class="text-muted">ID dibuat otomatis oleh sistem.</small>
      </div>
      <div class="form-element">
        <label>Nama Bahan Baku</label>
        <input type="text" name="nama_bahan_baku" class="form-control @error('nama_bahan_baku') is-invalid @enderror" value="{{ old('nama_bahan_baku') }}" required>
        @error('nama_bahan_baku') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Satuan</label>
        <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror" value="{{ old('satuan', 'Unit') }}" placeholder="Kg, Liter, Pcs, dll">
        @error('satuan') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Harga Bahan Baku</label>
        <input type="number" step="0.01" name="harga_bahan_baku" class="form-control @error('harga_bahan_baku') is-invalid @enderror" value="{{ old('harga_bahan_baku', '0') }}">
        @error('harga_bahan_baku') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('bahan_baku.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
