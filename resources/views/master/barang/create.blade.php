@extends('layouts.app')

@section('title', 'Tambah Barang - PT Ken Mandiri Teknik')
@section('active', 'barang')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-plus mr-2" style="color: #000000;"></i>Tambah <span>Barang</span></h4>
      <p>Isi data barang baru</p>
    </div>
    <a href="{{ route('barang.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('barang.store') }}" method="POST">
      @csrf
      <div class="form-element">
        <label>ID Barang</label>
        <input type="text" name="id_barang" class="form-control @error('id_barang') is-invalid @enderror" value="{{ old('id_barang') }}" required>
        @error('id_barang') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang') }}" required>
        @error('nama_barang') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Harga Barang</label>
        <input type="number" step="0.01" name="harga_barang" class="form-control @error('harga_barang') is-invalid @enderror" value="{{ old('harga_barang', '0') }}">
        @error('harga_barang') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('barang.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
