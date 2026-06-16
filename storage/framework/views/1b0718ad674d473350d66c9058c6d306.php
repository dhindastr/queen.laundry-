<?php $title='Riwayat Tugas'; $roleLabel='Kurir'; $sidebarColor='var(--green)'; $userName=auth()->user()->name; ?>
<?php $__env->startSection('sidebar-nav'); ?> <?php echo $__env->make('components.nav-kurir', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; ?>
<div class="stats-grid stats-3">
  <div class="stat-card"><div class="stat-icon ic-amber"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg></div><div class="stat-label">Total Pickup</div><div class="stat-value"><?php echo e($stats['total_pickup']); ?></div></div>
  <div class="stat-card"><div class="stat-icon ic-blue"><svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div><div class="stat-label">Total Delivery</div><div class="stat-value"><?php echo e($stats['total_delivery']); ?></div></div>
  <div class="stat-card"><div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><div class="stat-label">Total Selesai</div><div class="stat-value"><?php echo e($stats['total_selesai']); ?></div></div>
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Riwayat Semua Tugas</span></div>
  <div class="table-wrap"><table>
    <thead><tr><th>ID</th><th>Customer</th><th>Jenis</th><th>Berat</th><th>Tanggal</th><th>Peran</th><th>Status</th></tr></thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td class="fw-700 text-brand">#<?php echo e(str_pad($o->id,3,'0',STR_PAD_LEFT)); ?></td>
        <td><?php echo e($o->customer->nama); ?></td>
        <td><?php echo e($o->jenis_laundry); ?></td>
        <td><?php echo e($o->total_berat > 0 ? $o->total_berat.' kg' : '—'); ?></td>
        <td><?php echo e($o->tanggal_order->format('d M Y')); ?></td>
        <td>
          <?php if($o->kurir_pickup_id===auth()->id() && $o->kurir_delivery_id===auth()->id()): ?>
            <span class="badge badge-brand">Pickup + Delivery</span>
          <?php elseif($o->kurir_pickup_id===auth()->id()): ?>
            <span class="badge badge-amber">Pickup</span>
          <?php else: ?>
            <span class="badge badge-blue">Delivery</span>
          <?php endif; ?>
        </td>
        <td><span class="badge badge-<?php echo e($colors[$o->status]??'gray'); ?>"><span class="badge-dot" style="background:currentColor"></span><?php echo e($o->status_label); ?></span></td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr><td colspan="7" style="text-align:center;color:var(--gray-400);padding:32px">Belum ada riwayat</td></tr>
      <?php endif; ?>
    </tbody>
  </table></div>
  <?php if($orders->hasPages()): ?><div style="padding:14px 18px;border-top:1px solid var(--gray-100)"><?php echo e($orders->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac/Downloads/ql/resources/views/kurir/riwayat.blade.php ENDPATH**/ ?>