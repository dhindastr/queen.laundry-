<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Daftar Akun — Queen Laundry</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/app.css">
<style>
.auth-page{min-height:100vh;display:grid;grid-template-columns:1fr 1fr}
.auth-left{background:linear-gradient(135deg,#059669 0%,#0D9488 100%);display:flex;flex-direction:column;justify-content:space-between;padding:48px;position:relative;overflow:hidden}
.auth-left::before{content:'';position:absolute;top:-120px;right:-80px;width:400px;height:400px;background:rgba(255,255,255,.06);border-radius:50%}
.auth-left::after{content:'';position:absolute;bottom:-80px;left:-60px;width:300px;height:300px;background:rgba(255,255,255,.04);border-radius:50%}
.auth-brand{display:flex;align-items:center;gap:10px;position:relative;z-index:1}
.auth-brand-icon{width:38px;height:38px;background:rgba(255,255,255,.2);border-radius:10px;display:flex;align-items:center;justify-content:center}
.auth-brand-icon svg{width:18px;height:18px;stroke:#fff;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.auth-brand-name{font-size:16px;font-weight:800;color:#fff}
.auth-left-content{position:relative;z-index:1}
.auth-left-content h2{font-size:28px;font-weight:800;color:#fff;line-height:1.2;margin-bottom:14px;letter-spacing:-.02em}
.auth-left-content p{font-size:14px;color:rgba(255,255,255,.75);line-height:1.7;margin-bottom:24px}
.auth-perk{display:flex;align-items:flex-start;gap:12px;margin-bottom:14px}
.auth-perk-icon{width:32px;height:32px;background:rgba(255,255,255,.15);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.auth-perk-icon svg{width:15px;height:15px;stroke:#fff;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.auth-perk-text strong{display:block;font-size:13px;font-weight:700;color:#fff;margin-bottom:1px}
.auth-perk-text span{font-size:12px;color:rgba(255,255,255,.6)}
.auth-left-footer{position:relative;z-index:1;font-size:12px;color:rgba(255,255,255,.4)}
.auth-right{display:flex;align-items:center;justify-content:center;padding:40px;background:#fff;overflow-y:auto}
.auth-form-wrap{width:100%;max-width:420px;padding:8px 0}
.auth-title{font-size:24px;font-weight:800;color:#111827;margin-bottom:6px;letter-spacing:-.02em}
.auth-subtitle{font-size:14px;color:#6B7280;margin-bottom:24px}
.auth-link{color:#059669;text-decoration:none;font-weight:600}
.auth-link:hover{color:#047857;text-decoration:underline}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
@media(max-width:768px){.auth-page{grid-template-columns:1fr}.auth-left{display:none}.form-row{grid-template-columns:1fr}}
.pass-strength{height:3px;background:#E5E7EB;border-radius:2px;margin-top:5px;overflow:hidden}
.pass-strength-fill{height:100%;border-radius:2px;width:0%;transition:width .3s,background .3s}
.pass-hint{font-size:11px;color:#9CA3AF;margin-top:4px}
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
      <h2>Bergabung dengan 500+ Customer Queen Laundry</h2>
      <p>Daftar gratis dan nikmati kemudahan layanan laundry profesional dengan pickup & delivery.</p>
      <div class="auth-perk">
        <div class="auth-perk-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
        <div class="auth-perk-text"><strong>Pickup Cepat</strong><span>Kurir tiba dalam 1–2 jam setelah request</span></div>
      </div>
      <div class="auth-perk">
        <div class="auth-perk-icon"><svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
        <div class="auth-perk-text"><strong>Tracking Real-Time</strong><span>Pantau status laundry dari mana saja</span></div>
      </div>
      <div class="auth-perk">
        <div class="auth-perk-icon"><svg viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
        <div class="auth-perk-text"><strong>Invoice Digital</strong><span>Download PDF untuk keperluan administrasi</span></div>
      </div>
      <div class="auth-perk">
        <div class="auth-perk-icon"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
        <div class="auth-perk-text"><strong>Daftar 100% Gratis</strong><span>Tidak ada biaya pendaftaran atau langganan</span></div>
      </div>
    </div>
    <div class="auth-left-footer">© {{ date('Y') }} Queen Laundry · Surabaya</div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="auth-right">
    <div class="auth-form-wrap">
      <a href="{{ route('landing') }}" style="display:inline-flex;align-items:center;gap:6px;font-size:12px;color:#9CA3AF;text-decoration:none;margin-bottom:24px;font-weight:500">
        <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali ke beranda
      </a>

      <div class="auth-title">Buat Akun Baru</div>
      <div class="auth-subtitle">Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a></div>

      @if($errors->any())
      <div class="alert alert-error" style="margin-bottom:16px">
        <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <div>
          @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
        </div>
      </div>
      @endif

      <form method="POST" action="{{ route('register.post') }}" id="reg-form">
        @csrf
        <div class="form-group">
          <label class="form-label">Nama Lengkap / Nama Perusahaan</label>
          <input type="text" name="nama" class="form-control" placeholder="cth: PT Maju Jaya / Budi Santoso" value="{{ old('nama') }}" required autofocus>
        </div>
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
          <label class="form-label">No. Telepon / WhatsApp</label>
          <input type="text" name="no_telp" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('no_telp') }}" required>
        </div>
        <div class="form-group">
          <label class="form-label">Alamat Lengkap (untuk pickup)</label>
          <input type="text" name="alamat" class="form-control" placeholder="Jl. Contoh No.1, Kec. Surabaya..." value="{{ old('alamat') }}" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" id="reg-pass" class="form-control" placeholder="Min. 8 karakter" required oninput="checkStrength(this.value)">
            <div class="pass-strength"><div class="pass-strength-fill" id="pass-fill"></div></div>
            <div class="pass-hint" id="pass-hint">Minimal 8 karakter</div>
          </div>
          <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
          </div>
        </div>

        <div style="background:#F0FDF4;border:1px solid #A7F3D0;border-radius:8px;padding:11px 14px;margin-bottom:16px;font-size:12px;color:#065F46;display:flex;gap:8px">
          <svg viewBox="0 0 24 24" style="width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0;margin-top:1px"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          Data Anda aman dan tidak akan dibagikan ke pihak ketiga.
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:12px 24px;font-size:14px;background:#059669;border-color:#059669">
          <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
          Buat Akun Gratis
        </button>
        <p style="text-align:center;font-size:11px;color:#9CA3AF;margin-top:12px">
          Dengan mendaftar, Anda menyetujui syarat & ketentuan layanan Queen Laundry.
        </p>
      </form>
    </div>
  </div>
</div>

<script>
function checkStrength(val) {
  const fill = document.getElementById('pass-fill');
  const hint = document.getElementById('pass-hint');
  let strength = 0;
  if (val.length >= 8) strength++;
  if (/[A-Z]/.test(val)) strength++;
  if (/[0-9]/.test(val)) strength++;
  if (/[^A-Za-z0-9]/.test(val)) strength++;
  const colors = ['', '#EF4444', '#F97316', '#EAB308', '#22C55E'];
  const labels = ['', 'Terlalu pendek', 'Lemah', 'Cukup', 'Kuat'];
  fill.style.width = (strength * 25) + '%';
  fill.style.background = colors[strength] || '#E5E7EB';
  hint.textContent = val.length < 8 ? 'Minimal 8 karakter' : (labels[strength] || '');
  hint.style.color = colors[strength] || '#9CA3AF';
}
</script>
</body>
</html>
