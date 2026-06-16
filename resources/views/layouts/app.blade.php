<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title ?? 'Queen Laundry' }} — Queen Laundry</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="app-shell">
  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="sidebar-brand-icon" style="background:{{ $sidebarColor ?? 'var(--brand)' }}">
        <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
      </div>
      <div>
        <div class="sidebar-brand-text">Queen Laundry</div>
        <div class="sidebar-brand-sub">{{ $roleLabel ?? 'System' }}</div>
      </div>
    </div>
    <nav class="sidebar-nav">
      @yield('sidebar-nav')
    </nav>
    <div class="sidebar-footer">
      <div class="sidebar-avatar" style="background:{{ $sidebarColor ?? 'var(--brand)' }}">
        {{ strtoupper(substr($userName ?? 'U', 0, 2)) }}
      </div>
      <div>
        <div class="sidebar-user-name">{{ $userName ?? 'User' }}</div>
        <div class="sidebar-user-role">{{ $roleLabel ?? '' }}</div>
      </div>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main-content">
    <header class="topbar">
      <h1 class="topbar-title">{{ $title ?? 'Dashboard' }}</h1>
      <div class="topbar-actions">
        @yield('topbar-actions')
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
          @csrf
          <button type="submit" class="btn btn-secondary btn-sm">
            <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            Keluar
          </button>
        </form>
      </div>
    </header>
    <main class="page-content">
      @if(session('success'))
        <div class="alert alert-success" data-auto-dismiss>
          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          {{ session('success') }}
        </div>
      @endif
      @if($errors->any())
        <div class="alert alert-error">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          {{ $errors->first() }}
        </div>
      @endif
      @yield('content')
    </main>
  </div>
</div>
<script src="/js/app.js"></script>
@yield('scripts')
</body>
</html>
