@extends('layouts.app')
@php $title=$invoice->no_invoice; $roleLabel='Customer Portal'; $sidebarColor='var(--teal)'; $userName=auth('customer')->user()->nama; @endphp
@section('sidebar-nav') @include('components.nav-customer') @endsection
@section('topbar-actions')<a href="{{ route('customer.invoice.pdf',$invoice) }}" class="btn btn-primary btn-sm" target="_blank"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Cetak PDF</a>@endsection
@section('content')
@include('admin.invoice.partial')
@endsection
