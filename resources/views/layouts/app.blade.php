<!doctype html>
<html lang="id">
<head>
  <title>@yield('title', 'PT Ken Mandiri Teknik')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
      background: #fff;
      margin-left: auto;
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
    #content { flex: 1; min-height: 100vh; display: flex; flex-direction: column; overflow-x: hidden; }

    /* ══════════════════════════════════════
       TOPBAR
    ══════════════════════════════════════ */
    .top-navbar {
      height: var(--topbar-h);
      background: #fff;
      border-bottom: 1px solid var(--gray200);
      padding: 0 24px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 100;
      box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .topnav-left { display: flex; align-items: center; gap: 16px; }
    #sidebarCollapse {
      background: var(--gray100);
      border: 1px solid var(--gray200);
      border-radius: 8px;
      padding: 7px 10px;
      color: var(--gray600);
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s;
    }
    #sidebarCollapse:hover { background: var(--gray200); color: var(--gray900); }

    .breadcrumb-wrap {
      display: flex; align-items: center; gap: 7px;
      font-size: 13px;
    }
    .bc-home { color: var(--gray400); font-size: 12px; }
    .bc-sep { color: var(--gray300); font-size: 9px; }
    .bc-current { color: var(--gray700); font-weight: 600; }

    .topnav-right { display: flex; align-items: center; gap: 10px; position: relative; }
    .topnav-btn {
      width: 36px; height: 36px;
      border-radius: 8px;
      background: var(--gray100);
      border: 1px solid var(--gray200);
      display: flex; align-items: center; justify-content: center;
      color: var(--gray500); font-size: 14px;
      cursor: pointer; transition: all 0.2s;
    }
    .topnav-btn:hover { background: var(--gray200); color: var(--gray800); }

    .topnav-user {
      display: flex; align-items: center; gap: 10px;
      padding: 6px 10px;
      border-radius: 10px;
      border: 1px solid var(--gray200);
      cursor: pointer; transition: all 0.2s;
    }
    .topnav-user:hover { background: var(--gray50); }
    .tu-avatar {
      width: 30px; height: 30px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--blue), var(--indigo));
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 12px; font-weight: 700;
    }
    .tu-name { font-size: 13px; font-weight: 600; color: var(--gray800); line-height: 1.2; }
    .tu-role { font-size: 11px; color: var(--gray500); }
    .tu-arrow { font-size: 10px; color: var(--gray400); }

    .user-dropdown-menu {
      position: absolute; top: calc(100% + 10px); right: 0;
      width: 220px;
      background: #fff;
      border: 1px solid var(--gray200);
      border-radius: 12px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.12);
      overflow: hidden;
      display: none; z-index: 1000;
    }
    .user-dropdown-menu.show { display: block; }
    .udm-header { padding: 14px 16px; }
    .udm-name { font-weight: 700; font-size: 14px; color: var(--gray900); }
    .udm-badge {
      display: inline-flex; align-items: center; gap: 5px;
      font-size: 11px; font-weight: 600;
      border-radius: 20px; padding: 2px 8px; margin-top: 4px;
    }
    .udm-badge.admin { background: rgba(37,99,235,0.1); color: var(--blue); }
    .udm-badge.pegawai { background: rgba(16,185,129,0.1); color: #059669; }
    .udm-divider { height: 1px; background: var(--gray100); }
    .udm-item {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 16px;
      font-size: 13px; color: var(--gray700);
      text-decoration: none; background: none; border: none;
      width: 100%; cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif;
      transition: background 0.15s;
    }
    .udm-item:hover { background: var(--gray50); color: var(--gray900); }
    .udm-logout { color: #DC2626; }
    .udm-logout:hover { background: rgba(239,68,68,0.06); color: #DC2626; }
    .udm-item i { width: 16px; text-align: center; color: var(--gray400); }
    .udm-logout i { color: #F87171; }

    /* ══════════════════════════════════════
       PAGE BODY
    ══════════════════════════════════════ */
    .page-body { padding: 24px 28px; flex: 1; }

    /* Page header */
    .page-header {
      border-radius: 14px;
      padding: 22px 26px;
      margin-bottom: 22px;
      display: flex; align-items: center; justify-content: space-between;
      background: linear-gradient(135deg, #1e3a5f, #2563EB);
      position: relative; overflow: hidden;
    }
    .page-header::before {
      content: '';
      position: absolute;
      width: 200px; height: 200px; border-radius: 50%;
      background: rgba(255,255,255,0.05);
      top: -80px; right: 160px;
    }
    .page-header::after {
      content: '';
      position: absolute;
      width: 140px; height: 140px; border-radius: 50%;
      background: rgba(255,255,255,0.04);
      bottom: -60px; right: 40px;
    }
    .page-header .header-text { position: relative; z-index: 1; }
    .page-header h4 { color: #fff; font-weight: 800; margin: 0; font-size: 18px; }
    .page-header p { color: rgba(255,255,255,0.65); margin: 5px 0 0; font-size: 12.5px; }
    .btn-tambah {
      position: relative; z-index: 1;
      background: rgba(255,255,255,0.15);
      border: 1px solid rgba(255,255,255,0.25);
      color: #fff; font-weight: 700; font-size: 13px;
      border-radius: 9px; padding: 10px 20px;
      text-decoration: none;
      transition: all 0.2s; white-space: nowrap;
      backdrop-filter: blur(4px);
      display: inline-flex; align-items: center; gap: 7px;
    }
    .btn-tambah:hover { background: rgba(255,255,255,0.25); color: #fff; text-decoration: none; transform: translateY(-1px); }

    /* Table card */
    .table-card {
      background: #fff;
      border-radius: 14px;
      padding: 22px 24px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.06);
      border: 1px solid var(--gray200);
    }

    /* DataTable customization */
    table#example { width: 100% !important; }
    table#example thead th {
      background: var(--gray900);
      color: #fff;
      font-size: 12.5px; font-weight: 700;
      border: none; padding: 13px 14px; text-align: center;
      letter-spacing: 0.3px;
    }
    table#example tbody tr { transition: background 0.15s; }
    table#example tbody tr:hover { background: var(--gray50); }
    table#example tbody td {
      font-size: 13px; vertical-align: middle; padding: 12px 14px;
      color: var(--gray700); border-color: var(--gray100); text-align: center;
    }

    /* Table inside detail pages */
    table.detail-tbl { width: 100%; border-collapse: collapse; }
    table.detail-tbl th {
      background: var(--gray800); color: #fff;
      font-weight: 700; text-align: center;
      padding: 12px 14px; border: 1px solid var(--gray200);
      font-size: 12.5px;
    }
    table.detail-tbl td {
      padding: 12px 14px; border: 1px solid var(--gray100);
      font-size: 13px; color: var(--gray600); vertical-align: middle;
    }
    table.detail-tbl tbody tr:hover { background: var(--gray50); }

    /* Buttons */
    .btn-ubah {
      background: var(--blue); color: #fff;
      border: none; border-radius: 7px; padding: 6px 14px;
      font-size: 12px; font-weight: 600; text-decoration: none;
      display: inline-flex; align-items: center; gap: 5px;
      transition: background 0.2s;
      cursor: pointer;
    }
    .btn-ubah:hover { background: var(--blue2); color: #fff; text-decoration: none; }
    .btn-hapus {
      background: var(--red); color: #fff;
      border: none; border-radius: 7px; padding: 6px 14px;
      font-size: 12px; font-weight: 600; text-decoration: none;
      display: inline-flex; align-items: center; gap: 5px;
      transition: background 0.2s;
    }
    .btn-hapus:hover { background: #DC2626; color: #fff; text-decoration: none; }
    .btn-detail {
      background: var(--gray600); color: #fff;
      border: none; border-radius: 7px; padding: 6px 14px;
      font-size: 12px; font-weight: 600; text-decoration: none;
      display: inline-flex; align-items: center; gap: 5px;
      transition: background 0.2s;
    }
    .btn-detail:hover { background: var(--gray700); color: #fff; text-decoration: none; }
    .btn-hapus-inline { display: inline; }
    .badge-cetak {
      background: var(--gray100); color: var(--gray700);
      border: 1px solid var(--gray200);
      border-radius: 20px; padding: 4px 12px;
      font-size: 11.5px; font-weight: 600;
      display: inline-flex; align-items: center; gap: 5px;
      text-decoration: none;
    }
    .badge-cetak:hover { background: var(--gray200); color: var(--gray900); text-decoration: none; }

    /* Form styles */
    .form-element {
      display: flex; align-items: center; gap: 16px;
      flex-wrap: wrap; margin-bottom: 18px;
    }
    .form-element label { width: 160px; margin-bottom: 0; font-weight: 600; color: var(--gray600); font-size: 13px; }
    .form-element input,
    .form-element select,
    .form-element textarea {
      flex: 1; min-width: 220px;
      border-radius: 9px; border: 1.5px solid var(--gray200);
      box-shadow: none; padding: 10px 14px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 13.5px; color: var(--gray800);
      background: var(--gray50);
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-element input:focus,
    .form-element select:focus,
    .form-element textarea:focus {
      border-color: var(--blue);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
      outline: none; background: #fff;
    }
    .form-element .invalid-feedback {
      display: block; width: 100%; margin-left: 176px; margin-top: -10px;
      font-size: 12px;
    }
    .form-actions {
      display: flex; gap: 10px; justify-content: flex-end;
      margin-top: 22px; padding-top: 22px; border-top: 1px solid var(--gray200);
    }
    .btn-primary-form {
      background: linear-gradient(135deg, var(--blue), var(--indigo));
      color: #fff; border: none; border-radius: 9px;
      padding: 10px 22px; font-size: 13.5px; font-weight: 700;
      cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif;
      display: inline-flex; align-items: center; gap: 7px;
      box-shadow: 0 3px 12px rgba(37,99,235,0.3);
      transition: all 0.2s;
    }
    .btn-primary-form:hover { opacity: 0.9; transform: translateY(-1px); }
    .btn-secondary-form {
      background: var(--gray100); color: var(--gray700);
      border: 1px solid var(--gray200); border-radius: 9px;
      padding: 10px 22px; font-size: 13.5px; font-weight: 600;
      cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif;
      text-decoration: none; display: inline-flex; align-items: center; gap: 7px;
      transition: all 0.2s;
    }
    .btn-secondary-form:hover { background: var(--gray200); color: var(--gray900); text-decoration: none; }

    /* DataTables custom */
    .dataTables_wrapper .dataTables_filter input {
      border: 1.5px solid var(--gray200); border-radius: 8px;
      padding: 6px 12px; font-size: 13px; outline: none;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .dataTables_wrapper .dataTables_filter input:focus { border-color: var(--blue); }
    .dataTables_wrapper .dataTables_length select {
      border: 1.5px solid var(--gray200); border-radius: 8px;
      padding: 5px 8px; font-size: 13px;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
      background: var(--blue) !important; color: #fff !important;
      border-color: var(--blue) !important; border-radius: 7px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: var(--gray100) !important; color: var(--gray900) !important;
      border-radius: 7px;
    }
    .dataTables_wrapper label { color: var(--gray500); font-size: 13px; }
    .dataTables_wrapper .dataTables_info { color: var(--gray500); font-size: 12.5px; }

    /* Alert */
    .alert { border-radius: 10px; font-size: 13.5px; }
    .alert-success { background: rgba(16,185,129,0.08); border-color: rgba(16,185,129,0.2); color: #065F46; }
    .alert-danger { background: rgba(239,68,68,0.08); border-color: rgba(239,68,68,0.2); color: #B91C1C; }

    /* Access denied badge */
    .access-denied {
      display: flex; align-items: center; justify-content: center;
      flex-direction: column; gap: 16px;
      padding: 60px 24px; text-align: center;
    }
    .access-denied .ad-icon {
      width: 72px; height: 72px;
      border-radius: 50%;
      background: rgba(239,68,68,0.08);
      border: 1px solid rgba(239,68,68,0.15);
      display: flex; align-items: center; justify-content: center;
      color: var(--red); font-size: 28px;
    }
    .access-denied h4 { font-weight: 800; color: var(--gray900); margin: 0; }
    .access-denied p { color: var(--gray500); font-size: 14px; max-width: 360px; }

    @media (max-width: 768px) {
      #sidebar { position: fixed; z-index: 200; transform: translateX(-100%); }
      #sidebar.mobile-open { transform: translateX(0); }
      .page-body { padding: 16px; }
    }

    @yield('page_styles')
  </style>
</head>
<body>
  @include('layouts.sidebar')

  <div id="content">
    @include('layouts.topbar')

    <div class="page-body">
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
          <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
          <i class="fa-solid fa-exclamation-circle"></i> {{ session('error') }}
          <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @yield('content')
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function () {
      if ($('#example').length) {
        $('#example').DataTable({
          language: { search: "Cari:", lengthMenu: "Tampilkan _MENU_ data", zeroRecords: "Tidak ada data ditemukan", info: "Menampilkan _START_ – _END_ dari _TOTAL_ data", infoEmpty: "Tidak ada data", paginate: { previous: "‹", next: "›" } }
        });
      }
      $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('collapsed');
      });
    });
  </script>
  @yield('scripts')
</body>
</html>
