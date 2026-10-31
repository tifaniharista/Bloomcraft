<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice {{ $order->order_number ?: ('#' . $order->id) }} - Bloomcraft</title>
    <style>
        :root {
            --bloom-green: #496b55;
            --bloom-green-dark: #2f4937;
            --bloom-sage: #edf3eb;
            --bloom-cream: #fbfaf6;
            --bloom-border: #e1e8dd;
            --bloom-text: #263329;
            --bloom-muted: #758075;
            --bloom-gold: #c3a66b;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 38px 18px;
            background: radial-gradient(circle at top left, #eef3e9 0, #f7f7f2 38%, #f0f2ec 100%);
            color: var(--bloom-text);
            font-family: Inter, "Segoe UI", Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.65;
        }

        .invoice-wrap { max-width: 960px; margin: 0 auto; }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .toolbar a, .toolbar button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 17px;
            border: 1px solid var(--bloom-border);
            border-radius: 11px;
            background: rgba(255,255,255,.92);
            color: var(--bloom-green-dark);
            text-decoration: none;
            font: inherit;
            font-size: 13px;
            font-weight: 650;
            cursor: pointer;
            transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
        }

        .toolbar a:hover, .toolbar button:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(38, 51, 41, .08);
        }

        .toolbar .print-button {
            border-color: var(--bloom-green);
            background: var(--bloom-green);
            color: #fff;
        }

        .invoice {
            position: relative;
            overflow: hidden;
            background: #fff;
            border: 1px solid rgba(223, 231, 218, .95);
            border-radius: 22px;
            padding: 48px;
            box-shadow: 0 22px 60px rgba(38, 51, 41, .09);
        }

        .invoice::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--bloom-green-dark), #789477, #d8c59a);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 24px;
            padding: 4px 0 29px;
            border-bottom: 1px solid var(--bloom-border);
        }

        .brand {
            margin: 0;
            color: var(--bloom-green);
            font-family: Georgia, "Times New Roman", serif;
            font-size: 39px;
            font-weight: 700;
            letter-spacing: -.8px;
            line-height: 1.15;
        }

        .brand-subtitle {
            margin: 8px 0 0;
            color: var(--bloom-muted);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
        }

        .invoice-title {
            margin: 0;
            color: var(--bloom-green-dark);
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 3px;
            text-align: right;
        }

        .invoice-number {
            display: inline-block;
            max-width: 260px;
            margin: 9px 0 0;
            padding: 6px 10px;
            border-radius: 7px;
            background: var(--bloom-sage);
            color: var(--bloom-green-dark);
            font-size: 12px;
            font-weight: 700;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .status-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            margin: 25px 0 30px;
            padding: 17px 20px;
            border: 1px solid var(--bloom-border);
            border-radius: 14px;
            background: linear-gradient(120deg, #fbfcf8, #f5f7f0);
        }

        .status-label { color: var(--bloom-muted); font-size: 11px; margin-bottom: 3px; }
        .status-value { color: var(--bloom-green-dark); font-weight: 750; text-align: right; }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            margin: 0 0 34px;
        }

        .info-block {
            padding: 20px;
            border: 1px solid #e8ede4;
            border-radius: 14px;
            background: #fff;
            min-width: 0;
        }

        .section-label {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0 0 14px;
            color: var(--bloom-green);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .section-label::before {
            content: "";
            display: inline-block;
            width: 20px;
            height: 2px;
            border-radius: 2px;
            background: var(--bloom-gold);
        }

        .info-block p { margin: 6px 0; overflow-wrap: anywhere; }
        .info-block p strong { color: var(--bloom-text); }
        .muted { color: var(--bloom-muted); font-size: 12px; }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 14px;
            overflow: hidden;
            border: 1px solid var(--bloom-border);
            border-radius: 12px;
        }

        thead th {
            padding: 14px 12px;
            background: var(--bloom-sage);
            color: var(--bloom-green-dark);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .55px;
            text-align: left;
            text-transform: uppercase;
        }

        tbody td {
            padding: 16px 12px;
            border-bottom: 1px solid #edf0e9;
            vertical-align: top;
            font-size: 13px;
        }

        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:nth-child(even) { background: #fdfdfa; }
        .numeric { text-align: right; white-space: nowrap; font-variant-numeric: tabular-nums; }

        .totals {
            width: min(100%, 380px);
            margin: 25px 0 0 auto;
            padding: 17px 20px;
            border: 1px solid var(--bloom-border);
            border-radius: 14px;
            background: #fcfdf9;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            padding: 8px 0;
        }

        .total-line > span:first-child { color: var(--bloom-muted); }
        .total-line strong, .total-line > span:last-child { text-align: right; }
        .grand-total {
            margin-top: 8px;
            padding: 17px 0 2px;
            border-top: 1px dashed #cbd7c7;
            color: var(--bloom-green-dark);
            font-size: 17px;
            font-weight: 800;
        }

        .grand-total span:last-child {
            max-width: 62%;
            color: var(--bloom-green);
            font-size: 19px;
            overflow-wrap: anywhere;
        }

        .free-shipping { color: var(--bloom-green); font-weight: 800; }

        .note {
            margin-top: 32px;
            padding: 17px 19px;
            border: 1px solid #e7ecdf;
            border-left: 4px solid #91a98b;
            border-radius: 10px;
            background: var(--bloom-cream);
            color: var(--bloom-muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .note strong { display: block; margin-bottom: 4px; color: var(--bloom-green-dark); }

        .footer-note {
            margin: 30px 0 0;
            color: var(--bloom-green);
            font-family: Georgia, "Times New Roman", serif;
            font-size: 17px;
            font-style: italic;
            text-align: center;
        }

        @media (max-width: 700px) {
            body { padding: 18px 10px; }
            .invoice { padding: 30px 20px; border-radius: 16px; }
            .invoice-header { gap: 14px; }
            .brand { font-size: 30px; }
            .invoice-title { font-size: 21px; letter-spacing: 2px; }
            .invoice-number { max-width: 155px; font-size: 11px; }
            .status-row { align-items: flex-start; padding: 14px; }
            .status-row > div { min-width: 0; }
            .status-value { max-width: 180px; overflow-wrap: anywhere; }
            .info-grid { grid-template-columns: 1fr; gap: 14px; }
            .info-block { padding: 17px; }
            table { display: block; max-width: 100%; overflow-x: auto; }
            table thead, table tbody { width: 100%; }
            .totals { width: 100%; }
        }

        @media (max-width: 440px) {
            .toolbar { align-items: stretch; flex-direction: column; }
            .toolbar a, .toolbar button { width: 100%; }
            .invoice { padding: 25px 15px; }
            .invoice-header { flex-direction: column; }
            .invoice-header > div:last-child { align-self: stretch; text-align: left; }
            .invoice-title, .invoice-number { text-align: left; }
            .status-row { flex-direction: column; }
            .status-value { text-align: left; }
            .grand-total { font-size: 15px; }
            .grand-total span:last-child { font-size: 16px; }
        }

        @page { size: A4; margin: 14mm; }

        @media print {
            body {
                padding: 0;
                background: #fff;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            body * { visibility: hidden; }
            .invoice-print, .invoice-print * { visibility: visible; }
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
                overflow: visible;
            }
            .invoice::before { display: none; }
            .no-print { display: none !important; }
            thead { display: table-header-group; }
            tr, .info-block, .status-row, .totals, .note { break-inside: avoid; }
        }
    </style>
</head>
<body>
    <main class="invoice-wrap invoice-print">
        <div class="toolbar no-print">
            <a href="{{ route('orders.index') }}">← Kembali ke Pesanan Saya</a>
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
                        {{ $order->order_number ?: ('BC-' . str_pad((string) $order->id, 6, '0', STR_PAD_LEFT)) }}
                    </p>
                </div>
            </header>

            <div class="status-row">
                <div>
                    <div class="status-label">Tanggal pesanan</div>
                    <div><strong>{{ optional($order->created_at)->format('d M Y, H:i') ?? '-' }}</strong></div>
                </div>
                <div>
                    <div class="status-label">Status pembayaran</div>
                    <div class="status-value">
                        @php
                            $paymentStatusLabels = [
                                'not_started' => 'Belum dimulai',
                                'pending' => 'Menunggu pembayaran',
                                'under_review' => 'Menunggu verifikasi admin',
                                'paid' => 'Terverifikasi / dibayar',
                                'rejected' => 'Bukti pembayaran ditolak',
                                'cancelled' => 'Dibatalkan',
                            ];
                            $paymentStatus = $payment->status ?: ($order->payment_status ?? 'pending');
                        @endphp
                        {{ $paymentStatusLabels[$paymentStatus] ?? ucfirst(str_replace('_', ' ', $paymentStatus)) }}
                    </div>
                </div>
            </div>

            <section class="info-grid">
                <div class="info-block">
                    <h3 class="section-label">Ditagihkan kepada</h3>
                    <p><strong>{{ $order->name }}</strong></p>
                    @if($order->email)
                        <p>{{ $order->email }}</p>
                    @endif
                    @if($order->phone)
                        <p>{{ $order->phone }}</p>
                    @endif
                    @if($order->address)
                        <p>{{ $order->address }}</p>
                    @endif
                </div>
                <div class="info-block">
                    <h3 class="section-label">Informasi pesanan</h3>
                    <p><span class="muted">Nomor pesanan:</span><br><strong>{{ $order->order_number ?: ('#' . $order->id) }}</strong></p>
                    <p><span class="muted">Status pesanan:</span><br><strong>{{ ucfirst(str_replace('_', ' ', $order->order_status ?: $order->status ?: 'pending')) }}</strong></p>
                    <p><span class="muted">Pengiriman:</span><br><strong>Ongkos kirim gratis</strong></p>
                    @if($order->tracking_number)
                        <p><span class="muted">Nomor resi:</span><br><strong>{{ $order->tracking_number }}</strong></p>
                    @endif
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
                        @forelse($order->details as $detail)
                            <tr>
                                <td>
                                    <strong>{{ $detail->product->name ?? 'Produk tidak tersedia' }}</strong>
                                </td>
                                <td class="numeric">{{ $detail->quantity }}</td>
                                <td class="numeric">Rp {{ number_format((float) $detail->price, 0, ',', '.') }}</td>
                                <td class="numeric">Rp {{ number_format((float) $detail->price * (int) $detail->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center;">Detail produk tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>

            <section class="totals">
                <div class="total-line">
                    <span>Subtotal produk</span>
                    <strong>Rp {{ number_format((float) $order->details->sum(fn ($detail) => (float) $detail->price * (int) $detail->quantity), 0, ',', '.') }}</strong>
                </div>
                <div class="total-line">
                    <span>Ongkos kirim</span>
                    <span class="free-shipping">Gratis</span>
                </div>
                <div class="total-line grand-total">
                    <span>Total pesanan</span>
                    <span>Rp {{ number_format((float) $order->total, 0, ',', '.') }}</span>
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
