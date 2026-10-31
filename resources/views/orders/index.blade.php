@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<style>
    .orders-page {
        --bc-green: #496b55;
        --bc-green-dark: #304b39;
        --bc-green-soft: #edf3eb;
        --bc-cream: #faf9f5;
        --bc-text: #29332c;
        --bc-muted: #788078;
        --bc-border: #e5e8e1;
        max-width: 1100px;
        margin: 0 auto;
        padding: 42px 20px 64px;
        color: var(--bc-text);
    }
    .orders-page * { box-sizing: border-box; }
    .orders-hero { margin-bottom: 30px; }
    .orders-eyebrow {
        color: var(--bc-green);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 9px;
    }
    .orders-title {
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(30px, 4vw, 42px);
        line-height: 1.2;
        margin: 0 0 10px;
        color: var(--bc-text);
    }
    .orders-intro { color: var(--bc-muted); font-size: 14px; line-height: 1.8; margin: 0; }
    .orders-alert {
        padding: 15px 18px;
        border-radius: 12px;
        margin-bottom: 18px;
        font-size: 14px;
        line-height: 1.7;
    }
    .orders-alert ul { padding-left: 20px; margin: 8px 0 0; }
    .orders-alert-error { background: #fff0ef; color: #a32f2f; border: 1px solid #f2cecb; }
    .orders-alert-success { background: #eff8ef; color: #28623b; border: 1px solid #d5ead6; }
    .orders-empty {
        background: #fff;
        border: 1px solid var(--bc-border);
        border-radius: 18px;
        padding: 45px 24px;
        text-align: center;
        color: var(--bc-muted);
        box-shadow: 0 8px 28px rgba(40,60,42,.04);
    }
    .orders-empty-mark {
        display: flex; align-items: center; justify-content: center;
        width: 58px; height: 58px; border-radius: 50%;
        margin: 0 auto 15px; background: var(--bc-green-soft);
        color: var(--bc-green); font-size: 25px;
    }
    .order-card {
        background: #fff;
        border: 1px solid var(--bc-border);
        border-radius: 18px;
        padding: 26px;
        margin-bottom: 22px;
        box-shadow: 0 8px 28px rgba(40,60,42,.045);
        overflow: hidden;
    }
    .order-header {
        display: flex; justify-content: space-between; align-items: flex-start;
        gap: 16px; flex-wrap: wrap; padding-bottom: 20px;
        border-bottom: 1px solid var(--bc-border); margin-bottom: 22px;
    }
    .order-number {
        font-size: 20px; line-height: 1.4; margin: 0 0 6px;
        overflow-wrap: anywhere;
    }
    .order-date { margin: 0; color: var(--bc-muted); font-size: 13px; }
    .order-section { margin-top: 24px; }
    .order-section:first-of-type { margin-top: 0; }
    .order-section-title {
        font-size: 16px; margin: 0 0 14px; font-weight: 700; color: var(--bc-text);
    }
    .order-info-panel, .bank-panel {
        background: #f8faf7;
        border: 1px solid var(--bc-border);
        border-radius: 13px;
        padding: 18px;
    }
    .info-item { margin: 0 0 14px; line-height: 1.7; font-size: 14px; overflow-wrap: anywhere; }
    .info-item:last-child { margin-bottom: 0; }
    .field-label { display: block; font-weight: 600; font-size: 13px; margin-bottom: 7px; }
    .field-help { display: block; color: var(--bc-muted); font-size: 12px; line-height: 1.7; margin-top: 7px; }
    .order-form-row { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
    .order-input, .order-file {
        font: inherit; font-size: 13px; color: var(--bc-text);
        border: 1px solid #d9e0d7; border-radius: 9px;
        background: #fff; padding: 11px 13px; max-width: 100%;
    }
    .order-input { width: 100%; max-width: 340px; min-height: 44px; }
    .order-input:focus, .order-file:focus {
        outline: none; border-color: var(--bc-green);
        box-shadow: 0 0 0 3px rgba(73,107,85,.11);
    }
    .order-btn, .order-link-btn {
        display: inline-flex; align-items: center; justify-content: center;
        gap: 7px; padding: 11px 16px; border: 0; border-radius: 9px;
        background: var(--bc-green); color: #fff; text-decoration: none;
        font: inherit; font-size: 13px; font-weight: 700; cursor: pointer;
        transition: background .2s, transform .2s;
    }
    .order-btn:hover, .order-link-btn:hover { background: var(--bc-green-dark); color: #fff; transform: translateY(-1px); }
    .order-btn-secondary { background: #374151; }
    .order-btn-secondary:hover { background: #1f2937; }
    .order-status {
        display: inline-flex; align-items: center; gap: 8px;
        max-width: 100%; padding: 10px 14px; border-radius: 10px;
        background: #fff7df; color: #8a5a12; border: 1px solid #f3e3ad;
        font-weight: 700; font-size: 13px; line-height: 1.6;
    }
    .order-status::before {
        content: ''; width: 7px; height: 7px; flex: 0 0 7px;
        border-radius: 50%; background: currentColor;
    }
    .order-meta {
        display: flex; flex-wrap: wrap; gap: 12px 24px;
        margin-top: 14px; font-size: 13px; line-height: 1.7;
    }
    .order-meta span { color: var(--bc-muted); }
    .order-muted { color: var(--bc-muted); font-size: 13px; line-height: 1.7; }
    .order-warning {
        background: #fff8e8; border: 1px solid #f2dfb5; color: #855b19;
        padding: 13px 15px; border-radius: 10px; font-size: 13px; line-height: 1.7;
    }
    .order-danger {
        background: #fff0ef; border: 1px solid #f2cecb; color: #a32f2f;
        padding: 12px 14px; border-radius: 10px; font-size: 13px; line-height: 1.7;
    }
    .order-divider { border: 0; border-top: 1px solid var(--bc-border); margin: 25px 0; }
    .product-row {
        display: flex; gap: 15px; align-items: center;
        padding: 15px 0; border-bottom: 1px solid #edf0eb;
    }
    .product-row:last-child { border-bottom: 0; }
    .product-image {
        width: 82px; height: 82px; flex: 0 0 82px; object-fit: cover;
        border-radius: 12px; background: var(--bc-green-soft);
    }
    .product-placeholder {
        width: 82px; height: 82px; flex: 0 0 82px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        background: var(--bc-green-soft); color: var(--bc-green); font-size: 24px;
    }
    .product-name { font-size: 15px; margin: 0 0 7px; }
    .product-meta { font-size: 13px; color: var(--bc-muted); margin: 4px 0 0; line-height: 1.6; }
    .order-total {
        margin-top: 22px; padding: 18px; border-radius: 13px;
        background: var(--bc-green-soft); display: flex;
        justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap;
    }
    .order-total-label { font-size: 14px; font-weight: 700; }
    .order-total-value { font-family: Georgia, 'Times New Roman', serif; font-size: 24px; font-weight: 700; color: var(--bc-green-dark); }
    .order-total-note { display: block; font: 12px Arial, sans-serif; color: var(--bc-muted); margin-top: 4px; }
    .proof-form { margin: 15px 0 0; padding: 17px; border: 1px dashed #cbd8c8; border-radius: 12px; background: #fbfcfa; }
    .proof-form .order-btn { margin-top: 12px; }
    @media (max-width: 600px) {
        .orders-page { padding: 30px 14px 45px; }
        .order-card { padding: 19px 16px; border-radius: 15px; }
        .order-header { gap: 10px; }
        .order-number { font-size: 18px; }
        .order-info-panel, .bank-panel { padding: 14px; }
        .order-input { max-width: 100%; }
        .order-form-row .order-btn { width: 100%; }
        .product-image, .product-placeholder { width: 68px; height: 68px; flex-basis: 68px; }
        .order-total-value { font-size: 21px; }
    }
</style>

<section class="orders-page">
    <header class="orders-hero">
        <div class="orders-eyebrow">Bloomcraft Online Store</div>
        <h1 class="orders-title">Pesanan Saya</h1>
        <p class="orders-intro">Pantau status pesanan, informasi pengiriman, dan pembayaranmu dalam satu tempat.</p>
    </header>

    <?php if (session('error')): ?>
        <div class="orders-alert orders-alert-error" role="alert">
            {{ session('error') }}
        </div>
    <?php endif; ?>

    <?php if ($errors->any()): ?>
        <div class="orders-alert orders-alert-error" role="alert">
            <strong>Periksa kembali data berikut:</strong>
            <ul>
                <?php foreach ($errors->all() as $error): ?>
                    <li>{{ $error }}</li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (session('success')): ?>
        <div class="orders-alert orders-alert-success" role="status">
            {{ session('success') }}
        </div>
    <?php endif; ?>

    <?php if ($orders->isEmpty()): ?>
        <div class="orders-empty">
            <div class="orders-empty-mark" aria-hidden="true">&#10047;</div>
            <h2 style="font-size:20px;margin:0 0 8px;color:var(--bc-text);">Belum ada pesanan</h2>
            <p style="margin:0;font-size:14px;line-height:1.7;">Pesanan yang kamu buat akan muncul di halaman ini.</p>
        </div>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <article class="order-card">
                <header class="order-header">
                    <div>
                        <h2 class="order-number">Pesanan {{ $order->order_number ?: ('#' . $order->id) }}</h2>
                        <p class="order-date">Tanggal pesanan: {{ optional($order->created_at)->format('d M Y') }}</p>
                    </div>
                    <div class="orders-eyebrow" style="margin:5px 0 0;">Bloomcraft Order</div>
                </header>

                <section class="order-section">
                    <h3 class="order-section-title">Informasi Pemesan</h3>
                    <div class="order-info-panel">
                        <p class="info-item"><strong>Nama penerima</strong><br>{{ $order->name }}</p>

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

                        <div style="margin:12px 0 16px;">
                            <label for="phone-{{ $order->id }}" class="field-label">Nomor telepon</label>
                            <small class="field-help" style="margin:0 0 8px;">Format nomor telepon: <strong>+62 XXX-XXXX-XXXX</strong>.</small>

                            <?php if ($phoneCanBeEdited): ?>
                                <form method="POST" action="{{ route('orders.phone.update', $order) }}" class="order-form-row">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input
                                        class="order-input"
                                        id="phone-{{ $order->id }}"
                                        type="tel"
                                        name="phone"
                                        value="{{ $phoneInputValue }}"
                                        maxlength="17"
                                        placeholder="+62 812-3456-7890"
                                        required
                                        autocomplete="tel"
                                        inputmode="tel"
                                        pattern="\+62 [0-9]{3}-[0-9]{4}-[0-9]{4}"
                                        aria-describedby="phone-help-{{ $order->id }}"
                                    >
                                    <button type="submit" class="order-btn order-btn-secondary">Simpan Nomor Telepon</button>
                                </form>
                                <small id="phone-help-{{ $order->id }}" class="field-help">
                                    Format wajib: +62 XXX-XXXX-XXXX. Nomor telepon dapat diubah selama pesanan belum selesai.
                                </small>
                            <?php else: ?>
                                <p class="info-item">{{ $order->phone }}</p>
                                <small class="field-help">Nomor telepon tidak dapat diubah karena pesanan sudah selesai, dibatalkan, atau kedaluwarsa.</small>
                            <?php endif; ?>
                        </div>

                        <p class="info-item"><strong>Alamat pengiriman</strong><br>{{ $order->address }}</p>
                    </div>
                </section>

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

                <section class="order-section">
                    <h3 class="order-section-title">Status Pesanan</h3>
                    <div class="order-status">
                        {{ $statusLabels[$displayStatus] ?? ucfirst(str_replace('_', ' ', $displayStatus ?? 'pending')) }}
                    </div>
                    <div class="order-meta">
                        <div><span>Status pembayaran:</span> <strong>{{ ucfirst(str_replace('_', ' ', $order->payment_status ?? 'not_started')) }}</strong></div>
                        <div><span>Ongkos kirim:</span> <strong>Gratis</strong></div>
                    </div>
                </section>

                {{-- Tautan invoice hanya muncul setelah bukti pembayaran tersimpan. --}}
                <?php if ($payment && !empty($payment->proof_path)): ?>
                    <div style="margin:17px 0 0;">
                        <a href="{{ route('orders.invoice', $order) }}" class="order-link-btn">
                            Lihat Invoice / Bukti Pesanan
                        </a>
                    </div>
                <?php else: ?>
                    <p class="order-muted" style="margin:13px 0 0;">Invoice tersedia setelah bukti pembayaran berhasil diunggah.</p>
                <?php endif; ?>

                <?php if ($order->payment_status !== 'paid' && !in_array($order->order_status, ['cancelled', 'completed'], true)): ?>
                    <section class="order-section">
                        <h3 class="order-section-title">Instruksi Pembayaran</h3>
                        <p class="order-muted" style="margin:0 0 14px;">
                            Transfer sebesar <strong style="color:var(--bc-text);">Rp {{ number_format((float) $order->total, 0, ',', '.') }}</strong>
                            ke rekening resmi Bloomcraft. Jangan membagikan PIN atau kata sandi bank.
                        </p>

                        <?php if (config('bloomcraft.bank_account_number')): ?>
                            <div class="bank-panel">
                                <p class="info-item"><strong>Bank</strong><br>{{ config('bloomcraft.bank_name') }}</p>
                                <p class="info-item"><strong>Nama pemilik</strong><br>{{ config('bloomcraft.bank_account_name') }}</p>
                                <p class="info-item"><strong>Nomor rekening</strong><br>{{ config('bloomcraft.bank_account_number') }}</p>
                            </div>
                        <?php else: ?>
                            <p class="order-warning">Rekening belum dikonfigurasi. Hubungi admin Bloomcraft untuk mendapatkan nomor rekening resmi sebelum transfer.</p>
                        <?php endif; ?>

                        <?php if ($payment && $payment->status === 'rejected'): ?>
                            <p class="order-danger" style="margin-top:13px;">Bukti ditolak: {{ $payment->admin_note }}</p>
                        <?php endif; ?>

                        <?php if (!$payment || !$payment->proof_path || $payment->status === 'rejected'): ?>
                            <form method="POST" enctype="multipart/form-data" action="{{ route('orders.payment-proof', $order) }}" class="proof-form">
                                @csrf
                                <label for="proof-{{ $order->id }}" class="field-label">Unggah bukti transfer</label>
                                <small class="field-help" style="margin:0 0 12px;">Format JPG, PNG, atau WEBP. Ukuran maksimal 4 MB.</small>
                                <input class="order-file" id="proof-{{ $order->id }}" type="file" name="proof" accept="image/jpeg,image/png,image/webp" required>
                                <br>
                                <button type="submit" class="order-btn">Kirim Bukti Transfer</button>
                            </form>
                        <?php else: ?>
                            <p class="order-muted" style="margin-top:13px;">Bukti transfer: <strong>{{ ucfirst(str_replace('_', ' ', $payment->status)) }}</strong></p>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>

                <?php if ($order->tracking_number): ?>
                    <section class="order-section">
                        <h3 class="order-section-title">Informasi Pengiriman</h3>
                        <div class="bank-panel">
                            <p class="info-item"><strong>Kurir:</strong><br>{{ $order->shipping_courier }} {{ $order->shipping_service }}</p>
                            <p class="info-item"><strong>Nomor resi:</strong><br>{{ $order->tracking_number }}</p>
                        </div>
                    </section>
                <?php endif; ?>

                <hr class="order-divider">

                <section class="order-section">
                    <h3 class="order-section-title">Detail Produk</h3>
                    <?php foreach ($order->details as $detail): ?>
                        <div class="product-row">
                            <?php
                                $product = $detail->product;
                                $images = $product ? $product->image : null;
                                if (!is_array($images)) {
                                    $decoded = is_string($images) ? json_decode($images, true) : null;
                                    $images = is_array($decoded) ? $decoded : [];
                                }
                            ?>
                            <?php if (!empty($images)): ?>
                                <img class="product-image" src="{{ asset('storage/' . $images[0]) }}" width="82" height="82" alt="Foto produk">
                            <?php else: ?>
                                <div class="product-placeholder" aria-hidden="true">&#10047;</div>
                            <?php endif; ?>
                            <div style="min-width:0;">
                                <h4 class="product-name">{{ $product->name ?? 'Produk Tidak Tersedia' }}</h4>
                                <p class="product-meta">Jumlah: {{ $detail->quantity }}</p>
                                <p class="product-meta">Harga: Rp {{ number_format((float) $detail->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="order-total">
                        <div class="order-total-label">Total Pesanan</div>
                        <div class="order-total-value">
                            Rp {{ number_format((float) $order->total, 0, ',', '.') }}
                            <span class="order-total-note">Ongkos kirim gratis</span>
                        </div>
                    </div>
                </section>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>
@endsection
