@extends('layouts.app')

@section('title', 'Riwayat Transaksi - PT Ken Mandiri Teknik')
@section('active', 'riwayat-transaksi')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-clipboard-list mr-2" style="color: #000000;"></i>Riwayat <span>Transaksi</span></h4>
      <p>Gabungan riwayat seluruh nota pembelian &amp; invoice penjualan</p>
    </div>
  </div>

  <div class="table-card">
    <table id="example" class="table table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th>No. Transaksi</th>
          <th>Jenis</th>
          <th>User</th>
          <th>Pegawai</th>
          <th>Role</th>
          <th>Jumlah Item</th>
          <th>Tanggal</th>
          <th>Total</th>
          <th>Status</th>
          <th>Created By</th>
          <th>Updated By</th>
          <th>Deleted By</th>
          <th>Dibuat</th>
          <th>Diubah</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $row)
          <tr>
            <td>{{ $row->nomor }}</td>
            <td>
              @if ($row->jenis === 'Pembelian')
                <span class="badge-cetak" style="color:#1D4ED8;border-color:rgba(37,99,235,0.3);">Pembelian</span>
              @else
                <span class="badge-cetak" style="color:#065F46;border-color:rgba(16,185,129,0.3);">Penjualan</span>
              @endif
            </td>
            <td>{{ $row->user }}</td>
            <td>{{ $row->pegawai }}</td>
            <td>{{ $row->role }}</td>
            <td style="text-align:center;">{{ $row->jumlah_item }}</td>
            <td>{{ optional($row->tanggal)->format('d-m-Y') }}</td>
            <td>Rp {{ number_format($row->total, 0, ',', '.') }}</td>
            <td>
              @if ($row->status === 'Dihapus')
                <span style="color:#DC2626;font-weight:600;">{{ $row->status }}</span>
              @else
                <span style="color:#059669;font-weight:600;">{{ $row->status }}</span>
              @endif
            </td>
            <td>{{ $row->created_by }}</td>
            <td>{{ $row->updated_by }}</td>
            <td>{{ $row->deleted_by }}</td>
            <td>{{ optional($row->created_at)->format('d-m-Y H:i') ?? '-' }}</td>
            <td>{{ optional($row->updated_at)->format('d-m-Y H:i') ?? '-' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
