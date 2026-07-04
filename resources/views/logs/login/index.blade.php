@extends('layouts.app')

@section('title', 'Riwayat Login - PT Ken Mandiri Teknik')
@section('active', 'riwayat-login')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-right-to-bracket mr-2" style="color: #000000;"></i>Riwayat <span>Login</span></h4>
      <p>Riwayat login dan logout pengguna (500 sesi terbaru)</p>
    </div>
  </div>

  <div class="table-card">
    <table id="example" class="table table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th>Nama User</th>
          <th>Role</th>
          <th>Login</th>
          <th>Logout</th>
          <th>IP Address</th>
          <th>Browser / User Agent</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $log)
          <tr>
            <td>{{ $log->nama_user }}</td>
            <td>
              @if ($log->role === 'admin')
                <span class="role-pill admin" style="color:#1D4ED8;background:rgba(37,99,235,0.1);">Admin</span>
              @else
                <span class="role-pill pegawai" style="color:#059669;background:rgba(16,185,129,0.1);">Pegawai</span>
              @endif
            </td>
            <td>{{ optional($log->login_at)->format('d-m-Y H:i:s') }}</td>
            <td>
              @if ($log->logout_at)
                {{ $log->logout_at->format('d-m-Y H:i:s') }}
              @else
                <span style="color: var(--green); font-weight:600;">Masih login</span>
              @endif
            </td>
            <td>{{ $log->ip_address }}</td>
            <td style="max-width: 320px; overflow-wrap: anywhere; font-size: 12px;">{{ $log->user_agent }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
