@extends('layouts.app')
@php $title='Riwayat Transaksi'; $roleLabel='Customer Portal'; $sidebarColor='var(--teal)'; $userName=auth('customer')->user()->nama; @endphp
@section('sidebar-nav') @include('components.nav-customer') @endsection
@section('content')
@php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; @endphp
<div class="stats-grid stats-3">
  <div class="stat-card"><div class="stat-icon ic-brand"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div><div class="stat-label">Total Order</div><div class="stat-value">{{ $stats['total_order'] }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-blue"><svg viewBox="0 0 24 24"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/><line x1="9" y1="9" x2="9" y2="9"/><line x1="9" y1="12" x2="9" y2="12"/><line x1="9" y1="15" x2="9" y2="15"/></svg></div><div class="stat-label">Total Berat</div><div class="stat-value">{{ number_format($stats['total_berat'],1,',','.') }} kg</div></div>
  <div class="stat-card"><div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div class="stat-label">Total Belanja</div><div class="stat-value" style="font-size:18px">Rp {{ number_format($stats['total_belanja'],0,',','.') }}</div></div>
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Semua Transaksi</span></div>
  <div class="table-wrap"><table>
    <thead><tr><th>ID</th><th>Tanggal</th><th>Jenis</th><th>Berat</th><th>Total</th><th>Status</th></tr></thead>
    <tbody>
      @forelse($orders as $o)
      <tr>
        <td><a href="{{ route('customer.orders.show',$o) }}" class="fw-700 text-brand">#{{ str_pad($o->id,3,'0',STR_PAD_LEFT) }}</a></td>
        <td>{{ $o->tanggal_order->format('d M Y') }}</td>
        <td>{{ $o->jenis_laundry }}</td>
        <td>{{ $o->total_berat > 0 ? $o->total_berat.' kg' : '—' }}</td>
        <td class="fw-600 text-green">{{ $o->total_harga > 0 ? 'Rp '.number_format($o->total_harga,0,',','.') : '—' }}</td>
        <td><span class="badge badge-{{ $colors[$o->status]??'gray' }}"><span class="badge-dot" style="background:currentColor"></span>{{ $o->status_label }}</span></td>
      </tr>
      @empty
      <tr><td colspan="6" style="text-align:center;color:var(--gray-400);padding:32px">Belum ada transaksi</td></tr>
      @endforelse
    </tbody>
  </table></div>
</div>
@endsection
