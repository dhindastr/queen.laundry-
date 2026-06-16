<?php $title='Tugas Delivery'; $roleLabel='Kurir'; $sidebarColor='var(--green)'; $userName=auth()->user()->name; ?>
<?php $__env->startSection('sidebar-nav'); ?> <?php echo $__env->make('components.nav-kurir', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if($tasks->isEmpty()): ?>
  <div class="card"><div class="card-body" style="text-align:center;padding:48px">
    <svg viewBox="0 0 24 24" style="width:40px;height:40px;stroke:var(--gray-300);fill:none;stroke-width:1.5;display:block;margin:0 auto 12px"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
    <div style="font-size:15px;font-weight:600;color:var(--gray-400)">Tidak ada tugas delivery saat ini</div>
  </div></div>
<?php else: ?>
<div style="display:grid;grid-template-columns:repeat(2,1fr);gap:14px">
  <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="card" style="margin-bottom:0">
    <div class="card-header">
      <span class="fw-700 text-brand">#<?php echo e(str_pad($o->id,3,'0',STR_PAD_LEFT)); ?></span>
      <span class="badge badge-teal"><span class="badge-dot" style="background:currentColor"></span><?php echo e($o->status_label); ?></span>
    </div>
    <div class="card-body">
      <div style="font-size:16px;font-weight:700;color:var(--gray-900);margin-bottom:8px"><?php echo e($o->customer->nama); ?></div>
      <div class="task-detail" style="margin-bottom:6px"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg><?php echo e($o->customer->alamat ?? 'Alamat tidak tersedia'); ?></div>
      <div class="task-detail" style="margin-bottom:6px"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12"/></svg><?php echo e($o->customer->no_telp ?? '—'); ?></div>
      <div class="task-detail" style="margin-bottom:6px"><svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>Rp <?php echo e(number_format($o->total_harga,0,',','.')); ?> (<?php echo e($o->total_berat); ?> kg)</div>
      <div class="task-detail" style="margin-bottom:14px"><svg viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/></svg><?php echo e($o->jenis_laundry); ?></div>
      <form method="POST" action="<?php echo e(route('kurir.delivery.konfirmasi',$o)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
          <label class="form-label">Foto Bukti Delivery</label>
          <input type="file" name="foto" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success" style="width:100%;justify-content:center" onclick="return confirm('Konfirmasi delivery selesai?')">
          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg> Konfirmasi Terkirim
        </button>
      </form>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac/Downloads/ql/resources/views/kurir/delivery.blade.php ENDPATH**/ ?>