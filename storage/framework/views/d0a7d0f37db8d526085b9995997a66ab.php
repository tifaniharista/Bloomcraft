<?php $__env->startSection('title', 'Daftar Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width:1400px;margin:0 auto;padding:24px 18px;">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:24px;">
        <div>
            <h1 style="margin:0;color:#263329;">Daftar Pesanan</h1>
            <p style="margin:8px 0 0;color:#64748b;">Kelola pesanan customer Bloomcraft dari panel admin.</p>
        </div>
        <div style="background:#edf1e8;color:#334735;padding:10px 14px;border-radius:10px;font-weight:600;">
            Total pesanan: <?php echo e($orders->count()); ?>

        </div>
    </div>

    <?php if(session('success')): ?>
        <div role="status" style="background:#dcfce7;color:#166534;padding:14px 16px;border-radius:10px;margin-bottom:18px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div role="alert" style="background:#fee2e2;color:#991b1b;padding:14px 16px;border-radius:10px;margin-bottom:18px;">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div role="alert" style="background:#fee2e2;color:#991b1b;padding:14px 16px;border-radius:10px;margin-bottom:18px;">
            <ul style="margin:0;padding-left:20px;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:16px;box-shadow:0 6px 22px rgba(0,0,0,.05);overflow:hidden;">
        <?php if($orders->isEmpty()): ?>
            <div style="padding:48px 20px;text-align:center;">
                <div style="font-size:40px;margin-bottom:12px;">🧾</div>
                <h2 style="margin:0 0 8px;color:#334735;">Belum ada pesanan</h2>
                <p style="margin:0;color:#64748b;">Pesanan customer akan muncul di halaman ini setelah dibuat.</p>
            </div>
        <?php else: ?>
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;min-width:900px;">
                    <thead>
                        <tr style="background:#f7f8f4;color:#475569;text-align:left;">
                            <th style="padding:15px 16px;font-size:12px;text-transform:uppercase;letter-spacing:.05em;">Pesanan</th>
                            <th style="padding:15px 16px;font-size:12px;text-transform:uppercase;letter-spacing:.05em;">Customer</th>
                            <th style="padding:15px 16px;font-size:12px;text-transform:uppercase;letter-spacing:.05em;">Tanggal</th>
                            <th style="padding:15px 16px;font-size:12px;text-transform:uppercase;letter-spacing:.05em;text-align:right;">Total</th>
                            <th style="padding:15px 16px;font-size:12px;text-transform:uppercase;letter-spacing:.05em;">Pembayaran</th>
                            <th style="padding:15px 16px;font-size:12px;text-transform:uppercase;letter-spacing:.05em;">Status Pesanan</th>
                            <th style="padding:15px 16px;font-size:12px;text-transform:uppercase;letter-spacing:.05em;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $orderStatus = $order->order_status ?: $order->status ?: 'pending';
                                $orderStatusLabels = [
                                    'awaiting_payment' => 'Menunggu pembayaran',
                                    'pending_payment' => 'Menunggu pembayaran',
                                    'payment_review' => 'Verifikasi pembayaran',
                                    'processing' => 'Diproses',
                                    'process' => 'Diproses',
                                    'ready_to_ship' => 'Siap dikirim',
                                    'shipped' => 'Dikirim',
                                    'completed' => 'Selesai',
                                    'success' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                    'cancel' => 'Dibatalkan',
                                    'expired' => 'Kedaluwarsa',
                                    'pending' => 'Menunggu',
                                ];
                                $paymentStatus = $order->payment_status ?: 'not_started';
                                $paymentStatusLabels = [
                                    'not_started' => 'Belum dibayar',
                                    'pending' => 'Menunggu pembayaran',
                                    'under_review' => 'Menunggu verifikasi',
                                    'paid' => 'Terverifikasi',
                                    'rejected' => 'Ditolak',
                                    'cancelled' => 'Dibatalkan',
                                ];
                                $isCompleted = $order->order_status === 'completed';
                            ?>
                            <tr style="border-top:1px solid #edf0e9;">
                                <td style="padding:16px;vertical-align:top;">
                                    <strong style="display:block;color:#263329;"><?php echo e($order->order_number ?: ('#' . $order->id)); ?></strong>
                                    <span style="font-size:12px;color:#64748b;">ID: <?php echo e($order->id); ?></span>
                                </td>
                                <td style="padding:16px;vertical-align:top;">
                                    <strong style="display:block;color:#263329;"><?php echo e($order->name ?: ($order->user->name ?? 'Customer')); ?></strong>
                                    <span style="font-size:12px;color:#64748b;"><?php echo e($order->phone ?: 'Telepon belum diisi'); ?></span>
                                </td>
                                <td style="padding:16px;vertical-align:top;color:#475569;">
                                    <?php echo e(optional($order->created_at)->format('d M Y, H:i') ?: '-'); ?>

                                </td>
                                <td style="padding:16px;vertical-align:top;text-align:right;white-space:nowrap;font-weight:600;color:#263329;">
                                    Rp <?php echo e(number_format((float) $order->total, 0, ',', '.')); ?>

                                    <div style="font-size:11px;color:#64748b;font-weight:400;">Ongkir gratis</div>
                                </td>
                                <td style="padding:16px;vertical-align:top;">
                                    <span style="display:inline-block;padding:6px 9px;border-radius:999px;background:<?php echo e($paymentStatus === 'paid' ? '#dcfce7' : ($paymentStatus === 'rejected' ? '#fee2e2' : '#fef3c7')); ?>;color:<?php echo e($paymentStatus === 'paid' ? '#166534' : ($paymentStatus === 'rejected' ? '#991b1b' : '#92400e')); ?>;font-size:12px;font-weight:600;">
                                        <?php echo e($paymentStatusLabels[$paymentStatus] ?? ucfirst(str_replace('_', ' ', $paymentStatus))); ?>

                                    </span>
                                </td>
                                <td style="padding:16px;vertical-align:top;">
                                    <span style="display:inline-block;padding:6px 9px;border-radius:999px;background:<?php echo e($isCompleted ? '#dcfce7' : ($orderStatus === 'cancelled' || $orderStatus === 'cancel' ? '#fee2e2' : '#f1f5f9')); ?>;color:<?php echo e($isCompleted ? '#166534' : ($orderStatus === 'cancelled' || $orderStatus === 'cancel' ? '#991b1b' : '#475569')); ?>;font-size:12px;font-weight:600;">
                                        <?php echo e($orderStatusLabels[$orderStatus] ?? ucfirst(str_replace('_', ' ', $orderStatus))); ?>

                                    </span>
                                </td>
                                <td style="padding:16px;vertical-align:top;white-space:nowrap;">
                                    <a href="<?php echo e(route('admin.orders.show', $order)); ?>"
                                       style="display:inline-block;background:#2563eb;color:#fff;padding:9px 12px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;margin:0 5px 5px 0;">
                                        Detail
                                    </a>

                                    <?php if($isCompleted): ?>
                                        <form action="<?php echo e(route('admin.orders.destroy', $order)); ?>"
                                              method="POST"
                                              style="display:inline-block;"
                                              onsubmit="return confirm('Yakin ingin menghapus pesanan yang sudah selesai ini? Tindakan ini tidak dapat dibatalkan.');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                    style="background:#b91c1c;color:#fff;padding:9px 12px;border:0;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;">
                                                Hapus
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>