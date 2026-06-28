@extends('layouts.app')

@section('title', 'Customer - PT Ken Mandiri Teknik')
@section('active', 'customer')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-users mr-2" style="color: #000000;"></i>Data <span>Customer</span></h4>
      <p>Kelola data customer PT Ken Mandiri Teknik</p>
    </div>
    <a href="{{ route('customer.create') }}" class="btn-tambah">+ TAMBAHKAN</a>
  </div>

  <div class="table-card">
    <table id="example" class="table table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th>ID Customer</th>
          <th>Nama Customer</th>
          <th>Nama PT</th>
          <th>Alamat PT</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $d)
          <tr>
            <td>{{ $d->id_customer }}</td>
            <td>{{ $d->nama_customer }}</td>
            <td>{{ $d->nama_pt }}</td>
            <td>{{ $d->alamat_pt }}</td>
            <td>
              <a class="btn-ubah" href="{{ route('customer.edit', $d->id_customer) }}"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
              <form action="{{ route('customer.destroy', $d->id_customer) }}" method="POST" class="btn-hapus-inline" onsubmit="return confirm('Yakin hapus?')">
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
