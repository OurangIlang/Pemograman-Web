<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard — PT Ken Mandiri Teknik</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --blue:    #2563EB;
      --blue2:   #1D4ED8;
      --indigo:  #4F46E5;
      --green:   #10B981;
      --red:     #EF4444;
      --orange:  #F59E0B;
      --gray50:  #F9FAFB;
      --gray100: #F3F4F6;
      --gray200: #E5E7EB;
      --gray300: #D1D5DB;
      --gray400: #9CA3AF;
      --gray500: #6B7280;
      --gray600: #4B5563;
      --gray700: #374151;
      --gray800: #1F2937;
      --gray900: #111827;
      --sidebar-w: 248px;
      --topbar-h: 60px;
    }
    *, *::before, *::after { box-sizing: border-box; }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--gray100);
      color: var(--gray800);
      margin: 0; padding: 0;
      display: flex;
      min-height: 100vh;
    }

    /* ══════════════════════════════════════
       SIDEBAR
    ══════════════════════════════════════ */
    #sidebar {
      width: var(--sidebar-w);
      min-width: var(--sidebar-w);
      background: var(--gray900);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      transition: width 0.3s ease, min-width 0.3s ease;
      position: relative;
      flex-shrink: 0;
    }
    #sidebar::after {
      content: '';
      position: absolute; top: 0; right: 0; bottom: 0;
      width: 1px;
      background: linear-gradient(180deg, transparent, rgba(255,255,255,0.06) 30%, rgba(255,255,255,0.06) 70%, transparent);
    }
    #sidebar.collapsed { width: 68px; min-width: 68px; }
    #sidebar.collapsed .sidebar-brand-text,
    #sidebar.collapsed .nav-text,
    #sidebar.collapsed .nav-dot,
    #sidebar.collapsed .nav-section-label,
    #sidebar.collapsed .sidebar-footer-txt,
    #sidebar.collapsed .su-name,
    #sidebar.collapsed .su-role,
    #sidebar.collapsed .copyright-txt { display: none !important; }
    #sidebar.collapsed .sidebar-brand { padding: 18px 12px; justify-content: center; }
    #sidebar.collapsed .sidebar-user { padding: 10px 0; justify-content: center; flex-direction: column; }
    #sidebar.collapsed .su-avatar { width: 34px; height: 34px; font-size: 13px; }
    #sidebar.collapsed .nav-item a { justify-content: center; padding: 12px 0; }
    #sidebar.collapsed .nav-icon { margin: 0; }
    #sidebar.collapsed #sidebar-bottom { padding: 12px 0; align-items: center; }
    #sidebar.collapsed .btn-logout { justify-content: center; padding: 10px 0; width: 100%; border-radius: 0; }

    .sidebar-brand {
      display: flex; align-items: center; gap: 10px;
      padding: 20px 18px 16px;
      border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .s-logo {
      width: 38px; height: 38px; flex-shrink: 0;
      background: #ffffff;
      border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      padding: 3px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.2);
    }
    .s-name { color: #fff; font-size: 13px; font-weight: 700; white-space: nowrap; }
    .s-sub  { color: var(--gray400); font-size: 10px; margin-top: 1px; white-space: nowrap; }

    .sidebar-user {
      display: flex; align-items: center; gap: 10px;
      padding: 12px 16px;
      border-bottom: 1px solid rgba(255,255,255,0.06);
      margin-bottom: 8px;
    }
    .su-avatar {
      width: 36px; height: 36px; flex-shrink: 0;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--blue), var(--indigo));
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 14px; font-weight: 700;
    }
    .su-name { color: #fff; font-size: 12.5px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px; }
    .role-pill {
      display: inline-flex; align-items: center; gap: 4px;
      font-size: 10px; font-weight: 700;
      border-radius: 20px; padding: 2px 8px;
      margin-top: 3px;
    }
    .role-pill.admin { background: rgba(37,99,235,0.2); color: #60A5FA; }
    .role-pill.pegawai { background: rgba(16,185,129,0.2); color: #34D399; }

    .sidebar-nav { flex: 1; padding: 0 10px; overflow-y: auto; }
    .sidebar-nav::-webkit-scrollbar { width: 3px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }

    .nav-section-label {
      padding: 16px 8px 6px;
      font-size: 9.5px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
      color: var(--gray500);
    }

    .nav-item a {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 12px;
      border-radius: 9px;
      color: var(--gray400);
      text-decoration: none;
      font-size: 13px; font-weight: 500;
      transition: all 0.18s;
      position: relative;
      margin-bottom: 2px;
    }
    .nav-item a:hover { background: rgba(255,255,255,0.06); color: #fff; }
    .nav-item.active > a { background: rgba(37,99,235,0.18); color: #fff; font-weight: 600; }
    .nav-icon { width: 18px; text-align: center; font-size: 14px; flex-shrink: 0; }
    .nav-dot {
      width: 6px; height: 6px; border-radius: 50%;
      background: var(--blue);
      margin-left: auto;
      flex-shrink: 0;
    }

    #sidebar-bottom {
      padding: 12px 10px 16px;
      border-top: 1px solid rgba(255,255,255,0.06);
      display: flex; flex-direction: column; gap: 4px;
    }
    .btn-logout {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 12px;
      border-radius: 9px;
      background: transparent;
      border: none;
      color: var(--gray400);
      font-size: 13px; font-weight: 500;
      cursor: pointer; width: 100%;
      transition: all 0.18s;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-logout:hover { background: rgba(239,68,68,0.12); color: #FCA5A5; }
    .copyright-txt {
      font-size: 10px; color: var(--gray600);
      padding: 4px 12px;
      white-space: nowrap;
    }

    /* ══════════════════════════════════════
       MAIN CONTENT
    ══════════════════════════════════════ */
    #main {
      flex: 1;
      display: flex; flex-direction: column;
      min-width: 0;
      min-height: 100vh;
    }

    /* ══════════════════════════════════════
       TOPBAR
    ══════════════════════════════════════ */
    .topbar {
      height: var(--topbar-h);
      background: #fff;
      border-bottom: 1px solid var(--gray200);
      padding: 0 24px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 100;
      box-shadow: 0 1px 3px rgba(0,0,0,0.04);
      flex-shrink: 0;
    }
    .topbar-left { display: flex; align-items: center; gap: 14px; }
    #toggle-sidebar {
      background: var(--gray100);
      border: 1px solid var(--gray200);
      border-radius: 8px;
      padding: 7px 10px;
      color: var(--gray600);
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s;
    }
    #toggle-sidebar:hover { background: var(--gray200); color: var(--gray900); }
    .breadcrumb-wrap {
      display: flex; align-items: center; gap: 7px;
      font-size: 13px;
    }
    .bc-home { color: var(--gray400); font-size: 12px; }
    .bc-sep { color: var(--gray300); font-size: 9px; }
    .bc-current { color: var(--gray700); font-weight: 600; }
    .topbar-right { display: flex; align-items: center; gap: 10px; }
    .tb-badge {
      display: flex; align-items: center; gap: 6px;
      padding: 6px 14px; border-radius: 6px;
      background: var(--gray100);
      border: 1px solid var(--gray200);
      font-size: 12px; color: var(--gray600);
    }
    .dot-live { width: 6px; height: 6px; border-radius: 50%; background: #22c55e; animation: blink 1.4s infinite; }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

    /* ══════════════════════════════════════
       PAGE BODY
    ══════════════════════════════════════ */
    .content { flex: 1; padding: 28px; overflow-y: auto; }

    /* Welcome banner */
    .welcome-banner {
      border-radius: 16px;
      padding: 28px 30px;
      margin-bottom: 24px;
      background: linear-gradient(135deg, #0f1f3d 0%, #1e3a5f 50%, #2563EB 100%);
      position: relative; overflow: hidden;
      display: flex; align-items: center; justify-content: space-between;
    }
    .welcome-banner::before {
      content: '';
      position: absolute; width: 280px; height: 280px; border-radius: 50%;
      background: rgba(255,255,255,0.04);
      top: -120px; right: 120px;
    }
    .welcome-banner::after {
      content: '';
      position: absolute; width: 180px; height: 180px; border-radius: 50%;
      background: rgba(255,255,255,0.04);
      bottom: -80px; right: 30px;
    }
    .wb-text { position: relative; z-index: 1; }
    .wb-greeting { color: rgba(255,255,255,0.65); font-size: 12.5px; font-weight: 500; margin-bottom: 4px; }
    .wb-title { color: #fff; font-size: 22px; font-weight: 800; margin: 0 0 6px; }
    .wb-sub { color: rgba(255,255,255,0.55); font-size: 13px; margin: 0; }
    .wb-date {
      position: relative; z-index: 1;
      display: flex; align-items: center; gap: 8px;
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.15);
      backdrop-filter: blur(4px);
      border-radius: 10px;
      padding: 10px 18px;
      color: rgba(255,255,255,0.85);
      font-size: 12.5px; font-weight: 500;
      white-space: nowrap;
    }
    .wb-date i { color: rgba(255,255,255,0.6); }

    /* Stats grid */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 14px;
      margin-bottom: 24px;
    }
    .stat-card {
      background: #fff;
      border: 1px solid var(--gray200);
      border-radius: 14px;
      padding: 20px 18px;
      position: relative;
      overflow: hidden;
      transition: box-shadow 0.2s, transform 0.2s;
      cursor: default;
    }
    .stat-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.08); transform: translateY(-2px); }
    .stat-card::before {
      content: '';
      position: absolute; top: 0; left: 0; right: 0; height: 3px;
      border-radius: 14px 14px 0 0;
    }
    .stat-card.c-blue::before   { background: linear-gradient(90deg, #2563EB, #4F46E5); }
    .stat-card.c-violet::before { background: linear-gradient(90deg, #7C3AED, #4F46E5); }
    .stat-card.c-green::before  { background: linear-gradient(90deg, #10B981, #059669); }
    .stat-card.c-amber::before  { background: linear-gradient(90deg, #F59E0B, #D97706); }
    .stat-card.c-cyan::before   { background: linear-gradient(90deg, #06B6D4, #0891B2); }
    .stat-card.c-orange::before { background: linear-gradient(90deg, #F97316, #EA580C); }
    .stat-card.c-pink::before   { background: linear-gradient(90deg, #EC4899, #DB2777); }

    .sc-icon {
      width: 40px; height: 40px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 17px; margin-bottom: 14px;
    }
    .c-blue   .sc-icon { background: rgba(37,99,235,0.1);   color: #2563EB; }
    .c-violet .sc-icon { background: rgba(124,58,237,0.1);  color: #7C3AED; }
    .c-green  .sc-icon { background: rgba(16,185,129,0.1);  color: #10B981; }
    .c-amber  .sc-icon { background: rgba(245,158,11,0.1);  color: #D97706; }
    .c-cyan   .sc-icon { background: rgba(6,182,212,0.1);   color: #0891B2; }
    .c-orange .sc-icon { background: rgba(249,115,22,0.1);  color: #EA580C; }
    .c-pink   .sc-icon { background: rgba(236,72,153,0.1);  color: #DB2777; }

    .sc-val {
      font-size: 28px; font-weight: 800; color: var(--gray900);
      line-height: 1; margin-bottom: 4px;
    }
    .sc-label { font-size: 11.5px; color: var(--gray500); font-weight: 500; }

    /* Section title */
    .s-title {
      font-size: 13px; font-weight: 700; color: var(--gray700);
      margin-bottom: 14px;
      display: flex; align-items: center; gap: 8px;
    }
    .s-title::before { content: ''; display: block; width: 3px; height: 15px; border-radius: 2px; background: var(--blue); }

    /* Tables row */
    .tables-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-bottom: 24px;
    }
    @media (max-width: 1100px) { .tables-row { grid-template-columns: 1fr; } }

    .data-card {
      background: #fff;
      border: 1px solid var(--gray200);
      border-radius: 14px;
      overflow: hidden;
    }
    .data-card-head {
      padding: 16px 20px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--gray100);
    }
    .data-card-head h5 {
      font-size: 13.5px; font-weight: 700; color: var(--gray800);
      display: flex; align-items: center; gap: 8px; margin: 0;
    }
    .data-card-head h5 i { color: var(--blue); font-size: 13px; }
    .data-card-head .view-all {
      font-size: 11.5px; color: var(--blue); text-decoration: none; font-weight: 600;
      display: flex; align-items: center; gap: 4px;
    }
    .data-card-head .view-all:hover { text-decoration: underline; }

    table.data-tbl { width: 100%; border-collapse: collapse; }
    table.data-tbl th {
      font-size: 11px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;
      color: var(--gray500); padding: 11px 16px; text-align: left;
      background: var(--gray50);
      border-bottom: 1px solid var(--gray100);
    }
    table.data-tbl td {
      font-size: 12.5px; color: var(--gray600);
      padding: 11px 16px;
      border-bottom: 1px solid var(--gray100);
    }
    table.data-tbl tr:last-child td { border-bottom: none; }
    table.data-tbl tr:hover td { background: var(--gray50); }
    .empty-row td { text-align: center; color: var(--gray400); font-style: italic; padding: 24px; }
    .kode-badge { color: var(--blue); font-weight: 700; }

    /* Quick links */
    .quick-links {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
      gap: 12px;
    }
    .ql-card {
      background: #fff;
      border: 1px solid var(--gray200);
      border-radius: 12px;
      padding: 16px 18px;
      text-decoration: none;
      display: flex; align-items: center; gap: 13px;
      transition: all 0.2s;
    }
    .ql-card:hover {
      border-color: var(--blue);
      background: rgba(37,99,235,0.03);
      transform: translateY(-2px);
      box-shadow: 0 4px 16px rgba(37,99,235,0.08);
      text-decoration: none;
    }
    .ql-icon {
      width: 38px; height: 38px; flex-shrink: 0;
      border-radius: 9px; background: rgba(37,99,235,0.08);
      display: flex; align-items: center; justify-content: center;
      font-size: 15px; color: var(--blue);
      transition: background 0.2s;
    }
    .ql-card:hover .ql-icon { background: var(--blue); color: #fff; }
    .ql-text strong { display: block; font-size: 12.5px; color: var(--gray800); font-weight: 700; }
    .ql-text span { font-size: 11px; color: var(--gray500); }

    @media (max-width: 768px) {
      #sidebar { position: fixed; z-index: 200; transform: translateX(-100%); }
      #sidebar.mobile-open { transform: translateX(0); }
      .content { padding: 16px; }
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
      .welcome-banner { flex-direction: column; gap: 14px; }
      .wb-date { align-self: flex-start; }
    }
  </style>
</head>
<body>

<!-- ════ SIDEBAR ════ -->
<nav id="sidebar">

  {{-- Brand --}}
  <div class="sidebar-brand">
    <div class="s-logo">
      <img src="{{ asset('assets/images/logo_ken.png') }}" alt="Logo" style="width:28px;height:28px;object-fit:contain;">
    </div>
    <div class="sidebar-brand-text">
      <div class="s-name">Ken Mandiri</div>
      <div class="s-sub">Teknik Elektronik</div>
    </div>
  </div>

  {{-- User Badge --}}
  <div class="sidebar-user">
    <div class="su-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
    <div class="sidebar-brand-text" style="min-width:0;">
      <div class="su-name">{{ auth()->user()->name }}</div>
      <div class="su-role">
        @if(auth()->user()->isAdmin())
          <span class="role-pill admin"><i class="fa-solid fa-shield-halved"></i> Admin</span>
        @else
          <span class="role-pill pegawai"><i class="fa-solid fa-id-badge"></i> Pegawai</span>
        @endif
      </div>
    </div>
  </div>

  {{-- Navigation --}}
  <div class="sidebar-nav">

    <div class="nav-section-label"><span class="section-label-text">Utama</span></div>
    <div class="nav-item active">
      <a href="{{ route('dashboard') }}">
        <span class="nav-icon"><i class="fa-solid fa-house"></i></span>
        <span class="nav-text">Dashboard</span>
        <span class="nav-dot"></span>
      </a>
    </div>

    @if(auth()->user()->isAdmin())
    <div class="nav-section-label"><span class="section-label-text">Master Data</span></div>
    <div class="nav-item">
      <a href="{{ route('customer.index') }}">
        <span class="nav-icon"><i class="fa-solid fa-users"></i></span>
        <span class="nav-text">Customer</span>
      </a>
    </div>
    <div class="nav-item">
      <a href="{{ route('perusahaan.index') }}">
        <span class="nav-icon"><i class="fa-solid fa-building"></i></span>
        <span class="nav-text">Perusahaan</span>
      </a>
    </div>
    <div class="nav-item">
      <a href="{{ route('pegawai.index') }}">
        <span class="nav-icon"><i class="fa-solid fa-id-badge"></i></span>
        <span class="nav-text">Pegawai</span>
      </a>
    </div>
    <div class="nav-item">
      <a href="{{ route('bahan_baku.index') }}">
        <span class="nav-icon"><i class="fa-solid fa-cubes"></i></span>
        <span class="nav-text">Bahan Baku</span>
      </a>
    </div>
    <div class="nav-item">
      <a href="{{ route('barang.index') }}">
        <span class="nav-icon"><i class="fa-solid fa-box-open"></i></span>
        <span class="nav-text">Barang</span>
      </a>
    </div>
    @endif

    <div class="nav-section-label"><span class="section-label-text">Transaksi</span></div>
    <div class="nav-item">
      <a href="{{ route('nota.index') }}">
        <span class="nav-icon"><i class="fa-solid fa-receipt"></i></span>
        <span class="nav-text">Nota Pembelian</span>
      </a>
    </div>
    <div class="nav-item">
      <a href="{{ route('invoice.index') }}">
        <span class="nav-icon"><i class="fa-solid fa-file-invoice"></i></span>
        <span class="nav-text">Invoice Penjualan</span>
      </a>
    </div>

  </div>

  {{-- Bottom --}}
  <div id="sidebar-bottom">
    <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
    <button class="btn-logout sidebar-brand-text" onclick="if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();">
      <i class="fa-solid fa-right-from-bracket"></i>
      <span class="sidebar-footer-txt">Keluar</span>
    </button>
    <div class="sidebar-footer-txt copyright-txt">
      &copy; {{ date('Y') }} PT Ken Mandiri Teknik
    </div>
  </div>

</nav>

<!-- ════ MAIN ════ -->
<div id="main">

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="topbar-left">
      <button id="toggle-sidebar"><i class="fa-solid fa-bars"></i></button>
      <div class="breadcrumb-wrap">
        <span class="bc-home"><i class="fa-solid fa-house"></i></span>
        <span class="bc-sep"><i class="fa-solid fa-chevron-right"></i></span>
        <span class="bc-current">Dashboard</span>
      </div>
    </div>
    <div class="topbar-right">
      <div class="tb-badge">
        <span class="dot-live"></span>
        Sistem Aktif
      </div>
      <div class="tb-badge">
        <i class="fa-regular fa-clock"></i>
        {{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') }}
      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <!-- Welcome Banner -->
    <div class="welcome-banner">
      <div class="wb-text">
        <div class="wb-greeting">Selamat datang kembali 👋</div>
        <h2 class="wb-title">{{ auth()->user()->name }}</h2>
        <p class="wb-sub">Ringkasan operasional dan transaksi terbaru PT Ken Mandiri Teknik</p>
      </div>
      <div class="wb-date">
        @php
          $hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
          $bulan = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
        @endphp
        <i class="fa-regular fa-calendar"></i>
        {{ $hari[date('w')] . ', ' . date('d') . ' ' . $bulan[(int)date('m')] . ' ' . date('Y') }}
      </div>
    </div>

    <!-- Stats -->
    <div class="s-title">Ringkasan Data</div>
    <div class="stats-grid">
      <div class="stat-card c-blue">
        <div class="sc-icon"><i class="fa-solid fa-users"></i></div>
        <div class="sc-val">{{ $stats['customer'] }}</div>
        <div class="sc-label">Customer</div>
      </div>
      <div class="stat-card c-violet">
        <div class="sc-icon"><i class="fa-solid fa-building"></i></div>
        <div class="sc-val">{{ $stats['perusahaan'] }}</div>
        <div class="sc-label">Perusahaan</div>
      </div>
      <div class="stat-card c-green">
        <div class="sc-icon"><i class="fa-solid fa-id-badge"></i></div>
        <div class="sc-val">{{ $stats['pegawai'] }}</div>
        <div class="sc-label">Pegawai</div>
      </div>
      <div class="stat-card c-amber">
        <div class="sc-icon"><i class="fa-solid fa-cubes"></i></div>
        <div class="sc-val">{{ $stats['bahan_baku'] }}</div>
        <div class="sc-label">Bahan Baku</div>
      </div>
      <div class="stat-card c-cyan">
        <div class="sc-icon"><i class="fa-solid fa-box-open"></i></div>
        <div class="sc-val">{{ $stats['barang'] }}</div>
        <div class="sc-label">Barang</div>
      </div>
      <div class="stat-card c-orange">
        <div class="sc-icon"><i class="fa-solid fa-receipt"></i></div>
        <div class="sc-val">{{ $stats['nota'] }}</div>
        <div class="sc-label">Nota Pembelian</div>
      </div>
      <div class="stat-card c-pink">
        <div class="sc-icon"><i class="fa-solid fa-file-invoice"></i></div>
        <div class="sc-val">{{ $stats['invoice'] }}</div>
        <div class="sc-label">Invoice Penjualan</div>
      </div>
    </div>

    <!-- Recent tables -->
    <div class="s-title">Transaksi Terbaru</div>
    <div class="tables-row">

      <div class="data-card">
        <div class="data-card-head">
          <h5><i class="fa-solid fa-receipt"></i> Nota Pembelian Terbaru</h5>
          <a href="{{ route('nota.index') }}" class="view-all">Lihat Semua <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></a>
        </div>
        <table class="data-tbl">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Tanggal</th>
              <th>Perusahaan</th>
              <th>Bahan Baku</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($recentNota as $row)
            <tr>
              <td><span class="kode-badge">{{ $row->kode_nota }}</span></td>
              <td>{{ $row->tanggal?->format('d M Y') }}</td>
              <td>{{ $row->perusahaan->nama_perusahaan ?? '—' }}</td>
              <td>{{ optional($row->details->first()?->bahanBaku)->nama_bahan_baku ?? '—' }}</td>
            </tr>
            @empty
            <tr class="empty-row"><td colspan="4">Belum ada data nota pembelian</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="data-card">
        <div class="data-card-head">
          <h5><i class="fa-solid fa-file-invoice"></i> Invoice Penjualan Terbaru</h5>
          <a href="{{ route('invoice.index') }}" class="view-all">Lihat Semua <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i></a>
        </div>
        <table class="data-tbl">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Tanggal</th>
              <th>Customer</th>
              <th>Barang</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($recentInvoice as $row)
            <tr>
              <td><span class="kode-badge">{{ $row->no_invoice }}</span></td>
              <td>{{ $row->tanggal?->format('d M Y') }}</td>
              <td>{{ $row->customer->nama_customer ?? '—' }}</td>
              <td>{{ optional($row->details->first()?->barang)->nama_barang ?? '—' }}</td>
            </tr>
            @empty
            <tr class="empty-row"><td colspan="4">Belum ada data invoice penjualan</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>

    <!-- Quick Links -->
    <div class="s-title">Akses Cepat</div>
    <div class="quick-links">
      <a href="{{ route('customer.create') }}" class="ql-card">
        <div class="ql-icon"><i class="fa-solid fa-user-plus"></i></div>
        <div class="ql-text"><strong>Tambah Customer</strong><span>Data pelanggan baru</span></div>
      </a>
      <a href="{{ route('perusahaan.create') }}" class="ql-card">
        <div class="ql-icon"><i class="fa-solid fa-building-circle-arrow-right"></i></div>
        <div class="ql-text"><strong>Tambah Perusahaan</strong><span>Mitra bisnis baru</span></div>
      </a>
      <a href="{{ route('bahan_baku.create') }}" class="ql-card">
        <div class="ql-icon"><i class="fa-solid fa-layer-group"></i></div>
        <div class="ql-text"><strong>Tambah Bahan Baku</strong><span>Entri stok material</span></div>
      </a>
      <a href="{{ route('barang.create') }}" class="ql-card">
        <div class="ql-icon"><i class="fa-solid fa-box"></i></div>
        <div class="ql-text"><strong>Tambah Barang</strong><span>Produk baru</span></div>
      </a>
      <a href="{{ route('nota.create') }}" class="ql-card">
        <div class="ql-icon"><i class="fa-solid fa-cart-plus"></i></div>
        <div class="ql-text"><strong>Buat Nota Beli</strong><span>Transaksi pembelian</span></div>
      </a>
      <a href="{{ route('invoice.create') }}" class="ql-card">
        <div class="ql-icon"><i class="fa-solid fa-file-circle-plus"></i></div>
        <div class="ql-text"><strong>Buat Invoice</strong><span>Transaksi penjualan</span></div>
      </a>
      <a href="{{ route('pegawai.create') }}" class="ql-card">
        <div class="ql-icon"><i class="fa-solid fa-user-tie"></i></div>
        <div class="ql-text"><strong>Tambah Pegawai</strong><span>Data karyawan baru</span></div>
      </a>
    </div>

  </div><!-- /content -->
</div><!-- /main -->

<script>
document.getElementById('toggle-sidebar')?.addEventListener('click', function () {
  document.getElementById('sidebar').classList.toggle('collapsed');
});
</script>
<form id="logout-form-hidden" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
</body>
</html>
