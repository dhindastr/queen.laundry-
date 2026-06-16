<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>{{ $invoice->no_invoice }}</title>
<style>
body{font-family:Arial,sans-serif;font-size:13px;color:#111;margin:0;padding:0}
.inv-wrap{max-width:680px;margin:0 auto;padding:40px}
.inv-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:32px;padding-bottom:20px;border-bottom:2px solid #4F46E5}
.inv-company{font-size:22px;font-weight:800;color:#4F46E5}
.inv-company-sub{font-size:12px;color:#6B7280;margin-top:2px}
.inv-badge{background:#EEF2FF;color:#3730A3;padding:6px 14px;border-radius:6px;font-size:13px;font-weight:700}
.inv-no{font-size:12px;color:#6B7280;margin-top:4px;text-align:right}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:28px}
.info-block p{margin:0 0 4px;font-size:11px;text-transform:uppercase;letter-spacing:.06em;color:#9CA3AF;font-weight:600}
.info-block h3{margin:0;font-size:15px;font-weight:700}
.info-block span{font-size:12px;color:#6B7280}
table{width:100%;border-collapse:collapse;margin-bottom:24px}
th{padding:10px 14px;background:#F9FAFB;font-size:11px;text-transform:uppercase;letter-spacing:.06em;color:#6B7280;text-align:left;border-bottom:1px solid #E5E7EB}
td{padding:12px 14px;border-bottom:1px solid #F3F4F6;font-size:13px}
.total-row{display:flex;justify-content:flex-end;margin-top:8px}
.total-box{background:#F9FAFB;border-radius:10px;padding:16px 24px;min-width:220px}
.total-line{display:flex;justify-content:space-between;gap:32px;margin-bottom:6px;font-size:13px}
.total-final{font-size:18px;font-weight:800;color:#4F46E5;padding-top:8px;border-top:1px solid #E5E7EB;margin-top:8px;display:flex;justify-content:space-between}
.paid-badge{display:inline-block;background:#ECFDF5;color:#059669;padding:4px 12px;border-radius:4px;font-size:12px;font-weight:700;margin-top:10px}
.footer{margin-top:40px;padding-top:16px;border-top:1px solid #E5E7EB;font-size:11px;color:#9CA3AF;text-align:center}
</style>
</head>
<body>
<div class="inv-wrap">
  <div class="inv-header">
    <div>
      <div class="inv-company">Queen Laundry</div>
      <div class="inv-company-sub">Management System · Surabaya</div>
    </div>
    <div style="text-align:right">
      <div class="inv-badge">INVOICE</div>
      <div class="inv-no">{{ $invoice->no_invoice }}</div>
    </div>
  </div>
  <div class="grid-2">
    <div class="info-block">
      <p>Tagihan Kepada</p>
      <h3>{{ $invoice->order->customer->nama }}</h3>
      <span>{{ $invoice->order->customer->no_telp ?? '' }}<br>{{ $invoice->order->customer->alamat ?? '' }}</span>
    </div>
    <div class="info-block">
      <p>Detail Invoice</p>
      <h3>{{ $invoice->no_invoice }}</h3>
      <span>Tanggal: {{ $invoice->created_at->format('d M Y') }}<br>Order: #{{ str_pad($invoice->order_id,3,'0',STR_PAD_LEFT) }}</span>
    </div>
  </div>
  <table>
    <thead><tr><th>Deskripsi</th><th>Berat</th><th>Harga/kg</th><th style="text-align:right">Subtotal</th></tr></thead>
    <tbody>
      <tr>
        <td><strong>{{ $invoice->order->jenis_laundry }}</strong>@if($invoice->order->catatan)<br><small style="color:#6B7280">{{ $invoice->order->catatan }}</small>@endif</td>
        <td>{{ $invoice->order->total_berat }} kg</td>
        <td>Rp {{ number_format($invoice->order->harga_per_kg,0,',','.') }}</td>
        <td style="text-align:right;font-weight:700">Rp {{ number_format($invoice->subtotal,0,',','.') }}</td>
      </tr>
    </tbody>
  </table>
  <div class="total-row">
    <div class="total-box">
      <div class="total-line"><span>Subtotal</span><span>Rp {{ number_format($invoice->subtotal,0,',','.') }}</span></div>
      <div class="total-final"><span>Total</span><span>Rp {{ number_format($invoice->total,0,',','.') }}</span></div>
      <div><span class="paid-badge">✓ LUNAS</span></div>
    </div>
  </div>
  <div class="footer">Terima kasih atas kepercayaan Anda menggunakan layanan Queen Laundry.</div>
</div>
<script>if(window.location.pathname.includes('/pdf'))window.print();</script>
</body></html>
