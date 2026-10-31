<?php $__env->startSection('title', 'Pesanan Saya'); ?>

<?php $__env->startSection('content'); ?>
<section style="max-width:1100px;margin:0 auto;padding:40px 20px;">
    <h1>Pesanan Saya</h1>

    <?php if (session('error')): ?>
        <div style="background:#fee2e2;padding:15px;border-radius:10px;color:#991b1b;margin-bottom:20px;">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if ($errors->any()): ?>
        <div style="background:#fee2e2;padding:15px;border-radius:10px;color:#991b1b;margin-bottom:20px;">
            <ul>
                <?php foreach ($errors->all() as $error): ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (session('success')): ?>
        <div style="background:#dcfce7;padding:15px;border-radius:10px;color:#166534;margin-bottom:25px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if ($orders->isEmpty()): ?>
        <p>Belum ada pesanan.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <article style="background:white;padding:24px;border-radius:16px;margin-bottom:24px;box-shadow:0 6px 22px rgba(0,0,0,.07);">
                <h2>Pesanan <?php echo e($order->order_number ?: ('#' . $order->id)); ?></h2>
                <p>Tanggal pesanan: <?php echo e(optional($order->created_at)->format('d M Y')); ?></p>

                <div style="margin-top:20px;background:#f8fafc;padding:20px;border-radius:14px;border:1px solid #e5e7eb;">
                    <h3>Informasi Pemesan</h3>
                    <p><strong>Nama:</strong><br><?php echo e($order->name); ?></p>

                    <?php
                        $phoneLockedStatuses = [
                            'completed',
                            'done',
                            'cancelled',
                            'canceled',
                            'expired',
                        ];

                        $phoneCanBeEdited = !in_array($order->order_status, $phoneLockedStatuses, true)
                            && !in_array($order->status, [
                                'success',
                                'completed',
                                'done',
                                'cancel',
                                'cancelled',
                                'canceled',
                                'expired',
                            ], true)
                            && !in_array($order->payment_status, [
                                'cancelled',
                                'canceled',
                                'expired',
                            ], true);

                        // Old input hanya ditampilkan pada pesanan yang form-nya dikirim.
                        $phoneInputValue = (string) old('order_id') === (string) $order->id
                            ? old('phone', $order->phone)
                            : $order->phone;
                    ?>

                    <div style="margin:12px 0;">
                        <label for="phone-<?php echo e($order->id); ?>" style="display:block;font-weight:600;margin-bottom:6px;">
                            Nomor telepon
                        </label>
                        <small style="display:block;color:#64748b;margin-bottom:8px;">
                            Format nomor telepon: <strong>+62 XXX-XXXX-XXXX</strong>.
                        </small>

                        <?php if ($phoneCanBeEdited): ?>
                            <form method="POST" action="<?php echo e(route('orders.phone.update', $order)); ?>" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                                <input
                                    id="phone-<?php echo e($order->id); ?>"
                                    type="tel"
                                    name="phone"
                                    value="<?php echo e($phoneInputValue); ?>"
                                    maxlength="17"
                                    placeholder="+62 812-3456-7890"
                                    required
                                    autocomplete="tel"
                                    inputmode="tel"
                                    pattern="\+62 [0-9]{3}-[0-9]{4}-[0-9]{4}"
                                    aria-describedby="phone-help-<?php echo e($order->id); ?>"
                                    style="width:100%;max-width:320px;padding:10px 12px;border:1px solid #cbd5e1;border-radius:8px;"
                                >
                                <button
                                    type="submit"
                                    style="padding:10px 14px;background:#374151;color:white;border:0;border-radius:8px;cursor:pointer;"
                                >
                                    Simpan Nomor Telepon
                                </button>
                            </form>
                            <small id="phone-help-<?php echo e($order->id); ?>" style="display:block;color:#64748b;margin-top:6px;">
                                Format wajib: +62 XXX-XXXX-XXXX. Nomor telepon dapat diubah selama pesanan belum selesai.
                            </small>
                        <?php else: ?>
                            <p style="margin:0;"><?php echo e($order->phone); ?></p>
                            <small style="display:block;color:#64748b;margin-top:6px;">
                                Nomor telepon tidak dapat diubah karena pesanan sudah selesai, dibatalkan, atau kedaluwarsa.
                            </small>
                        <?php endif; ?>
                    </div>

                    <p><strong>Alamat pengiriman:</strong><br><?php echo e($order->address); ?></p>
                </div>

                <?php
                    $statusLabels = [
                        'awaiting_shipping_quote' => 'Menunggu pembayaran',
                        'awaiting_payment' => 'Menunggu pembayaran',
                        'payment_review' => 'Bukti pembayaran sedang diverifikasi',
                        'ready_to_ship' => 'Barang siap dikirim',
                        'pending_payment' => 'Menunggu pembayaran',
                        'processing' => 'Pembayaran terkonfirmasi — pesanan diproses',
                        'shipped' => 'Pesanan telah dikirim',
                        'completed' => 'Pesanan selesai',
                        'cancelled' => 'Pesanan dibatalkan',
                        'expired' => 'Pesanan kedaluwarsa',
                    ];
                    $displayStatus = $order->order_status ?: $order->status;
                    $payment = $order->payments->sortByDesc('id')->first();
                ?>
                <h3>Status Pesanan</h3>
                <div style="background:#fef3c7;color:#92400e;padding:14px;border-radius:12px;font-weight:bold;">
                    <?php echo e($statusLabels[$displayStatus] ?? ucfirst(str_replace('_', ' ', $displayStatus ?? 'pending'))); ?>

                </div>
                <p>Status pembayaran: <strong><?php echo e(ucfirst(str_replace('_', ' ', $order->payment_status ?? 'not_started'))); ?></strong></p>
                <p><strong>Ongkir:</strong> Gratis</p>

                
                <?php if ($payment && !empty($payment->proof_path)): ?>
                    <div style="margin:16px 0;">
                        <a
                            href="<?php echo e(route('orders.invoice', $order)); ?>"
                            style="display:inline-block;background:#465b47;color:#fff;padding:11px 18px;border-radius:9px;text-decoration:none;font-weight:600;"
                        >
                            Lihat Invoice / Bukti Pesanan
                        </a>
                    </div>
                <?php else: ?>
                    <p style="margin:12px 0;color:#64748b;font-size:14px;">
                        Invoice tersedia setelah bukti pembayaran berhasil diunggah.
                    </p>
                <?php endif; ?>

                <?php if ($order->payment_status !== 'paid' && !in_array($order->order_status, ['cancelled', 'completed'], true)): ?>
                    <h3>Instruksi Pembayaran</h3>
                    <p>Transfer sebesar <strong>Rp <?php echo e(number_format((float) $order->total, 0, ',', '.')); ?></strong> ke rekening resmi Bloomcraft. Jangan membagikan PIN atau kata sandi bank.</p>
                    <?php if (config('bloomcraft.bank_account_number')): ?>
                        <div style="background:#f8fafc;padding:15px;border-radius:12px;">
                            <p><strong>Bank:</strong> <?php echo e(config('bloomcraft.bank_name')); ?></p>
                            <p><strong>Nama pemilik:</strong> <?php echo e(config('bloomcraft.bank_account_name')); ?></p>
                            <p><strong>Nomor rekening:</strong> <?php echo e(config('bloomcraft.bank_account_number')); ?></p>
                        </div>
                    <?php else: ?>
                        <p style="color:#92400e;">Rekening belum dikonfigurasi. Hubungi admin Bloomcraft untuk mendapatkan nomor rekening resmi sebelum transfer.</p>
                    <?php endif; ?>

                    <?php if ($payment && $payment->status === 'rejected'): ?>
                        <p style="color:#b91c1c;">Bukti ditolak: <?php echo e($payment->admin_note); ?></p>
                    <?php endif; ?>

                    <?php if (!$payment || !$payment->proof_path || $payment->status === 'rejected'): ?>
                        <form method="POST" enctype="multipart/form-data" action="<?php echo e(route('orders.payment-proof', $order)); ?>" style="margin:16px 0;">
                            <?php echo csrf_field(); ?>
                            <label for="proof-<?php echo e($order->id); ?>">Unggah bukti transfer (JPG/PNG/WEBP, maks. 4 MB)</label><br>
                            <input id="proof-<?php echo e($order->id); ?>" type="file" name="proof" accept="image/jpeg,image/png,image/webp" required>
                            <button type="submit">Kirim Bukti Transfer</button>
                        </form>
                    <?php else: ?>
                        <p>Bukti transfer: <?php echo e(ucfirst(str_replace('_', ' ', $payment->status))); ?></p>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($order->tracking_number): ?>
                    <p>Kurir: <?php echo e($order->shipping_courier); ?> <?php echo e($order->shipping_service); ?></p>
                    <p>Nomor resi: <strong><?php echo e($order->tracking_number); ?></strong></p>
                <?php endif; ?>

                <hr style="margin:24px 0;">
                <h3>Detail Produk</h3>
                <?php foreach ($order->details as $detail): ?>
                    <div style="display:flex;gap:16px;align-items:center;padding:14px 0;border-bottom:1px solid #eee;">
                        <?php
                            $product = $detail->product;
                            $images = $product ? $product->image : null;
                            if (!is_array($images)) {
                                $decoded = is_string($images) ? json_decode($images, true) : null;
                                $images = is_array($decoded) ? $decoded : [];
                            }
                        ?>
                        <?php if (!empty($images)): ?>
                            <img src="<?php echo e(asset('storage/' . $images[0])); ?>" width="80" height="80" alt="Foto produk" style="object-fit:cover;border-radius:12px;">
                        <?php endif; ?>
                        <div>
                            <h4><?php echo e($product->name ?? 'Produk Tidak Tersedia'); ?></h4>
                            <p>Jumlah: <?php echo e($detail->quantity); ?></p>
                            <p>Harga: Rp <?php echo e(number_format((float) $detail->price, 0, ',', '.')); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>

                <h2 style="margin-top:24px;">Total Pesanan: Rp <?php echo e(number_format((float) $order->total, 0, ',', '.')); ?> <small>Ongkos kirim gratis.</small></h2>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/orders/index.blade.php ENDPATH**/ ?>