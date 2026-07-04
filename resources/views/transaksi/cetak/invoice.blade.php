<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Invoice - {{ $invoice->no_invoice }}</title>
<style>
  * { margin:0; padding:0; box-sizing:border-box; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
  body { font-family: Arial, sans-serif; background: #e0e0e0; display: flex; flex-direction: column; align-items: center; padding: 24px; }
  .page { background: #fff; width: 740px; padding: 28px 32px; box-shadow: 0 0 10px rgba(0,0,0,0.2); }

  /* HEADER */
  .header { display: flex; align-items: flex-start; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 14px; }
  .logo-box { width: 90px; flex-shrink: 0; text-align: center; }
  .logo-diamond { width: 54px; height: 54px; background: #1a6abf; transform: rotate(45deg); display: inline-block; margin-bottom: 4px; position: relative; }
  .logo-diamond span { position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%) rotate(-45deg); color: #fff; font-weight: bold; font-size: 13px; letter-spacing: 1px; }
  .logo-sub { font-size: 7px; font-weight: bold; color: #333; letter-spacing: 0.5px; }
  .company-info { flex: 1; padding-left: 14px; }
  .company-info .nama { font-size: 22px; font-weight: 900; letter-spacing: 2px; color: #000; }
  .company-info .tagline { font-size: 9px; font-weight: bold; letter-spacing: 1px; color: #333; margin-bottom: 3px; }
  .company-info .detail { font-size: 9px; color: #333; line-height: 1.6; }

  /* JUDUL */
  .judul { text-align: center; font-size: 22px; font-weight: 900; letter-spacing: 3px; text-decoration: underline; margin-bottom: 14px; }

  /* INFO KEPADA */
  .info-section { display: flex; gap: 0; margin-bottom: 14px; font-size: 11px; border: 1px solid #888; }
  .kepada-box { flex: 1; padding: 8px 10px; border-right: 1px solid #888; }
  .kepada-box .kpd-label { font-size: 10px; margin-bottom: 4px; }
  .kepada-box .kpd-nama { font-weight: bold; font-size: 11px; }
  .kepada-box .kpd-alamat { font-size: 10px; line-height: 1.5; }
  .kepada-box .attn-row { margin-top: 6px; font-size: 10px; }
  .meta-box { width: 260px; flex-shrink: 0; padding: 8px 10px; font-size: 10px; }
  .meta-row { display: flex; margin-bottom: 3px; }
  .meta-row .lbl { width: 100px; font-weight: normal; }
  .meta-row .sep { margin: 0 4px; }
  .meta-row .val { flex: 1; }

  /* TABLE */
  table.items { width: 100%; border-collapse: collapse; font-size: 11px; margin-bottom: 0; }
  table.items th { background: #555 !important; color: #fff; text-align: center; padding: 6px 8px; border: 1px solid #333; font-size: 11px; }
  table.items td { border: 1px solid #888; padding: 5px 8px; vertical-align: top; }
  .td-c { text-align: center; }
  .td-r { text-align: right; }
  .td-l { text-align: left; }
  .row-empty td { height: 28px; }

  /* SUBTOTAL / GRAND */
  .summary-table { width: 100%; border-collapse: collapse; font-size: 11px; }
  .summary-table td { border: 1px solid #888; padding: 5px 8px; }
  .lbl-subtotal { font-weight: bold; font-size: 12px; }
  .terbilang-cell { font-style: italic; font-size: 10px; }
  .vat-lbl { text-align: center; font-size: 10px; font-weight: bold; }
  .amt-r { text-align: right; font-weight: bold; }

  /* BANK & TANDA TANGAN */
  .bottom-section { display: flex; justify-content: space-between; align-items: flex-start; margin-top: 20px; font-size: 10px; }
  .bank-info .title { font-weight: bold; font-size: 11px; margin-bottom: 4px; }
  .bank-info .baris { display: flex; gap: 6px; margin-bottom: 2px; }
  .bank-info .baris .k { width: 80px; font-weight: bold; }
  .sign-box { text-align: center; }
  .sign-box .sign-label { font-size: 10px; margin-bottom: 50px; }
  .sign-box .sign-line { border-top: 1px solid #000; padding-top: 4px; }
  .sign-box .sign-name { font-weight: bold; font-size: 11px; }
  .sign-box .sign-jabatan { font-size: 9px; letter-spacing: 1px; }

  .no-print { margin-top: 16px; }
  @media print {
    body { background: none; padding: 0; }
    .page { box-shadow: none; }
    .no-print { display: none; }
  }
</style>

<body>
<div class="page">

  <!-- HEADER -->
  <div class="header">
    <div class="logo-box">
      <div class="logo-diamond"><span>KEN</span></div><br>
      <div class="logo-sub">MANDIRI TEKNIK<br>GENERAL CONTRACTOR</div>
    </div>
    <div class="company-info">
      <div class="nama">PT.KEN MANDIRI TEKNIK</div>
      <div class="tagline">GENERAL CONTRACTOR MECHANICAL,ELECTRICAL AND CIVIL</div>
      <div class="detail">
        ADDRESS: Perum Telaga Harapan, Jln. Telaga Mina Raya Blok H-12 no 14<br>
        Tlp.(021) 89071548 &nbsp; Email: ken_mandiriteknik@yahoo.co.id
      </div>
    </div>
  </div>

  <!-- JUDUL -->
  <div class="judul">INVOICE</div>

  <!-- INFO -->
  <div class="info-section">
    <div class="kepada-box">
      <div class="kpd-label">Kepada : </div>
      <div class="kpd-nama">{{ $invoice->customer->nama_pt ?: ($invoice->customer->nama_customer ?? '') }}</div>
      <div class="kpd-alamat">{!! nl2br(e($invoice->customer->alamat_pt ?? '')) !!}</div>
      <div class="attn-row">Atas nama &nbsp;&nbsp;: &nbsp; {{ $invoice->customer->nama_customer ?? '' }}</div>
    </div>
    <div class="meta-box">
      <div class="meta-row"><span class="lbl">Tanggal</span><span class="sep">:</span><span class="val">{{ $invoice->tanggal?->format('Y-m-d') }}</span></div>
      <div class="meta-row"><span class="lbl">NO Invoice</span><span class="sep">:</span><span class="val">{{ $invoice->no_invoice }}</span></div>
      <div class="meta-row"><span class="lbl">NO PO</span><span class="sep">:</span><span class="val">{{ $invoice->no_preorder ?? '-' }}</span></div>
      <div class="meta-row"><span class="lbl">NO faktur</span><span class="sep">:</span><span class="val">{{ $invoice->no_faktur ?? '-' }}</span></div>
    </div>
  </div>

  <!-- TABLE ITEMS -->
  <table class="items">
    <thead>
      <tr>
        <th style="width:40px;">NO</th>
        <th>DESKRIPSI</th>
        <th style="width:80px;">SATUAN<br>QTY</th>
        <th style="width:140px;">UNIT PRICE<br>(Rp)</th>
        <th style="width:140px;">TOTAL PRICE<br>(Rp)</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($invoice->details as $item)
      <tr>
        <td class="td-c">{{ $loop->iteration }}</td>
        <td class="td-l">{{ $item->deskripsi }}</td>
        <td class="td-c">{{ number_format($item->qty, 0, ',', '.') }} &nbsp; Lot</td>
        <td class="td-r">{{ number_format($item->unit_price_terkini, 2, ',', '.') }}</td>
        <td class="td-r">{{ number_format($item->sub_total_terkini, 2, ',', '.') }}</td>
      </tr>
      @endforeach
      @for ($i = $invoice->details->count(); $i < 8; $i++)
      <tr class="row-empty"><td></td><td></td><td></td><td></td><td></td></tr>
      @endfor
    </tbody>
  </table>

  <!-- SUMMARY -->
  <table class="summary-table">
    <tr>
      <td style="width:60px;" class="lbl-subtotal">SUB TOTAL</td>
      <td style="width:80px; text-align:right; font-weight:bold;">Rp</td>
      <td style="width:150px; text-align:right; font-weight:bold; border-left:1px solid #888;">
        {{ number_format($subtotal, 2, ',', '.') }}
      </td>
    </tr>
    <tr>
      <td colspan="1" class="terbilang-cell" style="border-top:1px solid #888;">
        <strong>TERBILANG</strong> &nbsp; {{ $terbilang }}
      </td>
      <td class="vat-lbl" style="border:1px solid #888; border-top:none;">V.A.T 11%</td>
      <td style="text-align:right; font-weight:bold; border:1px solid #888; border-top:none;">Rp &nbsp; {{ number_format($ppn, 2, ',', '.') }}</td>
    </tr>
    <tr>
      <td></td>
      <td class="vat-lbl" style="border:1px solid #888; border-top:none; font-weight:bold; font-size:11px;">GRAND TOTAL</td>
      <td style="text-align:right; font-weight:bold; font-size:12px; border:1px solid #888; border-top:none;">Rp &nbsp; {{ number_format($grand, 2, ',', '.') }}</td>
    </tr>
  </table>

  <!-- BOTTOM: BANK + TTD -->
  <div class="bottom-section">
    <div class="bank-info">
      <div class="title">Bank Account</div>
      <div class="baris"><span class="k">PT.KEN MANDIRI TEKNIK</span></div>
      <div class="baris"><span class="k">NO:REK</span><span>: &nbsp; 156-00-1507280-6</span></div>
      <div class="baris"><span class="k">Bank Mandiri Cab :</span><span>KCP.Bulak Kapal</span></div>
    </div>
    <div class="sign-box">
      <div class="sign-label">Hormat Kami,</div>
      <div class="sign-line">
        <div class="sign-name">MANDIRI TEKNIK</div>
        <div class="sign-jabatan">GENERAL CONTRACTOR</div>
        <div class="sign-name" style="margin-top:2px;">{{ $invoice->pegawai->nama_pegawai ?? '' }}</div>
      </div>
    </div>
  </div>

</div>
<div class="no-print" style="text-align:center; margin-top:16px;">
  <button onclick="window.print()" style="padding:8px 28px; font-size:14px; cursor:pointer;">Cetak</button>
</div>
</body>
</html>
