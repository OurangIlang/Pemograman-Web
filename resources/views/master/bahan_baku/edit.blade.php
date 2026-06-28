@extends('layouts.app')

@section('title', 'Ubah Bahan Baku - PT Ken Mandiri Teknik')
@section('active', 'bahan_baku')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-edit mr-2" style="color: #000000;"></i>Ubah <span>Bahan Baku</span></h4>
      <p>Perbarui data bahan baku</p>
    </div>
    <a href="{{ route('bahan_baku.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('bahan_baku.update', $item->id_bahan_baku) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-element">
        <label>ID Bahan Baku</label>
        <input type="text" value="{{ $item->id_bahan_baku }}" class="form-control" readonly>
      </div>
      <div class="form-element">
        <label>Nama Bahan Baku</label>
        <input type="text" name="nama_bahan_baku" value="{{ old('nama_bahan_baku', $item->nama_bahan_baku) }}" class="form-control @error('nama_bahan_baku') is-invalid @enderror">
        @error('nama_bahan_baku') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Harga Bahan Baku</label>
        <input type="number" step="0.01" name="harga_bahan_baku" value="{{ old('harga_bahan_baku', $item->harga_bahan_baku) }}" class="form-control @error('harga_bahan_baku') is-invalid @enderror">
        @error('harga_bahan_baku') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('bahan_baku.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
