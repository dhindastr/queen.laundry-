@extends('layouts.app')
@php $title='Dashboard Admin'; $roleLabel='Admin Panel'; $sidebarColor='var(--brand)'; $userName=auth()->user()->name; @endphp

@section('sidebar-nav')
  @include('components.nav-admin')
@endsection

@section('topbar-actions')
<button class="btn btn-primary btn-sm" data-modal-open="modal-tambah-order">
  <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
  Tambah Order
</button>
@endsection

@section('content')
<!-- Stats -->
<div class="stats-grid stats-4">
  <div class="stat-card">
    <div class="stat-icon ic-brand"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
    <div class="stat-label">Order Hari Ini</div>
    <div class="stat-value">{{ $stats['order_hari_ini'] }}</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon ic-amber"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
    <div class="stat-label">Menunggu Pickup</div>
    <div class="stat-value">{{ $stats['menunggu_pickup'] }}</div>
    <div class="stat-sub text-amber">Perlu assign kurir</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon ic-blue"><svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10"/><path d="M12 6v6l4 2"/></svg></div>
    <div class="stat-label">Sedang Diproses</div>
    <div class="stat-value">{{ $stats['sedang_proses'] }}</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="stat-label">Selesai Bulan Ini</div>
    <div class="stat-value">{{ $stats['selesai_bulan'] }}</div>
    <div class="stat-sub text-green">Rp {{ number_format($stats['pemasukan_bulan'],0,',','.') }}</div>
  </div>
</div>

<div class="grid-2">
  <div>
    <!-- Recent Orders -->
    <div class="card">
      <div class="card-header">
        <span class="card-title">Order Terbaru</span>
        <a href="{{ route('admin.orders.index') }}" class="card-action">Lihat semua →</a>
      </div>
      <div class="table-wrap">
        <table>
          <thead><tr><th>ID</th><th>Customer</th><th>Berat</th><th>Status</th><th></th></tr></thead>
          <tbody>
            @forelse($recentOrders as $order)
            <tr>
              <td><span class="fw-700 text-brand">#{{ str_pad($order->id,3,'0',STR_PAD_LEFT) }}</span></td>
              <td>{{ $order->customer->nama }}</td>
              <td>{{ $order->total_berat > 0 ? $order->total_berat.' kg' : '—' }}</td>
              <td>
                @php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; @endphp
                <span class="badge badge-{{ $colors[$order->status]??'gray' }}">
                  <span class="badge-dot" style="background:currentColor"></span>
                  {{ $order->status_label }}
                </span>
              </td>
              <td>
                <a href="{{ route('admin.orders.show',$order) }}" class="btn btn-secondary btn-sm">Detail</a>
              </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:var(--gray-400);padding:24px">Belum ada order</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Status Summary -->
    <div class="card">
      <div class="card-header"><span class="card-title">Status Order Hari Ini</span></div>
      <div class="card-body">
        @php
        $allStatuses=['menunggu_pickup'=>['Menunggu Pickup','amber'],'pickup'=>['Pickup','blue'],'proses'=>['Diproses','brand'],'siap_delivery'=>['Siap Delivery','teal'],'delivery'=>['Delivery','blue'],'selesai'=>['Selesai','green']];
        $total=max($statusSummary->sum("total"),1);
        @endphp
        @foreach($allStatuses as $key=>[$label,$color])
        @php $cnt=$statusSummary[$key]->total??0; @endphp
        <div class="stok-row">
          <div style="width:10px;height:10px;border-radius:50%;background:var(--{{ $color }});flex-shrink:0"></div>
          <div class="stok-name">{{ $label }}</div>
          <div class="progress-track"><div class="progress-fill" style="width:{{ $total>0?($cnt/$total*100):0 }}%;background:var(--{{ $color }})"></div></div>
          <div style="width:24px;text-align:right;font-weight:700;font-size:13px">{{ $cnt }}</div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <div>
    <!-- Assign Kurir Form -->
    <div class="card">
      <div class="card-header"><span class="card-title">Quick Assign Kurir</span></div>
      <div class="card-body">
        @php $pendingOrders=\App\Models\Order::where('status','menunggu_pickup')->doesntHave('kurirPickup')->with('customer')->latest()->take(10)->get(); @endphp
        @if($pendingOrders->isEmpty())
          <p style="color:var(--gray-400);font-size:13px;text-align:center;padding:16px 0">Tidak ada order menunggu pickup</p>
        @else
        <form method="POST" action="" id="form-assign">
          @csrf @method('PUT')
          <div class="form-group">
            <label class="form-label">Order</label>
            <select class="form-control" name="order_id" id="sel-order">
              <option value="">— Pilih Order —</option>
              @foreach($pendingOrders as $o)
              <option value="{{ $o->id }}">#{{ str_pad($o->id,3,'0',STR_PAD_LEFT) }} — {{ $o->customer->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Kurir</label>
            <select class="form-control" name="kurir_pickup_id">
              <option value="">— Pilih Kurir —</option>
              @foreach($kurirList as $k)
              <option value="{{ $k->id }}">{{ $k->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Jadwal Pickup</label>
            <input type="datetime-local" name="jadwal_pickup" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center" onclick="submitAssign(event)">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Konfirmasi Assign
          </button>
        </form>
        <script>
        function submitAssign(e){
          e.preventDefault();
          const sel=document.getElementById('sel-order');
          const id=sel.value; if(!id)return;
          const f=document.getElementById('form-assign');
          f.action='/admin/orders/'+id;
          f.submit();
        }
        </script>
        @endif
      </div>
    </div>

    <!-- Stok Kritis -->
    <div class="card">
      <div class="card-header">
        <span class="card-title">Stok Kritis</span>
        @if($stokKritis->isNotEmpty())<span class="badge badge-red">{{ $stokKritis->count() }} item</span>@endif
        <a href="{{ route('admin.stok.index') }}" class="card-action">Kelola →</a>
      </div>
      <div class="card-body">
        @forelse($stokKritis as $item)
        <div class="stok-row">
          <div class="stok-name">{{ $item->nama }}</div>
          <div class="progress-track"><div class="progress-fill" style="width:{{ min(($item->stok/$item->stok_minimum)*100,100) }}%;background:var(--red)"></div></div>
          <span class="badge badge-red">{{ $item->stok }} {{ $item->satuan }}</span>
        </div>
        @empty
        <p style="color:var(--gray-400);font-size:13px;text-align:center;padding:12px 0">
          <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:currentColor;display:block;margin:0 auto 4px"><polyline points="20 6 9 17 4 12"/></svg>
          Semua stok aman
        </p>
        @endforelse
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Order -->
<div class="modal-overlay" id="modal-tambah-order">
  <div class="modal">
    <div class="modal-header">
      <span class="modal-title">Tambah Order Baru</span>
      <button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <form method="POST" action="{{ route('admin.orders.store') }}">
      @csrf
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Customer</label>
          <select name="customer_id" class="form-control" required>
            <option value="">— Pilih Customer —</option>
            @foreach($customerList as $c)
            <option value="{{ $c->id }}">{{ $c->nama }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-grid-2">
          <div class="form-group">
            <label class="form-label">Jenis Laundry</label>
            <select name="jenis_laundry" class="form-control">
              <option>Pakaian biasa</option><option>Pakaian kerja</option><option>Linen/Sprei</option><option>Karpet/Gordyn</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Harga / kg (Rp)</label>
            <input type="number" name="harga_per_kg" class="form-control" value="25000" required>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Catatan</label>
          <input type="text" name="catatan" class="form-control" placeholder="Instruksi khusus...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary modal-close">Batal</button>
        <button type="submit" class="btn btn-primary">
          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg> Simpan Order
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
