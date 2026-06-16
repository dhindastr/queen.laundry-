<?php $title='Detail Order'; $roleLabel='Customer Portal'; $sidebarColor='var(--teal)'; $userName=auth('customer')->user()->nama; ?>
<?php $__env->startSection('sidebar-nav'); ?> <?php echo $__env->make('components.nav-customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('topbar-actions'); ?><a href="<?php echo e(route('customer.orders.index')); ?>" class="btn btn-secondary btn-sm"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg> Kembali</a><?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; $statusOrder=array_keys(\App\Models\Order::$statusLabels); $curIdx=array_search($order->status,$statusOrder); ?>
<div class="grid-2">
  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">Detail Order #<?php echo e(str_pad($order->id,3,'0',STR_PAD_LEFT)); ?></span><span class="badge badge-<?php echo e($colors[$order->status]??'gray'); ?>"><span class="badge-dot" style="background:currentColor"></span><?php echo e($order->status_label); ?></span></div>
      <div class="card-body">
        <?php $__currentLoopData = [['Jenis Laundry',$order->jenis_laundry],['Tanggal Order',$order->tanggal_order->format('d M Y, H:i')],['Berat',$order->total_berat>0?$order->total_berat.' kg':'Belum ditimbang'],['Total Harga',$order->total_harga>0?'Rp '.number_format($order->total_harga,0,',','.'):'Dihitung setelah pickup'],['Kurir Pickup',$order->kurirPickup?->name??'Belum ditentukan'],['Catatan',$order->catatan??'—']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$l,$v]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="display:flex;gap:12px;padding:8px 0;border-bottom:1px solid var(--gray-50)"><div style="width:120px;font-size:12px;color:var(--gray-400);font-weight:600;flex-shrink:0"><?php echo e($l); ?></div><div style="font-size:13px;font-weight:500;color:var(--gray-800)"><?php echo e($v); ?></div></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    <?php if($order->invoice): ?>
    <div class="card">
      <div class="card-header"><span class="card-title">Invoice</span><span class="badge badge-green">Lunas</span></div>
      <div class="card-body" style="display:flex;justify-content:space-between;align-items:center">
        <div><div class="fw-700"><?php echo e($order->invoice->no_invoice); ?></div><div style="font-size:20px;font-weight:800;color:var(--brand)">Rp <?php echo e(number_format($order->invoice->total,0,',','.')); ?></div></div>
        <div style="display:flex;gap:8px">
          <a href="<?php echo e(route('customer.invoice.show',$order->invoice)); ?>" class="btn btn-secondary btn-sm">Lihat</a>
          <a href="<?php echo e(route('customer.invoice.pdf',$order->invoice)); ?>" class="btn btn-primary btn-sm" target="_blank">Cetak</a>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
  <div>
    <div class="card">
      <div class="card-header"><span class="card-title">Tracking Status</span></div>
      <div class="card-body">
        <div class="timeline">
          <?php $__currentLoopData = $order->statusLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="tl-item">
            <div class="tl-dot done"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
            <div><div class="tl-title"><?php echo e(\App\Models\Order::$statusLabels[$log->status]??$log->status); ?></div><div class="tl-time"><?php echo e($log->created_at->format('d M Y, H:i')); ?><?php echo e($log->catatan?' — '.$log->catatan:''); ?></div></div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac/Downloads/ql/resources/views/customer/order-show.blade.php ENDPATH**/ ?>