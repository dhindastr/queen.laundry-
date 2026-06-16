@extends('layouts.app')
@php $title='Dashboard Owner'; $roleLabel='Owner'; $sidebarColor='var(--amber)'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-owner') @endsection
@section('content')
@php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; @endphp
<div class="stats-grid stats-4">
  <div class="stat-card"><div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg></div><div class="stat-label">Pemasukan Bulan Ini</div><div class="stat-value" style="font-size:18px">Rp {{ number_format($pemasukan/1000000,2,',','.') }}jt</div></div>
  <div class="stat-card"><div class="stat-icon ic-red"><svg viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg></div><div class="stat-label">Pengeluaran Bulan Ini</div><div class="stat-value" style="font-size:18px">Rp {{ number_format($pengeluaran/1000000,2,',','.') }}jt</div></div>
  <div class="stat-card"><div class="stat-icon ic-brand"><svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div class="stat-label">Laba Bersih</div><div class="stat-value" style="font-size:18px">Rp {{ number_format(($pemasukan-$pengeluaran)/1000000,2,',','.') }}jt</div></div>
  <div class="stat-card"><div class="stat-icon ic-blue"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div><div class="stat-label">Total Order</div><div class="stat-value">{{ $totalOrder }}</div></div>
</div>
<div class="grid-2">
  <div class="card">
    <div class="card-header"><span class="card-title">Pemasukan per Minggu</span><a href="{{ route('owner.pemasukan.index') }}" class="card-action">Detail →</a></div>
    <div class="card-body">
      @php $maxW=max(array_values($weekly)+[1]); @endphp
      @foreach($weekly as $label=>$val)
      <div class="bar-chart-row">
        <div class="bar-label">{{ $label }}</div>
        <div class="progress-track"><div class="progress-fill" style="width:{{ $maxW>0?($val/$maxW*100):0 }}%;background:var(--brand)"></div></div>
        <div class="bar-val">Rp {{ number_format($val/1000,0,',','.')}}k</div>
      </div>
      @endforeach
    </div>
  </div>
  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">Status Order</span><a href="{{ route('owner.monitoring.index') }}" class="card-action">Monitor →</a></div>
      <div class="card-body">
        @foreach(['menunggu_pickup'=>['Menunggu','amber'],'proses'=>['Proses','brand'],'delivery'=>['Delivery','blue'],'selesai'=>['Selesai','green']] as $s=>[$l,$c])
        @php $cnt=$statusSummary[$s]->total??0; @endphp
        <div class="stok-row">
          <div style="width:10px;height:10px;border-radius:50%;background:var(--{{$c}});flex-shrink:0"></div>
          <div class="stok-name">{{ $l }}</div>
          <div class="progress-track"><div class="progress-fill" style="width:{{ ($totalOrder>0?$cnt/$totalOrder*100:0) }}%;background:var(--{{$c}})"></div></div>
          <div style="width:24px;text-align:right;font-weight:700;font-size:13px">{{ $cnt }}</div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="card">
      <div class="card-header"><span class="card-title">Stok Kritis</span><a href="{{ route('owner.stok.index') }}" class="card-action">Lihat →</a></div>
      <div class="card-body">
        @forelse($stokKritis as $item)
        <div class="stok-row">
          <div class="stok-name">{{ $item->nama }}</div>
          <div class="progress-track"><div class="progress-fill" style="width:{{ min(($item->stok/$item->stok_minimum)*100,100) }}%;background:var(--red)"></div></div>
          <span class="badge badge-red">{{ $item->stok }} {{ $item->satuan }}</span>
        </div>
        @empty
        <p style="color:var(--gray-400);font-size:13px;text-align:center;padding:12px 0">Semua stok aman</p>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection
