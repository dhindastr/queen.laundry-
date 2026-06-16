@extends('layouts.app')
@php $title='Laporan Operasional'; $roleLabel='Admin Panel'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-admin') @endsection
@section('topbar-actions')
<form method="GET" style="display:flex;gap:8px;align-items:center">
  <label style="font-size:12px;color:var(--gray-500);font-weight:600">Periode:</label>
  <select name="bulan" class="form-control" style="width:160px" onchange="this.form.submit()">
    @foreach($bulanList as $b)<option value="{{ $b }}" {{ $month===$b?'selected':'' }}>{{ \Carbon\Carbon::createFromFormat('Y-m',$b)->format('M Y') }}</option>@endforeach
  </select>
</form>
@endsection
@section('content')
<div class="stats-grid stats-4">
  <div class="stat-card"><div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg></div><div class="stat-label">Total Pemasukan</div><div class="stat-value" style="font-size:18px">Rp {{ number_format($pemasukan/1000000,1,',','.') }}jt</div><div class="stat-sub text-green">Bulan ini</div></div>
  <div class="stat-card"><div class="stat-icon ic-red"><svg viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg></div><div class="stat-label">Total Pengeluaran</div><div class="stat-value" style="font-size:18px">Rp {{ number_format($pengeluaran/1000000,1,',','.') }}jt</div></div>
  <div class="stat-card"><div class="stat-icon ic-brand"><svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div class="stat-label">Laba Bersih</div><div class="stat-value" style="font-size:18px">Rp {{ number_format(($pemasukan-$pengeluaran)/1000000,1,',','.') }}jt</div></div>
  <div class="stat-card"><div class="stat-icon ic-blue"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><div class="stat-label">Total Order</div><div class="stat-value">{{ $totalOrder }}</div><div class="stat-sub">{{ $selesai }} selesai</div></div>
</div>
<div class="grid-2">
  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">Pemasukan per Minggu</span></div>
      <div class="card-body">
        @php $maxW=max(array_values($weekly)+[1]); @endphp
        @foreach($weekly as $label=>$val)
        <div class="bar-chart-row">
          <div class="bar-label">{{ $label }}</div>
          <div class="progress-track"><div class="progress-fill" style="width:{{ $maxW>0?($val/$maxW*100):0 }}%;background:var(--brand)"></div></div>
          <div class="bar-val">Rp {{ number_format($val/1000,0,',','.')  }}k</div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="card">
      <div class="card-header"><span class="card-title">Top Customer</span></div>
      <div class="table-wrap"><table>
        <thead><tr><th>Customer</th><th>Total Nilai</th></tr></thead>
        <tbody>
          @foreach($topCustomers as $c)
          <tr><td class="fw-600">{{ $c->nama }}</td><td class="text-green fw-600">Rp {{ number_format($c->total_val??0,0,',','.') }}</td></tr>
          @endforeach
        </tbody>
      </table></div>
    </div>
  </div>
  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">Rincian Pengeluaran</span></div>
      <div class="table-wrap"><table>
        <thead><tr><th>Kategori</th><th>Jumlah</th><th>%</th></tr></thead>
        <tbody>
          @php $totalExp=$byKat->sum('total')+0.01; @endphp
          @foreach($byKat as $e)
          <tr><td>{{ $e->kategori }}</td><td class="text-red fw-600">Rp {{ number_format($e->total,0,',','.') }}</td><td><span class="badge badge-gray">{{ round($e->total/$totalExp*100) }}%</span></td></tr>
          @endforeach
        </tbody>
      </table></div>
    </div>
    <div class="card">
      <div class="card-header"><span class="card-title">Kinerja Kurir</span></div>
      <div class="table-wrap"><table>
        <thead><tr><th>Kurir</th><th>Pickup</th><th>Delivery</th></tr></thead>
        <tbody>
          @foreach($kurirStats as $k)
          <tr><td class="fw-600">{{ $k->name }}</td><td><span class="badge badge-amber">{{ $k->pickup_count }}</span></td><td><span class="badge badge-brand">{{ $k->delivery_count }}</span></td></tr>
          @endforeach
        </tbody>
      </table></div>
    </div>
  </div>
</div>
@endsection
