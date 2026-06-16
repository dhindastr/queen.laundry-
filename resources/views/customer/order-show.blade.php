@extends('layouts.app')
@php $title='Detail Order'; $roleLabel='Customer Portal'; $sidebarColor='var(--teal)'; $userName=auth('customer')->user()->nama; @endphp
@section('sidebar-nav') @include('components.nav-customer') @endsection
@section('topbar-actions')<a href="{{ route('customer.orders.index') }}" class="btn btn-secondary btn-sm"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg> Kembali</a>@endsection
@section('content')
@php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; $statusOrder=array_keys(\App\Models\Order::$statusLabels); $curIdx=array_search($order->status,$statusOrder); @endphp
<div class="grid-2">
  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">Detail Order #{{ str_pad($order->id,3,'0',STR_PAD_LEFT) }}</span><span class="badge badge-{{ $colors[$order->status]??'gray' }}"><span class="badge-dot" style="background:currentColor"></span>{{ $order->status_label }}</span></div>
      <div class="card-body">
        @foreach([['Jenis Laundry',$order->jenis_laundry],['Tanggal Order',$order->tanggal_order->format('d M Y, H:i')],['Berat',$order->total_berat>0?$order->total_berat.' kg':'Belum ditimbang'],['Total Harga',$order->total_harga>0?'Rp '.number_format($order->total_harga,0,',','.'):'Dihitung setelah pickup'],['Kurir Pickup',$order->kurirPickup?->name??'Belum ditentukan'],['Catatan',$order->catatan??'—']] as [$l,$v])
        <div style="display:flex;gap:12px;padding:8px 0;border-bottom:1px solid var(--gray-50)"><div style="width:120px;font-size:12px;color:var(--gray-400);font-weight:600;flex-shrink:0">{{ $l }}</div><div style="font-size:13px;font-weight:500;color:var(--gray-800)">{{ $v }}</div></div>
        @endforeach
      </div>
    </div>
    @if($order->invoice)
    <div class="card">
      <div class="card-header"><span class="card-title">Invoice</span><span class="badge badge-green">Lunas</span></div>
      <div class="card-body" style="display:flex;justify-content:space-between;align-items:center">
        <div><div class="fw-700">{{ $order->invoice->no_invoice }}</div><div style="font-size:20px;font-weight:800;color:var(--brand)">Rp {{ number_format($order->invoice->total,0,',','.') }}</div></div>
        <div style="display:flex;gap:8px">
          <a href="{{ route('customer.invoice.show',$order->invoice) }}" class="btn btn-secondary btn-sm">Lihat</a>
          <a href="{{ route('customer.invoice.pdf',$order->invoice) }}" class="btn btn-primary btn-sm" target="_blank">Cetak</a>
        </div>
      </div>
    </div>
    @endif
  </div>
  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">Tracking Status</span></div>
      <div class="card-body">
        <div class="timeline">
          @foreach($order->statusLogs as $log)
          <div class="tl-item">
            <div class="tl-dot done"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
            <div><div class="tl-title">{{ \App\Models\Order::$statusLabels[$log->status]??$log->status }}</div><div class="tl-time">{{ $log->created_at->format('d M Y, H:i') }}{{ $log->catatan?' — '.$log->catatan:'' }}</div></div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
