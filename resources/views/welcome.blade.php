<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT Ken Mandiri Teknik Elektronik</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
                :root {
      --primary:       #000000;
      --primary-hover: #222222;
      --bg-main:       #F5F5F5;
      --card-bg:       #FFFFFF;
      --border-clr:    #E0E0E0;
      --text-main:     #000000;
      --text-muted:    #555555;
      --electric:      #1a73e8;
      --steel:         #334155;
      --glow:          rgba(26,115,232,0.4);
      --panel:         #0f172a;
      --blue:          #1a73e8;
      --volt:          #f59e0b;
      --border:        rgba(255,255,255,0.08);
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Inter', sans-serif;
      background: #F5F5F5;
      color: #000000;
      overflow-x: hidden;
      min-height: 100vh;
    }

    /* ── GRID BACKGROUND ── */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image:
        linear-gradient(rgba(0,0,0,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,0.04) 1px, transparent 1px);
      background-size: 40px 40px;
      pointer-events: none;
      z-index: 0;
    }

    /* ── CIRCUIT TRACES (decorative lines) ── */
    .circuit-svg {
      position: fixed;
      inset: 0;
      width: 100%; height: 100%;
      pointer-events: none;
      z-index: 0;
      opacity: 0.18;
    }

    /* ── NAV ── */
    nav {
      position: fixed;
      top: 0; left: 0; right: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 48px;
      background: rgba(10,22,40,0.85);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(0,0,0,0.08);
      z-index: 100;
    }
    .nav-brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .nav-brand .brand-icon {
      width: 40px; height: 40px;
      background: linear-gradient(135deg, var(--electric), #000000);
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      font-size: 18px; color: #fff;
    }
    .nav-brand span {
      font-family: 'Inter', monospace;
      font-weight: 700;
      font-size: 14px;
      color: #ffffff;
      letter-spacing: 1px;
      line-height: 1.2;
    }
    .nav-brand small {
      display: block;
      font-family: 'Inter', sans-serif;
      font-size: 10px;
      color: #aaaaaa;
      font-weight: 400;
      letter-spacing: 2px;
      text-transform: uppercase;
    }
    .nav-cta {
      display: flex;
      gap: 10px;
      align-items: center;
    }
    .btn-outline {
      padding: 9px 22px;
      border: 1.5px solid rgba(255,255,255,0.25);
      color: #ffffff;
      background: transparent;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.2s;
      font-family: 'Inter', sans-serif;
    }
    .btn-outline:hover {
      background: rgba(255,255,255,0.1);
      border-color: #ffffff;
    }
    .btn-solid {
      padding: 9px 22px;
      background: linear-gradient(135deg, #000000, var(--electric));
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
    }
    .btn-solid:hover { opacity: 0.85; transform: translateY(-1px); }

    /* ── HERO ── */
    .hero {
      position: relative;
      z-index: 1;
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 120px 48px 80px;
      gap: 60px;
    }
    .hero-left { flex: 1; max-width: 600px; }
    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(0,0,0,0.08);
      border: 1px solid rgba(0,0,0,0.08);
      border-radius: 100px;
      padding: 5px 14px;
      font-size: 11.5px;
      color: #000000;
      font-weight: 500;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      margin-bottom: 24px;
    }
    .hero-eyebrow .dot {
      width: 6px; height: 6px; border-radius: 50%;
      background: #000000;
      animation: blink 1.4s infinite;
    }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.2} }

    .hero h1 {
      font-family: 'Inter', monospace;
      font-size: clamp(32px, 4.5vw, 58px);
      font-weight: 900;
      line-height: 1.1;
      color: #000000;
      margin-bottom: 20px;
      letter-spacing: -0.5px;
    }
    .hero h1 .accent { color: #000000; text-shadow: 0 0 30px var(--glow); }
    .hero-sub {
      font-size: 15.5px;
      color: #555555;
      line-height: 1.75;
      margin-bottom: 36px;
      max-width: 500px;
    }
    .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }
    .btn-hero-primary {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 14px 32px;
      background: linear-gradient(135deg, #000000, var(--electric));
      color: #fff; font-size: 14px; font-weight: 600;
      border-radius: 8px; text-decoration: none;
      box-shadow: 0 0 30px rgba(0,0,0,0.08);
      transition: all 0.25s;
      font-family: 'Inter', sans-serif;
    }
    .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 0 40px rgba(0,0,0,0.08); }
    .btn-hero-secondary {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 14px 32px;
      border: 1.5px solid rgba(0,0,0,0.08);
      color: #000000; font-size: 14px; font-weight: 500;
      border-radius: 8px; text-decoration: none;
      transition: all 0.2s;
      font-family: 'Inter', sans-serif;
    }
    .btn-hero-secondary:hover { background: rgba(0,0,0,0.08); }

    /* ── PANEL BOX (right side) ── */
    .hero-right { flex: 0 0 420px; }
    .panel-box {
      background: #000000;
      border: 2px solid var(--steel);
      border-radius: 12px;
      padding: 28px;
      position: relative;
      box-shadow: 0 0 60px rgba(0,0,0,0.08), inset 0 1px 0 rgba(255,255,255,0.05);
    }
    .panel-box::before {
      content: 'CONTROL PANEL — MDP/SDP';
      position: absolute;
      top: -10px; left: 20px;
      background: #F5F5F5;
      padding: 0 10px;
      font-family: 'Inter', monospace;
      font-size: 9px;
      color: #555555;
      letter-spacing: 2px;
    }
    /* Panel header strip */
    .panel-header {
      display: flex; align-items: center; justify-content: space-between;
      background: #333333;
      border-radius: 6px;
      padding: 10px 16px;
      margin-bottom: 20px;
    }
    .panel-header span {
      font-family: 'Inter', monospace;
      font-size: 11px; color: #555555; letter-spacing: 1px;
    }
    .status-badge {
      display: flex; align-items: center; gap: 5px;
      font-size: 10px; color: #000000; font-weight: 600;
    }
    .status-badge .led { width: 7px; height: 7px; border-radius: 50%; background: #000000; ; }

    /* Breaker rows */
    .breaker-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
      margin-bottom: 18px;
    }
    .breaker {
      background: #111111;
      border: 1px solid rgba(0,0,0,0.08);
      border-radius: 6px;
      padding: 10px 8px;
      text-align: center;
      transition: all 0.2s;
    }
    .breaker:hover { border-color: rgba(0,0,0,0.08); }
    .breaker .b-label { font-size: 9px; color: #555555; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 6px; }
    .breaker .b-val {
      font-family: 'Inter', monospace;
      font-size: 15px; font-weight: 700;
      color: #000000;
    }
    .breaker .b-unit { font-size: 9px; color: #555555; margin-top: 2px; }
    .breaker.warn .b-val { color: var(--volt); }
    .breaker.ok .b-val { color: #000000; }

    /* Busbar visual */
    .busbar-row {
      display: flex; align-items: center; gap: 6px;
      margin-bottom: 16px;
    }
    .busbar-label { font-size: 10px; color: #555555; letter-spacing: 1px; white-space: nowrap; }
    .busbar-line {
      flex: 1; height: 4px;
      background: linear-gradient(90deg, #000000, var(--electric), #000000);
      border-radius: 2px;
      box-shadow: 0 0 8px rgba(0,0,0,0.08);
    }
    .busbar-v { font-family: 'Inter', monospace; font-size: 11px; color: #000000; white-space: nowrap; }

    /* Toggle switches */
    .switch-row {
      display: flex; gap: 8px; flex-wrap: wrap;
    }
    .sw {
      display: flex; flex-direction: column; align-items: center; gap: 5px;
      background: #111111; border: 1px solid rgba(255,255,255,0.07);
      border-radius: 6px; padding: 8px 12px;
    }
    .sw-track {
      width: 32px; height: 14px; border-radius: 7px;
      background: #000000;
      box-shadow: 0 0 6px rgba(34,197,94,0.6);
      position: relative;
    }
    .sw-track.off { background: #CCCCCC; box-shadow: none; }
    .sw-track::after {
      content: '';
      position: absolute;
      width: 10px; height: 10px;
      border-radius: 50%; background: #fff;
      top: 2px; right: 2px;
      transition: right 0.2s;
    }
    .sw-track.off::after { right: auto; left: 2px; }
    .sw-label { font-size: 9px; color: #555555; letter-spacing: 1px; text-transform: uppercase; }

    /* ── STATS STRIP ── */
    .stats-strip {
      position: relative; z-index: 1;
      display: flex;
      gap: 0;
      border-top: 1px solid rgba(0,0,0,0.08);
      border-bottom: 1px solid rgba(0,0,0,0.08);
      background: rgba(28,43,58,0.5);
      backdrop-filter: blur(6px);
      margin: 0 0 80px;
    }
    .stat-item {
      flex: 1;
      padding: 28px 32px;
      border-right: 1px solid rgba(0,0,0,0.08);
      position: relative;
    }
    .stat-item:last-child { border-right: none; }
    .stat-num {
      font-family: 'Inter', monospace;
      font-size: 36px; font-weight: 700;
      color: #000000;
      line-height: 1;
      margin-bottom: 6px;
    }
    .stat-desc { font-size: 13px; color: #555555; font-weight: 400; }

    /* ── PRODUCTS SECTION ── */
    .section {
      position: relative; z-index: 1;
      padding: 0 48px 80px;
    }
    .section-label {
      font-family: 'Inter', monospace;
      font-size: 10px; letter-spacing: 3px;
      color: #000000; text-transform: uppercase;
      margin-bottom: 10px;
    }
    .section-title {
      font-family: 'Inter', monospace;
      font-size: clamp(22px, 3vw, 34px);
      font-weight: 700; color: #000000;
      margin-bottom: 14px;
    }
    .section-sub { font-size: 14.5px; color: #555555; max-width: 540px; line-height: 1.7; margin-bottom: 48px; }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
    }
    .product-card {
      background: #76ABAE;
      border: 1px solid var(--steel);
      border-radius: 12px;
      padding: 26px;
      transition: all 0.25s;
      position: relative;
      overflow: hidden;
    }
    .product-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; height: 2px;
      background: linear-gradient(90deg, transparent, var(--electric), transparent);
      opacity: 0;
      transition: opacity 0.3s;
    }
    .product-card:hover { border-color: rgba(0,0,0,0.08); transform: translateY(-3px); box-shadow: 0 12px 40px rgba(0,0,0,0.08); }
    .product-card:hover::before { opacity: 1; }
    .product-icon {
      width: 52px; height: 52px; border-radius: 10px;
      background: rgba(0,0,0,0.08);
      display: flex; align-items: center; justify-content: center;
      font-size: 22px; margin-bottom: 18px;
      border: 1px solid rgba(0,0,0,0.08);
    }
    .product-card h3 { font-size: 16px; font-weight: 600; color: #000000; margin-bottom: 8px; }
    .product-card p { font-size: 13px; color: #555555; line-height: 1.65; margin-bottom: 16px; }
    .product-spec {
      display: flex; gap: 8px; flex-wrap: wrap;
    }
    .spec-tag {
      font-size: 10.5px;
      color: #000000;
      background: rgba(0,0,0,0.08);
      border: 1px solid rgba(0,0,0,0.08);
      border-radius: 4px;
      padding: 3px 9px;
      font-weight: 500;
    }

    /* ── WHY US ── */
    .why-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 20px;
      margin-top: 10px;
    }
    .why-card {
      background: rgba(28,43,58,0.5);
      border: 1px solid rgba(0,0,0,0.08);
      border-radius: 10px; padding: 24px;
    }
    .why-icon { font-size: 26px; margin-bottom: 14px; }
    .why-card h4 { font-size: 15px; font-weight: 600; color: #555555; margin-bottom: 8px; }
    .why-card p { font-size: 13px; color: #555555; line-height: 1.65; }

    /* ── FOOTER ── */
    footer {
      position: relative; z-index: 1;
      border-top: 1px solid rgba(0,0,0,0.08);
      padding: 28px 48px;
      display: flex; align-items: center; justify-content: space-between;
      font-size: 12px; color: #555555;
    }
    footer a { color: #000000; text-decoration: none; font-weight: 500; }

    @media (max-width: 900px) {
      .hero { flex-direction: column; padding: 100px 24px 60px; }
      .hero-right { width: 100%; flex: none; }
      nav { padding: 14px 24px; }
      .section { padding: 0 24px 60px; }
      .stats-strip { flex-wrap: wrap; }
      footer { flex-direction: column; gap: 10px; text-align: center; }
    }
  </style>
</head>
<body>

<!-- Circuit decoration SVG -->
<svg class="circuit-svg" viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice">
  <path d="M100,200 L300,200 L300,350 L500,350 L500,200 L700,200" stroke="#000000" stroke-width="1.5" fill="none"/>
  <circle cx="300" cy="200" r="4" fill="#000000"/>
  <circle cx="500" cy="350" r="4" fill="#000000"/>
  <path d="M900,100 L900,300 L1100,300 L1100,450 L1300,450" stroke="#000000" stroke-width="1.5" fill="none"/>
  <circle cx="900" cy="300" r="4" fill="#000000"/>
  <circle cx="1100" cy="300" r="4" fill="#000000"/>
  <path d="M50,600 L200,600 L200,750 L400,750" stroke="#000000" stroke-width="1" fill="none"/>
  <path d="M1200,600 L1050,600 L1050,750 L850,750 L850,650" stroke="#AAAAAA" stroke-width="1" fill="none"/>
  <circle cx="200" cy="750" r="3" fill="#000000"/>
  <circle cx="1050" cy="750" r="3" fill="#AAAAAA"/>
</svg>

<!-- NAV -->
<nav>
  <div class="nav-brand">
    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo PT Ken Mandiri Teknik" style="width:48px;height:48px;object-fit:contain;border-radius:6px;">
    <div>
      <span>KEN MANDIRI TEKNIK</span>
      <small>Panel Elektronik &amp; Kelistrikan</small>
    </div>
  </div>
  <div class="nav-cta">
    <a href="{{ route('login') }}" class="btn-outline"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-left">
    <div class="hero-eyebrow">
      <span class="dot"></span>
      Solusi Panel Listrik Industri &amp; Komersial
    </div>
    <h1>PT <span class="accent">KEN</span><br>MANDIRI<br>TEKNIK</h1>
    <p class="hero-sub">
      PT Ken Mandiri Teknik menyediakan panel MDP, SDP, ATS, panel LVMDP, dan solusi kelistrikan industri berstandar SNI dengan kualitas terpercaya untuk proyek skala kecil hingga besar.
    </p>
    <div class="hero-actions">
      <a href="{{ route('login') }}" class="btn-hero-primary"><i class="fa-solid fa-gauge-high"></i> Masuk Dashboard</a>
      <a href="#produk" class="btn-hero-secondary"><i class="fa-solid fa-bolt"></i> Lihat Produk</a>
    </div>
  </div>

  
</section>

<!-- STATS STRIP -->
<div class="stats-strip">
  <div class="stat-item">
    <div class="stat-num">15+</div>
    <div class="stat-desc">Tahun Pengalaman</div>
  </div>
  <div class="stat-item">
    <div class="stat-num">500+</div>
    <div class="stat-desc">Proyek Selesai</div>
  </div>
  <div class="stat-item">
    <div class="stat-num">100%</div>
    <div class="stat-desc">Standar SNI</div>
  </div>
  <div class="stat-item">
    <div class="stat-num">24/7</div>
    <div class="stat-desc">Dukungan Teknis</div>
  </div>
</div>

<!-- PRODUCTS -->
<section class="section" id="produk">
  <div class="section-label">// Layanan & Produk</div>
  <div class="section-title">Panel Elektronik Kami</div>
  <p class="section-sub">Kami merancang dan membangun berbagai jenis panel listrik untuk kebutuhan industri, gedung perkantoran, pabrik, dan infrastruktur.</p>

  <div class="products-grid">
    <div class="product-card">
      <div class="product-icon">⚡</div>
      <h3>Panel MDP (Main Distribution)</h3>
      <p>Panel distribusi utama untuk menyalurkan daya dari sumber utama ke berbagai sub-panel dengan sistem proteksi berlapis.</p>
      <div class="product-spec">
        <span class="spec-tag">100A – 2000A</span>
        <span class="spec-tag">400V / 3Ø</span>
        <span class="spec-tag">IP54</span>
      </div>
    </div>
    <div class="product-card">
      <div class="product-icon">🔌</div>
      <h3>Panel SDP (Sub Distribution)</h3>
      <p>Mendistribusikan daya ke beban-beban individual di zona tertentu. Dilengkapi monitoring arus dan proteksi ELCB.</p>
      <div class="product-spec">
        <span class="spec-tag">32A – 400A</span>
        <span class="spec-tag">MCCB</span>
        <span class="spec-tag">ELCB</span>
      </div>
    </div>
    <div class="product-card">
      <div class="product-icon">🔄</div>
      <h3>Panel ATS / AMF</h3>
      <p>Automatic Transfer Switch untuk perpindahan otomatis ke genset saat PLN padam. Response time kurang dari 10 detik.</p>
      <div class="product-spec">
        <span class="spec-tag">&lt; 10 Detik</span>
        <span class="spec-tag">Auto Start</span>
        <span class="spec-tag">Monitoring</span>
      </div>
    </div>
    <div class="product-card">
      <div class="product-icon">🏭</div>
      <h3>Panel Motor Control (MCC)</h3>
      <p>Kontrol motor listrik dengan sistem star-delta starter, DOL, dan inverter untuk efisiensi energi optimal di lingkungan industri.</p>
      <div class="product-spec">
        <span class="spec-tag">Star-Delta</span>
        <span class="spec-tag">Inverter</span>
        <span class="spec-tag">PLC Ready</span>
      </div>
    </div>
    <div class="product-card">
      <div class="product-icon">💡</div>
      <h3>Panel Penerangan (LP)</h3>
      <p>Panel untuk distribusi daya penerangan gedung. Dilengkapi timer digital, dimmer, dan sistem manajemen energi.</p>
      <div class="product-spec">
        <span class="spec-tag">Timer</span>
        <span class="spec-tag">MCB</span>
        <span class="spec-tag">Energy Meter</span>
      </div>
    </div>
    <div class="product-card">
      <div class="product-icon">🛡️</div>
      <h3>Panel LVMDP</h3>
      <p>Low Voltage Main Distribution Panel berkapasitas besar untuk pusat perbelanjaan, hotel, dan gedung bertingkat tinggi.</p>
      <div class="product-spec">
        <span class="spec-tag">ACB</span>
        <span class="spec-tag">hingga 4000A</span>
        <span class="spec-tag">Busbar Besar</span>
      </div>
    </div>
  </div>
</section>

<!-- WHY US -->
<section class="section" id="tentang">
  <div class="section-label">// Keunggulan Kami</div>
  <div class="section-title">Mengapa Pilih Kami?</div>
  <div class="why-grid">
    <div class="why-card">
      <div class="why-icon">🔬</div>
      <h4>Uji Kualitas Ketat</h4>
      <p>Setiap panel melalui pengujian tegangan, isolasi, dan beban sebelum pengiriman sesuai standar IEC & SNI.</p>
    </div>
    <div class="why-card">
      <div class="why-icon">🎓</div>
      <h4>Teknisi Bersertifikat</h4>
      <p>Tim kami memiliki sertifikasi PUIL, K3 Listrik, dan pelatihan pabrikan dari komponen ternama.</p>
    </div>
    <div class="why-card">
      <div class="why-icon">⚙️</div>
      <h4>Komponen Terpilih</h4>
      <p>Menggunakan komponen bermerek global: Schneider, ABB, Siemens, LS, dan Mitsubishi dengan garansi resmi.</p>
    </div>
    <div class="why-card">
      <div class="why-icon">📋</div>
      <h4>Dokumentasi Lengkap</h4>
      <p>Setiap proyek disertai gambar single-line, wiring diagram, dan manual operasi dalam format digital dan cetak.</p>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div>
    &copy; {{ date('Y') }} PT Ken Mandiri Teknik Elektronik — Semua hak dilindungi
  </div>
  <div>
    Masuk ke sistem: <a href="{{ route('login') }}">Portal Admin</a>
  </div>
</footer>

</body>
</html>
