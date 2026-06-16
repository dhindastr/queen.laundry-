<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Masuk — Queen Laundry</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/app.css">
<style>
.auth-page{min-height:100vh;display:grid;grid-template-columns:1fr 1fr}
.auth-left{background:linear-gradient(135deg,#4F46E5 0%,#7C3AED 100%);display:flex;flex-direction:column;justify-content:space-between;padding:48px;position:relative;overflow:hidden}
.auth-left::before{content:'';position:absolute;top:-120px;right:-80px;width:400px;height:400px;background:rgba(255,255,255,.06);border-radius:50%}
.auth-left::after{content:'';position:absolute;bottom:-80px;left:-60px;width:300px;height:300px;background:rgba(255,255,255,.04);border-radius:50%}
.auth-brand{display:flex;align-items:center;gap:10px;position:relative;z-index:1}
.auth-brand-icon{width:38px;height:38px;background:rgba(255,255,255,.2);border-radius:10px;display:flex;align-items:center;justify-content:center}
.auth-brand-icon svg{width:18px;height:18px;stroke:#fff;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.auth-brand-name{font-size:16px;font-weight:800;color:#fff}
.auth-left-content{position:relative;z-index:1}
.auth-left-content h2{font-size:30px;font-weight:800;color:#fff;line-height:1.2;margin-bottom:14px;letter-spacing:-.02em}
.auth-left-content p{font-size:15px;color:rgba(255,255,255,.7);line-height:1.7;margin-bottom:28px}
.auth-feature{display:flex;align-items:center;gap:10px;margin-bottom:12px}
.auth-feature-dot{width:28px;height:28px;background:rgba(255,255,255,.15);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.auth-feature-dot svg{width:14px;height:14px;stroke:#fff;fill:none;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round}
.auth-feature span{font-size:13px;color:rgba(255,255,255,.8);font-weight:500}
.auth-left-footer{position:relative;z-index:1;font-size:12px;color:rgba(255,255,255,.4)}
.auth-right{display:flex;align-items:center;justify-content:center;padding:40px;background:#fff}
.auth-form-wrap{width:100%;max-width:400px}
.auth-title{font-size:24px;font-weight:800;color:#111827;margin-bottom:6px;letter-spacing:-.02em}
.auth-subtitle{font-size:14px;color:#6B7280;margin-bottom:28px}
.auth-link{color:#4F46E5;text-decoration:none;font-weight:600}
.auth-link:hover{color:#3730A3;text-decoration:underline}
.auth-divider{display:flex;align-items:center;gap:10px;margin:16px 0;font-size:12px;color:#9CA3AF}
.auth-divider::before,.auth-divider::after{content:'';flex:1;height:1px;background:#E5E7EB}
.remember-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
.check-label{display:flex;align-items:center;gap:7px;font-size:13px;color:#374151;cursor:pointer}
.check-label input{width:15px;height:15px;accent-color:#4F46E5}
@media(max-width:768px){.auth-page{grid-template-columns:1fr}.auth-left{display:none}}
</style>
</head>
<body style="margin:0">

<div class="auth-page">
  <!-- LEFT PANEL -->
  <div class="auth-left">
    <div class="auth-brand">
      <div class="auth-brand-icon"><svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div>
      <span class="auth-brand-name">Queen Laundry</span>
    </div>
    <div class="auth-left-content">
      <h2>Platform Manajemen Laundry Terpadu</h2>
      <p>Kelola seluruh operasional laundry Anda dalam satu dashboard yang mudah digunakan.</p>
      <div class="auth-feature"><div class="auth-feature-dot"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><span>Lacak status order real-time</span></div>
      <div class="auth-feature"><div class="auth-feature-dot"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><span>Invoice digital otomatis</span></div>
      <div class="auth-feature"><div class="auth-feature-dot"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><span>Manajemen kurir terintegrasi</span></div>
      <div class="auth-feature"><div class="auth-feature-dot"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><span>Laporan bisnis lengkap</span></div>
    </div>
    <div class="auth-left-footer">© {{ date('Y') }} Queen Laundry · Surabaya</div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="auth-right">
    <div class="auth-form-wrap">
      <a href="{{ route('landing') }}" style="display:inline-flex;align-items:center;gap:6px;font-size:12px;color:#9CA3AF;text-decoration:none;margin-bottom:28px;font-weight:500">
        <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali ke beranda
      </a>

      <div class="auth-title">Selamat Datang</div>
      <div class="auth-subtitle">Belum punya akun? <a href="{{ route('register') }}" class="auth-link">Daftar sekarang</a></div>

      @if($errors->any())
      <div class="alert alert-error" style="margin-bottom:16px">
        <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        {{ $errors->first() }}
      </div>
      @endif



      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <div class="remember-row">
          <label class="check-label">
            <input type="checkbox" name="remember"> Ingat saya
          </label>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:12px 24px;font-size:14px">
          <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
          Masuk ke Akun
        </button>
      </form>
    </div>
  </div>
</div>

<link rel="stylesheet" href="/css/app.css">
</body>
</html>
