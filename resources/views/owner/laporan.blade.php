@extends('layouts.app')
@php $title='Laporan Bisnis'; $roleLabel='Owner'; $sidebarColor='var(--amber)'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-owner') @endsection
@section('topbar-actions')
<form method="GET" style="display:flex;gap:8px;align-items:center">
  <select name="bulan" class="form-control" style="width:160px" onchange="this.form.submit()">
    @foreach($bulanList as $b)<option value="{{ $b }}" {{ $month===$b?'selected':'' }}>{{ \Carbon\Carbon::createFromFormat('Y-m',$b)->format('M Y') }}</option>@endforeach
  </select>
</form>
@endsection
@section('content')
<div class="stats-grid stats-4">
  <div class="stat-card"><div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg></div><div class="stat-label">Pemasukan</div><div class="stat-value" style="font-size:18px">Rp {{ number_format($pemasukan/1000000,2,',','.') }}jt</div></div>
  <div class="stat-card"><div class="stat-icon ic-red"><svg viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/></svg></div><div class="stat-label">Pengeluaran</div><div class="stat-value" style="font-size:18px">Rp {{ number_format($pengeluaran/1000000,2,',','.') }}jt</div></div>
  <div class="stat-card"><div class="stat-icon ic-brand"><svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div class="stat-label">Laba Bersih</div><div class="stat-value" style="font-size:18px;color:{{ $pemasukan>=$pengeluaran?'var(--green)':'var(--red)' }}">Rp {{ number_format(($pemasukan-$pengeluaran)/1000000,2,',','.') }}jt</div></div>
  <div class="stat-card"><div class="stat-icon ic-blue"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div><div class="stat-label">Total Order</div><div class="stat-value">{{ $totalOrder }}</div></div>
</div>
<div class="grid-2">
  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">Tren Pemasukan 6 Bulan</span></div>
      <div class="card-body">
        @php $maxM=max(array_values($monthly)+[1]); @endphp
        @foreach($monthly as $label=>$val)
        <div class="bar-chart-row">
          <div class="bar-label" style="width:70px;font-size:10px">{{ $label }}</div>
          <div class="progress-track"><div class="progress-fill" style="width:{{ $maxM>0?($val/$maxM*100):0 }}%;background:var(--brand)"></div></div>
          <div class="bar-val">Rp {{ number_format($val/1000,0,',','.')}}k</div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="card">
      <div class="card-header"><span class="card-title">Kinerja Kurir</span></div>
      <div class="table-wrap"><table>
        <thead><tr><th>Kurir</th><th>Pickup</th><th>Delivery</th></tr></thead>
        <tbody>
          @foreach($kurirStats as $k)
          <tr><td class="fw-600">{{ $k->name }}</td><td><span class="badge badge-amber">{{ $k->pickup }}</span></td><td><span class="badge badge-brand">{{ $k->delivery }}</span></td></tr>
          @endforeach
        </tbody>
      </table></div>
    </div>
  </div>
  <div class="card">
    <div class="card-header"><span class="card-title">Rincian Pengeluaran</span></div>
    <div class="card-body">
      @php $totP=$byKat->sum('total')+0.01; @endphp
      @foreach($byKat as $kat)
      <div class="bar-chart-row">
        <div class="bar-label" style="width:90px;font-size:10px">{{ $kat->kategori }}</div>
        <div class="progress-track"><div class="progress-fill" style="width:{{ ($kat->total/$totP*100) }}%;background:var(--red)"></div></div>
        <div class="bar-val">Rp {{ number_format($kat->total/1000,0,',','.')}}k</div>
      </div>
      @endforeach
      <div style="border-top:1px solid var(--gray-100);margin-top:14px;padding-top:12px;display:flex;justify-content:space-between">
        <span style="font-size:13px;font-weight:600;color:var(--gray-700)">Total Pengeluaran</span>
        <span style="font-size:15px;font-weight:700;color:var(--red)">Rp {{ number_format($pengeluaran,0,',','.') }}</span>
      </div>
    </div>
  </div>
</div>
@endsection
