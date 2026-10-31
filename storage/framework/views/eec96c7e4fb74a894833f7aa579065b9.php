<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice <?php echo e($order->order_number ?: ('#' . $order->id)); ?> - Bloomcraft</title>
    <style>
        :root {
            --bloom-green: #465b47;
            --bloom-green-dark: #334735;
            --bloom-sage: #edf1e8;
            --bloom-cream: #faf9f5;
            --bloom-border: #dfe5da;
            --bloom-text: #263329;
            --bloom-muted: #68736a;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 32px 16px;
            background: #f3f4ef;
            color: var(--bloom-text);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.5;
        }

        .invoice-wrap {
            max-width: 900px;
            margin: 0 auto;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .toolbar a,
        .toolbar button {
            display: inline-block;
            padding: 10px 16px;
            border: 1px solid var(--bloom-border);
            border-radius: 9px;
            background: #fff;
            color: var(--bloom-green-dark);
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .toolbar .print-button {
            border-color: var(--bloom-green);
            background: var(--bloom-green);
            color: #fff;
            font-weight: 700;
        }

        .invoice {
            background: #fff;
            border: 1px solid var(--bloom-border);
            border-radius: 18px;
            padding: 42px;
            box-shadow: 0 10px 32px rgba(38, 51, 41, .07);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 24px;
            padding-bottom: 26px;
            border-bottom: 2px solid var(--bloom-sage);
        }

        .brand {
            margin: 0;
            color: var(--bloom-green);
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 34px;
            letter-spacing: .4px;
        }

        .brand-subtitle {
            margin: 3px 0 0;
            color: var(--bloom-muted);
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .invoice-title {
            margin: 0;
            color: var(--bloom-green-dark);
            font-size: 26px;
            letter-spacing: 1.5px;
            text-align: right;
        }

        .invoice-number {
            margin: 5px 0 0;
            color: var(--bloom-muted);
            font-size: 13px;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .status-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin: 22px 0;
            padding: 14px 16px;
            border: 1px solid var(--bloom-border);
            border-radius: 10px;
            background: var(--bloom-cream);
        }

        .status-label {
            color: var(--bloom-muted);
            font-size: 13px;
        }

        .status-value {
            color: var(--bloom-green-dark);
            font-weight: 700;
            text-align: right;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            margin: 26px 0 32px;
        }

        .section-label {
            margin: 0 0 10px;
            color: var(--bloom-green);
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .info-block p {
            margin: 4px 0;
            overflow-wrap: anywhere;
        }

        .muted { color: var(--bloom-muted); }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        thead th {
            padding: 12px 10px;
            background: var(--bloom-sage);
            color: var(--bloom-green-dark);
            font-size: 12px;
            text-align: left;
        }

        tbody td {
            padding: 14px 10px;
            border-bottom: 1px solid #edf0e9;
            vertical-align: top;
        }

        .numeric { text-align: right; white-space: nowrap; }

        .totals {
            width: min(100%, 360px);
            margin: 24px 0 0 auto;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 7px 0;
        }

        .grand-total {
            margin-top: 8px;
            padding: 15px 0 0;
            border-top: 2px solid var(--bloom-green);
            color: var(--bloom-green-dark);
            font-size: 19px;
            font-weight: 700;
        }

        .free-shipping {
            color: var(--bloom-green);
            font-weight: 700;
        }

        .note {
            margin-top: 34px;
            padding: 16px;
            border-radius: 10px;
            background: var(--bloom-cream);
            color: var(--bloom-muted);
            font-size: 13px;
        }

        .footer-note {
            margin-top: 28px;
            color: var(--bloom-muted);
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 16px;
            font-style: italic;
            text-align: center;
        }

        @media (max-width: 640px) {
            body { padding: 16px 8px; }
            .invoice { padding: 22px 16px; border-radius: 12px; }
            .invoice-header { gap: 12px; }
            .brand { font-size: 26px; }
            .invoice-title { font-size: 20px; }
            .info-grid { grid-template-columns: 1fr; gap: 18px; }
            table { font-size: 12px; }
            thead th, tbody td { padding: 9px 6px; }
            .numeric { white-space: normal; }
        }

        @page {
            size: A4;
            margin: 14mm;
        }

        @media print {
            body {
                padding: 0;
                background: #fff;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            body * { visibility: hidden; }

            .invoice-print,
            .invoice-print * { visibility: visible; }

            .invoice-print {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                max-width: none;
                margin: 0;
            }

            .invoice {
                padding: 0;
                border: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .no-print { display: none !important; }
            thead { display: table-header-group; }
            tr { break-inside: avoid; }
        }
    </style>
</head>
<body>
    <main class="invoice-wrap invoice-print">
        <div class="toolbar no-print">
            <a href="<?php echo e(route('orders.index')); ?>">← Kembali ke Pesanan Saya</a>
            <button type="button" class="print-button" onclick="window.print()">Cetak / Simpan PDF</button>
        </div>

        <article class="invoice">
            <header class="invoice-header">
                <div>
                    <h1 class="brand">Bloomcraft</h1>
                    <p class="brand-subtitle">Crafted with care</p>
                </div>
                <div>
                    <h2 class="invoice-title">INVOICE</h2>
                    <p class="invoice-number">
                        <?php echo e($order->order_number ?: ('BC-' . str_pad((string) $order->id, 6, '0', STR_PAD_LEFT))); ?>

                    </p>
                </div>
            </header>

            <div class="status-row">
                <div>
                    <div class="status-label">Tanggal pesanan</div>
                    <div><strong><?php echo e(optional($order->created_at)->format('d M Y, H:i') ?? '-'); ?></strong></div>
                </div>
                <div>
                    <div class="status-label">Status pembayaran</div>
                    <div class="status-value">
                        <?php
                            $paymentStatusLabels = [
                                'not_started' => 'Belum dimulai',
                                'pending' => 'Menunggu pembayaran',
                                'under_review' => 'Menunggu verifikasi admin',
                                'paid' => 'Terverifikasi / dibayar',
                                'rejected' => 'Bukti pembayaran ditolak',
                                'cancelled' => 'Dibatalkan',
                            ];
                            $paymentStatus = $payment->status ?: ($order->payment_status ?? 'pending');
                        ?>
                        <?php echo e($paymentStatusLabels[$paymentStatus] ?? ucfirst(str_replace('_', ' ', $paymentStatus))); ?>

                    </div>
                </div>
            </div>

            <section class="info-grid">
                <div class="info-block">
                    <h3 class="section-label">Ditagihkan kepada</h3>
                    <p><strong><?php echo e($order->name); ?></strong></p>
                    <?php if($order->email): ?>
                        <p><?php echo e($order->email); ?></p>
                    <?php endif; ?>
                    <?php if($order->phone): ?>
                        <p><?php echo e($order->phone); ?></p>
                    <?php endif; ?>
                    <?php if($order->address): ?>
                        <p><?php echo e($order->address); ?></p>
                    <?php endif; ?>
                </div>
                <div class="info-block">
                    <h3 class="section-label">Informasi pesanan</h3>
                    <p><span class="muted">Nomor pesanan:</span><br><strong><?php echo e($order->order_number ?: ('#' . $order->id)); ?></strong></p>
                    <p><span class="muted">Status pesanan:</span><br><strong><?php echo e(ucfirst(str_replace('_', ' ', $order->order_status ?: $order->status ?: 'pending'))); ?></strong></p>
                    <p><span class="muted">Pengiriman:</span><br><strong>Ongkos kirim gratis</strong></p>
                    <?php if($order->tracking_number): ?>
                        <p><span class="muted">Nomor resi:</span><br><strong><?php echo e($order->tracking_number); ?></strong></p>
                    <?php endif; ?>
                </div>
            </section>

            <section>
                <h3 class="section-label">Rincian produk</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="numeric">Jumlah</th>
                            <th class="numeric">Harga satuan</th>
                            <th class="numeric">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($detail->product->name ?? 'Produk tidak tersedia'); ?></strong>
                                </td>
                                <td class="numeric"><?php echo e($detail->quantity); ?></td>
                                <td class="numeric">Rp <?php echo e(number_format((float) $detail->price, 0, ',', '.')); ?></td>
                                <td class="numeric">Rp <?php echo e(number_format((float) $detail->price * (int) $detail->quantity, 0, ',', '.')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" style="text-align:center;">Detail produk tidak tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>

            <section class="totals">
                <div class="total-line">
                    <span>Subtotal produk</span>
                    <strong>Rp <?php echo e(number_format((float) $order->details->sum(fn ($detail) => (float) $detail->price * (int) $detail->quantity), 0, ',', '.')); ?></strong>
                </div>
                <div class="total-line">
                    <span>Ongkos kirim</span>
                    <span class="free-shipping">Gratis</span>
                </div>
                <div class="total-line grand-total">
                    <span>Total pesanan</span>
                    <span>Rp <?php echo e(number_format((float) $order->total, 0, ',', '.')); ?></span>
                </div>
            </section>

            <div class="note">
                <strong>Catatan pembayaran:</strong>
                Invoice ini tersedia karena bukti pembayaran telah diunggah. Status “Menunggu verifikasi admin” berarti pembayaran belum dinyatakan terverifikasi. Simpan invoice ini sebagai bukti rincian pesanan.
            </div>

            <p class="footer-note">Terima kasih telah memilih Bloomcraft.</p>
        </article>
    </main>
</body>
</html>
<?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/orders/invoice.blade.php ENDPATH**/ ?>