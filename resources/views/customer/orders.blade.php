@extends('layouts.app')
@php $title='Order Saya'; $roleLabel='Customer Portal'; $sidebarColor='var(--teal)'; $userName=auth('customer')->user()->nama; @endphp
@section('sidebar-nav') @include('components.nav-customer') @endsection
@section('content')
@php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; @endphp
<div class="filter-tabs">
  @foreach([''=>'Semua','menunggu_pickup'=>'Menunggu Pickup','proses'=>'Diproses','selesai'=>'Selesai'] as $k=>$v)
  <form method="GET" style="display:inline"><input type="hidden" name="status" value="{{ $k }}"><button type="submit" class="filter-tab {{ request('status')===$k?'active':'' }}">{{ $v }}</button></form>
  @endforeach
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Riwayat Order ({{ $orders->total() }})</span><a href="{{ route('customer.pickup.create') }}" class="btn btn-primary btn-sm"><svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Baru</a></div>
  <div class="table-wrap"><table>
    <thead><tr><th>ID</th><th>Tanggal</th><th>Jenis</th><th>Berat</th><th>Total</th><th>Status</th><th></th></tr></thead>
    <tbody>
      @forelse($orders as $o)
      <tr>
        <td><span class="fw-700 text-brand">#{{ str_pad($o->id,3,'0',STR_PAD_LEFT) }}</span></td>
        <td>{{ $o->tanggal_order->format('d M Y') }}</td>
        <td>{{ $o->jenis_laundry }}</td>
        <td>{{ $o->total_berat > 0 ? $o->total_berat.' kg' : '—' }}</td>
        <td class="fw-600 text-green">{{ $o->total_harga > 0 ? 'Rp '.number_format($o->total_harga,0,',','.') : '—' }}</td>
        <td><span class="badge badge-{{ $colors[$o->status]??'gray' }}"><span class="badge-dot" style="background:currentColor"></span>{{ $o->status_label }}</span></td>
        <td><a href="{{ route('customer.orders.show',$o) }}" class="btn btn-secondary btn-sm">Detail</a></td>
      </tr>
      @empty
      <tr><td colspan="7" style="text-align:center;color:var(--gray-400);padding:32px">Belum ada order</td></tr>
      @endforelse
    </tbody>
  </table></div>
  @if($orders->hasPages())<div style="padding:14px 18px;border-top:1px solid var(--gray-100)">{{ $orders->withQueryString()->links() }}</div>@endif
</div>
@endsection
