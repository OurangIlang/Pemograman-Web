@extends('layouts.app')

@section('title', 'Ubah Item Nota - PT Ken Mandiri Teknik')
@section('active', 'nota')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-edit mr-2" style="color: #000000;"></i>Ubah Item <span>Nota {{ $detail->kode_nota }}</span></h4>
      <p>Perbarui item bahan baku pada nota</p>
    </div>
    <a href="{{ route('nota.detail.index', $detail->kode_nota) }}" class="btn-tambah">Kembali</a>
  </div>

  <div class="table-card">
    <form action="{{ route('nota.detail.update', [$detail->kode_nota, $detail->id_bahan_baku]) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-element">
        <label>Kode Nota</label>
        <input type="text" class="form-control" value="{{ $detail->kode_nota }}" readonly>
      </div>

      <div class="form-element">
        <label>Bahan Baku</label>
        <select name="id_bahan_baku_display" id="id_bahan_baku" class="form-control" onchange="ambilHarga()" disabled>
          @foreach ($bahanBaku as $b)
            <option value="{{ $b->id_bahan_baku }}" data-harga="{{ $b->harga_bahan_baku }}" @selected($detail->id_bahan_baku === $b->id_bahan_baku)>
              {{ $b->nama_bahan_baku }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-element">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan', $detail->keterangan) }}">
      </div>

      <div class="form-element">
        <label>Qty</label>
        <input type="number" step="0.001" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty', $detail->qty) }}" required oninput="hitung()">
        @error('qty') <span class="invalid-feedback">{{ $message }}</span> @enderror
      </div>

      <div class="form-element">
        <label>Harga Satuan</label>
        <input type="number" step="0.01" name="harga_satuan" id="harga_satuan" class="form-control" value="{{ old('harga_satuan', $detail->harga_satuan_terkini) }}" readonly>
      </div>

      <div class="form-element">
        <label>Sub Total</label>
        <input type="text" id="sub_display" class="form-control" readonly value="Rp {{ number_format($detail->sub_total_terkini, 2, ',', '.') }}">
      </div>

      <div class="form-actions">
        <a class="btn-secondary-form" href="{{ route('nota.detail.index', $detail->kode_nota) }}">Batal</a>
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
}
</script>
@endsection
