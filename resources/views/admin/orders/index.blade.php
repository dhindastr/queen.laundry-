@extends('layouts.app')
@php $title='Kelola Order'; $roleLabel='Admin Panel'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-admin') @endsection
@section('topbar-actions')
<button class="btn btn-primary btn-sm" data-modal-open="modal-order">
  <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Tambah Order
</button>
@endsection
@section('content')
@php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; @endphp
<div class="search-bar">
  <form method="GET" style="display:flex;gap:8px;width:100%">
    <div class="search-wrap">
      <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" name="search" class="search-input" placeholder="Cari customer..." value="{{ request('search') }}">
    </div>
    <select name="status" class="form-control" style="width:180px" onchange="this.form.submit()">
      <option value="">Semua Status</option>
      @foreach(\App\Models\Order::$statusLabels as $k=>$v)
      <option value="{{ $k }}" {{ request('status')===$k?'selected':'' }}>{{ $v }}</option>
      @endforeach
    </select>
    <button type="submit" class="btn btn-secondary btn-sm">Cari</button>
    @if(request('search')||request('status'))<a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Reset</a>@endif
  </form>
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Daftar Order ({{ $orders->total() }})</span></div>
  <div class="table-wrap">
    <table>
      <thead><tr><th>ID</th><th>Customer</th><th>Jenis</th><th>Berat</th><th>Total</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($orders as $o)
        <tr>
          <td><span class="fw-700 text-brand">#{{ str_pad($o->id,3,'0',STR_PAD_LEFT) }}</span></td>
          <td class="fw-600">{{ $o->customer->nama }}</td>
          <td>{{ $o->jenis_laundry }}</td>
          <td>{{ $o->total_berat > 0 ? $o->total_berat.' kg' : '—' }}</td>
          <td class="fw-600 text-green">{{ $o->total_harga > 0 ? 'Rp '.number_format($o->total_harga,0,',','.') : '—' }}</td>
          <td>{{ $o->tanggal_order->format('d M Y') }}</td>
          <td><span class="badge badge-{{ $colors[$o->status]??'gray' }}"><span class="badge-dot" style="background:currentColor"></span>{{ $o->status_label }}</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <a href="{{ route('admin.orders.show',$o) }}" class="btn btn-secondary btn-sm">Detail</a>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;color:var(--gray-400);padding:32px">Belum ada order</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($orders->hasPages())
  <div style="padding:14px 18px;border-top:1px solid var(--gray-100)">{{ $orders->withQueryString()->links() }}</div>
  @endif
</div>

<!-- Modal Tambah Order -->
<div class="modal-overlay" id="modal-order">
  <div class="modal">
    <div class="modal-header"><span class="modal-title">Tambah Order Baru</span><button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <form method="POST" action="{{ route('admin.orders.store') }}">
      @csrf
      <div class="modal-body">
        <div class="form-group"><label class="form-label">Customer</label><select name="customer_id" class="form-control" required><option value="">— Pilih Customer —</option>@foreach($customers as $c)<option value="{{ $c->id }}">{{ $c->nama }}</option>@endforeach</select></div>
        <div class="form-grid-2">
          <div class="form-group"><label class="form-label">Jenis Laundry</label><select name="jenis_laundry" class="form-control"><option>Pakaian biasa</option><option>Pakaian kerja</option><option>Linen/Sprei</option><option>Karpet/Gordyn</option></select></div>
          <div class="form-group"><label class="form-label">Harga/kg (Rp)</label><input type="number" name="harga_per_kg" class="form-control" value="25000" required></div>
        </div>
        <div class="form-group"><label class="form-label">Catatan</label><input type="text" name="catatan" class="form-control" placeholder="Instruksi khusus..."></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary modal-close">Batal</button><button type="submit" class="btn btn-primary"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg> Simpan</button></div>
    </form>
  </div>
</div>
@endsection
