@extends('layouts.app')
@php $title=$customer->nama; $roleLabel='Admin Panel'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-admin') @endsection
@section('topbar-actions')<a href="{{ route('admin.customers.index') }}" class="btn btn-secondary btn-sm"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg> Kembali</a>@endsection
@section('content')
@php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; @endphp
<div class="grid-2">
  <div class="card"><div class="card-header"><span class="card-title">Profil Customer</span></div><div class="card-body">
    @foreach([['Nama',$customer->nama],['Email',$customer->email],['No. Telp',$customer->no_telp??'—'],['Alamat',$customer->alamat??'—'],['Terdaftar',$customer->created_at->format('d M Y')]] as [$l,$v])
    <div style="display:flex;gap:12px;padding:8px 0;border-bottom:1px solid var(--gray-50)"><div style="width:100px;font-size:12px;color:var(--gray-400);font-weight:600">{{ $l }}</div><div style="font-size:13px;font-weight:500;color:var(--gray-800)">{{ $v }}</div></div>
    @endforeach
  </div></div>
  <div class="card"><div class="card-header"><span class="card-title">Riwayat Order</span></div><div class="table-wrap"><table>
    <thead><tr><th>ID</th><th>Jenis</th><th>Berat</th><th>Total</th><th>Status</th></tr></thead>
    <tbody>
      @forelse($customer->orders as $o)
      <tr>
        <td><a href="{{ route('admin.orders.show',$o) }}" class="fw-700 text-brand">#{{ str_pad($o->id,3,'0',STR_PAD_LEFT) }}</a></td>
        <td>{{ $o->jenis_laundry }}</td>
        <td>{{ $o->total_berat > 0 ? $o->total_berat.' kg' : '—' }}</td>
        <td class="text-green fw-600">{{ $o->total_harga > 0 ? 'Rp '.number_format($o->total_harga,0,',','.') : '—' }}</td>
        <td><span class="badge badge-{{ $colors[$o->status]??'gray' }}">{{ $o->status_label }}</span></td>
      </tr>
      @empty
      <tr><td colspan="5" style="text-align:center;color:var(--gray-400);padding:24px">Belum ada order</td></tr>
      @endforelse
    </tbody>
  </table></div></div>
</div>
@endsection
