@extends('layouts.app')

@section('title', 'Perusahaan - PT Ken Mandiri Teknik')
@section('active', 'perusahaan')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-building mr-2" style="color: #000000;"></i>Data <span>Perusahaan</span></h4>
      <p>Kelola data perusahaan PT Ken Mandiri Teknik</p>
    </div>
    <a href="{{ route('perusahaan.create') }}" class="btn-tambah">+ TAMBAHKAN</a>
  </div>

  <div class="table-card">
    <table id="example" class="table table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Perusahaan</th>
          <th>Alamat</th>
          <th>No. Telpon</th>
          <th>Email</th>
          <th>Penandatangan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $d)
          <tr>
            <td>{{ $d->id_perusahaan }}</td>
            <td>{{ $d->nama_perusahaan }}</td>
            <td>{{ $d->alamat_perusahaan }}</td>
            <td>{{ $d->no_telpon }}</td>
            <td>{{ $d->email_perusahaan }}</td>
            <td>{{ $d->nama_penandatangan }}</td>
            <td>
              <a class="btn-ubah" href="{{ route('perusahaan.edit', $d->id_perusahaan) }}"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
              <form action="{{ route('perusahaan.destroy', $d->id_perusahaan) }}" method="POST" class="btn-hapus-inline" onsubmit="return confirm('Yakin hapus?')">
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
