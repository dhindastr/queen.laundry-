@extends('layouts.app')
@php $title='Pemasukan'; $roleLabel='Owner'; $sidebarColor='var(--amber)'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-owner') @endsection
@section('topbar-actions')
<form method="GET" style="display:flex;gap:8px;align-items:center">
  <select name="bulan" class="form-control" style="width:160px" onchange="this.form.submit()">
    @foreach($bulanList as $b)<option value="{{ $b }}" {{ $month===$b?'selected':'' }}>{{ \Carbon\Carbon::createFromFormat('Y-m',$b)->format('M Y') }}</option>@endforeach
  </select>
</form>
@endsection
@section('content')
<div class="stats-grid stats-3">
  <div class="stat-card"><div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg></div><div class="stat-label">Total Pemasukan</div><div class="stat-value" style="font-size:18px">Rp {{ number_format($total,0,',','.') }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-blue"><svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div><div class="stat-label">Jumlah Invoice</div><div class="stat-value">{{ $invoices->total() }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-brand"><svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div class="stat-label">Rata-rata per Invoice</div><div class="stat-value" style="font-size:18px">Rp {{ $invoices->total()>0?number_format($total/$invoices->total(),0,',','.'):0 }}</div></div>
</div>
<div class="grid-2" style="margin-bottom:20px">
  <div class="card" style="margin-bottom:0">
    <div class="card-header"><span class="card-title">Tren Mingguan</span></div>
    <div class="card-body">
      @php $maxW=max(array_values($weekly)+[1]); @endphp
      @foreach($weekly as $label=>$val)
      <div class="bar-chart-row">
        <div class="bar-label">{{ $label }}</div>
        <div class="progress-track"><div class="progress-fill" style="width:{{ $maxW>0?($val/$maxW*100):0 }}%;background:var(--green)"></div></div>
        <div class="bar-val">Rp {{ number_format($val/1000,0,',','.')}}k</div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Detail Invoice Lunas</span></div>
  <div class="table-wrap"><table>
    <thead><tr><th>No. Invoice</th><th>Customer</th><th>Berat</th><th>Total</th><th>Tanggal Bayar</th></tr></thead>
    <tbody>
      @forelse($invoices as $inv)
      <tr>
        <td class="fw-700 text-brand">{{ $inv->no_invoice }}</td>
        <td>{{ $inv->order->customer->nama }}</td>
        <td>{{ $inv->order->total_berat }} kg</td>
        <td class="fw-600 text-green">Rp {{ number_format($inv->total,0,',','.') }}</td>
        <td>{{ $inv->tanggal_bayar?->format('d M Y') ?? $inv->created_at->format('d M Y') }}</td>
      </tr>
      @empty
      <tr><td colspan="5" style="text-align:center;color:var(--gray-400);padding:32px">Tidak ada data</td></tr>
      @endforelse
    </tbody>
  </table></div>
</div>
@endsection
