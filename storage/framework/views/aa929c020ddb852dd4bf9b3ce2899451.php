<?php $title='Dashboard Kurir'; $roleLabel='Kurir'; $sidebarColor='var(--green)'; $userName=auth()->user()->name; ?>
<?php $__env->startSection('sidebar-nav'); ?> <?php echo $__env->make('components.nav-kurir', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; ?>
<div class="stats-grid stats-3">
  <div class="stat-card"><div class="stat-icon ic-amber"><svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg></div><div class="stat-label">Antrian Pickup</div><div class="stat-value"><?php echo e($pickupQueue->count()); ?></div></div>
  <div class="stat-card"><div class="stat-icon ic-blue"><svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div><div class="stat-label">Antrian Delivery</div><div class="stat-value"><?php echo e($deliveryQueue->count()); ?></div></div>
  <div class="stat-card"><div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><div class="stat-label">Selesai Hari Ini</div><div class="stat-value"><?php echo e($todayDone); ?></div></div>
</div>
<div class="grid-2">
  <div class="card">
    <div class="card-header"><span class="card-title">Tugas Pickup Saat Ini</span><a href="<?php echo e(route('kurir.pickup.index')); ?>" class="card-action">Lihat semua →</a></div>
    <div class="card-body">
      <?php $__empty_1 = true; $__currentLoopData = $pickupQueue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="task-card priority">
        <div style="display:flex;justify-content:space-between"><span class="fw-700 text-brand">#<?php echo e(str_pad($o->id,3,'0',STR_PAD_LEFT)); ?></span><span class="badge badge-amber"><span class="badge-dot" style="background:currentColor"></span><?php echo e($o->status_label); ?></span></div>
        <div class="task-name"><?php echo e($o->customer->nama); ?></div>
        <div class="task-detail"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg><?php echo e($o->customer->alamat ?? 'Alamat tidak tersedia'); ?></div>
        <div class="task-detail"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg><?php echo e($o->jadwal_pickup ? $o->jadwal_pickup->format('d M, H:i') : 'Jadwal belum ditentukan'); ?></div>
        <div style="margin-top:10px"><a href="<?php echo e(route('kurir.pickup.index')); ?>" class="btn btn-primary btn-sm">Proses Pickup</a></div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <p style="color:var(--gray-400);font-size:13px;text-align:center;padding:24px 0">Tidak ada tugas pickup</p>
      <?php endif; ?>
    </div>
  </div>
  <div class="card">
    <div class="card-header"><span class="card-title">Tugas Delivery Saat Ini</span><a href="<?php echo e(route('kurir.delivery.index')); ?>" class="card-action">Lihat semua →</a></div>
    <div class="card-body">
      <?php $__empty_1 = true; $__currentLoopData = $deliveryQueue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="task-card ready">
        <div style="display:flex;justify-content:space-between"><span class="fw-700 text-brand">#<?php echo e(str_pad($o->id,3,'0',STR_PAD_LEFT)); ?></span><span class="badge badge-teal"><span class="badge-dot" style="background:currentColor"></span><?php echo e($o->status_label); ?></span></div>
        <div class="task-name"><?php echo e($o->customer->nama); ?></div>
        <div class="task-detail"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg><?php echo e($o->customer->alamat ?? 'Alamat tidak tersedia'); ?></div>
        <div class="task-detail"><svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>Rp <?php echo e(number_format($o->total_harga,0,',','.')); ?></div>
        <div style="margin-top:10px"><a href="<?php echo e(route('kurir.delivery.index')); ?>" class="btn btn-success btn-sm">Proses Delivery</a></div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <p style="color:var(--gray-400);font-size:13px;text-align:center;padding:24px 0">Tidak ada tugas delivery</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php if($recentLogs->isNotEmpty()): ?>
<div class="card">
  <div class="card-header"><span class="card-title">Aktivitas Terbaru</span></div>
  <div class="table-wrap"><table>
    <thead><tr><th>Order</th><th>Customer</th><th>Status</th><th>Waktu</th></tr></thead>
    <tbody>
      <?php $__currentLoopData = $recentLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td class="fw-700 text-brand">#<?php echo e(str_pad($log->order_id,3,'0',STR_PAD_LEFT)); ?></td>
        <td><?php echo e($log->order->customer->nama); ?></td>
        <td><span class="badge badge-<?php echo e($colors[$log->status]??'gray'); ?>"><?php echo e(\App\Models\Order::$statusLabels[$log->status]??$log->status); ?></span></td>
        <td><?php echo e($log->created_at->diffForHumans()); ?></td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table></div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac/Downloads/ql/resources/views/kurir/dashboard.blade.php ENDPATH**/ ?>