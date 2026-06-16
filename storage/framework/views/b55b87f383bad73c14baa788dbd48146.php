<?php $title='Order Saya'; $roleLabel='Customer Portal'; $sidebarColor='var(--teal)'; $userName=auth('customer')->user()->nama; ?>
<?php $__env->startSection('sidebar-nav'); ?> <?php echo $__env->make('components.nav-customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; ?>
<div class="filter-tabs">
  <?php $__currentLoopData = [''=>'Semua','menunggu_pickup'=>'Menunggu Pickup','proses'=>'Diproses','selesai'=>'Selesai']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <form method="GET" style="display:inline"><input type="hidden" name="status" value="<?php echo e($k); ?>"><button type="submit" class="filter-tab <?php echo e(request('status')===$k?'active':''); ?>"><?php echo e($v); ?></button></form>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="card">
  <div class="card-header"><span class="card-title">Riwayat Order (<?php echo e($orders->total()); ?>)</span><a href="<?php echo e(route('customer.pickup.create')); ?>" class="btn btn-primary btn-sm"><svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Baru</a></div>
  <div class="table-wrap"><table>
    <thead><tr><th>ID</th><th>Tanggal</th><th>Jenis</th><th>Berat</th><th>Total</th><th>Status</th><th></th></tr></thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td><span class="fw-700 text-brand">#<?php echo e(str_pad($o->id,3,'0',STR_PAD_LEFT)); ?></span></td>
        <td><?php echo e($o->tanggal_order->format('d M Y')); ?></td>
        <td><?php echo e($o->jenis_laundry); ?></td>
        <td><?php echo e($o->total_berat > 0 ? $o->total_berat.' kg' : '—'); ?></td>
        <td class="fw-600 text-green"><?php echo e($o->total_harga > 0 ? 'Rp '.number_format($o->total_harga,0,',','.') : '—'); ?></td>
        <td><span class="badge badge-<?php echo e($colors[$o->status]??'gray'); ?>"><span class="badge-dot" style="background:currentColor"></span><?php echo e($o->status_label); ?></span></td>
        <td><a href="<?php echo e(route('customer.orders.show',$o)); ?>" class="btn btn-secondary btn-sm">Detail</a></td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr><td colspan="7" style="text-align:center;color:var(--gray-400);padding:32px">Belum ada order</td></tr>
      <?php endif; ?>
    </tbody>
  </table></div>
  <?php if($orders->hasPages()): ?><div style="padding:14px 18px;border-top:1px solid var(--gray-100)"><?php echo e($orders->withQueryString()->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac/Downloads/ql/resources/views/customer/orders.blade.php ENDPATH**/ ?>