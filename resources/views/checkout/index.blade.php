
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout | Bloomcraft</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --green: #496b55;
            --green-dark: #304b39;
            --green-light: #edf3eb;
            --cream: #faf9f5;
            --text: #29332c;
            --muted: #788078;
            --border: #e5e8e1;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text);
            min-height: 100vh;
        }

        .navbar {
            width: 100%;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 20px 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 29px;
            font-weight: 700;
            color: var(--green);
            letter-spacing: -0.8px;
        }

        .nav-label {
            font-size: 13px;
            color: var(--muted);
        }

        .page-wrapper {
            max-width: 1050px;
            width: calc(100% - 40px);
            margin: 52px auto 70px;
        }

        .page-heading {
            margin-bottom: 30px;
        }

        .eyebrow {
            color: var(--green);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .page-heading h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 5vw, 43px);
            font-weight: 600;
            margin-bottom: 12px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
            max-width: 620px;
        }

        .checkout-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(280px, 0.85fr);
            gap: 25px;
            align-items: start;
        }

        .checkout-card,
        .summary-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(40, 60, 42, 0.035);
        }

        .checkout-card {
            padding: 32px;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 27px;
        }

        .step-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--green-light);
            color: var(--green);
            font-weight: 700;
        }

        .section-heading h2 {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .section-heading p {
            font-size: 12px;
            color: var(--muted);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .form-control {
            display: block;
            width: 100%;
            min-height: 48px;
            padding: 13px 15px;
            font: inherit;
            font-size: 13px;
            color: var(--text);
            background: #fff;
            border: 1px solid #dfe4dc;
            border-radius: 9px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control::placeholder {
            color: #a2aaa1;
        }

        .form-control:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(73, 107, 85, 0.10);
        }

        textarea.form-control {
            min-height: 115px;
            resize: vertical;
            line-height: 1.7;
        }

        .field-error {
            color: #bd3737;
            font-size: 12px;
            margin-top: 7px;
        }

        .notice {
            display: flex;
            gap: 12px;
            padding: 15px;
            margin-bottom: 26px;
            border-radius: 10px;
            background: #f1f6ee;
            color: #49634c;
            font-size: 12px;
            line-height: 1.8;
        }

        .notice-icon {
            font-size: 18px;
            flex-shrink: 0;
        }

        .summary-card {
            padding: 27px;
            position: sticky;
            top: 24px;
        }

        .summary-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .summary-subtitle {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .summary-divider {
            border: 0;
            border-top: 1px solid var(--border);
            margin: 23px 0;
        }

        .summary-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 16px;
            font-size: 13px;
        }

        .summary-row span:first-child {
            color: var(--muted);
        }

        .summary-row strong {
            font-weight: 600;
            text-align: right;
        }

        .free-shipping {
            color: var(--green);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .total-label {
            font-size: 14px;
            font-weight: 600;
        }

        .total-amount {
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            color: var(--green);
            font-weight: 700;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .total-caption {
            text-align: right;
            font-size: 11px;
            color: var(--muted);
            margin-top: 5px;
        }

        .checkout-button {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 16px 20px;
            margin-top: 25px;
            background: var(--green);
            color: white;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .checkout-button:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
        }

        .checkout-button:focus-visible {
            outline: 3px solid #b8cdbb;
            outline-offset: 3px;
        }

        .payment-note {
            margin-top: 15px;
            text-align: center;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.8;
        }

        .secure-note {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            margin-top: 20px;
            color: var(--muted);
            font-size: 11px;
        }

        .alert {
            padding: 14px 16px;
            margin-bottom: 22px;
            border-radius: 9px;
            font-size: 13px;
            line-height: 1.8;
        }

        .alert-error {
            background: #fff0ef;
            color: #a32f2f;
            border: 1px solid #f2cecb;
        }

        .alert ul {
            padding-left: 20px;
        }

        .footer {
            text-align: center;
            padding: 0 20px 30px;
            font-size: 12px;
            color: var(--muted);
        }

        @media (max-width: 760px) {
            .navbar {
                padding: 18px 22px;
            }

            .logo {
                font-size: 25px;
            }

            .nav-label {
                font-size: 11px;
            }

            .page-wrapper {
                width: calc(100% - 28px);
                margin: 35px auto 45px;
            }

            .checkout-layout {
                grid-template-columns: 1fr;
            }

            .checkout-card {
                padding: 23px 19px;
            }

            .summary-card {
                position: static;
                padding: 23px 19px;
            }

            .page-heading h1 {
                font-size: 34px;
            }
        }

        @media (max-width: 380px) {
            .nav-label {
                display: none;
            }

            .total-amount {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">Bloomcraft.</div>
        <div class="nav-label">Checkout Aman &amp; Mudah</div>
    </nav>

    <main class="page-wrapper">

        <header class="page-heading">
            <div class="eyebrow">Bloomcraft Online Store</div>
            <h1>Selesaikan Pesananmu</h1>
            <p>
                Satu langkah lagi untuk membawa keindahan bunga pilihanmu.
                Lengkapi informasi pengiriman di bawah ini.
            </p>
        </header>

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <strong>Periksa kembali data kamu.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="checkout-layout">

            <section class="checkout-card">

                <div class="section-heading">
                    <div class="step-number">01</div>
                    <div>
                        <h2>Informasi Pengiriman</h2>
                        <p>Isi informasi penerima dengan benar.</p>
                    </div>
                </div>

                <div class="notice">
                    <span class="notice-icon" aria-hidden="true">&#10003;</span>
                    <p>
                        <strong>Gratis ongkos kirim!</strong><br>
                        Kamu hanya membayar harga produk. Setelah pesanan
                        dibuat, transfer ke rekening admin yang ditampilkan
                        pada halaman pesanan, lalu unggah bukti transfer.
                    </p>
                </div>

                <form method="POST" action="{{ route('checkout.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama lengkap</label>
                        <input
                            class="form-control"
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Masukkan nama penerima"
                            value="{{ old('name', auth()->user()->name ?? '') }}"
                            autocomplete="name"
                            required
                        >
                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat email</label>
                        <input
                            class="form-control"
                            type="email"
                            id="email"
                            name="email"
                            placeholder="nama@email.com"
                            value="{{ old('email', auth()->user()->email ?? '') }}"
                            autocomplete="email"
                            required
                        >
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Nomor telepon</label>
                        <input
                            class="form-control"
                            type="tel"
                            id="phone"
                            name="phone"
                            placeholder="Contoh: 081234567890"
                            value="{{ old('phone') }}"
                            autocomplete="tel"
                            required
                        >
                        @error('phone')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat lengkap</label>
                        <textarea
                            class="form-control"
                            id="address"
                            name="address"
                            placeholder="Nama jalan, nomor rumah, kelurahan, kecamatan, kota, dan kode pos"
                            autocomplete="street-address"
                            required
                        >{{ old('address') }}</textarea>
                        @error('address')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="checkout-button">
                        Buat Pesanan &mdash; Lanjut Pembayaran
                    </button>

                    <p class="payment-note">
                        Pastikan data penerima sudah benar sebelum membuat pesanan.
                    </p>
                </form>

            </section>

            <aside class="summary-card">

                <h2 class="summary-title">Ringkasan Pesanan</h2>
                <p class="summary-subtitle">
                    Periksa kembali total pembayaranmu sebelum melanjutkan.
                </p>

                <hr class="summary-divider">

                <div class="summary-row">
                    <span>Subtotal produk</span>
                    <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                </div>

                <div class="summary-row">
                    <span>Ongkos kirim</span>
                    <strong class="free-shipping">Gratis</strong>
                </div>

                <hr class="summary-divider">

                <div class="total-row">
                    <div class="total-label">Total pembayaran</div>
                    <div>
                        <div class="total-amount">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </div>
                        <div class="total-caption">Termasuk ongkos kirim</div>
                    </div>
                </div>

                <div class="secure-note">
                    <span aria-hidden="true">&#10003;</span>
                    <span>Periksa detail sebelum mengirim pesanan</span>
                </div>

            </aside>

        </div>
    </main>

    <footer class="footer">
        &copy; {{ date('Y') }} Bloomcraft. Made with care for every occasion.
    </footer>

</body>
</html>
