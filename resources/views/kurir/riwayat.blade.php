@extends('layouts.app')
@php $title='Riwayat Tugas'; $roleLabel='Kurir'; $sidebarColor='var(--green)'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-kurir') @endsection
@section('content')
@php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; @endphp
<div class="stats-grid stats-3">
  <div class="stat-card"><div class="stat-icon ic-amber"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg></div><div class="stat-label">Total Pickup</div><div class="stat-value">{{ $stats['total_pickup'] }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-blue"><svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div><div class="stat-label">Total Delivery</div><div class="stat-value">{{ $stats['total_delivery'] }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><div class="stat-label">Total Selesai</div><div class="stat-value">{{ $stats['total_selesai'] }}</div></div>
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Riwayat Semua Tugas</span></div>
  <div class="table-wrap"><table>
    <thead><tr><th>ID</th><th>Customer</th><th>Jenis</th><th>Berat</th><th>Tanggal</th><th>Peran</th><th>Status</th></tr></thead>
    <tbody>
      @forelse($orders as $o)
      <tr>
        <td class="fw-700 text-brand">#{{ str_pad($o->id,3,'0',STR_PAD_LEFT) }}</td>
        <td>{{ $o->customer->nama }}</td>
        <td>{{ $o->jenis_laundry }}</td>
        <td>{{ $o->total_berat > 0 ? $o->total_berat.' kg' : '—' }}</td>
        <td>{{ $o->tanggal_order->format('d M Y') }}</td>
        <td>
          @if($o->kurir_pickup_id===auth()->id() && $o->kurir_delivery_id===auth()->id())
            <span class="badge badge-brand">Pickup + Delivery</span>
          @elseif($o->kurir_pickup_id===auth()->id())
            <span class="badge badge-amber">Pickup</span>
          @else
            <span class="badge badge-blue">Delivery</span>
          @endif
        </td>
        <td><span class="badge badge-{{ $colors[$o->status]??'gray' }}"><span class="badge-dot" style="background:currentColor"></span>{{ $o->status_label }}</span></td>
      </tr>
      @empty
      <tr><td colspan="7" style="text-align:center;color:var(--gray-400);padding:32px">Belum ada riwayat</td></tr>
      @endforelse
    </tbody>
  </table></div>
  @if($orders->hasPages())<div style="padding:14px 18px;border-top:1px solid var(--gray-100)">{{ $orders->links() }}</div>@endif
</div>
@endsection
