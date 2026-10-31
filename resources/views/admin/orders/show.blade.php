@extends('layouts.admin')

@section('content')
<style>
    .order-detail-page {
        --od-green: #496b55;
        --od-green-dark: #304b39;
        --od-sage: #edf3eb;
        --od-border: #e3e8e0;
        --od-text: #29332c;
        --od-muted: #788078;
        width: 100%;
        color: var(--od-text);
    }

    .order-detail-page * { box-sizing: border-box; }

    .order-detail-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .order-detail-eyebrow {
        margin: 0 0 8px;
        color: var(--od-green);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .order-detail-title {
        margin: 0;
        color: var(--od-text);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 600;
    }

    .order-detail-subtitle {
        margin: 9px 0 0;
        color: var(--od-muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .order-detail-number {
        display: inline-flex;
        align-items: center;
        padding: 10px 14px;
        border: 1px solid #dce8d9;
        border-radius: 10px;
        background: var(--od-sage);
        color: var(--od-green-dark);
        font-size: 12px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .order-detail-alert {
        margin-bottom: 18px;
        padding: 14px 16px;
        border-radius: 11px;
        font-size: 13px;
        line-height: 1.7;
    }

    .order-detail-alert-success {
        border: 1px solid #d2e8d3;
        background: #edf7ed;
        color: #27613a;
    }

    .order-detail-alert-error {
        border: 1px solid #f1d0cd;
        background: #fff0ef;
        color: #a33131;
    }

    .order-detail-alert ul { margin: 6px 0 0; padding-left: 20px; }

    .order-detail-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(280px, .85fr);
        gap: 20px;
        align-items: start;
    }

    .order-detail-main,
    .order-detail-sidebar {
        display: grid;
        gap: 20px;
        min-width: 0;
    }

    .order-detail-card {
        overflow: hidden;
        border: 1px solid var(--od-border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 8px 26px rgba(40, 60, 42, .04);
    }

    .order-detail-card-header {
        padding: 19px 22px;
        border-bottom: 1px solid var(--od-border);
    }

    .order-detail-card-header h2 {
        margin: 0;
        color: var(--od-text);
        font-size: 16px;
        font-weight: 700;
    }

    .order-detail-card-header p {
        margin: 5px 0 0;
        color: var(--od-muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .order-detail-card-body { padding: 21px 22px; }

    .customer-info {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 19px 22px;
    }

    .customer-info-item { min-width: 0; }
    .customer-info-full { grid-column: 1 / -1; }

    .detail-label {
        display: block;
        margin-bottom: 6px;
        color: var(--od-muted);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .7px;
        text-transform: uppercase;
    }

    .detail-value {
        display: block;
        color: var(--od-text);
        font-size: 13px;
        font-weight: 600;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .product-list { padding: 0 22px; }

    .product-row {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 17px 0;
        border-bottom: 1px solid #eef0eb;
    }

    .product-row:last-child { border-bottom: 0; }

    .product-thumb {
        flex: 0 0 76px;
        width: 76px;
        height: 76px;
        border: 1px solid var(--od-border);
        border-radius: 12px;
        object-fit: cover;
        background: #faf9f5;
    }

    .product-thumb-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 76px;
        width: 76px;
        height: 76px;
        border: 1px dashed #d7dfd4;
        border-radius: 12px;
        background: #faf9f5;
        color: var(--od-muted);
        font-size: 10px;
        text-align: center;
    }

    .product-info { flex: 1; min-width: 0; }

    .product-info h3 {
        margin: 0 0 7px;
        color: var(--od-text);
        font-size: 13px;
        font-weight: 700;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .product-info p {
        margin: 3px 0 0;
        color: var(--od-muted);
        font-size: 11px;
    }

    .product-line-total {
        color: var(--od-green-dark);
        font-size: 12px;
        font-weight: 700;
        text-align: right;
        white-space: nowrap;
    }

    .order-total-box {
        padding: 18px 22px;
        border-top: 1px solid var(--od-border);
        background: #fafbf9;
    }

    .order-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
        color: var(--od-muted);
        font-size: 12px;
    }

    .order-total-row:last-child { margin-bottom: 0; }

    .order-grand-total {
        padding-top: 12px;
        margin-top: 12px;
        border-top: 1px solid var(--od-border);
        color: var(--od-text);
        font-size: 14px;
        font-weight: 700;
    }

    .order-grand-total strong {
        color: var(--od-green-dark);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 23px;
    }

    .order-status-text {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        background: var(--od-sage);
        color: var(--od-green-dark);
        font-size: 11px;
        font-weight: 700;
    }

    .order-form-field { margin-bottom: 15px; }
    .order-form-field:last-child { margin-bottom: 0; }

    .order-form-label {
        display: block;
        margin-bottom: 7px;
        color: var(--od-text);
        font-size: 12px;
        font-weight: 700;
    }

    .order-form-input,
    .order-form-select,
    .order-form-textarea {
        display: block;
        width: 100%;
        min-height: 43px;
        padding: 11px 12px;
        border: 1px solid #dce3da;
        border-radius: 9px;
        background: #fff;
        color: var(--od-text);
        font: inherit;
        font-size: 12px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .order-form-input:focus,
    .order-form-select:focus,
    .order-form-textarea:focus {
        border-color: var(--od-green);
        box-shadow: 0 0 0 3px rgba(73, 107, 85, .10);
    }

    .order-form-textarea { min-height: 90px; resize: vertical; line-height: 1.6; }

    .order-form-help {
        display: block;
        margin-top: 6px;
        color: var(--od-muted);
        font-size: 10px;
        line-height: 1.6;
    }

    .order-detail-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 39px;
        padding: 10px 14px;
        border: 0;
        border-radius: 9px;
        font-family: inherit;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none !important;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .order-detail-button:hover { transform: translateY(-1px); }
    .order-button-primary { background: var(--od-green); color: #fff !important; }
    .order-button-primary:hover { background: var(--od-green-dark); }
    .order-button-secondary { background: #f0f2ed; color: #455247 !important; }
    .order-button-secondary:hover { background: #e5e9e1; }
    .order-button-danger { background: #fff0ef; color: #a33131 !important; }
    .order-button-danger:hover { background: #fbe1df; }
    .order-button-whatsapp { background: #e7f3e8; color: #28613b !important; }

    .order-button-group {
        display: flex;
        flex-wrap: wrap;
        gap: 9px;
        margin-top: 14px;
    }

    .payment-proof-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: var(--od-green-dark) !important;
        font-size: 12px;
        font-weight: 700;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .order-note {
        margin: 0 0 14px;
        padding: 11px 12px;
        border-radius: 9px;
        background: #f7f8f5;
        color: var(--od-muted);
        font-size: 11px;
        line-height: 1.6;
    }

    @media (max-width: 850px) {
        .order-detail-grid { grid-template-columns: 1fr; }
        .order-detail-sidebar { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .order-detail-sidebar .order-detail-card:last-child { grid-column: 1 / -1; }
    }

    @media (max-width: 580px) {
        .order-detail-heading { align-items: stretch; }
        .order-detail-number { align-self: flex-start; }
        .customer-info { grid-template-columns: 1fr; }
        .customer-info-full { grid-column: auto; }
        .order-detail-card-header,
        .order-detail-card-body { padding: 17px; }
        .product-list { padding: 0 17px; }
        .product-row { gap: 11px; }
        .product-thumb,
        .product-thumb-placeholder { flex-basis: 62px; width: 62px; height: 62px; }
        .product-line-total { font-size: 11px; }
        .order-detail-sidebar { grid-template-columns: 1fr; }
        .order-detail-sidebar .order-detail-card:last-child { grid-column: auto; }
        .order-button-group { flex-direction: column; }
        .order-button-group .order-detail-button { width: 100%; }
    }
</style>

<div class="order-detail-page">
    <header class="order-detail-heading">
        <div>
            <p class="order-detail-eyebrow">Bloomcraft Admin</p>
            <h1 class="order-detail-title">Detail Pesanan</h1>
            <p class="order-detail-subtitle">
                Periksa informasi pelanggan, produk, pembayaran, dan proses pengiriman.
            </p>
        </div>
        <div class="order-detail-number">
            {{ $order->order_number ?: ('Pesanan #' . $order->id) }}
        </div>
    </header>

    @if(session('success'))
        <div class="order-detail-alert order-detail-alert-success" role="status">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="order-detail-alert order-detail-alert-error" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="order-detail-alert order-detail-alert-error" role="alert">
            <strong>Ada data yang perlu diperiksa.</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="order-detail-grid">
        <div class="order-detail-main">
            <section class="order-detail-card">
                <div class="order-detail-card-header">
                    <h2>Informasi Pelanggan</h2>
                    <p>Data penerima pesanan Bloomcraft.</p>
                </div>

                <div class="order-detail-card-body">
                    <div class="customer-info">
                        <div class="customer-info-item">
                            <span class="detail-label">Nama pelanggan</span>
                            <span class="detail-value">{{ $order->name }}</span>
                        </div>

                        <div class="customer-info-item">
                            <span class="detail-label">Nomor telepon</span>
                            <span class="detail-value">{{ $order->phone }}</span>
                        </div>

                        <div class="customer-info-item customer-info-full">
                            <span class="detail-label">Alamat pengiriman</span>
                            <span class="detail-value">{{ $order->address }}</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="order-detail-card">
                <div class="order-detail-card-header">
                    <h2>Produk Dibeli</h2>
                    <p>Daftar produk dan jumlah yang dipesan.</p>
                </div>

                <div class="product-list">
                    @foreach($order->details as $detail)
                        <div class="product-row">
                            @if($detail->product && $detail->product->image && count($detail->product->image))
                                <img
                                    src="{{ asset('storage/' . $detail->product->image[0]) }}"
                                    alt="{{ $detail->product_name }}"
                                    class="product-thumb"
                                    loading="lazy"
                                >
                            @else
                                <div class="product-thumb-placeholder">Tidak ada foto</div>
                            @endif

                            <div class="product-info">
                                <h3>{{ $detail->product_name }}</h3>
                                <p>Jumlah: {{ $detail->quantity }}</p>
                                <p>Harga satuan: Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                            </div>

                            <div class="product-line-total">
                                Rp {{ number_format((float) $detail->price * (int) $detail->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="order-total-box">
                    <div class="order-total-row">
                        <span>Ongkos kirim</span>
                        <strong>Gratis (Rp 0)</strong>
                    </div>
                    <div class="order-total-row order-grand-total">
                        <span>Total pembayaran</span>
                        <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </section>
        </div>

        <aside class="order-detail-sidebar">
            <section class="order-detail-card">
                <div class="order-detail-card-header">
                    <h2>Ringkasan Pesanan</h2>
                    <p>Status dan identitas transaksi.</p>
                </div>
                <div class="order-detail-card-body">
                    <div class="order-form-field">
                        <span class="detail-label">Nomor pesanan</span>
                        <span class="detail-value">{{ $order->order_number }}</span>
                    </div>

                    <div class="order-form-field">
                        <span class="detail-label">Status pembayaran</span>
                        <span class="order-status-text">{{ $order->payment_status }}</span>
                    </div>

                    <div class="order-form-field">
                        <span class="detail-label">Status pesanan</span>
                        <span class="order-status-text">{{ $order->order_status ?: $order->status }}</span>
                    </div>

                    <div class="order-form-field">
                        <span class="detail-label">Ongkos kirim</span>
                        <span class="detail-value">Gratis</span>
                    </div>

                    <div class="order-form-field">
                        <span class="detail-label">Total</span>
                        <span class="detail-value" style="color:var(--od-green-dark);font-size:18px;">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </section>

            @if($order->payments->isNotEmpty())
                @php($payment = $order->payments->sortByDesc('id')->first())

                <section class="order-detail-card">
                    <div class="order-detail-card-header">
                        <h2>Bukti Pembayaran</h2>
                        <p>Periksa bukti transfer dari customer.</p>
                    </div>

                    <div class="order-detail-card-body">
                        <div class="order-form-field">
                            <span class="detail-label">Status pembayaran</span>
                            <span class="detail-value">{{ $payment->status }}</span>
                        </div>

                        @if($payment->proof_path)
                            <a
                                href="{{ route('admin.orders.payment-proof', $order) }}"
                                target="_blank"
                                rel="noopener"
                                class="payment-proof-link"
                            >
                                Lihat bukti transfer
                            </a>
                        @else
                            <p class="order-note">Customer belum mengunggah bukti transfer.</p>
                        @endif

                        @if($payment->proof_path && $order->payment_status !== 'paid')
                            <form
                                method="POST"
                                action="{{ route('admin.orders.verify-payment', $order) }}"
                                style="margin-top:17px;"
                            >
                                @csrf

                                <div class="order-form-field">
                                    <label class="order-form-label" for="admin-note">Catatan admin</label>
                                    <textarea
                                        class="order-form-textarea"
                                        id="admin-note"
                                        name="admin_note"
                                        placeholder="Catatan untuk customer (wajib diisi jika menolak)"
                                    ></textarea>
                                    <small class="order-form-help">
                                        Isi catatan jika bukti pembayaran ditolak.
                                    </small>
                                </div>

                                <div class="order-button-group">
                                    <button
                                        name="decision"
                                        value="approve"
                                        type="submit"
                                        class="order-detail-button order-button-primary"
                                    >
                                        Verifikasi Pembayaran
                                    </button>

                                    <button
                                        name="decision"
                                        value="reject"
                                        type="submit"
                                        class="order-detail-button order-button-danger"
                                    >
                                        Tolak Bukti
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </section>
            @endif

            @if($order->payment_status === 'paid' && !in_array($order->order_status, ['ready_to_ship', 'completed']))
                <section class="order-detail-card">
                    <div class="order-detail-card-header">
                        <h2>Persiapan Pengiriman</h2>
                        <p>Isi informasi pengiriman jika sudah tersedia.</p>
                    </div>

                    <div class="order-detail-card-body">
                        <form method="POST" action="{{ route('admin.orders.ready-to-ship', $order) }}">
                            @csrf

                            <div class="order-form-field">
                                <label class="order-form-label" for="shipping-courier">Kurir</label>
                                <input
                                    class="order-form-input"
                                    id="shipping-courier"
                                    name="shipping_courier"
                                    placeholder="Contoh: JNE, J&T"
                                >
                            </div>

                            <div class="order-form-field">
                                <label class="order-form-label" for="shipping-service">Layanan</label>
                                <input
                                    class="order-form-input"
                                    id="shipping-service"
                                    name="shipping_service"
                                    placeholder="Contoh: Reguler"
                                >
                            </div>

                            <div class="order-form-field">
                                <label class="order-form-label" for="tracking-number">Nomor resi</label>
                                <input
                                    class="order-form-input"
                                    id="tracking-number"
                                    name="tracking_number"
                                    placeholder="Masukkan nomor resi"
                                >
                            </div>

                            <button type="submit" class="order-detail-button order-button-primary" style="width:100%;">
                                Tandai Siap Dikirim
                            </button>
                        </form>
                    </div>
                </section>
            @endif

            @php($waText = 'Halo '.$order->name.', pesanan Bloomcraft '.$order->order_number.' siap dikirim. Ongkir gratis. Total: Rp '.number_format((float)$order->total,0,',','.').($order->tracking_number ? '. Resi: '.$order->tracking_number : '').'.')

            <section class="order-detail-card">
                <div class="order-detail-card-header">
                    <h2>Hubungi Customer</h2>
                    <p>Kirim informasi pesanan melalui WhatsApp.</p>
                </div>
                <div class="order-detail-card-body">
                    <a
                        target="_blank"
                        rel="noopener"
                        href="https://wa.me/{{ preg_replace('/\D/', '', $order->phone) }}?text={{ urlencode($waText) }}"
                        class="order-detail-button order-button-whatsapp"
                        style="width:100%;"
                    >
                        Hubungi melalui WhatsApp
                    </a>
                </div>
            </section>

            <section class="order-detail-card">
                <div class="order-detail-card-header">
                    <h2>Update Status Pesanan</h2>
                    <p>Ubah status sesuai perkembangan pesanan.</p>
                </div>

                <div class="order-detail-card-body">
                    <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="order-form-field">
                            <label class="order-form-label" for="order-status">Status Pesanan</label>
                            <select name="status" id="order-status" class="order-form-select">
                                <option value="pending" @if($order->status == 'pending') selected @endif>
                                    Pending
                                </option>
                                <option value="process" @if($order->status == 'process') selected @endif>
                                    Process
                                </option>
                                <option value="success" @if($order->status == 'success') selected @endif>
                                    Success
                                </option>
                                <option value="cancel" @if($order->status == 'cancel') selected @endif>
                                    Cancel
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="order-detail-button order-button-primary" style="width:100%;">
                            Update Status
                        </button>
                    </form>
                </div>
            </section>
        </aside>
    </div>
</div>
@endsection
