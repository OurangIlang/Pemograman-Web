@extends('layouts.app')

@section('title', 'Ubah Pegawai - PT Ken Mandiri Teknik')
@section('active', 'pegawai')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-edit mr-2" style="color: #000000;"></i>Ubah <span>Pegawai</span></h4>
      <p>Perbarui data pegawai</p>
    </div>
    <a href="{{ route('pegawai.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('pegawai.update', $item->id_pegawai) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-element">
        <label>ID Pegawai</label>
        <input type="text" value="{{ $item->id_pegawai }}" class="form-control" readonly>
      </div>
      <div class="form-element">
        <label>Nama Pegawai</label>
        <input type="text" name="nama_pegawai" value="{{ old('nama_pegawai', $item->nama_pegawai) }}" class="form-control @error('nama_pegawai') is-invalid @enderror">
        @error('nama_pegawai') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('pegawai.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
