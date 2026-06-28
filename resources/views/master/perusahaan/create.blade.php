@extends('layouts.app')

@section('title', 'Tambah Perusahaan - PT Ken Mandiri Teknik')
@section('active', 'perusahaan')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-plus mr-2" style="color: #000000;"></i>Tambah <span>Perusahaan</span></h4>
      <p>Isi data perusahaan baru</p>
    </div>
    <a href="{{ route('perusahaan.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('perusahaan.store') }}" method="POST">
      @csrf
      <div class="form-element">
        <label>ID Perusahaan</label>
        <input type="text" name="id_perusahaan" class="form-control @error('id_perusahaan') is-invalid @enderror" value="{{ old('id_perusahaan') }}" required>
        @error('id_perusahaan') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      @include('master.perusahaan._fields', ['item' => null])
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('perusahaan.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
