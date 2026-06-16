@extends('layouts.app')
@php $title='Monitoring Order'; $roleLabel='Owner'; $sidebarColor='var(--amber)'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-owner') @endsection
@section('content')
@php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; @endphp
<div class="filter-tabs">
  @foreach([''=>'Semua','menunggu_pickup'=>'Menunggu','pickup'=>'Pickup','proses'=>'Proses','siap_delivery'=>'Siap Delivery','delivery'=>'Delivery','selesai'=>'Selesai'] as $k=>$v)
  @php $cnt=$k===''?array_sum(array_map(fn($s)=>$s->total??0,$summary->all())):($summary[$k]->total??0); @endphp
  <form method="GET" style="display:inline"><input type="hidden" name="status" value="{{ $k }}"><button type="submit" class="filter-tab {{ request('status')===$k?'active':'' }}">{{ $v }} ({{ $cnt }})</button></form>
  @endforeach
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Semua Order ({{ $orders->total() }})</span></div>
  <div class="table-wrap"><table>
    <thead><tr><th>ID</th><th>Customer</th><th>Jenis</th><th>Kurir Pickup</th><th>Kurir Delivery</th><th>Berat</th><th>Total</th><th>Tanggal</th><th>Status</th></tr></thead>
    <tbody>
      @forelse($orders as $o)
      <tr>
        <td class="fw-700 text-brand">#{{ str_pad($o->id,3,'0',STR_PAD_LEFT) }}</td>
        <td>{{ $o->customer->nama }}</td>
        <td>{{ $o->jenis_laundry }}</td>
        <td>{{ $o->kurirPickup?->name ?? '—' }}</td>
        <td>{{ $o->kurirDelivery?->name ?? '—' }}</td>
        <td>{{ $o->total_berat > 0 ? $o->total_berat.' kg' : '—' }}</td>
        <td class="fw-600 text-green">{{ $o->total_harga > 0 ? 'Rp '.number_format($o->total_harga,0,',','.') : '—' }}</td>
        <td>{{ $o->tanggal_order->format('d M Y') }}</td>
        <td><span class="badge badge-{{ $colors[$o->status]??'gray' }}"><span class="badge-dot" style="background:currentColor"></span>{{ $o->status_label }}</span></td>
      </tr>
      @empty
      <tr><td colspan="9" style="text-align:center;color:var(--gray-400);padding:32px">Tidak ada data</td></tr>
      @endforelse
    </tbody>
  </table></div>
  @if($orders->hasPages())<div style="padding:14px 18px;border-top:1px solid var(--gray-100)">{{ $orders->withQueryString()->links() }}</div>@endif
</div>
@endsection
