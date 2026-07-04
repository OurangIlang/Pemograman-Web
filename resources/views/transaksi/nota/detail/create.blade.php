@extends('layouts.app')

@section('title', 'Tambah Item Nota - PT Ken Mandiri Teknik')
@section('active', 'nota')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-plus mr-2" style="color: #000000;"></i>Tambah Item <span>Nota {{ $nota->kode_nota }}</span></h4>
      <p>Tambahkan bahan baku ke nota pembelian</p>
    </div>
    <a href="{{ route('nota.detail.index', $nota->kode_nota) }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('nota.detail.store') }}" method="POST">
      @csrf
      <input type="hidden" name="kode_nota" value="{{ $nota->kode_nota }}">

      <div class="form-element">
        <label>Kode Nota</label>
        <input type="text" class="form-control" value="{{ $nota->kode_nota }}" readonly>
      </div>

      <div class="form-element">
        <label>Bahan Baku</label>
        <select name="id_bahan_baku" id="id_bahan_baku" class="form-control @error('id_bahan_baku') is-invalid @enderror" onchange="ambilHarga()" required>
          <option value="">-- Pilih Bahan Baku --</option>
          @foreach ($bahanBaku as $b)
            <option value="{{ $b->id_bahan_baku }}" data-harga="{{ $b->harga_bahan_baku }}" @selected(old('id_bahan_baku') === $b->id_bahan_baku)>
              {{ $b->nama_bahan_baku }}
            </option>
          @endforeach
        </select>
        @error('id_bahan_baku') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>

      <div class="form-element">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan tambahan" value="{{ old('keterangan') }}">
      </div>

      <div class="form-element">
        <label>Qty</label>
        <input type="number" step="0.001" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty', '1') }}" required oninput="hitung()">
        @error('qty') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>

      <div class="form-element">
        <label>Harga Satuan</label>
        <input type="number" step="0.01" name="harga_satuan" id="harga_satuan" class="form-control" value="{{ old('harga_satuan', '0') }}" readonly>
      </div>

      <div class="form-element">
        <label>Sub Total</label>
        <input type="text" id="sub_display" class="form-control" readonly value="Rp 0">
        <input type="hidden" name="sub_total" id="sub_total" value="{{ old('sub_total', '0') }}">
      </div>

      <div class="form-element">
        <label>Total Harga</label>
        <input type="number" step="0.01" name="total_harga" id="total_harga" class="form-control" value="{{ old('total_harga', '0') }}" readonly>
      </div>

      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('nota.detail.index', $nota->kode_nota) }}">Batal</a>
        <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </form>
  </div>
@endsection

@section('scripts')
<script>
function ambilHarga() {
    var sel   = document.getElementById('id_bahan_baku');
    var harga = sel.options[sel.selectedIndex].getAttribute('data-harga') || 0;
    document.getElementById('harga_satuan').value = parseFloat(harga).toFixed(2);
    hitung();
}
function hitung() {
    var q   = parseFloat(document.getElementById('qty').value) || 0;
    var p   = parseFloat(document.getElementById('harga_satuan').value) || 0;
    var sub = q * p;
    document.getElementById('sub_display').value = 'Rp ' + sub.toLocaleString('id-ID', {minimumFractionDigits: 2});
    document.getElementById('sub_total').value   = sub;
    document.getElementById('total_harga').value = sub;
}
</script>
@endsection
