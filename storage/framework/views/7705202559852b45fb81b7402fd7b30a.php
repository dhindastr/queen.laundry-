<?php $title='Dashboard Admin'; $roleLabel='Admin Panel'; $sidebarColor='var(--brand)'; $userName=auth()->user()->name; ?>

<?php $__env->startSection('sidebar-nav'); ?>
  <?php echo $__env->make('components.nav-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('topbar-actions'); ?>
<button class="btn btn-primary btn-sm" data-modal-open="modal-tambah-order">
  <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
  Tambah Order
</button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Stats -->
<div class="stats-grid stats-4">
  <div class="stat-card">
    <div class="stat-icon ic-brand"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
    <div class="stat-label">Order Hari Ini</div>
    <div class="stat-value"><?php echo e($stats['order_hari_ini']); ?></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon ic-amber"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
    <div class="stat-label">Menunggu Pickup</div>
    <div class="stat-value"><?php echo e($stats['menunggu_pickup']); ?></div>
    <div class="stat-sub text-amber">Perlu assign kurir</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon ic-blue"><svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10"/><path d="M12 6v6l4 2"/></svg></div>
    <div class="stat-label">Sedang Diproses</div>
    <div class="stat-value"><?php echo e($stats['sedang_proses']); ?></div>
  </div>
  <div class="stat-card">
    <div class="stat-icon ic-green"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="stat-label">Selesai Bulan Ini</div>
    <div class="stat-value"><?php echo e($stats['selesai_bulan']); ?></div>
    <div class="stat-sub text-green">Rp <?php echo e(number_format($stats['pemasukan_bulan'],0,',','.')); ?></div>
  </div>
</div>

<div class="grid-2">
  <div>
    <!-- Recent Orders -->
    <div class="card">
      <div class="card-header">
        <span class="card-title">Order Terbaru</span>
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="card-action">Lihat semua →</a>
      </div>
      <div class="table-wrap">
        <table>
          <thead><tr><th>ID</th><th>Customer</th><th>Berat</th><th>Status</th><th></th></tr></thead>
          <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><span class="fw-700 text-brand">#<?php echo e(str_pad($order->id,3,'0',STR_PAD_LEFT)); ?></span></td>
              <td><?php echo e($order->customer->nama); ?></td>
              <td><?php echo e($order->total_berat > 0 ? $order->total_berat.' kg' : '—'); ?></td>
              <td>
                <?php $colors=['menunggu_pickup'=>'amber','pickup'=>'blue','proses'=>'brand','selesai_cuci'=>'gray','siap_delivery'=>'teal','delivery'=>'blue','selesai'=>'green']; ?>
                <span class="badge badge-<?php echo e($colors[$order->status]??'gray'); ?>">
                  <span class="badge-dot" style="background:currentColor"></span>
                  <?php echo e($order->status_label); ?>

                </span>
              </td>
              <td>
                <a href="<?php echo e(route('admin.orders.show',$order)); ?>" class="btn btn-secondary btn-sm">Detail</a>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" style="text-align:center;color:var(--gray-400);padding:24px">Belum ada order</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Status Summary -->
    <div class="card">
      <div class="card-header"><span class="card-title">Status Order Hari Ini</span></div>
      <div class="card-body">
        <?php
        $allStatuses=['menunggu_pickup'=>['Menunggu Pickup','amber'],'pickup'=>['Pickup','blue'],'proses'=>['Diproses','brand'],'siap_delivery'=>['Siap Delivery','teal'],'delivery'=>['Delivery','blue'],'selesai'=>['Selesai','green']];
        $total=max($statusSummary->sum("total"),1);
        ?>
        <?php $__currentLoopData = $allStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>[$label,$color]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $cnt=$statusSummary[$key]->total??0; ?>
        <div class="stok-row">
          <div style="width:10px;height:10px;border-radius:50%;background:var(--<?php echo e($color); ?>);flex-shrink:0"></div>
          <div class="stok-name"><?php echo e($label); ?></div>
          <div class="progress-track"><div class="progress-fill" style="width:<?php echo e($total>0?($cnt/$total*100):0); ?>%;background:var(--<?php echo e($color); ?>)"></div></div>
          <div style="width:24px;text-align:right;font-weight:700;font-size:13px"><?php echo e($cnt); ?></div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>

  <div>
    <!-- Assign Kurir Form -->
    <div class="card">
      <div class="card-header"><span class="card-title">Quick Assign Kurir</span></div>
      <div class="card-body">
        <?php $pendingOrders=\App\Models\Order::where('status','menunggu_pickup')->doesntHave('kurirPickup')->with('customer')->latest()->take(10)->get(); ?>
        <?php if($pendingOrders->isEmpty()): ?>
          <p style="color:var(--gray-400);font-size:13px;text-align:center;padding:16px 0">Tidak ada order menunggu pickup</p>
        <?php else: ?>
        <form method="POST" action="" id="form-assign">
          <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
          <div class="form-group">
            <label class="form-label">Order</label>
            <select class="form-control" name="order_id" id="sel-order">
              <option value="">— Pilih Order —</option>
              <?php $__currentLoopData = $pendingOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($o->id); ?>">#<?php echo e(str_pad($o->id,3,'0',STR_PAD_LEFT)); ?> — <?php echo e($o->customer->nama); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Kurir</label>
            <select class="form-control" name="kurir_pickup_id">
              <option value="">— Pilih Kurir —</option>
              <?php $__currentLoopData = $kurirList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($k->id); ?>"><?php echo e($k->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Jadwal Pickup</label>
            <input type="datetime-local" name="jadwal_pickup" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center" onclick="submitAssign(event)">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Konfirmasi Assign
          </button>
        </form>
        <script>
        function submitAssign(e){
          e.preventDefault();
          const sel=document.getElementById('sel-order');
          const id=sel.value; if(!id)return;
          const f=document.getElementById('form-assign');
          f.action='/admin/orders/'+id;
          f.submit();
        }
        </script>
        <?php endif; ?>
      </div>
    </div>

    <!-- Stok Kritis -->
    <div class="card">
      <div class="card-header">
        <span class="card-title">Stok Kritis</span>
        <?php if($stokKritis->isNotEmpty()): ?><span class="badge badge-red"><?php echo e($stokKritis->count()); ?> item</span><?php endif; ?>
        <a href="<?php echo e(route('admin.stok.index')); ?>" class="card-action">Kelola →</a>
      </div>
      <div class="card-body">
        <?php $__empty_1 = true; $__currentLoopData = $stokKritis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="stok-row">
          <div class="stok-name"><?php echo e($item->nama); ?></div>
          <div class="progress-track"><div class="progress-fill" style="width:<?php echo e(min(($item->stok/$item->stok_minimum)*100,100)); ?>%;background:var(--red)"></div></div>
          <span class="badge badge-red"><?php echo e($item->stok); ?> <?php echo e($item->satuan); ?></span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p style="color:var(--gray-400);font-size:13px;text-align:center;padding:12px 0">
          <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:currentColor;display:block;margin:0 auto 4px"><polyline points="20 6 9 17 4 12"/></svg>
          Semua stok aman
        </p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Order -->
<div class="modal-overlay" id="modal-tambah-order">
  <div class="modal">
    <div class="modal-header">
      <span class="modal-title">Tambah Order Baru</span>
      <button class="modal-close"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <form method="POST" action="<?php echo e(route('admin.orders.store')); ?>">
      <?php echo csrf_field(); ?>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Customer</label>
          <select name="customer_id" class="form-control" required>
            <option value="">— Pilih Customer —</option>
            <?php $__currentLoopData = $customerList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($c->id); ?>"><?php echo e($c->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="form-grid-2">
          <div class="form-group">
            <label class="form-label">Jenis Laundry</label>
            <select name="jenis_laundry" class="form-control">
              <option>Pakaian biasa</option><option>Pakaian kerja</option><option>Linen/Sprei</option><option>Karpet/Gordyn</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Harga / kg (Rp)</label>
            <input type="number" name="harga_per_kg" class="form-control" value="25000" required>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Catatan</label>
          <input type="text" name="catatan" class="form-control" placeholder="Instruksi khusus...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary modal-close">Batal</button>
        <button type="submit" class="btn btn-primary">
          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg> Simpan Order
        </button>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac/Downloads/ql/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>