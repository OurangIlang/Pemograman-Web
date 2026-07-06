@extends('layouts.app')

@section('title', 'Invoice Penjualan - PT Ken Mandiri Teknik')
@section('active', 'invoice')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-file-alt mr-2" style="color: #000000;"></i>Data <span>Invoice Penjualan</span></h4>
      <p>Kelola data invoice penjualan PT Ken Mandiri Teknik</p>
    </div>
    <a href="{{ route('invoice.create') }}" class="btn-tambah">+ TAMBAHKAN</a>
  </div>

  <div class="table-card">
    <table id="example" class="table table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th>No Invoice</th>
          <th>No Faktur</th>
          <th>No Preorder</th>
          <th>Tanggal</th>
          <th>Customer</th>
          <th>Pegawai</th>
          <th>Aksi</th>
          <th>Detail</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $data)
          <tr>
            <td>{{ $data->no_invoice }}</td>
            <td>{{ $data->no_faktur }}</td>
            <td>{{ $data->no_preorder }}</td>
            <td>{{ $data->tanggal?->format('Y-m-d') }}</td>
            <td>{{ $data->customer->nama_customer ?? '' }}</td>
            <td>{{ $data->pegawai->nama_pegawai ?? '' }}</td>
            <td>
              <a class="btn-ubah" href="{{ route('invoice.edit', $data->no_invoice) }}"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
              <form action="{{ route('invoice.destroy', $data->no_invoice) }}" method="POST" class="btn-hapus-inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-hapus ml-1">Hapus</button>
              </form>
            </td>
            <td>
              <a class="btn-detail" href="{{ route('invoice.detail.index', $data->no_invoice) }}">Detail</a>
              <a class="badge-cetak ml-1" href="{{ route('invoice.cetak', $data->no_invoice) }}" target="_blank">Cetak</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
