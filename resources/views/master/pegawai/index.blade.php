@extends('layouts.app')

@section('title', 'Pegawai - PT Ken Mandiri Teknik')
@section('active', 'pegawai')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-id-badge mr-2" style="color: #000000;"></i>Data <span>Pegawai</span></h4>
      <p>Kelola data pegawai PT Ken Mandiri Teknik</p>
    </div>
    <a href="{{ route('pegawai.create') }}" class="btn-tambah">+ TAMBAHKAN</a>
  </div>

  <div class="table-card">
    <table id="example" class="table table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th>ID Pegawai</th>
          <th>Nama Pegawai</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $d)
          <tr>
            <td>{{ $d->id_pegawai }}</td>
            <td>{{ $d->nama_pegawai }}</td>
            <td>
              <a class="btn-ubah" href="{{ route('pegawai.edit', $d->id_pegawai) }}"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
              <form action="{{ route('pegawai.destroy', $d->id_pegawai) }}" method="POST" class="btn-hapus-inline" onsubmit="return confirm('Yakin hapus?')">
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
