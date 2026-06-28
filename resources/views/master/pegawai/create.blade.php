@extends('layouts.app')

@section('title', 'Tambah Pegawai - PT Ken Mandiri Teknik')
@section('active', 'pegawai')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-plus mr-2" style="color: #000000;"></i>Tambah <span>Pegawai</span></h4>
      <p>Isi data pegawai baru</p>
    </div>
    <a href="{{ route('pegawai.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('pegawai.store') }}" method="POST">
      @csrf
      <div class="form-element">
        <label>ID Pegawai</label>
        <input type="text" name="id_pegawai" class="form-control @error('id_pegawai') is-invalid @enderror" value="{{ old('id_pegawai') }}" required>
        @error('id_pegawai') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Nama Pegawai</label>
        <input type="text" name="nama_pegawai" class="form-control @error('nama_pegawai') is-invalid @enderror" value="{{ old('nama_pegawai') }}" required>
        @error('nama_pegawai') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('pegawai.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
