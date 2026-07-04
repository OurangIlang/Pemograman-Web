@extends('layouts.app')

@section('title', 'Log Aktivitas - PT Ken Mandiri Teknik')
@section('active', 'log-aktivitas')

@section('content')
  <div class="page-header">
    <div class="header-text">
      <h4><i class="fa fa-clock-rotate-left mr-2" style="color: #000000;"></i>Log <span>Aktivitas</span></h4>
      <p>Riwayat penambahan, perubahan, dan penghapusan data (500 aktivitas terbaru)</p>
    </div>
  </div>

  <div class="table-card">
    <table id="example" class="table table-bordered" style="width:100%;">
      <thead>
        <tr>
          <th>Waktu</th>
          <th>User</th>
          <th>Role</th>
          <th>Aktivitas</th>
          <th>Tabel</th>
          <th>ID Data</th>
          <th>Perubahan</th>
          <th>IP Address</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $log)
          <tr>
            <td>{{ optional($log->created_at)->format('d-m-Y H:i:s') }}</td>
            <td>{{ $log->nama_user }}</td>
            <td>{{ ucfirst($log->role) }}</td>
            <td>
              @if ($log->aktivitas === 'Tambah')
                <span class="badge-cetak" style="color:#065F46;border-color:rgba(16,185,129,0.3);">Tambah</span>
              @elseif ($log->aktivitas === 'Ubah')
                <span class="badge-cetak" style="color:#1D4ED8;border-color:rgba(37,99,235,0.3);">Ubah</span>
              @else
                <span class="badge-cetak" style="color:#B91C1C;border-color:rgba(239,68,68,0.3);">Hapus</span>
              @endif
            </td>
            <td>{{ $log->tabel }}</td>
            <td>{{ $log->record_id }}</td>
            <td style="max-width: 360px;">
              @php $lama = $log->data_lama_array; $baru = $log->data_baru_array; @endphp
              @if ($log->aktivitas === 'Ubah' && $baru)
                <ul class="mb-0 ps-3" style="font-size: 12px;">
                  @foreach ($baru as $field => $value)
                    <li><strong>{{ $field }}</strong>: {{ $lama[$field] ?? '-' }} &rarr; {{ $value }}</li>
                  @endforeach
                </ul>
              @elseif ($log->aktivitas === 'Tambah' && $baru)
                <span style="font-size: 12px; color: var(--gray500);">Data baru ditambahkan</span>
              @elseif ($log->aktivitas === 'Hapus' && $lama)
                <span style="font-size: 12px; color: var(--gray500);">Data dihapus</span>
              @else
                -
              @endif
            </td>
            <td>{{ $log->ip_address }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
