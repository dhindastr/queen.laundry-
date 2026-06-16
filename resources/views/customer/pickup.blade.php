@extends('layouts.app')
@php $title='Request Pickup'; $roleLabel='Customer Portal'; $sidebarColor='var(--teal)'; $userName=auth('customer')->user()->nama; @endphp
@section('sidebar-nav') @include('components.nav-customer') @endsection
@section('content')
<div style="max-width:580px;margin:0 auto">
  <div class="card">
    <div class="card-header"><span class="card-title">Form Request Pickup Laundry</span></div>
    <div class="card-body">
      <form method="POST" action="{{ route('customer.pickup.store') }}">
        @csrf
        <div class="form-grid-2">
          <div class="form-group"><label class="form-label">Jenis Laundry</label><select name="jenis_laundry" class="form-control"><option>Pakaian biasa</option><option>Pakaian kerja</option><option>Linen/Sprei</option><option>Karpet/Gordyn</option></select></div>
          <div class="form-group"><label class="form-label">Jadwal Pickup</label><input type="datetime-local" name="jadwal_pickup" class="form-control" required></div>
        </div>
        <div class="form-group"><label class="form-label">Alamat Pickup</label><input type="text" class="form-control" value="{{ auth('customer')->user()->alamat }}" readonly style="background:var(--gray-50)"></div>
        <div class="form-group"><label class="form-label">Catatan / Instruksi Khusus</label><textarea name="catatan" class="form-control" rows="3" placeholder="Misal: Jangan pakai pewangi, pisahkan warna..."></textarea></div>
        <div class="alert alert-warning" style="margin-bottom:14px"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> Estimasi harga: <strong>Rp 25.000–30.000/kg</strong>. Total dihitung setelah berat ditimbang.</div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center"><svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Kirim Request Pickup</button>
      </form>
    </div>
  </div>
</div>
@endsection
