@extends('layouts.app')

@section('title', 'Tambah Invoice Penjualan - PT Ken Mandiri Teknik')
@section('active', 'invoice')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-plus mr-2" style="color: #000000;"></i>Tambah <span>Invoice Penjualan</span></h4>
      <p>Isi data invoice penjualan baru</p>
    </div>
    <a href="{{ route('invoice.index') }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('invoice.store') }}" method="POST">
      @csrf
      <div class="form-element">
        <label>No Invoice</label>
        <input type="text" name="no_invoice" class="form-control @error('no_invoice') is-invalid @enderror" value="{{ old('no_invoice') }}" required>
        @error('no_invoice') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>No Faktur</label>
        <input type="text" name="no_faktur" class="form-control @error('no_faktur') is-invalid @enderror" value="{{ old('no_faktur') }}">
        @error('no_faktur') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>No Preorder</label>
        <input type="text" name="no_preorder" class="form-control @error('no_preorder') is-invalid @enderror" value="{{ old('no_preorder') }}">
        @error('no_preorder') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
        @error('tanggal') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Customer</label>
        <select name="id_customer" class="form-control @error('id_customer') is-invalid @enderror" required>
          <option disabled selected>--- Pilih Customer ---</option>
          @foreach ($customer as $r)
            <option value="{{ $r->id_customer }}" @selected(old('id_customer') === $r->id_customer)>{{ $r->nama_customer }}</option>
          @endforeach
        </select>
        @error('id_customer') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>
      <div class="form-element">
        <label>Pegawai</label>
        @if (auth()->user()->isAdmin())
          <select name="id_pegawai" class="form-control @error('id_pegawai') is-invalid @enderror" required>
            <option disabled selected>--- Pilih Pegawai ---</option>
            @foreach ($pegawai as $r)
              <option value="{{ $r->id_pegawai }}" @selected(old('id_pegawai') === $r->id_pegawai)>{{ $r->nama_pegawai }}</option>
            @endforeach
          </select>
          @error('id_pegawai') <span class="invalid-feedback">{{ $message }}</span> @enderror
        @else
          <input type="text" class="form-control" value="{{ auth()->user()->pegawai->nama_pegawai ?? auth()->user()->name }}" readonly>
          <input type="hidden" name="id_pegawai" value="{{ auth()->user()->id_pegawai }}">
        @endif
      </div>
      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('invoice.index') }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection
