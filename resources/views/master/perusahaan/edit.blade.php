@extends('layouts.app')

@section('title', 'Ubah Perusahaan - PT Ken Mandiri Teknik')
@section('active', 'perusahaan')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-edit mr-2" style="color: #000000;"></i>Ubah <span>Perusahaan</span></h4>
      <p>Perbarui data perusahaan</p>
    </div>
    <a href="{{ route('perusahaan.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('perusahaan.update', $item->id_perusahaan) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-element">
        <label>ID Perusahaan</label>
        <input type="text" value="{{ $item->id_perusahaan }}" class="form-control" readonly>
      </div>
      @include('master.perusahaan._fields')
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('perusahaan.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
