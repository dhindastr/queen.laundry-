@extends('layouts.app')
@php $title='Invoice'; $roleLabel='Admin Panel'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-admin') @endsection
@section('topbar-actions')<button class="btn btn-primary btn-sm" data-modal-open="modal-generate"><svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Generate Invoice</button>@endsection
@section('content')
<div class="card">
  <div class="card-header"><span class="card-title">Daftar Invoice ({{ $invoices->total() }})</span></div>
  <div class="table-wrap"><table>
    <thead><tr><th>No. Invoice</th><th>Order</th><th>Customer</th><th>Total</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
      @forelse($invoices as $inv)
      <tr>
        <td class="fw-700 text-brand">{{ $inv->no_invoice }}</td>
        <td><a href="{{ route('admin.orders.show',$inv->order) }}" class="text-brand">#{{ str_pad($inv->order_id,3,'0',STR_PAD_LEFT) }}</a></td>
        <td>{{ $inv->order->customer->nama }}</td>
        <td class="fw-600 text-green">Rp {{ number_format($inv->total,0,',','.') }}</td>
        <td>{{ $inv->created_at->format('d M Y') }}</td>
        <td><span class="badge badge-green"><span class="badge-dot" style="background:currentColor"></span>Lunas</span></td>
        <td><div style="display:flex;gap:6px"><a href="{{ route('admin.invoice.show',$inv) }}" class="btn btn-secondary btn-sm">Lihat</a><a href="{{ route('admin.invoice.pdf',$inv) }}" class="btn btn-secondary btn-sm" target="_blank">PDF</a></div></td>
      </tr>
      @empty
      <tr><td colspan="7" style="text-align:center;color:var(--gray-400);padding:32px">Belum ada invoice</td></tr>
      @endforelse
    </tbody>
  </table></div>
  @if($invoices->hasPages())<div style="padding:14px 18px;border-top:1px solid var(--gray-100)">{{ $invoices->links() }}</div>@endif
</div>
<div class="modal-overlay" id="modal-generate">
  <div class="modal"><div class="modal-header"><span class="modal-title">Generate Invoice</span><button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
  <form method="POST" action="{{ route('admin.invoice.generate') }}">@csrf
    <div class="modal-body">
      @if($pendingOrders->isEmpty())
        <p style="color:var(--gray-400);font-size:13px;text-align:center;padding:16px 0">Tidak ada order selesai yang belum dibuatkan invoice.</p>
      @else
        <div class="form-group"><label class="form-label">Pilih Order (Status: Selesai)</label>
          <select name="order_id" class="form-control" required>
            <option value="">— Pilih Order —</option>
            @foreach($pendingOrders as $o)
            <option value="{{ $o->id }}">#{{ str_pad($o->id,3,'0',STR_PAD_LEFT) }} — {{ $o->customer->nama }} — Rp {{ number_format($o->total_harga,0,',','.') }}</option>
            @endforeach
          </select>
        </div>
      @endif
    </div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary modal-close">Batal</button><button type="submit" class="btn btn-primary" @if($pendingOrders->isEmpty()) disabled @endif>Generate</button></div>
  </form></div>
</div>
@endsection
