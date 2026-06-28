@extends('layouts.app')

@section('title', 'Nota Pembelian - PT Ken Mandiri Teknik')
@section('active', 'nota')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-file-invoice mr-2" style="color: #000000;"></i>Data <span>Nota Pembelian</span></h4>
      <p>Kelola data nota pembelian PT Ken Mandiri Teknik</p>
    </div>
    <a href="{{ route('nota.create') }}" class="btn-tambah">+ TAMBAHKAN</a>
  </div>

  <div class="table-card">
    <table id="example" class="table table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th>Kode Nota</th>
          <th>Tanggal</th>
          <th>Perusahaan</th>
          <th>Pegawai</th>
          <th>Informasi</th>
          <th>Aksi</th>
          <th>Detail</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $data)
          <tr>
            <td>{{ $data->kode_nota }}</td>
            <td>{{ $data->tanggal?->format('Y-m-d') }}</td>
            <td>{{ $data->perusahaan->nama_perusahaan ?? '' }}</td>
            <td>{{ $data->pegawai->nama_pegawai ?? '' }}</td>
            <td>{{ $data->informasi }}</td>
            <td>
              <a class="btn-ubah" href="{{ route('nota.edit', $data->kode_nota) }}"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
              <form action="{{ route('nota.destroy', $data->kode_nota) }}" method="POST" class="btn-hapus-inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-hapus ml-1">Hapus</button>
              </form>
            </td>
            <td>
              <a class="btn-detail" href="{{ route('nota.detail.index', $data->kode_nota) }}">Detail</a>
              <a class="badge-cetak ml-1" href="{{ route('nota.cetak', $data->kode_nota) }}" target="_blank">Cetak</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
