@php
    $active = trim($__env->yieldContent('active'));
    $user = auth()->user();
    $isAdmin = $user && $user->isAdmin();
@endphp
<div class="top-navbar">
  <div class="topnav-left">
    <button type="button" id="sidebarCollapse" title="Toggle Sidebar">
      <i class="fa-solid fa-bars"></i>
    </button>
    <div class="breadcrumb-wrap">
      <span class="bc-home"><i class="fa-solid fa-house"></i></span>
      <span class="bc-sep"><i class="fa-solid fa-chevron-right"></i></span>
      <span class="bc-current">@yield('page_title', 'Dashboard')</span>
    </div>
  </div>

  <div class="topnav-right">
    {{-- Notification placeholder --}}
    <div class="topnav-btn" title="Notifikasi">
      <i class="fa-regular fa-bell"></i>
    </div>

    {{-- User dropdown --}}
    <div class="topnav-user" id="userDropdown" onclick="toggleUserMenu()">
      <div class="tu-avatar">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</div>
      <div class="tu-info">
        <div class="tu-name">{{ $user->name ?? 'User' }}</div>
        <div class="tu-role">
          @if($isAdmin)
            <i class="fa-solid fa-shield-halved" style="color:#2563EB;"></i> Administrator
          @else
            <i class="fa-solid fa-id-badge" style="color:#10B981;"></i> Pegawai
          @endif
        </div>
      </div>
      <i class="fa-solid fa-chevron-down tu-arrow"></i>
    </div>
    <div class="user-dropdown-menu" id="userMenu">
      <div class="udm-header">
        <div class="udm-name">{{ $user->name ?? 'User' }}</div>
        <div class="udm-badge @if($isAdmin) admin @else pegawai @endif">
          @if($isAdmin)<i class="fa-solid fa-shield-halved"></i> Admin @else <i class="fa-solid fa-id-badge"></i> Pegawai @endif
        </div>
      </div>
      <div class="udm-divider"></div>
      <a href="{{ route('dashboard') }}" class="udm-item"><i class="fa-solid fa-house"></i> Dashboard</a>
      <div class="udm-divider"></div>
      <button class="udm-item udm-logout" onclick="if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form2').submit();">
        <i class="fa-solid fa-right-from-bracket"></i> Keluar
      </button>
    </div>
  </div>
</div>
<form id="logout-form2" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

<script>
function toggleUserMenu() {
  document.getElementById('userMenu').classList.toggle('show');
}
document.addEventListener('click', function(e) {
  if (!document.getElementById('userDropdown').contains(e.target)) {
    document.getElementById('userMenu').classList.remove('show');
  }
});
</script>
