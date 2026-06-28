@extends('layouts.app')

@section('title', 'Tambah Item Invoice - PT Ken Mandiri Teknik')
@section('active', 'invoice')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-plus mr-2" style="color: #000000;"></i>Tambah Item <span>Invoice {{ $invoice->no_invoice }}</span></h4>
      <p>Tambahkan barang ke invoice penjualan</p>
    </div>
    <a href="{{ route('invoice.detail.index', $invoice->no_invoice) }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('invoice.detail.store') }}" method="POST">
      @csrf
      <input type="hidden" name="no_invoice" value="{{ $invoice->no_invoice }}">

      <div class="form-element">
        <label>No Invoice</label>
        <input type="text" class="form-control" value="{{ $invoice->no_invoice }}" readonly>
      </div>

      <div class="form-element">
        <label>Barang</label>
        <select name="id_barang" id="id_barang" class="form-control @error('id_barang') is-invalid @enderror" onchange="ambilHarga()" required>
          <option value="">-- Pilih Barang --</option>
          @foreach ($barang as $b)
            <option value="{{ $b->id_barang }}" data-harga="{{ $b->harga_barang }}" @selected(old('id_barang') === $b->id_barang)>
              {{ $b->nama_barang }}
            </option>
          @endforeach
        </select>
        @error('id_barang') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>

      <div class="form-element">
        <label>Deskripsi</label>
        <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi tambahan" value="{{ old('deskripsi') }}">
      </div>

      <div class="form-element">
        <label>Qty</label>
        <input type="number" step="0.001" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty', '1') }}" required oninput="hitung()">
        @error('qty') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>

      <div class="form-element">
        <label>Unit Price</label>
        <input type="number" step="0.01" name="unit_price" id="unit_price" class="form-control" value="{{ old('unit_price', '0') }}" readonly>
      </div>

      <div class="form-element">
        <label>Sub Total</label>
        <input type="text" id="sub_display" class="form-control" readonly value="Rp 0">
        <input type="hidden" name="sub_total" id="sub_total" value="{{ old('sub_total', '0') }}">
      </div>

      <div class="form-element">
        <label>Total Price</label>
        <input type="number" step="0.01" name="total_price" id="total_price" class="form-control" value="{{ old('total_price', '0') }}" placeholder="Bisa include diskon/pajak">
      </div>

      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('invoice.detail.index', $invoice->no_invoice) }}">Batal</a>
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
    document.getElementById('sub_total').value   = sub;
    document.getElementById('total_price').value = sub;
}
</script>
@endsection
