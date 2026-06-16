<div style="max-width:680px;margin:0 auto;padding:32px;font-family:Arial,sans-serif;font-size:13px;color:#111">
  <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:28px;padding-bottom:18px;border-bottom:2px solid #4F46E5">
    <div>
      <div style="font-size:22px;font-weight:800;color:#4F46E5">Queen Laundry</div>
      <div style="font-size:12px;color:#6B7280;margin-top:2px">Management System · Surabaya</div>
    </div>
    <div style="text-align:right">
      <div style="background:#EEF2FF;color:#3730A3;padding:6px 14px;border-radius:6px;font-size:13px;font-weight:700;display:inline-block">INVOICE</div>
      <div style="font-size:12px;color:#6B7280;margin-top:4px">{{ $invoice->no_invoice }}</div>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:24px">
    <div>
      <p style="margin:0 0 4px;font-size:11px;text-transform:uppercase;letter-spacing:.06em;color:#9CA3AF;font-weight:600">Tagihan Kepada</p>
      <h3 style="margin:0 0 4px;font-size:15px;font-weight:700">{{ $invoice->order->customer->nama }}</h3>
      <span style="font-size:12px;color:#6B7280">{{ $invoice->order->customer->no_telp ?? '' }}<br>{{ $invoice->order->customer->alamat ?? '' }}</span>
    </div>
    <div>
      <p style="margin:0 0 4px;font-size:11px;text-transform:uppercase;letter-spacing:.06em;color:#9CA3AF;font-weight:600">Detail Invoice</p>
      <h3 style="margin:0 0 4px;font-size:15px;font-weight:700">{{ $invoice->no_invoice }}</h3>
      <span style="font-size:12px;color:#6B7280">Tanggal: {{ $invoice->created_at->format('d M Y') }}<br>Order: #{{ str_pad($invoice->order_id,3,'0',STR_PAD_LEFT) }}</span>
    </div>
  </div>

  <table style="width:100%;border-collapse:collapse;margin-bottom:20px">
    <thead>
      <tr style="background:#F9FAFB">
        <th style="padding:10px 14px;text-align:left;font-size:11px;text-transform:uppercase;letter-spacing:.06em;color:#6B7280;border-bottom:1px solid #E5E7EB">Deskripsi</th>
        <th style="padding:10px 14px;text-align:left;font-size:11px;text-transform:uppercase;color:#6B7280;border-bottom:1px solid #E5E7EB">Berat</th>
        <th style="padding:10px 14px;text-align:left;font-size:11px;text-transform:uppercase;color:#6B7280;border-bottom:1px solid #E5E7EB">Harga/kg</th>
        <th style="padding:10px 14px;text-align:right;font-size:11px;text-transform:uppercase;color:#6B7280;border-bottom:1px solid #E5E7EB">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding:12px 14px;border-bottom:1px solid #F3F4F6">
          <strong>{{ $invoice->order->jenis_laundry }}</strong>
          @if($invoice->order->catatan)<br><small style="color:#6B7280">{{ $invoice->order->catatan }}</small>@endif
        </td>
        <td style="padding:12px 14px;border-bottom:1px solid #F3F4F6">{{ $invoice->order->total_berat }} kg</td>
        <td style="padding:12px 14px;border-bottom:1px solid #F3F4F6">Rp {{ number_format($invoice->order->harga_per_kg,0,',','.') }}</td>
        <td style="padding:12px 14px;border-bottom:1px solid #F3F4F6;text-align:right;font-weight:700">Rp {{ number_format($invoice->subtotal,0,',','.') }}</td>
      </tr>
    </tbody>
  </table>

  <div style="display:flex;justify-content:flex-end">
    <div style="background:#F9FAFB;border-radius:10px;padding:16px 24px;min-width:220px">
      <div style="display:flex;justify-content:space-between;gap:32px;margin-bottom:6px;font-size:13px">
        <span>Subtotal</span><span>Rp {{ number_format($invoice->subtotal,0,',','.') }}</span>
      </div>
      <div style="font-size:18px;font-weight:800;color:#4F46E5;padding-top:8px;border-top:1px solid #E5E7EB;margin-top:8px;display:flex;justify-content:space-between">
        <span>Total</span><span>Rp {{ number_format($invoice->total,0,',','.') }}</span>
      </div>
      <div><span style="display:inline-block;background:#ECFDF5;color:#059669;padding:4px 12px;border-radius:4px;font-size:12px;font-weight:700;margin-top:10px">&#10003; LUNAS</span></div>
    </div>
  </div>

  <div style="margin-top:36px;padding-top:14px;border-top:1px solid #E5E7EB;font-size:11px;color:#9CA3AF;text-align:center">
    Terima kasih atas kepercayaan Anda menggunakan layanan Queen Laundry.
  </div>
</div>
