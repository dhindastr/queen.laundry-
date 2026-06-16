@extends('layouts.app')
@php $title='Kelola Customer'; $roleLabel='Admin Panel'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-admin') @endsection
@section('topbar-actions')
<button class="btn btn-primary btn-sm" data-modal-open="modal-customer">
  <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Tambah Customer
</button>
@endsection
@section('content')
<div class="search-bar">
  <form method="GET" style="display:flex;gap:8px">
    <div class="search-wrap"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg><input type="text" name="search" class="search-input" placeholder="Cari nama..." value="{{ request('search') }}"></div>
    <button type="submit" class="btn btn-secondary btn-sm">Cari</button>
    @if(request('search'))<a href="{{ route('admin.customers.index') }}" class="btn btn-secondary btn-sm">Reset</a>@endif
  </form>
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Data Customer ({{ $customers->total() }})</span></div>
  <div class="table-wrap">
    <table>
      <thead><tr><th>Nama</th><th>Email</th><th>No. Telp</th><th>Alamat</th><th>Total Order</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($customers as $c)
        <tr>
          <td class="fw-600">{{ $c->nama }}</td>
          <td>{{ $c->email }}</td>
          <td>{{ $c->no_telp ?? '—' }}</td>
          <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $c->alamat ?? '—' }}</td>
          <td><span class="badge badge-blue">{{ $c->orders_count }} order</span></td>
          <td>
            <div style="display:flex;gap:6px">
              <a href="{{ route('admin.customers.show',$c) }}" class="btn btn-secondary btn-sm">Detail</a>
              <button class="btn btn-secondary btn-sm" data-modal-open="modal-edit-{{ $c->id }}">Edit</button>
              <form method="POST" action="{{ route('admin.customers.destroy',$c) }}" onsubmit="return confirm('Hapus customer ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;color:var(--gray-400);padding:32px">Belum ada customer</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($customers->hasPages())<div style="padding:14px 18px;border-top:1px solid var(--gray-100)">{{ $customers->withQueryString()->links() }}</div>@endif
</div>

@foreach($customers as $c)
<div class="modal-overlay" id="modal-edit-{{ $c->id }}">
  <div class="modal">
    <div class="modal-header"><span class="modal-title">Edit Customer</span><button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <form method="POST" action="{{ route('admin.customers.update',$c) }}">@csrf @method('PUT')
      <div class="modal-body">
        <div class="form-group"><label class="form-label">Nama</label><input type="text" name="nama" class="form-control" value="{{ $c->nama }}" required></div>
        <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ $c->email }}" required></div>
        <div class="form-grid-2">
          <div class="form-group"><label class="form-label">No. Telp</label><input type="text" name="no_telp" class="form-control" value="{{ $c->no_telp }}"></div>
          <div class="form-group"><label class="form-label">Password Baru</label><input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah"></div>
        </div>
        <div class="form-group"><label class="form-label">Alamat</label><input type="text" name="alamat" class="form-control" value="{{ $c->alamat }}"></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary modal-close">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
    </form>
  </div>
</div>
@endforeach

<div class="modal-overlay" id="modal-customer">
  <div class="modal">
    <div class="modal-header"><span class="modal-title">Tambah Customer</span><button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <form method="POST" action="{{ route('admin.customers.store') }}">@csrf
      <div class="modal-body">
        <div class="form-group"><label class="form-label">Nama</label><input type="text" name="nama" class="form-control" required></div>
        <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
        <div class="form-grid-2">
          <div class="form-group"><label class="form-label">No. Telp</label><input type="text" name="no_telp" class="form-control"></div>
          <div class="form-group"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
        </div>
        <div class="form-group"><label class="form-label">Alamat</label><input type="text" name="alamat" class="form-control"></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary modal-close">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
    </form>
  </div>
</div>
@endsection
