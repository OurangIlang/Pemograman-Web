@extends('layouts.app')

@section('title', 'Tambah Customer - PT Ken Mandiri Teknik')
@section('active', 'customer')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-plus mr-2" style="color: #000000;"></i>Tambah <span>Customer</span></h4>
      <p>Isi data customer baru</p>
    </div>
    <a href="{{ route('customer.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('customer.store') }}" method="POST">
      @csrf
      <div class="form-element">
        <label>ID Customer</label>
        <input type="text" name="id_customer" class="form-control @error('id_customer') is-invalid @enderror" value="{{ old('id_customer') }}" required>
        @error('id_customer') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Nama Customer</label>
        <input type="text" name="nama_customer" class="form-control @error('nama_customer') is-invalid @enderror" value="{{ old('nama_customer') }}" required>
        @error('nama_customer') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Nama PT</label>
        <input type="text" name="nama_pt" class="form-control @error('nama_pt') is-invalid @enderror" value="{{ old('nama_pt') }}">
        @error('nama_pt') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Alamat PT</label>
        <textarea name="alamat_pt" class="form-control @error('alamat_pt') is-invalid @enderror" rows="2">{{ old('alamat_pt') }}</textarea>
        @error('alamat_pt') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('customer.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
