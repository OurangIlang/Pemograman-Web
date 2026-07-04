@extends('layouts.app')

@section('title', 'Ubah Item Invoice - PT Ken Mandiri Teknik')
@section('active', 'invoice')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-edit mr-2" style="color: #000000;"></i>Ubah Item <span>Invoice {{ $detail->no_invoice }}</span></h4>
      <p>Perbarui item barang pada invoice</p>
    </div>
    <a href="{{ route('invoice.detail.index', $detail->no_invoice) }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('invoice.detail.update', [$detail->no_invoice, $detail->id_barang]) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-element">
        <label>No Invoice</label>
        <input type="text" class="form-control" value="{{ $detail->no_invoice }}" readonly>
      </div>

      <div class="form-element">
        <label>Barang</label>
        <select id="id_barang" class="form-control" onchange="ambilHarga()" disabled>
          @foreach ($barang as $b)
            <option value="{{ $b->id_barang }}" data-harga="{{ $b->harga_barang }}" @selected($detail->id_barang === $b->id_barang)>
              {{ $b->nama_barang }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-element">
        <label>Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi', $detail->deskripsi) }}">
      </div>

      <div class="form-element">
        <label>Qty</label>
        <input type="number" step="0.001" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty', $detail->qty) }}" required oninput="hitung()">
        @error('qty') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>

      <div class="form-element">
        <label>Unit Price</label>
        <input type="number" step="0.01" name="unit_price" id="unit_price" class="form-control" value="{{ old('unit_price', $detail->unit_price_terkini) }}" readonly>
      </div>

      <div class="form-element">
        <label>Sub Total</label>
        <input type="text" id="sub_display" class="form-control" readonly value="Rp {{ number_format($detail->sub_total_terkini, 2, ',', '.') }}">
      </div>

      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('invoice.detail.index', $detail->no_invoice) }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection

@section('scripts')
<script>
function ambilHarga() {
    var sel   = document.getElementById('id_barang');
    var harga = sel.options[sel.selectedIndex].getAttribute('data-harga') || 0;
    document.getElementById('unit_price').value = parseFloat(harga).toFixed(2);
    hitung();
}
function hitung() {
    var q   = parseFloat(document.getElementById('qty').value) || 0;
    var p   = parseFloat(document.getElementById('unit_price').value) || 0;
    var sub = q * p;
    document.getElementById('sub_display').value = 'Rp ' + sub.toLocaleString('id-ID', {minimumFractionDigits: 2});
}
</script>
@endsection
