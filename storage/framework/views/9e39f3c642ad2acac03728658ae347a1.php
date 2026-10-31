<?php $__env->startSection('title', 'Daftar Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .orders-page {
        --op-green: #496b55;
        --op-green-dark: #304b39;
        --op-sage: #edf3eb;
        --op-border: #e3e8e0;
        --op-text: #29332c;
        --op-muted: #788078;
        width: 100%;
        color: var(--op-text);
    }

    .orders-page * { box-sizing: border-box; }

    .orders-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 25px;
    }

    .orders-eyebrow {
        margin: 0 0 8px;
        color: var(--op-green);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .orders-title {
        margin: 0;
        color: var(--op-text);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 600;
    }

    .orders-description {
        margin: 9px 0 0;
        color: var(--op-muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .orders-total {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 11px 15px;
        border: 1px solid #dce8d9;
        border-radius: 11px;
        background: var(--op-sage);
        color: var(--op-green-dark);
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .orders-total-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 27px;
        height: 27px;
        padding: 0 7px;
        border-radius: 8px;
        background: #fff;
        color: var(--op-green-dark);
        font-size: 12px;
    }

    .orders-alert {
        margin-bottom: 17px;
        padding: 14px 16px;
        border-radius: 11px;
        font-size: 13px;
        line-height: 1.7;
    }

    .orders-alert-success {
        border: 1px solid #d2e8d3;
        background: #edf7ed;
        color: #27613a;
    }

    .orders-alert-error {
        border: 1px solid #f1d0cd;
        background: #fff0ef;
        color: #a33131;
    }

    .orders-alert ul { margin: 6px 0 0; padding-left: 20px; }

    .orders-card {
        overflow: hidden;
        border: 1px solid var(--op-border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 8px 26px rgba(40, 60, 42, .045);
    }

    .orders-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        padding: 20px 23px;
        border-bottom: 1px solid var(--op-border);
    }

    .orders-card-header h2 {
        margin: 0;
        color: var(--op-text);
        font-size: 16px;
        font-weight: 700;
    }

    .orders-card-caption {
        margin: 5px 0 0;
        color: var(--op-muted);
        font-size: 12px;
    }

    .orders-table-wrap { width: 100%; overflow-x: auto; }

    .orders-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .orders-table thead th {
        padding: 15px 16px;
        border-bottom: 1px solid var(--op-border);
        background: #f7f8f5;
        color: #68736a;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .8px;
        text-align: left;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .orders-table tbody td {
        padding: 17px 16px;
        border-bottom: 1px solid #eef0eb;
        color: var(--op-text);
        font-size: 12px;
        line-height: 1.6;
        vertical-align: top;
    }

    .orders-table tbody tr:last-child td { border-bottom: 0; }
    .orders-table tbody tr { transition: background .15s; }
    .orders-table tbody tr:hover { background: #fcfdfb; }

    .order-number {
        display: block;
        color: var(--op-text);
        font-size: 13px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .order-meta {
        display: block;
        margin-top: 4px;
        color: var(--op-muted);
        font-size: 11px;
    }

    .order-customer {
        display: block;
        color: var(--op-text);
        font-size: 12px;
        font-weight: 700;
    }

    .order-date { color: #58645a; white-space: nowrap; }

    .order-total {
        color: var(--op-green-dark);
        font-size: 13px;
        font-weight: 700;
        text-align: right;
        white-space: nowrap;
    }

    .order-shipping {
        display: block;
        margin-top: 3px;
        color: var(--op-muted);
        font-size: 10px;
        font-weight: 400;
    }

    .order-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 9px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        line-height: 1.35;
        white-space: nowrap;
    }

    .badge-paid { background: #e4f3e5; color: #27613a; }
    .badge-rejected { background: #fff0ef; color: #a33131; }
    .badge-waiting { background: #fff4dc; color: #946316; }
    .badge-neutral { background: #eef1f3; color: #53616b; }
    .badge-completed { background: #e4f3e5; color: #27613a; }
    .badge-cancelled { background: #fff0ef; color: #a33131; }

    .order-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-wrap: wrap;
        white-space: nowrap;
    }

    .order-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 34px;
        padding: 8px 11px;
        border: 0;
        border-radius: 8px;
        font-family: inherit;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none !important;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .order-action:hover { transform: translateY(-1px); }
    .order-action-detail { background: var(--op-sage); color: var(--op-green-dark) !important; }
    .order-action-detail:hover { background: #dfeadd; }
    .order-action-delete { background: #fff0ef; color: #a33131; }
    .order-action-delete:hover { background: #fbe1df; }

    .orders-empty {
        padding: 55px 20px !important;
        text-align: center;
        color: var(--op-muted) !important;
    }

    .orders-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 58px;
        height: 58px;
        margin: 0 auto 15px;
        border-radius: 17px;
        background: var(--op-sage);
        color: var(--op-green);
        font-size: 25px;
    }

    .orders-empty strong {
        display: block;
        margin-bottom: 6px;
        color: var(--op-text);
        font-size: 15px;
    }

    .orders-empty span { font-size: 12px; }

    @media (max-width: 700px) {
        .orders-heading { align-items: stretch; }
        .orders-total { justify-content: space-between; }
        .orders-card-header { padding: 17px; }
        .orders-table thead th,
        .orders-table tbody td { padding: 13px; }
    }
</style>

<div class="orders-page">
    <header class="orders-heading">
        <div>
            <p class="orders-eyebrow">Bloomcraft Admin</p>
            <h1 class="orders-title">Daftar Pesanan</h1>
            <p class="orders-description">
                Pantau pembayaran dan kelola pesanan customer Bloomcraft.
            </p>
        </div>

        <div class="orders-total">
            <span>Total pesanan</span>
            <span class="orders-total-number"><?php echo e($orders->count()); ?></span>
        </div>
    </header>

    <?php if(session('success')): ?>
        <div class="orders-alert orders-alert-success" role="status">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="orders-alert orders-alert-error" role="alert">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="orders-alert orders-alert-error" role="alert">
            <strong>Ada data yang perlu diperiksa.</strong>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <section class="orders-card">
        <div class="orders-card-header">
            <div>
                <h2>Semua Pesanan</h2>
                <p class="orders-card-caption">Informasi customer, pembayaran, dan status pemesanan.</p>
            </div>
        </div>

        <?php if($orders->isEmpty()): ?>
            <div class="orders-empty">
                <div class="orders-empty-icon" aria-hidden="true">♡</div>
                <strong>Belum ada pesanan</strong>
                <span>Pesanan customer akan muncul di halaman ini setelah dibuat.</span>
            </div>
        <?php else: ?>
            <div class="orders-table-wrap">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Pesanan</th>
                            <th>Customer</th>
                            <th>Tanggal</th>
                            <th style="text-align:right;">Total</th>
                            <th>Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Aksi</th>
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

                                $paymentBadgeClass = $paymentStatus === 'paid'
                                    ? 'badge-paid'
                                    : ($paymentStatus === 'rejected'
                                        ? 'badge-rejected'
                                        : (in_array($paymentStatus, ['pending', 'under_review', 'not_started'], true)
                                            ? 'badge-waiting'
                                            : 'badge-neutral'));

                                $orderBadgeClass = $isCompleted
                                    ? 'badge-completed'
                                    : (in_array($orderStatus, ['cancelled', 'cancel'], true)
                                        ? 'badge-cancelled'
                                        : 'badge-neutral');
                            ?>

                            <tr>
                                <td>
                                    <span class="order-number">
                                        <?php echo e($order->order_number ?: ('#' . $order->id)); ?>

                                    </span>
                                    <span class="order-meta">ID: <?php echo e($order->id); ?></span>
                                </td>

                                <td>
                                    <span class="order-customer">
                                        <?php echo e($order->name ?: ($order->user->name ?? 'Customer')); ?>

                                    </span>
                                    <span class="order-meta">
                                        <?php echo e($order->phone ?: 'Telepon belum diisi'); ?>

                                    </span>
                                </td>

                                <td>
                                    <span class="order-date">
                                        <?php echo e(optional($order->created_at)->format('d M Y, H:i') ?: '-'); ?>

                                    </span>
                                </td>

                                <td>
                                    <div class="order-total">
                                        Rp <?php echo e(number_format((float) $order->total, 0, ',', '.')); ?>

                                        <span class="order-shipping">Ongkir gratis</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="order-badge <?php echo e($paymentBadgeClass); ?>">
                                        <?php echo e($paymentStatusLabels[$paymentStatus] ?? ucfirst(str_replace('_', ' ', $paymentStatus))); ?>

                                    </span>
                                </td>

                                <td>
                                    <span class="order-badge <?php echo e($orderBadgeClass); ?>">
                                        <?php echo e($orderStatusLabels[$orderStatus] ?? ucfirst(str_replace('_', ' ', $orderStatus))); ?>

                                    </span>
                                </td>

                                <td>
                                    <div class="order-actions">
                                        <a
                                            href="<?php echo e(route('admin.orders.show', $order)); ?>"
                                            class="order-action order-action-detail"
                                        >
                                            Detail
                                        </a>

                                        <?php if($isCompleted): ?>
                                            <form
                                                action="<?php echo e(route('admin.orders.destroy', $order)); ?>"
                                                method="POST"
                                                style="display:inline-block;"
                                                onsubmit="return confirm('Yakin ingin menghapus pesanan yang sudah selesai ini? Tindakan ini tidak dapat dibatalkan.');"
                                            >
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="order-action order-action-delete">
                                                    Hapus
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>