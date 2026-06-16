@extends('layouts.app')
@php $title='Halo, '.auth('customer')->user()->nama; $roleLabel='Customer Portal'; $sidebarColor='var(--teal)'; $userName=auth('customer')->user()->nama; @endphp
@section('sidebar-nav') @include('components.nav-customer') @endsection
@section('topbar-actions')
<a href="{{ route('customer.pickup.create') }}" class="btn btn-primary btn-sm">
  <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Request Pickup
</a>
@endsection
@section('content')
@php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; @endphp
<div class="stats-grid stats-3">
  <div class="stat-card"><div class="stat-icon ic-brand"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div><div class="stat-label">Order Aktif</div><div class="stat-value">{{ $stats['order_aktif'] }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><div class="stat-label">Selesai Bulan Ini</div><div class="stat-value">{{ $stats['selesai_bulan'] }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-amber"><svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div><div class="stat-label">Tagihan Unpaid</div><div class="stat-value">Rp {{ number_format($stats['total_tagihan'],0,',','.') }}</div></div>
</div>
<div class="grid-2">
  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">Order Aktif Saya</span><a href="{{ route('customer.orders.index') }}" class="card-action">Lihat semua →</a></div>
      <div class="card-body">
        @forelse($activeOrders as $order)
        <div style="background:var(--gray-50);border-radius:10px;padding:14px;margin-bottom:10px;border:1px solid var(--gray-200)">
          <div style="display:flex;justify-content:space-between;margin-bottom:8px">
            <a href="{{ route('customer.orders.show',$order) }}" class="fw-700 text-brand">#{{ str_pad($order->id,3,'0',STR_PAD_LEFT) }}</a>
            <span class="badge badge-{{ $colors[$order->status]??'gray' }}"><span class="badge-dot" style="background:currentColor"></span>{{ $order->status_label }}</span>
          </div>
          <div style="font-size:12px;color:var(--gray-500);margin-bottom:10px">{{ $order->jenis_laundry }} · {{ $order->tanggal_order->format('d M Y') }}</div>
          <div class="timeline">
            @php $steps=[['menunggu_pickup','Menunggu Pickup'],['pickup','Pickup'],['proses','Diproses'],['siap_delivery','Siap Delivery'],['delivery','Delivery']]; $statusOrder=array_keys(\App\Models\Order::$statusLabels); $curIdx=array_search($order->status,$statusOrder); @endphp
            @foreach($steps as $i=>[$s,$l])
            @php $sIdx=array_search($s,$statusOrder); $done=$sIdx<=$curIdx; $active=$s===$order->status; @endphp
            <div class="tl-item">
              <div class="tl-dot {{ $done?'done':($active?'active':'') }}">@if($done)<svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>@else{{ $i+1 }}@endif</div>
              <div><div class="tl-title">{{ $l }}</div></div>
            </div>
            @endforeach
          </div>
        </div>
        @empty
        <div style="text-align:center;padding:24px 0;color:var(--gray-400)">
          <svg viewBox="0 0 24 24" style="width:32px;height:32px;stroke:currentColor;display:block;margin:0 auto 8px;fill:none;stroke-width:1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
          Tidak ada order aktif
        </div>
        @endforelse
      </div>
    </div>
  </div>
  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">Quick Request Pickup</span></div>
      <div class="card-body">
        <form method="POST" action="{{ route('customer.pickup.store') }}">
          @csrf
          <div class="form-group"><label class="form-label">Jenis Laundry</label><select name="jenis_laundry" class="form-control"><option>Pakaian biasa</option><option>Pakaian kerja</option><option>Linen/Sprei</option><option>Karpet/Gordyn</option></select></div>
          <div class="form-group"><label class="form-label">Jadwal Pickup</label><input type="datetime-local" name="jadwal_pickup" class="form-control" required></div>
          <div class="form-group"><label class="form-label">Catatan</label><input type="text" name="catatan" class="form-control" placeholder="Instruksi khusus..."></div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center"><svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Kirim Request</button>
        </form>
      </div>
    </div>
    <div class="card">
      <div class="card-header"><span class="card-title">Invoice Terbaru</span><a href="{{ route('customer.invoice.index') }}" class="card-action">Lihat semua →</a></div>
      <div class="card-body">
        @forelse($recentInvoices as $inv)
        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--gray-50)">
          <div><div class="fw-600">{{ $inv->no_invoice }}</div><div style="font-size:11px;color:var(--gray-400)">{{ $inv->created_at->format('d M Y') }}</div></div>
          <div style="text-align:right"><div class="fw-700">Rp {{ number_format($inv->total,0,',','.') }}</div><a href="{{ route('customer.invoice.show',$inv) }}" class="btn btn-secondary btn-sm" style="margin-top:4px">Lihat</a></div>
        </div>
        @empty
        <p style="color:var(--gray-400);font-size:13px;text-align:center;padding:16px 0">Belum ada invoice</p>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection
