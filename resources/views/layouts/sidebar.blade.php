@php
    $active = trim($__env->yieldContent('active'));
    $user = auth()->user();
    $isAdmin = $user && $user->isAdmin();

    $adminMenu = [
        'home'       => ['route' => 'dashboard',        'icon' => 'fa-solid fa-house',         'label' => 'Dashboard',        'section' => null],
        'customer'   => ['route' => 'customer.index',   'icon' => 'fa-solid fa-users',         'label' => 'Customer',         'section' => 'Master Data'],
        'perusahaan' => ['route' => 'perusahaan.index', 'icon' => 'fa-solid fa-building',      'label' => 'Perusahaan',       'section' => null],
        'pegawai'    => ['route' => 'pegawai.index',    'icon' => 'fa-solid fa-id-badge',      'label' => 'Pegawai',          'section' => null],
        'bahan_baku' => ['route' => 'bahan_baku.index', 'icon' => 'fa-solid fa-cubes',         'label' => 'Bahan Baku',       'section' => null],
        'barang'     => ['route' => 'barang.index',     'icon' => 'fa-solid fa-box',           'label' => 'Barang',           'section' => null],
        'nota'       => ['route' => 'nota.index',       'icon' => 'fa-solid fa-receipt',       'label' => 'Nota Pembelian',   'section' => 'Transaksi'],
        'invoice'    => ['route' => 'invoice.index',    'icon' => 'fa-solid fa-file-invoice',  'label' => 'Invoice Penjualan','section' => null],
        'log-aktivitas'      => ['route' => 'log-aktivitas.index',      'icon' => 'fa-solid fa-clock-rotate-left', 'label' => 'Log Aktivitas',      'section' => 'Log & Riwayat'],
        'riwayat-login'      => ['route' => 'riwayat-login.index',      'icon' => 'fa-solid fa-right-to-bracket',  'label' => 'Riwayat Login',       'section' => null],
        'riwayat-transaksi'  => ['route' => 'riwayat-transaksi.index',  'icon' => 'fa-solid fa-clipboard-list',    'label' => 'Riwayat Transaksi',   'section' => null],
    ];

    $pegawaiMenu = [
        'home'    => ['route' => 'dashboard',       'icon' => 'fa-solid fa-house',        'label' => 'Dashboard',        'section' => null],
        'nota'    => ['route' => 'nota.index',      'icon' => 'fa-solid fa-receipt',      'label' => 'Nota Pembelian',   'section' => 'Transaksi'],
        'invoice' => ['route' => 'invoice.index',   'icon' => 'fa-solid fa-file-invoice', 'label' => 'Invoice Penjualan','section' => null],
    ];

    $menu = $isAdmin ? $adminMenu : $pegawaiMenu;
    $prevSection = null;
@endphp

<nav id="sidebar">
  <div class="sidebar-brand">
    <div class="s-logo">
      <img src="{{ asset('assets/images/logo_ken.png') }}" alt="Logo" style="width:32px;height:32px;object-fit:contain;">
    </div>
    <div class="sidebar-brand-text">
      <div class="s-name">Ken Mandiri</div>
      <div class="s-sub">Teknik Elektronik</div>
    </div>
  </div>

  {{-- User badge --}}
  <div class="sidebar-user">
    <div class="su-avatar">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</div>
    <div class="sidebar-brand-text">
      <div class="su-name">{{ $user->name ?? 'User' }}</div>
      <div class="su-role">
        @if($isAdmin)
          <span class="role-pill admin"><i class="fa-solid fa-shield-halved"></i> Admin</span>
        @else
          <span class="role-pill pegawai"><i class="fa-solid fa-id-badge"></i> Pegawai</span>
        @endif
      </div>
    </div>
  </div>

  <div class="sidebar-nav">
    @foreach ($menu as $key => $item)
      @if($item['section'] && $item['section'] !== $prevSection)
        <div class="nav-section-label"><span class="section-label-text">{{ $item['section'] }}</span></div>
        @php $prevSection = $item['section']; @endphp
      @endif
      <div class="nav-item @if($active === $key) active @endif">
        <a href="{{ route($item['route']) }}">
          <span class="nav-icon"><i class="{{ $item['icon'] }}"></i></span>
          <span class="nav-text">{{ $item['label'] }}</span>
          @if($active === $key)<span class="nav-dot"></span>@endif
        </a>
      </div>
    @endforeach
  </div>

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
