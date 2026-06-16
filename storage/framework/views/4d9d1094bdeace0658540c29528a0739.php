<?php $title=$invoice->no_invoice; $roleLabel='Customer Portal'; $sidebarColor='var(--teal)'; $userName=auth('customer')->user()->nama; ?>
<?php $__env->startSection('sidebar-nav'); ?> <?php echo $__env->make('components.nav-customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('topbar-actions'); ?><a href="<?php echo e(route('customer.invoice.pdf',$invoice)); ?>" class="btn btn-primary btn-sm" target="_blank"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Cetak PDF</a><?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.invoice.partial', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac/Downloads/ql/resources/views/customer/invoice-show.blade.php ENDPATH**/ ?>