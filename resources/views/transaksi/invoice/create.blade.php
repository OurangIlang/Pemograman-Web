@extends('layouts.app')

@section('title', 'Tambah Invoice Penjualan - PT Ken Mandiri Teknik')
@section('active', 'invoice')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-plus mr-2" style="color: #000000;"></i>Tambah <span>Invoice Penjualan</span></h4>
      <p id="step-caption">Langkah 1 dari 3: Data Invoice</p>
    </div>
    <a href="{{ route('invoice.index') }}" class="btn-tambah">Kembali</a>
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
    <form action="{{ route('invoice.store') }}" method="POST" id="invoice-wizard-form">
      @csrf
      <div id="hidden-items-container"></div>

      {{-- STEP 1: Header --}}
      <div class="wizard-step" data-step="1">
        <div class="form-element">
          <label>No Invoice</label>
          <input type="text" class="form-control" value="{{ $nextNoInvoice }}" readonly>
          <small class="text-muted">Nomor invoice dibuat otomatis oleh sistem.</small>
        </div>
        <div class="form-element">
          <label>No Faktur</label>
          <input type="text" class="form-control" value="{{ $nextNoFaktur }}" readonly>
          <small class="text-muted">Nomor faktur dibuat otomatis oleh sistem.</small>
        </div>
        <div class="form-element">
          <label>No Preorder (PO)</label>
          <input type="text" class="form-control" value="{{ $nextNoPreorder }}" readonly>
          <small class="text-muted">Nomor PO dibuat otomatis oleh sistem.</small>
        </div>
        <div class="form-element">
          <label>Tanggal</label>
          <input type="date" name="tanggal" id="f-tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
          @error('tanggal') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="form-element">
          <label>Customer</label>
          <select name="id_customer" id="f-customer" class="form-control js-select2 @error('id_customer') is-invalid @enderror" data-placeholder="Cari customer..." required>
            <option value="">--- Pilih Customer ---</option>
            @foreach ($customer as $r)
              <option value="{{ $r->id_customer }}" @selected(old('id_customer') === $r->id_customer)>{{ $r->nama_customer }}</option>
            @endforeach
          </select>
          @error('id_customer') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
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
        <div class="form-actions">
          <a class="btn-secondary-form" href="{{ route('invoice.index') }}">Batal</a>
          <button type="button" class="btn-primary-form" onclick="invoiceWizard.goToStep(2)">Selanjutnya <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </div>

      {{-- STEP 2: Detail Barang --}}
      <div class="wizard-step d-none" data-step="2">
        <div class="form-element">
          <label>Barang</label>
          <select id="item-barang" class="form-control js-select2" data-placeholder="Cari barang...">
            <option value="">-- Pilih Barang --</option>
            @foreach ($barang as $b)
              <option value="{{ $b->id_barang }}" data-nama="{{ $b->nama_barang }}" data-harga="{{ $b->harga_barang }}" data-satuan="{{ $b->satuan }}">
                {{ $b->nama_barang }} ({{ $b->id_barang }})
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-element">
          <label>Harga</label>
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
          <label>Deskripsi</label>
          <input type="text" id="item-deskripsi" class="form-control" placeholder="Deskripsi tambahan (opsional)">
        </div>
        <div class="form-actions" style="justify-content:flex-start;">
          <button type="button" class="btn-primary-form" onclick="invoiceWizard.addItem()"><i class="fa-solid fa-plus"></i> Tambah ke Daftar</button>
        </div>

        <table class="detail-tbl mt-3">
          <thead>
            <tr>
              <th>Barang</th>
              <th>Satuan</th>
              <th>Qty</th>
              <th>Harga</th>
              <th>Sub Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="items-tbody">
            <tr id="items-empty-row"><td colspan="6" style="text-align:center;">Belum ada barang ditambahkan</td></tr>
          </tbody>
        </table>

        <div class="form-actions">
          <button type="button" class="btn-secondary-form" onclick="invoiceWizard.goToStep(1)"><i class="fa-solid fa-arrow-left"></i> Sebelumnya</button>
          <button type="button" class="btn-primary-form" onclick="invoiceWizard.goToStep(3)">Selanjutnya <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </div>

      {{-- STEP 3: Review --}}
      <div class="wizard-step d-none" data-step="3">
        <div class="table-card mb-3" style="box-shadow:none; border:1px solid #e5e7eb; padding:15px;">
          <div class="row">
            <div class="col-md-6">
              <p class="mb-1"><strong>No Invoice:</strong> {{ $nextNoInvoice }}</p>
              <p class="mb-1"><strong>No Faktur:</strong> {{ $nextNoFaktur }}</p>
              <p class="mb-1"><strong>No Preorder:</strong> {{ $nextNoPreorder }}</p>
              <p class="mb-1"><strong>Tanggal:</strong> <span id="review-tanggal"></span></p>
            </div>
            <div class="col-md-6">
              <p class="mb-1"><strong>Customer:</strong> <span id="review-customer"></span></p>
              <p class="mb-1"><strong>Pegawai:</strong> <span id="review-pegawai"></span></p>
            </div>
          </div>
        </div>

        <table class="detail-tbl">
          <thead>
            <tr>
              <th>Barang</th>
              <th>Satuan</th>
              <th>Qty</th>
              <th>Harga</th>
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
          <button type="button" class="btn-secondary-form" onclick="invoiceWizard.goToStep(2)"><i class="fa-solid fa-arrow-left"></i> Sebelumnya</button>
          <button type="submit" class="btn-primary-form"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
@endsection

@section('scripts')
<script>
window.invoiceWizard = (function () {
  var items = [];

  function formatRupiah(n) {
    return 'Rp ' + Number(n || 0).toLocaleString('id-ID', {minimumFractionDigits: 2, maximumFractionDigits: 2});
  }

  function goToStep(step) {
    if (step === 2 && !validateStep1()) return;
    if (step === 3) {
      if (items.length === 0) {
        alert('Tambahkan minimal satu barang sebelum melanjutkan.');
        return;
      }
      renderReview();
    }
    document.querySelectorAll('.wizard-step').forEach(function (el) {
      el.classList.toggle('d-none', el.getAttribute('data-step') != step);
    });
    var captions = {1: 'Langkah 1 dari 3: Data Invoice', 2: 'Langkah 2 dari 3: Detail Barang', 3: 'Langkah 3 dari 3: Review'};
    document.getElementById('step-caption').textContent = captions[step];
    window.scrollTo({top: 0, behavior: 'smooth'});
  }

  function validateStep1() {
    var tanggal = document.getElementById('f-tanggal').value;
    var customer = document.getElementById('f-customer').value;
    var pegawaiField = document.getElementById('f-pegawai') || document.querySelector('input[name="id_pegawai"]');
    var pegawai = pegawaiField ? pegawaiField.value : '';
    if (!tanggal || !customer || !pegawai) {
      alert('Lengkapi Tanggal, Customer, dan Pegawai terlebih dahulu.');
      return false;
    }
    return true;
  }

  function addItem() {
    var sel = document.getElementById('item-barang');
    var id = sel.value;
    if (!id) {
      alert('Pilih barang terlebih dahulu.');
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
      id_barang: id,
      nama: opt.getAttribute('data-nama'),
      satuan: opt.getAttribute('data-satuan') || '-',
      harga: harga,
      qty: qty,
      deskripsi: document.getElementById('item-deskripsi').value
    });

    $(sel).val('').trigger('change');
    document.getElementById('item-qty').value = 1;
    document.getElementById('item-deskripsi').value = '';
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
      tbody.innerHTML = '<tr id="items-empty-row"><td colspan="6" style="text-align:center;">Belum ada barang ditambahkan</td></tr>';
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
          '<td style="text-align:center;"><button type="button" class="btn-hapus" onclick="invoiceWizard.removeItem(' + idx + ')">Hapus</button></td>';
        tbody.appendChild(tr);
      });
    }

    syncHiddenInputs();
  }

  function syncHiddenInputs() {
    var container = document.getElementById('hidden-items-container');
    container.innerHTML = '';
    items.forEach(function (it, idx) {
      ['id_barang', 'qty', 'deskripsi'].forEach(function (field) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'items[' + idx + '][' + field + ']';
        input.value = it[field];
        container.appendChild(input);
      });
    });
  }

  function renderReview() {
    var customerSel = document.getElementById('f-customer');
    var pegawaiSel = document.getElementById('f-pegawai');

    document.getElementById('review-tanggal').textContent = document.getElementById('f-tanggal').value;
    document.getElementById('review-customer').textContent = customerSel.options[customerSel.selectedIndex].text;
    document.getElementById('review-pegawai').textContent = pegawaiSel
      ? pegawaiSel.options[pegawaiSel.selectedIndex].text
      : document.querySelector('#invoice-wizard-form input[type="text"][readonly]').value;

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
    var sel = document.getElementById('item-barang');
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
