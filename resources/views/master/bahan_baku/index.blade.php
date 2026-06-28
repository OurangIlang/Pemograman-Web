@extends('layouts.app')

@section('title', 'Bahan Baku - PT Ken Mandiri Teknik')
@section('active', 'bahan_baku')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-cubes mr-2" style="color: #000000;"></i>Data <span>Bahan Baku</span></h4>
      <p>Kelola data bahan baku PT Ken Mandiri Teknik</p>
    </div>
    <a href="{{ route('bahan_baku.create') }}" class="btn-tambah">+ TAMBAHKAN</a>
  </div>

  <div class="table-card">
    <table id="example" class="table table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th>ID Bahan Baku</th>
          <th>Nama Bahan Baku</th>
          <th>Harga Bahan Baku</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $d)
          <tr>
            <td>{{ $d->id_bahan_baku }}</td>
            <td>{{ $d->nama_bahan_baku }}</td>
            <td>Rp {{ number_format($d->harga_bahan_baku, 0, ',', '.') }}</td>
            <td>
              <a class="btn-ubah" href="{{ route('bahan_baku.edit', $d->id_bahan_baku) }}"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
              <form action="{{ route('bahan_baku.destroy', $d->id_bahan_baku) }}" method="POST" class="btn-hapus-inline" onsubmit="return confirm('Yakin hapus?')">
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
