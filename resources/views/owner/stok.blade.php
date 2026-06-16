@extends('layouts.app')
@php $title='Pantau Stok'; $roleLabel='Owner'; $sidebarColor='var(--amber)'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-owner') @endsection
@section('content')
<div class="stats-grid stats-3">
  <div class="stat-card"><div class="stat-icon ic-brand"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg></div><div class="stat-label">Total Jenis</div><div class="stat-value">{{ $items->count() }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-red"><svg viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg></div><div class="stat-label">Stok Kritis</div><div class="stat-value">{{ $kritis }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div class="stat-label">Nilai Stok</div><div class="stat-value" style="font-size:18px">Rp {{ number_format($items->sum(fn($i)=>$i->stok*$i->harga_satuan)/1000,0,',','.') }}k</div></div>
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Status Stok Barang</span></div>
  <div class="table-wrap"><table>
    <thead><tr><th>Nama Barang</th><th>Satuan</th><th>Stok</th><th>Minimum</th><th>Nilai Stok</th><th>Status</th></tr></thead>
    <tbody>
      @foreach($items as $item)
      <tr>
        <td class="fw-600">{{ $item->nama }}</td>
        <td>{{ $item->satuan }}</td>
        <td class="fw-700" style="color:{{ $item->stok<=$item->stok_minimum?'var(--red)':($item->stok<=$item->stok_minimum*1.5?'var(--amber)':'var(--gray-800)') }}">{{ $item->stok }}</td>
        <td>{{ $item->stok_minimum }}</td>
        <td>Rp {{ number_format($item->stok*$item->harga_satuan,0,',','.') }}</td>
        <td><span class="badge badge-{{ $item->status_color }}"><span class="badge-dot" style="background:currentColor"></span>{{ $item->status }}</span></td>
      </tr>
      @endforeach
    </tbody>
  </table></div>
</div>
@endsection
