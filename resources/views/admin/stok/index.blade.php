@extends('layouts.app')
@php $title='Stok Barang'; $roleLabel='Admin Panel'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-admin') @endsection
@section('topbar-actions')<button class="btn btn-primary btn-sm" data-modal-open="modal-stok"><svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Tambah Barang</button>@endsection
@section('content')
<div class="stats-grid stats-3" style="margin-bottom:20px">
  <div class="stat-card"><div class="stat-icon ic-brand"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg></div><div class="stat-label">Total Jenis</div><div class="stat-value">{{ $items->count() }}</div></div>
  <div class="stat-card"><div class="stat-icon ic-red"><svg viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div><div class="stat-label">Stok Kritis</div><div class="stat-value">{{ $kritis }}</div><div class="stat-sub text-red">Perlu segera restock</div></div>
  <div class="stat-card"><div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div class="stat-label">Nilai Stok</div><div class="stat-value">Rp {{ number_format($items->sum(fn($i)=>$i->stok*$i->harga_satuan)/1000,0,',','.') }}k</div></div>
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Data Stok Barang</span></div>
  <div class="table-wrap"><table>
    <thead><tr><th>Nama Barang</th><th>Satuan</th><th>Stok Saat Ini</th><th>Stok Minimum</th><th>Harga Satuan</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach($items as $item)
      <tr>
        <td class="fw-600">{{ $item->nama }}</td>
        <td>{{ $item->satuan }}</td>
        <td class="fw-700" style="color:{{ $item->stok<=$item->stok_minimum?'var(--red)':($item->stok<=$item->stok_minimum*1.5?'var(--amber)':'var(--gray-800)') }}">{{ $item->stok }}</td>
        <td>{{ $item->stok_minimum }}</td>
        <td>Rp {{ number_format($item->harga_satuan,0,',','.') }}</td>
        <td><span class="badge badge-{{ $item->status_color }}"><span class="badge-dot" style="background:currentColor"></span>{{ $item->status }}</span></td>
        <td>
          <div style="display:flex;gap:6px">
            <button class="btn btn-secondary btn-sm" data-modal-open="modal-restock-{{ $item->id }}">Restock</button>
            <form method="POST" action="{{ route('admin.stok.destroy',$item) }}" onsubmit="return confirm('Hapus barang?')">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm">Hapus</button></form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table></div>
</div>

@foreach($items as $item)
<div class="modal-overlay" id="modal-restock-{{ $item->id }}">
  <div class="modal"><div class="modal-header"><span class="modal-title">Restock — {{ $item->nama }}</span><button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
  <form method="POST" action="{{ route('admin.stok.update',$item) }}">@csrf @method('PUT')
    <div class="modal-body">
      <div style="background:var(--gray-50);border-radius:8px;padding:12px;margin-bottom:14px;display:flex;justify-content:space-between">
        <div><div style="font-size:11px;color:var(--gray-400)">Stok Saat Ini</div><div style="font-size:20px;font-weight:700">{{ $item->stok }} {{ $item->satuan }}</div></div>
        <div><div style="font-size:11px;color:var(--gray-400)">Minimum</div><div style="font-size:20px;font-weight:700;color:var(--amber)">{{ $item->stok_minimum }}</div></div>
      </div>
      <div class="form-group"><label class="form-label">Jumlah Tambah ({{ $item->satuan }})</label><input type="number" name="tambah_stok" class="form-control" min="0.1" step="0.1" placeholder="cth: 10" required></div>
    </div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary modal-close">Batal</button><button type="submit" class="btn btn-primary">Simpan Restock</button></div>
  </form></div>
</div>
@endforeach

<div class="modal-overlay" id="modal-stok">
  <div class="modal"><div class="modal-header"><span class="modal-title">Tambah Barang Baru</span><button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
  <form method="POST" action="{{ route('admin.stok.store') }}">@csrf
    <div class="modal-body">
      <div class="form-group"><label class="form-label">Nama Barang</label><input type="text" name="nama" class="form-control" required></div>
      <div class="form-grid-3">
        <div class="form-group"><label class="form-label">Satuan</label><select name="satuan" class="form-control"><option>Liter</option><option>pcs</option><option>kg</option><option>lembar</option><option>botol</option></select></div>
        <div class="form-group"><label class="form-label">Stok Awal</label><input type="number" name="stok" class="form-control" value="0" step="0.1" min="0" required></div>
        <div class="form-group"><label class="form-label">Stok Minimum</label><input type="number" name="stok_minimum" class="form-control" value="5" step="0.1" min="0" required></div>
      </div>
      <div class="form-group"><label class="form-label">Harga Satuan (Rp)</label><input type="number" name="harga_satuan" class="form-control" value="0" min="0" required></div>
    </div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary modal-close">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
  </form></div>
</div>
@endsection
