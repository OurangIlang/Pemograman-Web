<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>nota Harga - {{ $nota->kode_nota }}</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
  body { font-family: Arial, sans-serif; background: #ddd; display: flex; flex-direction: column; align-items: center; padding: 24px; }
  .page { background: #fff; width: 720px; padding: 30px 36px; box-shadow: 0 0 10px rgba(0,0,0,0.2); }

  /* HEADER */
  .header { display: flex; align-items: flex-start; justify-content: space-between; border-bottom: 3px solid #c00; margin-bottom: 20px; padding-bottom: 12px; }
  .logo-area { text-align: center; }
  .logo-img { width: 80px; height: 60px; background: linear-gradient(135deg, #c00 50%, #900 50%); display: flex; align-items: center; justify-content: center; border-radius: 4px; }
  .logo-img span { color: #fff; font-weight: 900; font-size: 18px; letter-spacing: 1px; }
  .logo-sub { font-size: 9px; font-weight: bold; color: #c00; margin-top: 4px; }
  .logo-tagline { font-size: 8px; color: #555; font-style: italic; }
  .contact-info { text-align: right; font-size: 10px; line-height: 1.8; color: #333; }
  .contact-info .row { display: flex; justify-content: flex-end; gap: 8px; }
  .contact-info .lbl { font-weight: bold; width: 40px; text-align: right; }

  /* TAGLINE BAWAH LOGO */
  .company-center { text-align: center; margin-top: 6px; }
  .company-center .nama { font-size: 13px; font-weight: 900; letter-spacing: 1px; color: #000; }
  .company-center .sub { font-size: 9px; font-style: italic; color: #555; }

  /* META INFO */
  .meta-section { font-size: 11px; margin-bottom: 16px; line-height: 2; }
  .meta-row { display: flex; gap: 0; }
  .meta-lbl { width: 100px; }
  .meta-sep { width: 20px; }
  .meta-val { flex: 1; }

  /* SALAM */
  .salam { font-size: 11px; margin-bottom: 10px; line-height: 1.7; }

  /* TABLE */
  table.items { width: 100%; border-collapse: collapse; font-size: 11px; margin-bottom: 12px; }
  table.items th { background: #f0f0f0 !important; text-align: center; padding: 6px 8px; border: 1px solid #888; font-size: 11px; font-weight: bold; }
  table.items td { border: 1px solid #888; padding: 6px 8px; }
  .td-c { text-align: center; }
  .td-r { text-align: right; }

  /* TOTAL ROW */
  .total-row td { font-weight: bold; background: #f5f5f5 !important; }

  /* SYARAT */
  .syarat { font-size: 10px; line-height: 1.8; margin-bottom: 16px; }
  .syarat .title { font-weight: bold; font-size: 11px; margin-bottom: 2px; }

  /* PENUTUP */
  .penutup { font-size: 11px; line-height: 1.7; margin-bottom: 20px; }

  /* TTD */
  .ttd-section { display: flex; gap: 30px; font-size: 11px; }
  .ttd-box { }
  .ttd-box .hormat { margin-bottom: 4px; }
  .ttd-box .perusahaan { font-size: 10px; color: #333; }
  .ttd-space { height: 60px; }
  .ttd-box .nama { font-weight: bold; font-size: 12px; text-transform: uppercase; }

  .no-print { margin-top: 16px; text-align: center; }
  @media print {
    body { background: none; padding: 0; }
    .page { box-shadow: none; }
    .no-print { display: none; }
  }
</style>
</head>
<body>
<div class="page">

  <!-- HEADER -->
  <div class="header">
    <div>
      <div class="logo-area">
        <div class="logo-img"><span>AE</span></div>
      </div>
      <div class="company-center">
        <div class="nama">{{ $nota->perusahaan->nama_perusahaan ?? '' }}</div>
        <div class="sub">Maintenance, Contractor and Switch Board</div>
      </div>
    </div>
    <div class="contact-info">
      <div>{{ $nota->perusahaan->alamat_perusahaan ?? '' }}</div>
      <div class="row"><span class="lbl">Telp</span><span>: {{ $nota->perusahaan->no_telpon ?? '' }}</span></div>
      <div class="row"><span class="lbl">Fax</span><span>: {{ $nota->perusahaan->no_fax ?? $nota->perusahaan->no_telpon ?? '' }}</span></div>
      <div class="row"><span class="lbl">Email</span><span>: {{ $nota->perusahaan->email_perusahaan ?? '' }}</span></div>
    </div>
  </div>

  <!-- META -->
  <div class="meta-section">
    <div class="meta-row"><span class="meta-lbl">Tanggal</span><span class="meta-sep">:</span><span class="meta-val">{{ $nota->tanggal?->format('Y-m-d') }}</span></div>
    <div class="meta-row"><span class="meta-lbl">Kode Nota</span><span class="meta-sep">:</span><span class="meta-val">{{ $nota->kode_nota }}</span></div>
    <div class="meta-row"><span class="meta-lbl">Deskripsi</span><span class="meta-sep">:</span><span class="meta-val">{{ $nota->informasi }}</span></div>
    <br>
    <div class="meta-row"><span style="width:100px;font-weight:bold;">Perusahaan</span><span class="meta-sep">:</span><span class="meta-val"><strong>{{ $nota->perusahaan->nama_perusahaan ?? '' }}</strong></div>
    <div class="meta-row"><span class="meta-lbl">Nama Pegawai</span><span class="meta-sep">:</span><span class="meta-val">{{ $nota->pegawai->nama_pegawai ?? '' }}</span></div>
  </div>

  <!-- SALAM -->
  <div class="salam">
    <p>Hormat,</p>
    <p>Dengan ini kami tawarkan harga terbaik untuk proyek tersebut diatas sebagai berikut :</p>
  </div>

  <!-- TABLE -->
  <table class="items">
    <thead>
      <tr>
        <th>Keterangan</th>
        <th style="width:80px;">Qty</th>
        <th style="width:150px;">Harga Satuan</th>
        <th style="width:150px;">Total Harga</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($nota->details as $item)
        @php $tot_item = $item->qty * $item->harga_satuan; @endphp
      <tr>
        <td>{{ $item->keterangan }}</td>
        <td class="td-c">{{ number_format($item->qty, 0, ',', '.') }} Unit</td>
        <td class="td-r">@@Rp &nbsp; {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
        <td class="td-r">Rp &nbsp; {{ number_format($tot_item, 0, ',', '.') }}</td>
      </tr>
      @endforeach
      <tr class="total-row">
        <td colspan="3" style="text-align:right;">Total ...............</td>
        <td class="td-r">Rp &nbsp; {{ number_format($total, 0, ',', '.') }}</td>
      </tr>
    </tbody>
  </table>

  <!-- SYARAT -->
  <div class="syarat">
    <p>Tersebut :</p>
    <div style="margin-left:16px;">
      <p>Belum termasuk PPn</p>
      <p>Harga hanya berlaku 1 (satu) Minggu</p>
      <p>Loco Jabotabek ( F O T )</p>
    </div>
    <br>
    <div class="title">Pembayaran :</div>
    <div style="margin-left:16px;">
      <p>40% Down Payment</p>
      <p>60% Progress Setelah pengiriman</p>
    </div>
  </div>

  <!-- PENUTUP -->
  <div class="penutup">
    <p>Penawaran ini kami sampaikan, Atas perhatian dan kerjasama yang baik kami ucapkan terima kasih.</p>
  </div>

  <!-- TTD -->
  <div class="ttd-section">
    <div class="ttd-box">
      <div class="hormat">Hormat kami</div>
      <div class="perusahaan">.........................</div>
      <div class="ttd-space"></div>
      <div class="nama">{{ $nota->perusahaan->nama_penandatangan ?? '' }}</div>
    </div>
  </div>

</div>
<div class="no-print">
  <button onclick="window.print()" style="padding:8px 28px; font-size:14px; cursor:pointer;">Cetak</button>
</div>
</body>
</html>
