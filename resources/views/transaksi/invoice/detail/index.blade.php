@extends('layouts.app')

@section('title', 'Detail Invoice ' . $invoice->no_invoice . ' - PT Ken Mandiri Teknik')
@section('active', 'invoice')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-list mr-2" style="color: #000000;"></i>Detail <span>Invoice {{ $invoice->no_invoice }}</span></h4>
      <p>Rincian item invoice penjualan</p>
    </div>
    <div>
      <a href="{{ route('invoice.cetak', $invoice->no_invoice) }}" target="_blank" class="badge-cetak">Cetak Invoice</a>
      <a href="{{ route('invoice.index') }}" class="btn-tambah ml-2">Kembali</a>
    </div>
  </div>

  <div class="table-card mb-3">
    <div class="row">
      <div class="col-md-6">
        <p class="mb-1"><strong>No Invoice:</strong> {{ $invoice->no_invoice }}</p>
        <p class="mb-1"><strong>No Faktur:</strong> {{ $invoice->no_faktur }}</p>
        <p class="mb-1"><strong>No Preorder:</strong> {{ $invoice->no_preorder }}</p>
      </div>
      <div class="col-md-6">
        <p class="mb-1"><strong>Tanggal:</strong> {{ $invoice->tanggal?->format('d-m-Y') }}</p>
        <p class="mb-1"><strong>Customer:</strong> {{ $invoice->customer->nama_customer ?? '' }}</p>
        <p class="mb-1"><strong>Pegawai:</strong> {{ $invoice->pegawai->nama_pegawai ?? '' }}</p>
      </div>
    </div>
  </div>

  <div class="table-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="mb-0">Daftar Item</h5>
      <a href="{{ route('invoice.detail.create', $invoice->no_invoice) }}" class="btn-purple">+ Tambah Item</a>
    </div>

    <table class="detail-tbl">
      <thead>
        <tr>
          <th>Barang</th>
          <th>Deskripsi</th>
          <th>Qty</th>
          <th>Unit Price</th>
          <th>Sub Total</th>
          <th>Total Price</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($details as $d)
          <tr>
            <td>{{ $d->nama_barang_terkini }}</td>
            <td>{{ $d->deskripsi }}</td>
            <td style="text-align:center;">{{ $d->qty }}</td>
            <td style="text-align:right;">Rp {{ number_format($d->unit_price_terkini, 2, ',', '.') }}</td>
            <td style="text-align:right;">Rp {{ number_format($d->sub_total_terkini, 2, ',', '.') }}</td>
            <td style="text-align:right;">Rp {{ number_format($d->sub_total_terkini, 2, ',', '.') }}</td>
            <td style="text-align:center;">
              <a class="btn-ubah" href="{{ route('invoice.detail.edit', [$invoice->no_invoice, $d->id_barang]) }}"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
              <form action="{{ route('invoice.detail.destroy', [$invoice->no_invoice, $d->id_barang]) }}" method="POST" class="btn-hapus-inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-hapus ml-1">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" style="text-align:center;">Belum ada item pada invoice ini</td></tr>
        @endforelse
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5" style="text-align:right;font-weight:700;background:#F5F5F5;">GRAND TOTAL</td>
          <td style="text-align:right;font-weight:700;background:#F5F5F5;">Rp {{ number_format($grandTotal, 2, ',', '.') }}</td>
          <td style="background:#F5F5F5;"></td>
        </tr>
      </tfoot>
    </table>
  </div>
@endsection
