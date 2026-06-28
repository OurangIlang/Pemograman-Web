@extends('layouts.app')

@section('title', 'Ubah Barang - PT Ken Mandiri Teknik')
@section('active', 'barang')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-edit mr-2" style="color: #000000;"></i>Ubah <span>Barang</span></h4>
      <p>Perbarui data barang</p>
    </div>
    <a href="{{ route('barang.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('barang.update', $item->id_barang) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-element">
        <label>ID Barang</label>
        <input type="text" value="{{ $item->id_barang }}" class="form-control" readonly>
      </div>
      <div class="form-element">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" class="form-control @error('nama_barang') is-invalid @enderror">
        @error('nama_barang') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Harga Barang</label>
        <input type="number" step="0.01" name="harga_barang" value="{{ old('harga_barang', $item->harga_barang) }}" class="form-control @error('harga_barang') is-invalid @enderror">
        @error('harga_barang') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('barang.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
