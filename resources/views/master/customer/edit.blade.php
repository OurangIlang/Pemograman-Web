@extends('layouts.app')

@section('title', 'Ubah Customer - PT Ken Mandiri Teknik')
@section('active', 'customer')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-edit mr-2" style="color: #000000;"></i>Ubah <span>Customer</span></h4>
      <p>Perbarui data customer</p>
    </div>
    <a href="{{ route('customer.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('customer.update', $item->id_customer) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-element">
        <label>ID Customer</label>
        <input type="text" value="{{ $item->id_customer }}" class="form-control" readonly>
      </div>
      <div class="form-element">
        <label>Nama Customer</label>
        <input type="text" name="nama_customer" value="{{ old('nama_customer', $item->nama_customer) }}" class="form-control @error('nama_customer') is-invalid @enderror">
        @error('nama_customer') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Nama PT</label>
        <input type="text" name="nama_pt" value="{{ old('nama_pt', $item->nama_pt) }}" class="form-control @error('nama_pt') is-invalid @enderror">
        @error('nama_pt') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Alamat PT</label>
        <textarea name="alamat_pt" class="form-control @error('alamat_pt') is-invalid @enderror" rows="2">{{ old('alamat_pt', $item->alamat_pt) }}</textarea>
        @error('alamat_pt') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('customer.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
