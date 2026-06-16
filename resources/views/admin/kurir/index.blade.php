@extends('layouts.app')
@php $title='Kelola Kurir'; $roleLabel='Admin Panel'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-admin') @endsection
@section('topbar-actions')<button class="btn btn-primary btn-sm" data-modal-open="modal-kurir"><svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Tambah Kurir</button>@endsection
@section('content')
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:20px">
  @forelse($kurirList as $k)
  <div class="card" style="margin-bottom:0">
    <div class="card-body">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px">
        <div style="width:44px;height:44px;border-radius:50%;background:var(--green-light);display:flex;align-items:center;justify-content:center">
          <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:var(--green);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round"><circle cx="12" cy="8" r="4"/><path d="M6 20v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>
        </div>
        <span class="badge badge-green"><span class="badge-dot" style="background:currentColor"></span>Aktif</span>
      </div>
      <div style="font-size:15px;font-weight:700;color:var(--gray-900);margin-bottom:3px">{{ $k->name }}</div>
      <div style="font-size:12px;color:var(--gray-400);margin-bottom:12px">{{ $k->no_telp ?? '—' }} · {{ $k->kendaraan ?? 'Motor' }}</div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:12px">
        <div style="background:var(--gray-50);border-radius:8px;padding:8px;text-align:center"><div style="font-size:18px;font-weight:700;color:var(--brand)">{{ $k->orders_as_pickup_count }}</div><div style="font-size:10px;color:var(--gray-400)">Pickup</div></div>
        <div style="background:var(--gray-50);border-radius:8px;padding:8px;text-align:center"><div style="font-size:18px;font-weight:700;color:var(--green)">{{ $k->orders_as_delivery_count }}</div><div style="font-size:10px;color:var(--gray-400)">Delivery</div></div>
      </div>
      <div style="display:flex;gap:6px">
        <button class="btn btn-secondary btn-sm" style="flex:1" data-modal-open="modal-edit-kurir-{{ $k->id }}">Edit</button>
        <form method="POST" action="{{ route('admin.kurir.destroy',$k) }}" onsubmit="return confirm('Hapus kurir?')" style="flex:1">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm" style="width:100%">Hapus</button></form>
      </div>
    </div>
  </div>
  <div class="modal-overlay" id="modal-edit-kurir-{{ $k->id }}">
    <div class="modal"><div class="modal-header"><span class="modal-title">Edit Kurir</span><button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <form method="POST" action="{{ route('admin.kurir.update',$k) }}">@csrf @method('PUT')
      <div class="modal-body">
        <div class="form-group"><label class="form-label">Nama</label><input type="text" name="name" class="form-control" value="{{ $k->name }}" required></div>
        <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ $k->email }}" required></div>
        <div class="form-grid-2">
          <div class="form-group"><label class="form-label">No. Telp</label><input type="text" name="no_telp" class="form-control" value="{{ $k->no_telp }}"></div>
          <div class="form-group"><label class="form-label">Kendaraan</label><select name="kendaraan" class="form-control"><option {{ $k->kendaraan==='Motor'?'selected':'' }}>Motor</option><option {{ $k->kendaraan==='Mobil'?'selected':'' }}>Mobil</option></select></div>
        </div>
        <div class="form-group"><label class="form-label">Password Baru</label><input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah"></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary modal-close">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
    </form></div>
  </div>
  @empty
  <div style="grid-column:span 3;text-align:center;color:var(--gray-400);padding:32px">Belum ada kurir terdaftar</div>
  @endforelse
</div>
<div class="modal-overlay" id="modal-kurir">
  <div class="modal"><div class="modal-header"><span class="modal-title">Tambah Kurir</span><button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
  <form method="POST" action="{{ route('admin.kurir.store') }}">@csrf
    <div class="modal-body">
      <div class="form-group"><label class="form-label">Nama Lengkap</label><input type="text" name="name" class="form-control" required></div>
      <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
      <div class="form-grid-2">
        <div class="form-group"><label class="form-label">No. Telp</label><input type="text" name="no_telp" class="form-control"></div>
        <div class="form-group"><label class="form-label">Kendaraan</label><select name="kendaraan" class="form-control"><option>Motor</option><option>Mobil</option></select></div>
      </div>
      <div class="form-group"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
    </div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary modal-close">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
  </form></div>
</div>
@endsection
