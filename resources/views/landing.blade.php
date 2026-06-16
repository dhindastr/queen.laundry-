<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Queen Laundry — Laundry Profesional Surabaya</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --brand:#4F46E5;--brand-dark:#3730A3;--brand-light:#EEF2FF;
  --green:#059669;--green-light:#ECFDF5;
  --amber:#D97706;--amber-light:#FFFBEB;
  --red:#DC2626;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-400:#9CA3AF;--gray-500:#6B7280;
  --gray-600:#4B5563;--gray-700:#374151;--gray-800:#1F2937;--gray-900:#111827;
}
html{scroll-behavior:smooth}
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;color:var(--gray-800);background:#fff;line-height:1.6;font-size:15px}

/* NAV */
.nav{position:fixed;top:0;left:0;right:0;z-index:100;background:rgba(255,255,255,.96);backdrop-filter:blur(10px);border-bottom:1px solid var(--gray-100)}
.nav-inner{max-width:1140px;margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:space-between;height:60px}
.nav-brand{display:flex;align-items:center;gap:9px;text-decoration:none}
.nav-brand-icon{width:32px;height:32px;background:var(--brand);border-radius:8px;display:flex;align-items:center;justify-content:center}
.nav-brand-icon svg{width:16px;height:16px;stroke:#fff;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.nav-brand-name{font-size:15px;font-weight:700;color:var(--gray-900)}
.nav-links{display:flex;align-items:center;gap:4px}
.nav-link{font-size:13px;font-weight:500;color:var(--gray-500);text-decoration:none;padding:6px 12px;border-radius:7px;transition:all .12s}
.nav-link:hover{color:var(--gray-900);background:var(--gray-50)}
.nav-btn{background:var(--brand);color:#fff;font-size:13px;font-weight:600;padding:7px 16px;border-radius:8px;text-decoration:none;transition:background .12s}
.nav-btn:hover{background:var(--brand-dark)}

/* HERO — split layout */
.hero{padding-top:60px;min-height:100vh;display:grid;grid-template-columns:1fr 440px;gap:0;max-width:1140px;margin:0 auto;padding-left:24px;padding-right:24px;align-items:center}
.hero-left{padding:48px 48px 48px 0}
.hero h1{font-size:36px;font-weight:700;color:var(--gray-900);line-height:1.25;margin-bottom:16px;letter-spacing:-.01em}
.hero h1 em{font-style:normal;color:var(--brand)}
.hero-desc{font-size:14px;color:var(--gray-500);line-height:1.8;margin-bottom:24px;max-width:440px}
.hero-actions{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px}
.btn{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;border-radius:9px;font-size:13px;font-weight:600;text-decoration:none;transition:all .13s;font-family:inherit;cursor:pointer;border:none;white-space:nowrap}
.btn svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.btn-primary{background:var(--brand);color:#fff;box-shadow:0 2px 8px rgba(79,70,229,.25)}
.btn-primary:hover{background:var(--brand-dark)}
.btn-ghost{background:#fff;color:var(--gray-600);border:1.5px solid var(--gray-200)}
.btn-ghost:hover{border-color:var(--gray-300);color:var(--gray-800)}

/* LOGIN CARD */
.login-card{background:#fff;border:1px solid var(--gray-200);border-radius:16px;padding:28px;box-shadow:0 8px 40px rgba(0,0,0,.08)}
.login-card-title{font-size:16px;font-weight:700;color:var(--gray-900);margin-bottom:4px}
.login-card-sub{font-size:12px;color:var(--gray-400);margin-bottom:20px}
.form-group{margin-bottom:12px}
.form-label{display:block;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--gray-400);margin-bottom:5px}
.form-control{width:100%;padding:9px 12px;border:1px solid var(--gray-200);border-radius:8px;font-size:13px;color:var(--gray-800);background:#fff;font-family:inherit;outline:none;transition:border-color .12s}
.form-control:focus{border-color:var(--brand)}
.login-btn{width:100%;padding:10px;background:var(--brand);color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;font-family:inherit;transition:background .12s;margin-top:4px}
.login-btn:hover{background:var(--brand-dark)}
.login-divider{display:flex;align-items:center;gap:10px;margin:14px 0;font-size:11px;color:var(--gray-400)}
.login-divider::before,.login-divider::after{content:'';flex:1;height:1px;background:var(--gray-100)}
.register-link{display:block;text-align:center;font-size:12px;color:var(--gray-500);margin-top:12px}
.register-link a{color:var(--brand);font-weight:600;text-decoration:none}
.register-link a:hover{text-decoration:underline}
.alert-error{background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;padding:9px 12px;border-radius:8px;font-size:12px;margin-bottom:12px;display:flex;align-items:flex-start;gap:7px}
.alert-error svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0;margin-top:1px}

/* STATS */
.stats-strip{background:var(--gray-900);padding:0 24px}
.stats-inner{max-width:1140px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);border-bottom:1px solid rgba(255,255,255,.06)}
.stat-item{padding:24px 20px;border-right:1px solid rgba(255,255,255,.06)}
.stat-item:last-child{border-right:none}
.stat-num{font-size:24px;font-weight:800;color:#fff;letter-spacing:-.02em}
.stat-label{font-size:12px;color:rgba(255,255,255,.4);margin-top:2px}

/* SECTION */
.section{padding:80px 24px}
.section-inner{max-width:1140px;margin:0 auto}
.section-kicker{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--brand);margin-bottom:8px}
.section-title{font-size:26px;font-weight:700;color:var(--gray-900);line-height:1.3;letter-spacing:-.01em;margin-bottom:10px}
.section-sub{font-size:14px;color:var(--gray-500);max-width:480px;line-height:1.7}

/* FEATURES */
.features{background:var(--gray-50)}
.feat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:48px}
.feat-card{background:#fff;border:1px solid var(--gray-200);border-radius:12px;padding:24px;transition:border-color .15s,transform .15s,box-shadow .15s}
.feat-card:hover{border-color:#C7D2FE;box-shadow:0 4px 20px rgba(79,70,229,.07);transform:translateY(-2px)}
.feat-icon{width:38px;height:38px;border-radius:9px;display:flex;align-items:center;justify-content:center;margin-bottom:14px}
.feat-icon svg{width:19px;height:19px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.feat-card h3{font-size:14px;font-weight:700;color:var(--gray-900);margin-bottom:6px}
.feat-card p{font-size:13px;color:var(--gray-500);line-height:1.65}

/* HOW */
.how-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;margin-top:48px;position:relative}
.how-steps::before{content:'';position:absolute;top:23px;left:calc(12.5% + 12px);right:calc(12.5% + 12px);height:1px;border-top:1.5px dashed var(--gray-200)}
.how-step{text-align:center;position:relative}
.how-num{width:48px;height:48px;border-radius:50%;background:#fff;border:1.5px solid var(--gray-200);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:15px;font-weight:800;color:var(--brand);position:relative;z-index:1;box-shadow:0 0 0 6px #fff}
.how-step h3{font-size:13px;font-weight:700;color:var(--gray-800);margin-bottom:5px}
.how-step p{font-size:12px;color:var(--gray-500);line-height:1.6}

/* PRICING */
.pricing{background:var(--gray-50)}
.price-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:48px}
.price-card{background:#fff;border:1.5px solid var(--gray-200);border-radius:14px;padding:28px;position:relative}
.price-card.featured{border-color:var(--brand)}
.price-tag{position:absolute;top:-11px;left:50%;transform:translateX(-50%);background:var(--brand);color:#fff;font-size:10px;font-weight:700;padding:3px 12px;border-radius:20px;white-space:nowrap;letter-spacing:.04em}
.price-name{font-size:13px;font-weight:600;color:var(--gray-500);margin-bottom:6px}
.price-amt{font-size:32px;font-weight:800;color:var(--gray-900);letter-spacing:-.02em;line-height:1}
.price-unit{font-size:12px;color:var(--gray-400);margin:4px 0 18px}
.price-sep{height:1px;background:var(--gray-100);margin:16px 0}
.price-list{list-style:none;margin-bottom:20px}
.price-list li{display:flex;align-items:center;gap:7px;font-size:13px;color:var(--gray-600);padding:4px 0}
.price-list li svg{width:14px;height:14px;stroke:var(--green);fill:none;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0}
.price-cta{display:block;text-align:center;padding:9px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;transition:all .12s}
.price-cta-outline{border:1.5px solid var(--gray-200);color:var(--gray-700)}
.price-cta-outline:hover{border-color:var(--brand);color:var(--brand)}
.price-cta-solid{background:var(--brand);color:#fff}
.price-cta-solid:hover{background:var(--brand-dark)}

/* TESTIMONIALS */
.testi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:48px}
.testi-card{background:#fff;border:1px solid var(--gray-200);border-radius:12px;padding:22px}
.testi-stars{display:flex;gap:2px;margin-bottom:12px}
.testi-stars svg{width:13px;height:13px;fill:#F59E0B}
.testi-text{font-size:13px;color:var(--gray-600);line-height:1.7;margin-bottom:14px}
.testi-author{display:flex;align-items:center;gap:9px}
.testi-av{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#fff;flex-shrink:0}
.testi-name{font-size:12px;font-weight:700;color:var(--gray-800)}
.testi-role{font-size:11px;color:var(--gray-400)}

/* CTA BAND */
.cta-band{background:var(--gray-900);padding:64px 24px;text-align:center}
.cta-band h2{font-size:26px;font-weight:800;color:#fff;margin-bottom:10px;letter-spacing:-.02em}
.cta-band p{font-size:14px;color:rgba(255,255,255,.5);margin-bottom:24px}
.cta-band .btn-white{background:#fff;color:var(--brand);font-weight:700}
.cta-band .btn-white:hover{background:var(--brand-light)}
.cta-band .btn-border{border:1.5px solid rgba(255,255,255,.2);color:rgba(255,255,255,.7);background:transparent}
.cta-band .btn-border:hover{border-color:rgba(255,255,255,.5);color:#fff}

/* FOOTER */
footer{background:var(--gray-900);border-top:1px solid rgba(255,255,255,.06);padding:48px 24px 28px}
.footer-inner{max-width:1140px;margin:0 auto}
.footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:40px;margin-bottom:40px}
.footer-brand-icon{width:32px;height:32px;background:var(--brand);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:12px}
.footer-brand-icon svg{width:15px;height:15px;stroke:#fff;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.footer-name{font-size:14px;font-weight:700;color:#fff;margin-bottom:8px}
.footer-desc{font-size:12px;color:rgba(255,255,255,.4);line-height:1.7;margin-bottom:14px}
.footer-contact{font-size:12px;color:rgba(255,255,255,.4);display:flex;align-items:center;gap:6px;margin-bottom:5px}
.footer-contact svg{width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0}
.footer-col-title{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,.25);margin-bottom:14px}
.footer-links{list-style:none}
.footer-links li{margin-bottom:7px}
.footer-links a{font-size:12px;color:rgba(255,255,255,.4);text-decoration:none;transition:color .12s}
.footer-links a:hover{color:rgba(255,255,255,.8)}
.footer-bottom{border-top:1px solid rgba(255,255,255,.06);padding-top:20px;display:flex;justify-content:space-between;font-size:11px;color:rgba(255,255,255,.25)}

@media(max-width:900px){
  .hero{grid-template-columns:1fr;padding-top:80px}
  .hero-left{padding:32px 0 0}
  .feat-grid,.price-grid,.testi-grid{grid-template-columns:1fr}
  .how-steps{grid-template-columns:1fr 1fr}
  .how-steps::before{display:none}
  .stats-inner{grid-template-columns:1fr 1fr}
  .footer-grid{grid-template-columns:1fr 1fr}
}
</style>
</head>
<body>

<!-- NAV -->
<nav class="nav">
  <div class="nav-inner">
    <a href="{{ route('landing') }}" class="nav-brand">
      <div class="nav-brand-icon"><svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div>
      <span class="nav-brand-name">Queen Laundry</span>
    </a>
    <div class="nav-links">
      <a href="#fitur" class="nav-link">Fitur</a>
      <a href="#cara-kerja" class="nav-link">Prosesnya sederhana</a>
      <a href="#harga" class="nav-link">Harga</a>
      <a href="{{ route('register') }}" class="nav-btn">Daftar Gratis</a>
    </div>
  </div>
</nav>

<!-- HERO -->
<div style="max-width:1140px;margin:0 auto;padding:0 24px">
  <div class="hero" style="max-width:none;padding:0;margin-top:60px">
    <!-- Left -->
    <div class="hero-left" style="padding-top:60px">

      <h1>Laundry bersih.<br>Dijemput, dicuci,<br>diantar ke <em>rumah Anda</em>.</h1>
      <p class="hero-desc">Tidak perlu antre atau keluar rumah. Kurir kami jemput laundry Anda, selesai kami kirim balik. Status bisa dipantau langsung dari sini.</p>
      <div class="hero-actions">
        <a href="{{ route('register') }}" class="btn btn-primary">
          <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
          Buat Akun Gratis
        </a>
        <a href="#cara-kerja" class="btn btn-ghost">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
          Prosesnya sederhananya
        </a>
      </div>

    </div>

    <!-- Right: Login Card -->
    <div style="padding:60px 0 60px 32px">
      <div class="login-card">
        <div class="login-card-title">Masuk ke Akun</div>
        <div class="login-card-sub">Belum punya akun? <a href="{{ route('register') }}" style="color:var(--brand);font-weight:600;text-decoration:none">Daftar gratis</a></div>

        @if($errors->any())
        <div class="alert-error">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          {{ $errors->first() }}
        </div>
        @endif

        @if(session('status'))
        <div style="background:#ECFDF5;border:1px solid #A7F3D0;color:#065F46;padding:9px 12px;border-radius:8px;font-size:12px;margin-bottom:12px">
          {{ session('status') }}
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
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
            <label style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--gray-500);cursor:pointer">
              <input type="checkbox" name="remember" style="accent-color:var(--brand);width:13px;height:13px"> Ingat saya
            </label>
          </div>
          <button type="submit" class="login-btn">Masuk</button>
        </form>

        <div class="login-divider">atau</div>

        <a href="{{ route('register') }}" style="display:block;text-align:center;padding:9px;border:1.5px solid var(--gray-200);border-radius:8px;font-size:13px;font-weight:600;color:var(--gray-700);text-decoration:none;transition:all .12s" onmouseover="this.style.borderColor='#C7D2FE';this.style.color='#4F46E5'" onmouseout="this.style.borderColor='var(--gray-200)';this.style.color='var(--gray-700)'">
          Daftar sebagai Customer Baru
        </a>

        <div style="margin-top:16px;padding:12px;background:var(--gray-50);border-radius:8px;font-size:11px;color:var(--gray-500);text-align:center;line-height:1.6">
          Login sebagai <strong>Admin</strong>, <strong>Kurir</strong>, atau <strong>Owner</strong>?<br>
          Gunakan kredensial yang diberikan oleh pengelola.
        </div>
      </div>
    </div>
  </div>
</div>

<!-- STATS -->
<div class="stats-strip">
  <div class="stats-inner">
    <div class="stat-item"><div class="stat-num">2.400+</div><div class="stat-label">Order selesai</div></div>
    <div class="stat-item"><div class="stat-num">98%</div><div class="stat-label">Kepuasan pelanggan</div></div>
    <div class="stat-item"><div class="stat-num">&lt; 2 jam</div><div class="stat-label">Rata-rata waktu pickup</div></div>
    <div class="stat-item"><div class="stat-num">500+</div><div class="stat-label">Pelanggan aktif</div></div>
  </div>
</div>

<!-- FEATURES -->
<section class="section features" id="fitur">
  <div class="section-inner">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:end;margin-bottom:0">
      <div>
        <div class="section-kicker">Yang membedakan kami</div>
        <h2 class="section-title">Satu platform,<br>semua terkendali</h2>
      </div>
      <p class="section-sub">Dari penjemputan hingga pengantaran, semua proses terpantau secara langsung melalui platform kami.</p>
    </div>
    <div class="feat-grid">
      <div class="feat-card">
        <div class="feat-icon" style="background:#EEF2FF;color:#4F46E5"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
        <h3>Jadwalkan Pickup Sendiri</h3>
        <p>Pilih waktu yang sesuai. Kurir kami siap menjemput laundry di lokasi Anda dalam 1–2 jam.</p>
      </div>
      <div class="feat-card">
        <div class="feat-icon" style="background:#ECFDF5;color:#059669"><svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
        <h3>Tracking Status Langsung</h3>
        <p>Pantau laundry Anda dari pickup, proses pencucian, hingga siap diantar — semua dari satu halaman.</p>
      </div>
      <div class="feat-card">
        <div class="feat-icon" style="background:#FFF7ED;color:#EA580C"><svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
        <h3>Invoice Digital Otomatis</h3>
        <p>Tagihan dibuat otomatis setelah order selesai dan bisa diunduh sebagai PDF kapan saja.</p>
      </div>
      <div class="feat-card">
        <div class="feat-icon" style="background:#F0FDF4;color:#16A34A"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h3>Proses Higienis</h3>
        <p>Setiap pakaian dicuci terpisah dengan deterjen premium. Tidak campur dengan milik orang lain.</p>
      </div>
      <div class="feat-card">
        <div class="feat-icon" style="background:#FFF1F2;color:#E11D48"><svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
        <h3>Antar ke Depan Pintu</h3>
        <p>Setelah selesai dicuci, kurir langsung mengantarkan ke alamat Anda tanpa biaya tambahan.</p>
      </div>
      <div class="feat-card">
        <div class="feat-icon" style="background:#F5F3FF;color:#7C3AED"><svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
        <h3>Riwayat Transaksi Lengkap</h3>
        <p>Semua riwayat order tersimpan. Cocok untuk keperluan reimburse biaya laundry dinas.</p>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="section" id="cara-kerja">
  <div class="section-inner" style="text-align:center">
    <div class="section-kicker">Prosesnya sederhana</div>
    <h2 class="section-title" style="margin:0 auto 8px">Empat langkah, sudah selesai</h2>
    <p class="section-sub" style="margin:0 auto 0">Dari request sampai pakaian bersih kembali ke tangan Anda.</p>
    <div class="how-steps">
      <div class="how-step"><div class="how-num">1</div><h3>Buat Akun</h3><p>Daftar gratis dalam satu menit. Tidak perlu kartu kredit.</p></div>
      <div class="how-step"><div class="how-num">2</div><h3>Request Pickup</h3><p>Pilih jadwal dan jenis laundry. Kurir akan datang ke tempat Anda.</p></div>
      <div class="how-step"><div class="how-num">3</div><h3>Kami Cuci</h3><p>Laundry dicuci, dikeringkan, dan dilipat dengan standar bersih.</p></div>
      <div class="how-step"><div class="how-num">4</div><h3>Diterima di Rumah</h3><p>Pakaian bersih dikirim kembali ke alamat Anda.</p></div>
    </div>
  </div>
</section>

<!-- PRICING -->
<section class="section pricing" id="harga">
  <div class="section-inner" style="text-align:center">
    <div class="section-kicker">Harga</div>
    <h2 class="section-title" style="margin:0 auto 8px">Bayar sesuai berat, tanpa biaya tersembunyi</h2>
    <p class="section-sub" style="margin:0 auto">Tidak ada biaya langganan. Cukup bayar per kilogram setelah laundry selesai.</p>
    <div class="price-grid">
      <div class="price-card">
        <div class="price-name">Pakaian Biasa</div>
        <div class="price-amt">Rp 8.000</div>
        <div class="price-unit">per kilogram</div>
        <div class="price-sep"></div>
        <ul class="price-list">
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Kaos, kemeja, celana</li>
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Cuci + kering + lipat</li>
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Selesai 1–2 hari</li>
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Pickup & delivery gratis</li>
        </ul>
        <a href="{{ route('register') }}" class="price-cta price-cta-outline">Mulai Sekarang</a>
      </div>
      <div class="price-card featured">
        <div class="price-tag">PALING DIMINATI</div>
        <div class="price-name">Pakaian Kerja</div>
        <div class="price-amt">Rp 12.000</div>
        <div class="price-unit">per kilogram</div>
        <div class="price-sep"></div>
        <ul class="price-list">
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Jas, blazer, kemeja formal</li>
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Cuci + press + rapi</li>
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Selesai dalam 1 hari</li>
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Pickup & delivery gratis</li>
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Penanganan ekstra hati-hati</li>
        </ul>
        <a href="{{ route('register') }}" class="price-cta price-cta-solid">Mulai Sekarang</a>
      </div>
      <div class="price-card">
        <div class="price-name">Linen &amp; Karpet</div>
        <div class="price-amt">Rp 15.000</div>
        <div class="price-unit">per kilogram</div>
        <div class="price-sep"></div>
        <ul class="price-list">
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Sprei, selimut, karpet</li>
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Deep clean khusus</li>
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Selesai 2–3 hari</li>
          <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Pickup & delivery gratis</li>
        </ul>
        <a href="{{ route('register') }}" class="price-cta price-cta-outline">Mulai Sekarang</a>
      </div>
    </div>
    <p style="margin-top:16px;font-size:12px;color:var(--gray-400)">Minimum order 2 kg. Harga sudah termasuk ongkos pickup dan delivery dalam kota Surabaya.</p>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="section">
  <div class="section-inner">
    <div class="section-kicker">Dari pelanggan kami</div>
    <h2 class="section-title">Mereka sudah mencoba</h2>
    <div class="testi-grid">
      <div class="testi-card">
        <div class="testi-stars">@for($i=0;$i<5;$i++)<svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor</div>
        <p class="testi-text">"Sangat membantu operasional kantor kami. Seragam karyawan bersih dan dikembalikan tepat waktu. Sistem tracking-nya memudahkan pemantauan."</p>
        <div class="testi-author"><div class="testi-av" style="background:#4F46E5">SR</div><div><div class="testi-name">Sari Rahayu</div><div class="testi-role">HRD Manager, PT Maju Jaya</div></div></div>
      </div>
      <div class="testi-card">
        <div class="testi-stars">@for($i=0;$i<5;$i++)<svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor</div>
        <p class="testi-text">"Tinggal request lewat HP, beberapa jam kurir datang. Pakaian bersih kembali keesokan harinya. Praktis sekali untuk ibu rumah tangga yang sibuk."</p>
        <div class="testi-author"><div class="testi-av" style="background:#059669">BW</div><div><div class="testi-name">Wulandari</div><div class="testi-role">Pelanggan Reguler</div></div></div>
      </div>
      <div class="testi-card">
        <div class="testi-stars">@for($i=0;$i<5;$i++)<svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor</div>
        <p class="testi-text">"Invoice digital-nya mempermudah proses reimburse laundry dinas. Tidak perlu struk fisik lagi. Pelayanan memuaskan dengan harga yang wajar."</p>
        <div class="testi-author"><div class="testi-av" style="background:#D97706">DR</div><div><div class="testi-name">Dani Rizky</div><div class="testi-role">Pegawai Swasta</div></div></div>
      </div>
    </div>
  </div>
</section>

<!-- CTA BAND -->
<div class="cta-band">
  <h2>Coba sekarang, gratis</h2>
  <p>Daftar butuh kurang dari satu menit. Tidak ada biaya pendaftaran.</p>
  <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
    <a href="{{ route('register') }}" class="btn btn-white">
      <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
      Daftar Gratis
    </a>
    <a href="#" onclick="window.scrollTo({top:0,behavior:'smooth'});return false" class="btn btn-border">Masuk ke Akun</a>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-grid">
      <div>
        <div class="footer-brand-icon"><svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div>
        <div class="footer-name">Queen Laundry</div>
        <div class="footer-desc">Layanan laundry profesional dengan sistem antar-jemput. Melayani seluruh wilayah Surabaya.</div>
        <div class="footer-contact"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12"/></svg>(031) 1234-5678</div>
        <div class="footer-contact"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>halo@queenlaundry.com</div>
        <div class="footer-contact"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Jl. Raya Darmo No.88, Surabaya</div>
      </div>
      <div>
        <div class="footer-col-title">Layanan</div>
        <ul class="footer-links">
          <li><a href="#harga">Pakaian Biasa</a></li>
          <li><a href="#harga">Pakaian Kerja</a></li>
          <li><a href="#harga">Linen &amp; Sprei</a></li>
          <li><a href="#harga">Karpet &amp; Gordyn</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Informasi</div>
        <ul class="footer-links">
          <li><a href="#fitur">Tentang Kami</a></li>
          <li><a href="#cara-kerja">Prosesnya sederhana</a></li>
          <li><a href="#harga">Harga</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Akun</div>
        <ul class="footer-links">
          <li><a href="{{ route('register') }}">Daftar Customer</a></li>
          <li><a href="{{ route('login') }}">Halaman Login</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© {{ date('Y') }} Queen Laundry. Semua hak dilindungi.</span>
      <span>Surabaya, Indonesia</span>
    </div>
  </div>
</footer>

<script>
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const t = document.querySelector(a.getAttribute('href'));
    if (t) { e.preventDefault(); t.scrollIntoView({behavior:'smooth',block:'start'}); }
  });
});
window.addEventListener('scroll', () => {
  document.querySelector('.nav').style.boxShadow = window.scrollY > 8 ? '0 1px 16px rgba(0,0,0,.07)' : 'none';
});
</script>
</body>
</html>
