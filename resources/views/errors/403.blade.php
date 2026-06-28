@extends('layouts.app')
@section('title', 'Akses Ditolak')
@section('page_title', 'Akses Ditolak')
@section('active', '')
@section('content')
<div class="access-denied">
  <div class="ad-icon"><i class="fa-solid fa-shield-halved"></i></div>
  <h4>Akses Ditolak</h4>
  <p>Halaman ini hanya dapat diakses oleh <strong>Administrator</strong>. Akun Anda sebagai Pegawai tidak memiliki izin untuk mengakses fitur ini.</p>
  <a href="{{ route('dashboard') }}" class="btn-primary-form">
    <i class="fa-solid fa-house"></i> Kembali ke Dashboard
  </a>
</div>
@endsection
