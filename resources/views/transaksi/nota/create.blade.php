@extends('layouts.app')

@section('title', 'Tambah Nota Pembelian - PT Ken Mandiri Teknik')
@section('active', 'nota')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-plus mr-2" style="color: #000000;"></i>Tambah <span>Nota Pembelian</span></h4>
      <p id="step-caption">Langkah 1 dari 3: Data Nota</p>
    </div>
    <a href="{{ route('nota.index') }}" class="btn-tambah">Kembali</a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Periksa kembali data yang dimasukkan:</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="table-card">
    <form action="{{ route('nota.store') }}" method="POST" id="nota-wizard-form">
      @csrf
      <div id="hidden-items-container"></div>

      {{-- STEP 1: Header --}}
      <div class="wizard-step" data-step="1">
        <div class="form-element">
          <label>Kode Nota</label>
          <input type="text" class="form-control" value="{{ $nextId }}" readonly>
          <small class="text-muted">Nomor nota dibuat otomatis oleh sistem.</small>
        </div>
        <div class="form-element">
          <label>Tanggal</label>
          <input type="date" name="tanggal" id="f-tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
          @error('tanggal') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="form-element">
          <label>Perusahaan</label>
          <select name="id_perusahaan" id="f-perusahaan" class="form-control js-select2 @error('id_perusahaan') is-invalid @enderror" data-placeholder="Cari perusahaan..." required>
            <option value="">--- Pilih Perusahaan ---</option>
            @foreach ($perusahaan as $r)
              <option value="{{ $r->id_perusahaan }}" @selected(old('id_perusahaan') === $r->id_perusahaan)>{{ $r->nama_perusahaan }}</option>
            @endforeach
          </select>
          @error('id_perusahaan') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
        </div>
        <div class="form-element">
          <label>Pegawai</label>
          @if (auth()->user()->isAdmin())
            <select name="id_pegawai" id="f-pegawai" class="form-control js-select2 @error('id_pegawai') is-invalid @enderror" data-placeholder="Cari pegawai..." required>
              <option value="">--- Pilih Pegawai ---</option>
              @foreach ($pegawai as $r)
                <option value="{{ $r->id_pegawai }}" @selected(old('id_pegawai') === $r->id_pegawai)>{{ $r->nama_pegawai }}</option>
              @endforeach
            </select>
            @error('id_pegawai') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
          @else
            <input type="text" class="form-control" value="{{ auth()->user()->pegawai->nama_pegawai ?? auth()->user()->name }}" readonly>
            <input type="hidden" name="id_pegawai" value="{{ auth()->user()->id_pegawai }}">
          @endif
        </div>
        <div class="form-element">
          <label>Informasi</label>
          <textarea name="informasi" id="f-informasi" class="form-control @error('informasi') is-invalid @enderror" rows="2">{{ old('informasi') }}</textarea>
          @error('informasi') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="form-actions">
          <a class="btn-secondary-form" href="{{ route('nota.index') }}">Batal</a>
          <button type="button" class="btn-primary-form" onclick="notaWizard.goToStep(2)">Selanjutnya <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </div>

      {{-- STEP 2: Detail Bahan Baku --}}
      <div class="wizard-step d-none" data-step="2">
        <div class="form-element">
          <label>Bahan Baku</label>
          <select id="item-bahan-baku" class="form-control js-select2" data-placeholder="Cari bahan baku...">
            <option value="">-- Pilih Bahan Baku --</option>
            @foreach ($bahanBaku as $b)
              <option value="{{ $b->id_bahan_baku }}" data-nama="{{ $b->nama_bahan_baku }}" data-harga="{{ $b->harga_bahan_baku }}" data-satuan="{{ $b->satuan }}">
                {{ $b->nama_bahan_baku }} ({{ $b->id_bahan_baku }})
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-element">
          <label>Harga Satuan</label>
          <input type="text" id="item-harga" class="form-control" readonly value="Rp 0">
        </div>
        <div class="form-element">
          <label>Satuan</label>
          <input type="text" id="item-satuan" class="form-control" readonly>
        </div>
        <div class="form-element">
          <label>Qty</label>
          <input type="number" step="1" min="1" id="item-qty" class="form-control" value="1">
        </div>
        <div class="form-element">
          <label>Keterangan</label>
          <input type="text" id="item-keterangan" class="form-control" placeholder="Keterangan tambahan (opsional)">
        </div>
        <div class="form-actions" style="justify-content:flex-start;">
          <button type="button" class="btn-primary-form" onclick="notaWizard.addItem()"><i class="fa-solid fa-plus"></i> Tambah ke Daftar</button>
        </div>

        <table class="detail-tbl mt-3">
          <thead>
            <tr>
              <th>Bahan Baku</th>
              <th>Satuan</th>
              <th>Qty</th>
              <th>Harga Satuan</th>
              <th>Sub Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="items-tbody">
            <tr id="items-empty-row"><td colspan="6" style="text-align:center;">Belum ada bahan baku ditambahkan</td></tr>
          </tbody>
        </table>

        <div class="form-actions">
          <button type="button" class="btn-secondary-form" onclick="notaWizard.goToStep(1)"><i class="fa-solid fa-arrow-left"></i> Sebelumnya</button>
          <button type="button" class="btn-primary-form" onclick="notaWizard.goToStep(3)">Selanjutnya <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </div>

      {{-- STEP 3: Ringkasan --}}
      <div class="wizard-step d-none" data-step="3">
        <div class="table-card mb-3" style="box-shadow:none; border:1px solid #e5e7eb; padding:15px;">
          <div class="row">
            <div class="col-md-6">
              <p class="mb-1"><strong>Kode Nota:</strong> {{ $nextId }}</p>
              <p class="mb-1"><strong>Tanggal:</strong> <span id="review-tanggal"></span></p>
            </div>
            <div class="col-md-6">
              <p class="mb-1"><strong>Perusahaan:</strong> <span id="review-perusahaan"></span></p>
              <p class="mb-1"><strong>Pegawai:</strong> <span id="review-pegawai"></span></p>
            </div>
          </div>
          <p class="mb-0 mt-2" id="review-informasi-wrap"><strong>Informasi:</strong> <span id="review-informasi"></span></p>
        </div>

        <table class="detail-tbl">
          <thead>
            <tr>
              <th>Bahan Baku</th>
              <th>Satuan</th>
              <th>Qty</th>
              <th>Harga Satuan</th>
              <th>Sub Total</th>
            </tr>
          </thead>
          <tbody id="review-tbody"></tbody>
          <tfoot>
            <tr>
              <td colspan="4" style="text-align:right;font-weight:700;background:#F5F5F5;">GRAND TOTAL</td>
              <td style="text-align:right;font-weight:700;background:#F5F5F5;" id="review-grand-total">Rp 0</td>
            </tr>
          </tfoot>
        </table>

        <div class="form-actions">
          <button type="button" class="btn-secondary-form" onclick="notaWizard.goToStep(2)"><i class="fa-solid fa-arrow-left"></i> Sebelumnya</button>
          <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('scripts')
<script>
window.notaWizard = (function () {
  var items = [];

  function formatRupiah(n) {
    return 'Rp ' + Number(n || 0).toLocaleString('id-ID', {minimumFractionDigits: 2, maximumFractionDigits: 2});
  }

  function goToStep(step) {
    if (step === 2 && !validateStep1()) return;
    if (step === 3) {
      if (items.length === 0) {
        alert('Tambahkan minimal satu bahan baku sebelum melanjutkan.');
        return;
      }
      renderReview();
    }
    document.querySelectorAll('.wizard-step').forEach(function (el) {
      el.classList.toggle('d-none', el.getAttribute('data-step') != step);
    });
    var captions = {1: 'Langkah 1 dari 3: Data Nota', 2: 'Langkah 2 dari 3: Detail Bahan Baku', 3: 'Langkah 3 dari 3: Ringkasan'};
    document.getElementById('step-caption').textContent = captions[step];
    window.scrollTo({top: 0, behavior: 'smooth'});
  }

  function validateStep1() {
    var tanggal = document.getElementById('f-tanggal').value;
    var perusahaan = document.getElementById('f-perusahaan').value;
    var pegawaiField = document.getElementById('f-pegawai') || document.querySelector('input[name="id_pegawai"]');
    var pegawai = pegawaiField ? pegawaiField.value : '';
    if (!tanggal || !perusahaan || !pegawai) {
      alert('Lengkapi Tanggal, Perusahaan, dan Pegawai terlebih dahulu.');
      return false;
    }
    return true;
  }

  function addItem() {
    var sel = document.getElementById('item-bahan-baku');
    var id = sel.value;
    if (!id) {
      alert('Pilih bahan baku terlebih dahulu.');
      return;
    }
    var opt = sel.options[sel.selectedIndex];
    var qty = parseFloat(document.getElementById('item-qty').value) || 0;
    if (qty <= 0) {
      alert('Qty harus lebih dari 0.');
      return;
    }
    var harga = parseFloat(opt.getAttribute('data-harga')) || 0;

    items.push({
      id_bahan_baku: id,
      nama: opt.getAttribute('data-nama'),
      satuan: opt.getAttribute('data-satuan') || '-',
      harga: harga,
      qty: qty,
      keterangan: document.getElementById('item-keterangan').value
    });

    $(sel).val('').trigger('change');
    document.getElementById('item-qty').value = 1;
    document.getElementById('item-keterangan').value = '';
    document.getElementById('item-harga').value = 'Rp 0';
    document.getElementById('item-satuan').value = '';

    renderItemsTable();
  }

  function removeItem(index) {
    items.splice(index, 1);
    renderItemsTable();
  }

  function renderItemsTable() {
    var tbody = document.getElementById('items-tbody');
    tbody.innerHTML = '';

    if (items.length === 0) {
      tbody.innerHTML = '<tr id="items-empty-row"><td colspan="6" style="text-align:center;">Belum ada bahan baku ditambahkan</td></tr>';
    } else {
      items.forEach(function (it, idx) {
        var sub = it.qty * it.harga;
        var tr = document.createElement('tr');
        tr.innerHTML =
          '<td>' + it.nama + '</td>' +
          '<td style="text-align:center;">' + it.satuan + '</td>' +
          '<td style="text-align:center;">' + it.qty + '</td>' +
          '<td style="text-align:right;">' + formatRupiah(it.harga) + '</td>' +
          '<td style="text-align:right;">' + formatRupiah(sub) + '</td>' +
          '<td style="text-align:center;"><button type="button" class="btn-hapus" onclick="notaWizard.removeItem(' + idx + ')">Hapus</button></td>';
        tbody.appendChild(tr);
      });
    }

    syncHiddenInputs();
  }

  function syncHiddenInputs() {
    var container = document.getElementById('hidden-items-container');
    container.innerHTML = '';
    items.forEach(function (it, idx) {
      ['id_bahan_baku', 'qty', 'keterangan'].forEach(function (field) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'items[' + idx + '][' + field + ']';
        input.value = it[field];
        container.appendChild(input);
      });
    });
  }

  function renderReview() {
    var perusahaanSel = document.getElementById('f-perusahaan');
    var pegawaiSel = document.getElementById('f-pegawai');

    document.getElementById('review-tanggal').textContent = document.getElementById('f-tanggal').value;
    document.getElementById('review-perusahaan').textContent = perusahaanSel.options[perusahaanSel.selectedIndex].text;
    document.getElementById('review-pegawai').textContent = pegawaiSel
      ? pegawaiSel.options[pegawaiSel.selectedIndex].text
      : document.querySelector('#nota-wizard-form input[type="text"][readonly]').value;

    var informasi = document.getElementById('f-informasi').value;
    document.getElementById('review-informasi-wrap').style.display = informasi ? '' : 'none';
    document.getElementById('review-informasi').textContent = informasi;

    var tbody = document.getElementById('review-tbody');
    tbody.innerHTML = '';
    var grandTotal = 0;
    items.forEach(function (it) {
      var sub = it.qty * it.harga;
      grandTotal += sub;
      var tr = document.createElement('tr');
      tr.innerHTML =
        '<td>' + it.nama + '</td>' +
        '<td style="text-align:center;">' + it.satuan + '</td>' +
        '<td style="text-align:center;">' + it.qty + '</td>' +
        '<td style="text-align:right;">' + formatRupiah(it.harga) + '</td>' +
        '<td style="text-align:right;">' + formatRupiah(sub) + '</td>';
      tbody.appendChild(tr);
    });
    document.getElementById('review-grand-total').textContent = formatRupiah(grandTotal);
  }

  document.addEventListener('DOMContentLoaded', function () {
    var sel = document.getElementById('item-bahan-baku');
    $(sel).on('change', function () {
      var opt = sel.options[sel.selectedIndex];
      var harga = opt.getAttribute('data-harga') || 0;
      document.getElementById('item-harga').value = formatRupiah(harga);
      document.getElementById('item-satuan').value = opt.getAttribute('data-satuan') || '';
    });
  });

  return {
    goToStep: goToStep,
    addItem: addItem,
    removeItem: removeItem
  };
})();
</script>
@endsection
