@extends('layouts.app')
@php $title=$invoice->no_invoice; $roleLabel='Admin Panel'; $userName=auth()->user()->name; @endphp
@section('sidebar-nav') @include('components.nav-admin') @endsection
@section('topbar-actions')
<a href="{{ route('admin.invoice.index') }}" class="btn btn-secondary btn-sm no-print"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg> Kembali</a>
<a href="{{ route('admin.invoice.pdf',$invoice) }}" class="btn btn-primary btn-sm no-print" target="_blank"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Cetak PDF</a>
@endsection
@section('content')
@include('admin.invoice.partial')
@endsection
