@extends('layouts.app')

@section('title', 'Tambah Nota Pembelian - PT Ken Mandiri Teknik')
@section('active', 'nota')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-plus mr-2" style="color: #000000;"></i>Tambah <span>Nota Pembelian</span></h4>
      <p>Isi data nota pembelian baru</p>
    </div>
    <a href="{{ route('nota.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('nota.store') }}" method="POST">
      @csrf
      <div class="form-element">
        <label>Kode Nota</label>
        <input type="text" name="kode_nota" class="form-control @error('kode_nota') is-invalid @enderror" value="{{ old('kode_nota') }}" required>
        @error('kode_nota') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
        @error('tanggal') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Perusahaan</label>
        <select name="id_perusahaan" class="form-control @error('id_perusahaan') is-invalid @enderror" required>
          <option disabled selected>--- Pilih Perusahaan ---</option>
          @foreach ($perusahaan as $r)
            <option value="{{ $r->id_perusahaan }}" @selected(old('id_perusahaan') === $r->id_perusahaan)>{{ $r->nama_perusahaan }}</option>
          @endforeach
        </select>
        @error('id_perusahaan') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Pegawai</label>
        <select name="id_pegawai" class="form-control @error('id_pegawai') is-invalid @enderror" required>
          <option disabled selected>--- Pilih Pegawai ---</option>
          @foreach ($pegawai as $r)
            <option value="{{ $r->id_pegawai }}" @selected(old('id_pegawai') === $r->id_pegawai)>{{ $r->nama_pegawai }}</option>
          @endforeach
        </select>
        @error('id_pegawai') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Informasi</label>
        <textarea name="informasi" class="form-control @error('informasi') is-invalid @enderror" rows="2">{{ old('informasi') }}</textarea>
        @error('informasi') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('nota.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
