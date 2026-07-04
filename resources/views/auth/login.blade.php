<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login — PT Ken Mandiri Teknik</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --blue:   #2563EB;
      --blue2:  #1D4ED8;
      --indigo: #4F46E5;
      --green:  #10B981;
      --red:    #EF4444;
      --gray50: #F9FAFB;
      --gray100:#F3F4F6;
      --gray200:#E5E7EB;
      --gray400:#9CA3AF;
      --gray600:#4B5563;
      --gray800:#1F2937;
      --gray900:#111827;
    }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      min-height: 100vh;
      background: var(--gray100);
      display: flex;
    }

    /* ── LEFT PANEL ── */
    .left {
      flex: 1;
      background: linear-gradient(135deg, #1e3a5f 0%, #2563EB 50%, #4F46E5 100%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 60px 64px;
      position: relative;
      overflow: hidden;
    }
    .left::before {
      content: '';
      position: absolute; inset: 0;
      background:
        radial-gradient(ellipse at 20% 20%, rgba(255,255,255,0.08) 0%, transparent 50%),
        radial-gradient(ellipse at 80% 80%, rgba(79,70,229,0.3) 0%, transparent 50%);
    }
    .left::after {
      content: '';
      position: absolute;
      width: 400px; height: 400px;
      border-radius: 50%;
      border: 1px solid rgba(255,255,255,0.08);
      top: -100px; right: -100px;
    }
    .left .circle2 {
      position: absolute;
      width: 250px; height: 250px;
      border-radius: 50%;
      border: 1px solid rgba(255,255,255,0.06);
      bottom: -60px; left: -60px;
    }
    .left-inner { position: relative; z-index: 1; max-width: 500px; }

    .brand-row {
      display: flex; align-items: center; gap: 14px;
      margin-bottom: 52px;
    }
    .brand-logo {
      width: 52px; height: 52px;
      background: #fff;
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      padding: 4px;
    }
    .brand-logo img { width: 44px; height: 44px; object-fit: contain; }
    .brand-name { color: #fff; font-size: 15px; font-weight: 700; letter-spacing: 0.3px; }
    .brand-sub { color: rgba(255,255,255,0.6); font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase; margin-top: 2px; }

    .left h1 {
      font-size: clamp(28px, 3.5vw, 44px);
      font-weight: 800;
      color: #fff;
      line-height: 1.15;
      margin-bottom: 18px;
    }
    .left h1 span { color: rgba(255,255,255,0.7); font-weight: 400; }
    .left > .left-inner > .desc {
      font-size: 14px;
      color: rgba(255,255,255,0.65);
      line-height: 1.8;
      margin-bottom: 48px;
    }

    .feat-list { display: flex; flex-direction: column; gap: 16px; }
    .feat-item { display: flex; align-items: center; gap: 14px; }
    .feat-icon {
      width: 40px; height: 40px; flex-shrink: 0;
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.15);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      color: rgba(255,255,255,0.9); font-size: 15px;
    }
    .feat-label { color: rgba(255,255,255,0.85); font-size: 13.5px; font-weight: 500; }

    .dots-row { margin-top: 52px; display: flex; gap: 6px; }
    .dot { width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.3); }
    .dot:first-child { background: #fff; width: 24px; border-radius: 4px; }

    /* ── RIGHT PANEL ── */
    .right {
      width: 460px;
      min-width: 460px;
      background: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 64px 52px;
      position: relative;
      box-shadow: -8px 0 48px rgba(0,0,0,0.08);
    }

    .role-tabs {
      display: flex;
      background: var(--gray100);
      border-radius: 10px;
      padding: 4px;
      margin-bottom: 36px;
      gap: 4px;
    }
    .role-tab {
      flex: 1;
      padding: 9px 12px;
      border-radius: 7px;
      border: none;
      background: transparent;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 13px;
      font-weight: 600;
      color: var(--gray400);
      cursor: pointer;
      display: flex; align-items: center; justify-content: center; gap: 7px;
      transition: all 0.2s;
    }
    .role-tab.active {
      background: #fff;
      color: var(--blue);
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }
    .role-tab i { font-size: 14px; }

    .form-header { margin-bottom: 32px; }
    .form-tag {
      display: inline-flex; align-items: center; gap: 6px;
      font-size: 11px; font-weight: 700;
      letter-spacing: 2px; text-transform: uppercase;
      color: var(--blue);
      background: rgba(37,99,235,0.08);
      border-radius: 20px;
      padding: 4px 12px;
      margin-bottom: 14px;
    }
    .form-tag i { font-size: 10px; }
    .form-header h2 {
      font-size: 26px; font-weight: 800;
      color: var(--gray900);
      margin-bottom: 6px;
    }
    .form-header p { font-size: 13.5px; color: var(--gray600); }

    .alert-error {
      display: flex; align-items: center; gap: 10px;
      background: rgba(239,68,68,0.06);
      border: 1px solid rgba(239,68,68,0.2);
      border-left: 3px solid var(--red);
      color: #B91C1C; font-size: 13px;
      border-radius: 8px; padding: 12px 16px;
      margin-bottom: 24px;
    }

    .alert-success-login {
      display: flex; align-items: center; gap: 10px;
      background: rgba(16,185,129,0.06);
      border: 1px solid rgba(16,185,129,0.2);
      border-left: 3px solid var(--green);
      color: #065F46; font-size: 13px;
      border-radius: 8px; padding: 12px 16px;
      margin-bottom: 24px;
    }

    .field { margin-bottom: 20px; }
    .field label {
      display: flex; align-items: center; gap: 6px;
      font-size: 12px; font-weight: 700;
      color: var(--gray800); text-transform: uppercase; letter-spacing: 0.8px;
      margin-bottom: 8px;
    }
    .field label i { color: var(--blue); font-size: 11px; }
    .input-wrap { position: relative; }
    .input-wrap .ico {
      position: absolute; left: 14px; top: 50%;
      transform: translateY(-50%); color: var(--gray400); font-size: 14px;
      pointer-events: none; transition: color 0.2s;
    }
    .input-wrap input {
      width: 100%;
      padding: 13px 14px 13px 44px;
      background: var(--gray50);
      border: 1.5px solid var(--gray200);
      border-radius: 10px;
      color: var(--gray900);
      font-size: 14px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }
    .input-wrap input::placeholder { color: var(--gray400); }
    .input-wrap input:focus {
      border-color: var(--blue);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
    }
    .input-wrap:focus-within .ico { color: var(--blue); }

    .toggle-pw {
      position: absolute; right: 14px; top: 50%;
      transform: translateY(-50%); color: var(--gray400);
      background: none; border: none; cursor: pointer;
      font-size: 14px; padding: 4px;
      transition: color 0.2s;
    }
    .toggle-pw:hover { color: var(--blue); }

    .remember-row {
      display: flex; align-items: center; gap: 8px;
      margin-bottom: 24px;
    }
    .remember-row input[type="checkbox"] {
      width: 16px; height: 16px;
      accent-color: var(--blue); cursor: pointer;
    }
    .remember-row label {
      font-size: 13px; color: var(--gray600); cursor: pointer;
    }

    .btn-submit {
      width: 100%; padding: 14px;
      background: linear-gradient(135deg, var(--blue), var(--indigo));
      color: #fff; font-size: 14px; font-weight: 700;
      border: none; border-radius: 10px; cursor: pointer;
      font-family: 'Plus Jakarta Sans', sans-serif;
      letter-spacing: 0.5px;
      box-shadow: 0 4px 20px rgba(37,99,235,0.35);
      transition: all 0.2s;
      display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(37,99,235,0.4);
    }
    .btn-submit:active { transform: translateY(0); }

    .hint-box {
      margin-top: 24px;
      background: var(--gray50);
      border: 1px solid var(--gray200);
      border-radius: 10px;
      padding: 14px 16px;
      font-size: 12px;
      color: var(--gray600);
    }
    .hint-box strong { color: var(--gray800); }
    .hint-row { display: flex; justify-content: space-between; margin-top: 6px; }
    .hint-badge {
      display: inline-flex; align-items: center; gap: 5px;
      background: rgba(37,99,235,0.08);
      color: var(--blue);
      border-radius: 6px;
      padding: 3px 8px;
      font-size: 11px; font-weight: 600;
    }
    .hint-badge.green {
      background: rgba(16,185,129,0.08);
      color: #059669;
    }

    .copyright {
      margin-top: 28px; text-align: center;
      font-size: 11px; color: var(--gray400);
    }

    @media (max-width: 860px) {
      .left { display: none; }
      .right { width: 100%; min-width: unset; padding: 48px 28px; }
    }
  </style>
</head>
<body>

<!-- LEFT -->
<div class="left">
  <div class="circle2"></div>
  <div class="left-inner">
    <div class="brand-row">
      <div class="brand-logo">
        <img src="{{ asset('assets/images/logo_ken.png') }}" alt="Logo Ken Mandiri" style="width:40px;height:40px;object-fit:contain;">
      </div>
      <div>
        <div class="brand-name">PT Ken Mandiri Teknik</div>
        <div class="brand-sub">Panel Elektronik Industri</div>
      </div>
    </div>

    <h1>Sistem Manajemen<br><span>Operasional</span><br>Terpadu</h1>
    <p class="desc">
      Platform terintegrasi untuk mengelola seluruh operasional bisnis PT Ken Mandiri Teknik — dari pembelian, penjualan, stok, hingga laporan.
    </p>

    <div class="feat-list">
      <div class="feat-item">
        <div class="feat-icon"><i class="fa-solid fa-file-invoice"></i></div>
        <div class="feat-label">Nota Pembelian & Invoice Penjualan</div>
      </div>
      <div class="feat-item">
        <div class="feat-icon"><i class="fa-solid fa-cubes"></i></div>
        <div class="feat-label">Manajemen Bahan Baku & Stok Barang</div>
      </div>
      <div class="feat-item">
        <div class="feat-icon"><i class="fa-solid fa-users-gear"></i></div>
        <div class="feat-label">Data Customer, Pegawai & Perusahaan</div>
      </div>
      <div class="feat-item">
        <div class="feat-icon"><i class="fa-solid fa-chart-pie"></i></div>
        <div class="feat-label">Dashboard Statistik & Laporan</div>
      </div>
    </div>

    <div class="dots-row">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
    </div>
  </div>
</div>

<!-- RIGHT -->
<div class="right">
  <div class="form-header">
    <div class="form-tag" id="role-tag">
      <i class="fa-solid fa-shield-halved"></i>
      <span id="role-tag-text">Akses Sistem</span>
    </div>
    <h2 id="form-title">Login Sistem PT Ken Mandiri Teknik</h2>
    <p id="form-sub">Masukkan username dan password untuk masuk ke sistem</p>
  </div>

  @if ($errors->any())
  <div class="alert-error">
    <i class="fa-solid fa-triangle-exclamation"></i>
    {{ $errors->first() }}
  </div>
  @endif

  @if (session('success'))
  <div class="alert-success-login">
    <i class="fa-solid fa-check-circle"></i>
    {{ session('success') }}
  </div>
  @endif

  <form method="POST" action="{{ route('login.attempt') }}" autocomplete="off">
    @csrf
    <div class="field">
      <label><i class="fa-solid fa-user"></i> Username</label>
      <div class="input-wrap">
        <i class="fa-solid fa-user ico"></i>
        <input
          type="text"
          name="username"
          placeholder="Masukkan username"
          value="{{ old('username') }}"
          autofocus required
        >
      </div>
    </div>

    <div class="field">
      <label><i class="fa-solid fa-lock"></i> Password</label>
      <div class="input-wrap">
        <i class="fa-solid fa-lock ico"></i>
        <input type="password" name="password" id="pw" placeholder="Masukkan password" required>
        <button type="button" class="toggle-pw" onclick="togglePw()">
          <i class="fa-solid fa-eye" id="eye-icon"></i>
        </button>
      </div>
    </div>

    <div class="remember-row">
      <input type="checkbox" name="remember" id="remember">
      <label for="remember">Ingat saya di perangkat ini</label>
    </div>

    <button type="submit" class="btn-submit">
      <i class="fa-solid fa-right-to-bracket"></i>
      <span id="btn-text">Masuk</span>
    </button>
  </form>

  <div class="hint-box">
    <strong>Akun Default:</strong>
    <div class="hint-row" style="margin-top:8px; flex-wrap: wrap; gap: 6px;">
      <span class="hint-badge"><i class="fa-solid fa-shield-halved"></i> admin / admin123</span>
      <span class="hint-badge green"><i class="fa-solid fa-id-badge"></i> nama pegawai / password123</span>
    </div>
  </div>

  <div class="copyright">
    &copy; {{ date('Y') }} PT Ken Mandiri Teknik Elektronik. All rights reserved.
  </div>
</div>

<script>
function togglePw() {
  var pw = document.getElementById('pw');
  var icon = document.getElementById('eye-icon');
  if (pw.type === 'password') {
    pw.type = 'text';
    icon.className = 'fa-solid fa-eye-slash';
  } else {
    pw.type = 'password';
    icon.className = 'fa-solid fa-eye';
  }
}
</script>
</body>
</html>
