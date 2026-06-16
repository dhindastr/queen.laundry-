@extends('layouts.app')
@php $title='Invoice Saya'; $roleLabel='Customer Portal'; $sidebarColor='var(--teal)'; $userName=auth('customer')->user()->nama; @endphp
@section('sidebar-nav') @include('components.nav-customer') @endsection
@section('content')
<div class="card">
  <div class="card-header"><span class="card-title">Invoice Saya ({{ $invoices->total() }})</span></div>
  <div class="table-wrap"><table>
    <thead><tr><th>No. Invoice</th><th>Order</th><th>Total</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
      @forelse($invoices as $inv)
      <tr>
        <td class="fw-700 text-brand">{{ $inv->no_invoice }}</td>
        <td><a href="{{ route('customer.orders.show',$inv->order) }}" class="text-brand">#{{ str_pad($inv->order_id,3,'0',STR_PAD_LEFT) }}</a></td>
        <td class="fw-700 text-green">Rp {{ number_format($inv->total,0,',','.') }}</td>
        <td>{{ $inv->created_at->format('d M Y') }}</td>
        <td><span class="badge badge-green"><span class="badge-dot" style="background:currentColor"></span>Lunas</span></td>
        <td><div style="display:flex;gap:6px"><a href="{{ route('customer.invoice.show',$inv) }}" class="btn btn-secondary btn-sm">Lihat</a><a href="{{ route('customer.invoice.pdf',$inv) }}" class="btn btn-secondary btn-sm" target="_blank">PDF</a></div></td>
      </tr>
      @empty
      <tr><td colspan="6" style="text-align:center;color:var(--gray-400);padding:32px">Belum ada invoice</td></tr>
      @endforelse
    </tbody>
  </table></div>
</div>
@endsection
