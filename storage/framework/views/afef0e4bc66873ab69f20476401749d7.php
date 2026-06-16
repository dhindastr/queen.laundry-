<?php $title='Kelola Order'; $roleLabel='Admin Panel'; $userName=auth()->user()->name; ?>
<?php $__env->startSection('sidebar-nav'); ?> <?php echo $__env->make('components.nav-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('topbar-actions'); ?>
<button class="btn btn-primary btn-sm" data-modal-open="modal-order">
  <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Tambah Order
</button>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; ?>
<div class="search-bar">
  <form method="GET" style="display:flex;gap:8px;width:100%">
    <div class="search-wrap">
      <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" name="search" class="search-input" placeholder="Cari customer..." value="<?php echo e(request('search')); ?>">
    </div>
    <select name="status" class="form-control" style="width:180px" onchange="this.form.submit()">
      <option value="">Semua Status</option>
      <?php $__currentLoopData = \App\Models\Order::$statusLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($k); ?>" <?php echo e(request('status')===$k?'selected':''); ?>><?php echo e($v); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <button type="submit" class="btn btn-secondary btn-sm">Cari</button>
    <?php if(request('search')||request('status')): ?><a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-secondary btn-sm">Reset</a><?php endif; ?>
  </form>
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Daftar Order (<?php echo e($orders->total()); ?>)</span></div>
  <div class="table-wrap">
    <table>
      <thead><tr><th>ID</th><th>Customer</th><th>Jenis</th><th>Berat</th><th>Total</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><span class="fw-700 text-brand">#<?php echo e(str_pad($o->id,3,'0',STR_PAD_LEFT)); ?></span></td>
          <td class="fw-600"><?php echo e($o->customer->nama); ?></td>
          <td><?php echo e($o->jenis_laundry); ?></td>
          <td><?php echo e($o->total_berat > 0 ? $o->total_berat.' kg' : '—'); ?></td>
          <td class="fw-600 text-green"><?php echo e($o->total_harga > 0 ? 'Rp '.number_format($o->total_harga,0,',','.') : '—'); ?></td>
          <td><?php echo e($o->tanggal_order->format('d M Y')); ?></td>
          <td><span class="badge badge-<?php echo e($colors[$o->status]??'gray'); ?>"><span class="badge-dot" style="background:currentColor"></span><?php echo e($o->status_label); ?></span></td>
          <td>
            <div style="display:flex;gap:6px">
              <a href="<?php echo e(route('admin.orders.show',$o)); ?>" class="btn btn-secondary btn-sm">Detail</a>
            </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="8" style="text-align:center;color:var(--gray-400);padding:32px">Belum ada order</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($orders->hasPages()): ?>
  <div style="padding:14px 18px;border-top:1px solid var(--gray-100)"><?php echo e($orders->withQueryString()->links()); ?></div>
  <?php endif; ?>
</div>

<!-- Modal Tambah Order -->
<div class="modal-overlay" id="modal-order">
  <div class="modal">
    <div class="modal-header"><span class="modal-title">Tambah Order Baru</span><button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <form method="POST" action="<?php echo e(route('admin.orders.store')); ?>">
      <?php echo csrf_field(); ?>
      <div class="modal-body">
        <div class="form-group"><label class="form-label">Customer</label><select name="customer_id" class="form-control" required><option value="">— Pilih Customer —</option><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($c->id); ?>"><?php echo e($c->nama); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
        <div class="form-grid-2">
          <div class="form-group"><label class="form-label">Jenis Laundry</label><select name="jenis_laundry" class="form-control"><option>Pakaian biasa</option><option>Pakaian kerja</option><option>Linen/Sprei</option><option>Karpet/Gordyn</option></select></div>
          <div class="form-group"><label class="form-label">Harga/kg (Rp)</label><input type="number" name="harga_per_kg" class="form-control" value="25000" required></div>
        </div>
        <div class="form-group"><label class="form-label">Catatan</label><input type="text" name="catatan" class="form-control" placeholder="Instruksi khusus..."></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary modal-close">Batal</button><button type="submit" class="btn btn-primary"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg> Simpan</button></div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac/Downloads/ql/resources/views/admin/orders/index.blade.php ENDPATH**/ ?>