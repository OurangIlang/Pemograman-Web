@extends('layouts.app')

@section('title', 'Barang - PT Ken Mandiri Teknik')
@section('active', 'barang')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-box mr-2" style="color: #000000;"></i>Data <span>Barang</span></h4>
      <p>Kelola data barang PT Ken Mandiri Teknik</p>
    </div>
    <a href="{{ route('barang.create') }}" class="btn-tambah">+ TAMBAHKAN</a>
  </div>

  <div class="table-card">
    <table id="example" class="table table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th>ID Barang</th>
          <th>Nama Barang</th>
          <th>Harga Barang</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $d)
          <tr>
            <td>{{ $d->id_barang }}</td>
            <td>{{ $d->nama_barang }}</td>
            <td>Rp {{ number_format($d->harga_barang, 0, ',', '.') }}</td>
            <td>
              <a class="btn-ubah" href="{{ route('barang.edit', $d->id_barang) }}"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
              <form action="{{ route('barang.destroy', $d->id_barang) }}" method="POST" class="btn-hapus-inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-hapus ml-1">Hapus</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
