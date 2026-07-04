@extends('layouts.app')

@section('title', 'Detail Nota ' . $nota->kode_nota . ' - PT Ken Mandiri Teknik')
@section('active', 'nota')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-list mr-2" style="color: #000000;"></i>Detail <span>Nota {{ $nota->kode_nota }}</span></h4>
      <p>Rincian item nota pembelian</p>
    </div>
    <div>
      <a href="{{ route('nota.cetak', $nota->kode_nota) }}" target="_blank" class="badge-cetak">Cetak Nota</a>
      <a href="{{ route('nota.index') }}" class="btn-tambah ml-2">Kembali</a>
    </div>
  </div>

  <div class="table-card mb-3">
    <div class="row">
      <div class="col-md-6">
        <p class="mb-1"><strong>Kode Nota:</strong> {{ $nota->kode_nota }}</p>
        <p class="mb-1"><strong>Tanggal:</strong> {{ $nota->tanggal?->format('d-m-Y') }}</p>
      </div>
      <div class="col-md-6">
        <p class="mb-1"><strong>Perusahaan:</strong> {{ $nota->perusahaan->nama_perusahaan ?? '' }}</p>
        <p class="mb-1"><strong>Pegawai:</strong> {{ $nota->pegawai->nama_pegawai ?? '' }}</p>
      </div>
    </div>
    @if ($nota->informasi)
      <p class="mb-0 mt-2"><strong>Informasi:</strong> {{ $nota->informasi }}</p>
    @endif
  </div>

  <div class="table-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="mb-0">Daftar Item</h5>
      <a href="{{ route('nota.detail.create', $nota->kode_nota) }}" class="btn-purple">+ Tambah Item</a>
    </div>

    <table class="detail-tbl">
      <thead>
        <tr>
          <th>Bahan Baku</th>
          <th>Keterangan</th>
          <th>Qty</th>
          <th>Harga Satuan</th>
          <th>Sub Total</th>
          <th>Total Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($details as $d)
          <tr>
            <td>{{ $d->nama_bahan_baku_terkini }}</td>
            <td>{{ $d->keterangan }}</td>
            <td style="text-align:center;">{{ $d->qty }}</td>
            <td style="text-align:right;">Rp {{ number_format($d->harga_satuan_terkini, 2, ',', '.') }}</td>
            <td style="text-align:right;">Rp {{ number_format($d->sub_total_terkini, 2, ',', '.') }}</td>
            <td style="text-align:right;">Rp {{ number_format($d->sub_total_terkini, 2, ',', '.') }}</td>
            <td style="text-align:center;">
              <a class="btn-ubah" href="{{ route('nota.detail.edit', [$nota->kode_nota, $d->id_bahan_baku]) }}"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
              <form action="{{ route('nota.detail.destroy', [$nota->kode_nota, $d->id_bahan_baku]) }}" method="POST" class="btn-hapus-inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-hapus ml-1">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" style="text-align:center;">Belum ada item pada nota ini</td></tr>
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
