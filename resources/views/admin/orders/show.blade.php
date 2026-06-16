@extends('layouts.app')
@php $title='Detail Order #'.str_pad($order->id,3,'0',STR_PAD_LEFT); $roleLabel='Admin Panel'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-admin') @endsection
@section('topbar-actions')
<a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">
  <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg> Kembali
</a>
@endsection
@section('content')
@php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; @endphp
<div class="grid-2">
  <div>
    <!-- Order Info -->
    <div class="card">
      <div class="card-header">
        <span class="card-title">Informasi Order</span>
        <span class="badge badge-{{ $colors[$order->status]??'gray' }}"><span class="badge-dot" style="background:currentColor"></span>{{ $order->status_label }}</span>
      </div>
      <div class="card-body">
        <div class="form-grid-2" style="gap:10px;margin-bottom:0">
          @foreach([['ID Order','#'.str_pad($order->id,3,'0',STR_PAD_LEFT)],['Customer',$order->customer->nama],['Jenis Laundry',$order->jenis_laundry],['Tanggal',$order->tanggal_order->format('d M Y, H:i')],['Berat',$order->total_berat > 0 ? $order->total_berat.' kg' : '—'],['Total Harga',$order->total_harga > 0 ? 'Rp '.number_format($order->total_harga,0,',','.') : '—'],['Harga/kg','Rp '.number_format($order->harga_per_kg,0,',','.')],['Kurir Pickup',$order->kurirPickup?->name ?? '—']] as [$lbl,$val])
          <div style="background:var(--gray-50);border-radius:8px;padding:10px 12px;margin-bottom:8px">
            <div style="font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--gray-400);margin-bottom:3px">{{ $lbl }}</div>
            <div style="font-size:14px;font-weight:600;color:var(--gray-900)">{{ $val }}</div>
          </div>
          @endforeach
        </div>
        @if($order->catatan)
        <div style="background:var(--amber-light);border-radius:8px;padding:10px 12px;margin-top:4px;font-size:13px;color:var(--amber)">
          <strong>Catatan:</strong> {{ $order->catatan }}
        </div>
        @endif
      </div>
    </div>

    <!-- Update Status -->
    <div class="card">
      <div class="card-header"><span class="card-title">Update Status & Assign</span></div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.orders.status',$order) }}">
          @csrf
          <div class="form-group">
            <label class="form-label">Status Baru</label>
            <select name="status" class="form-control">
              @foreach(\App\Models\Order::$statusLabels as $k=>$v)
              <option value="{{ $k }}" {{ $order->status===$k?'selected':'' }}>{{ $v }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label">Berat Aktual (kg)</label>
              <input type="number" name="total_berat" class="form-control" step="0.1" min="0" value="{{ $order->total_berat }}" placeholder="0.0">
            </div>
            <div class="form-group">
              <label class="form-label">Catatan</label>
              <input type="text" name="catatan" class="form-control" placeholder="Opsional...">
            </div>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg> Simpan Status
          </button>
        </form>
        <hr style="border:none;border-top:1px solid var(--gray-100);margin:16px 0">
        <form method="POST" action="{{ route('admin.orders.update',$order) }}">
          @csrf @method('PUT')
          <div class="form-group">
            <label class="form-label">Assign Kurir Pickup</label>
            <select name="kurir_pickup_id" class="form-control">
              <option value="">— Pilih Kurir —</option>
              @foreach($kurirList as $k)<option value="{{ $k->id }}" {{ $order->kurir_pickup_id===$k->id?'selected':'' }}>{{ $k->name }}</option>@endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Assign Kurir Delivery</label>
            <select name="kurir_delivery_id" class="form-control">
              <option value="">— Pilih Kurir —</option>
              @foreach($kurirList as $k)<option value="{{ $k->id }}" {{ $order->kurir_delivery_id===$k->id?'selected':'' }}>{{ $k->name }}</option>@endforeach
            </select>
          </div>
          <div class="form-grid-2">
            <div class="form-group"><label class="form-label">Jadwal Pickup</label><input type="datetime-local" name="jadwal_pickup" class="form-control" value="{{ $order->jadwal_pickup?->format('Y-m-d\TH:i') }}"></div>
            <div class="form-group"><label class="form-label">Jadwal Delivery</label><input type="datetime-local" name="jadwal_delivery" class="form-control" value="{{ $order->jadwal_delivery?->format('Y-m-d\TH:i') }}"></div>
          </div>
          <button type="submit" class="btn btn-secondary" style="width:100%;justify-content:center">Simpan Assign</button>
        </form>
      </div>
    </div>
  </div>

  <div>
    <!-- Timeline -->
    <div class="card">
      <div class="card-header"><span class="card-title">Riwayat Status</span></div>
      <div class="card-body">
        <div class="timeline">
          @forelse($order->statusLogs as $log)
          <div class="tl-item">
            <div class="tl-dot done"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
            <div>
              <div class="tl-title">{{ \App\Models\Order::$statusLabels[$log->status]??$log->status }}</div>
              <div class="tl-time">{{ $log->created_at->format('d M Y, H:i') }}{{ $log->catatan ? ' — '.$log->catatan : '' }}</div>
            </div>
          </div>
          @empty
          <p style="color:var(--gray-400);font-size:13px">Belum ada log status</p>
          @endforelse
        </div>
      </div>
    </div>

    <!-- Invoice -->
    @if($order->invoice)
    <div class="card">
      <div class="card-header"><span class="card-title">Invoice</span></div>
      <div class="card-body">
        <div style="display:flex;justify-content:space-between;align-items:center">
          <div>
            <div class="fw-700">{{ $order->invoice->no_invoice }}</div>
            <div style="font-size:12px;color:var(--gray-400)">{{ $order->invoice->created_at->format('d M Y') }}</div>
          </div>
          <div style="text-align:right">
            <div style="font-size:18px;font-weight:700;color:var(--gray-900)">Rp {{ number_format($order->invoice->total,0,',','.') }}</div>
            <span class="badge badge-green">Lunas</span>
          </div>
        </div>
        <div style="display:flex;gap:8px;margin-top:12px">
          <a href="{{ route('admin.invoice.show',$order->invoice) }}" class="btn btn-secondary btn-sm">Lihat Invoice</a>
          <a href="{{ route('admin.invoice.pdf',$order->invoice) }}" class="btn btn-secondary btn-sm" target="_blank">Cetak PDF</a>
        </div>
      </div>
    </div>
    @elseif($order->status==='selesai')
    <div class="card">
      <div class="card-header"><span class="card-title">Generate Invoice</span></div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.invoice.generate') }}">
          @csrf
          <input type="hidden" name="order_id" value="{{ $order->id }}">
          <p style="font-size:13px;color:var(--gray-500);margin-bottom:14px">Order sudah selesai. Generate invoice untuk customer.</p>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
            <svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            Generate Invoice
          </button>
        </form>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection
