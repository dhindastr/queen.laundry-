@extends('layouts.app')
@php $title='Pengeluaran'; $roleLabel='Owner'; $sidebarColor='var(--amber)'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-owner') @endsection
@section('topbar-actions')
<form method="GET" style="display:flex;gap:8px;align-items:center">
  <select name="bulan" class="form-control" style="width:160px" onchange="this.form.submit()">
    @foreach($bulanList as $b)<option value="{{ $b }}" {{ $month===$b?'selected':'' }}>{{ \Carbon\Carbon::createFromFormat('Y-m',$b)->format('M Y') }}</option>@endforeach
  </select>
</form>
<button class="btn btn-primary btn-sm" data-modal-open="modal-catat"><svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Catat Pengeluaran</button>
@endsection
@section('content')
<div class="stats-grid stats-3">
  <div class="stat-card"><div class="stat-icon ic-red"><svg viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/></svg></div><div class="stat-label">Total Pengeluaran</div><div class="stat-value" style="font-size:18px">Rp {{ number_format($total,0,',','.') }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-brand"><svg viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/></svg></div><div class="stat-label">Jumlah Transaksi</div><div class="stat-value">{{ $expenses->total() }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-amber"><svg viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div><div class="stat-label">Kategori</div><div class="stat-value">{{ $byKat->count() }}</div></div>
</div>
<div class="grid-2" style="margin-bottom:20px">
  <div class="card" style="margin-bottom:0">
    <div class="card-header"><span class="card-title">Komposisi Pengeluaran</span></div>
    <div class="card-body">
      @php $maxP=$byKat->max('total')+0.01; @endphp
      @foreach($byKat as $kat)
      <div class="bar-chart-row">
        <div class="bar-label" style="width:90px;font-size:10px">{{ $kat->kategori }}</div>
        <div class="progress-track"><div class="progress-fill" style="width:{{ ($kat->total/$maxP*100) }}%;background:var(--red)"></div></div>
        <div class="bar-val">Rp {{ number_format($kat->total/1000,0,',','.')}}k</div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Rincian Pengeluaran</span></div>
  <div class="table-wrap"><table>
    <thead><tr><th>Tanggal</th><th>Kategori</th><th>Keterangan</th><th>Jumlah</th></tr></thead>
    <tbody>
      @forelse($expenses as $e)
      <tr>
        <td>{{ $e->tanggal->format('d M Y') }}</td>
        <td><span class="badge badge-gray">{{ $e->kategori }}</span></td>
        <td>{{ $e->keterangan }}</td>
        <td class="fw-600 text-red">Rp {{ number_format($e->jumlah,0,',','.') }}</td>
      </tr>
      @empty
      <tr><td colspan="4" style="text-align:center;color:var(--gray-400);padding:32px">Tidak ada data</td></tr>
      @endforelse
    </tbody>
  </table></div>
</div>
<div class="modal-overlay" id="modal-catat">
  <div class="modal">
    <div class="modal-header"><span class="modal-title">Catat Pengeluaran</span><button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <form method="POST" action="{{ route('owner.pengeluaran.store') }}">@csrf
      <div class="modal-body">
        <div class="form-grid-2">
          <div class="form-group"><label class="form-label">Kategori</label><select name="kategori" class="form-control"><option>Bahan Baku</option><option>Gaji Kurir</option><option>Listrik/Air</option><option>Operasional</option><option>Perawatan Mesin</option><option>Lain-lain</option></select></div>
          <div class="form-group"><label class="form-label">Tanggal</label><input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required></div>
        </div>
        <div class="form-group"><label class="form-label">Keterangan</label><input type="text" name="keterangan" class="form-control" placeholder="Detail pengeluaran..." required></div>
        <div class="form-group"><label class="form-label">Jumlah (Rp)</label><input type="number" name="jumlah" class="form-control" min="0" required></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary modal-close">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
    </form>
  </div>
</div>
@endsection
