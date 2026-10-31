@extends('layouts.admin')

@section('content')
<style>
    .create-product-page {
        --cp-green: #496b55;
        --cp-green-dark: #304b39;
        --cp-sage: #edf3eb;
        --cp-cream: #faf9f5;
        --cp-border: #e3e8e0;
        --cp-text: #29332c;
        --cp-muted: #788078;
        width: 100%;
        color: var(--cp-text);
    }

    .create-product-page * { box-sizing: border-box; }

    .create-product-heading { margin-bottom: 24px; }

    .create-product-eyebrow {
        margin: 0 0 8px;
        color: var(--cp-green);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .create-product-title {
        margin: 0;
        color: var(--cp-text);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 600;
    }

    .create-product-subtitle {
        margin: 9px 0 0;
        color: var(--cp-muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .create-product-card {
        max-width: 900px;
        padding: clamp(20px, 4vw, 34px);
        background: #fff;
        border: 1px solid var(--cp-border);
        border-radius: 18px;
        box-shadow: 0 8px 28px rgba(40, 60, 42, .045);
    }

    .create-product-section-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 18px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--cp-border);
    }

    .create-product-step {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 38px;
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: var(--cp-sage);
        color: var(--cp-green-dark);
        font-size: 12px;
        font-weight: 700;
    }

    .create-product-section-heading h2 {
        margin: 0 0 4px;
        font-size: 16px;
        font-weight: 700;
    }

    .create-product-section-heading p {
        margin: 0;
        color: var(--cp-muted);
        font-size: 12px;
    }

    .create-product-alert {
        margin-bottom: 22px;
        padding: 14px 16px;
        border-radius: 10px;
        font-size: 13px;
        line-height: 1.7;
    }

    .create-product-alert ul { margin: 8px 0 0; padding-left: 20px; }

    .create-product-alert-error {
        color: #a33131;
        background: #fff0ef;
        border: 1px solid #f1d0cd;
    }

    .create-product-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .create-product-field { min-width: 0; }
    .create-product-field-full { grid-column: 1 / -1; }

    .create-product-label {
        display: block;
        margin-bottom: 8px;
        color: var(--cp-text);
        font-size: 13px;
        font-weight: 700;
    }

    .create-product-input,
    .create-product-select,
    .create-product-textarea {
        display: block;
        width: 100%;
        min-height: 46px;
        padding: 12px 14px;
        border: 1px solid #dce3da;
        border-radius: 9px;
        background: #fff;
        color: var(--cp-text);
        font: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .create-product-input:focus,
    .create-product-select:focus,
    .create-product-textarea:focus {
        border-color: var(--cp-green);
        box-shadow: 0 0 0 3px rgba(73, 107, 85, .11);
    }

    .create-product-textarea {
        min-height: 135px;
        resize: vertical;
        line-height: 1.7;
    }

    .create-product-help {
        display: block;
        margin-top: 7px;
        color: var(--cp-muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .create-product-upload {
        padding: 18px;
        border: 1px dashed #cbd7c9;
        border-radius: 12px;
        background: #fbfcfa;
    }

    .create-product-upload input[type="file"] {
        display: block;
        width: 100%;
        max-width: 100%;
        color: var(--cp-muted);
        font: inherit;
        font-size: 12px;
    }

    .create-product-preview {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 14px;
        margin-top: 16px;
    }

    .create-product-preview-item { min-width: 0; }

    .create-product-preview img {
        display: block;
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border: 1px solid var(--cp-border);
        border-radius: 12px;
        background: var(--cp-cream);
    }

    .create-product-preview-caption {
        margin-top: 6px;
        color: var(--cp-muted);
        font-size: 10px;
    }

    .create-product-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid var(--cp-border);
    }

    .create-product-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 43px;
        padding: 11px 18px;
        border: 0;
        border-radius: 9px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none !important;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .create-product-button:hover { transform: translateY(-1px); }

    .create-product-button-primary {
        background: var(--cp-green);
        color: #fff !important;
    }

    .create-product-button-primary:hover { background: var(--cp-green-dark); }

    .create-product-button-secondary {
        background: #f0f2ed;
        color: #455247 !important;
    }

    .create-product-button-secondary:hover { background: #e5e9e1; }

    .create-product-button-dark {
        background: #34463a;
        color: #fff !important;
    }

    .create-product-button-dark:hover { background: #25352a; }

    @media (max-width: 600px) {
        .create-product-grid { grid-template-columns: 1fr; gap: 17px; }
        .create-product-field-full { grid-column: auto; }
        .create-product-actions { align-items: stretch; }
        .create-product-actions .create-product-button { flex: 1 1 100%; }
        .create-product-preview { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }
</style>

<div class="create-product-page">
    <header class="create-product-heading">
        <p class="create-product-eyebrow">Bloomcraft Admin</p>
        <h1 class="create-product-title">Tambah Produk</h1>
        <p class="create-product-subtitle">
            Tambahkan produk baru ke katalog Bloomcraft dengan informasi yang lengkap.
        </p>
    </header>

    <section class="create-product-card">
        <div class="create-product-section-heading">
            <div class="create-product-step">01</div>
            <div>
                <h2>Informasi Produk</h2>
                <p>Isi detail produk, harga, stok, foto, dan deskripsinya.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="create-product-alert create-product-alert-error" role="alert">
                <strong>Produk belum dapat disimpan. Periksa data berikut:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="create-product-grid">
                <div class="create-product-field create-product-field-full">
                    <label class="create-product-label" for="product-name">Nama Produk</label>
                    <input
                        class="create-product-input"
                        id="product-name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama produk"
                        required
                    >
                </div>

                <div class="create-product-field create-product-field-full">
                    <label class="create-product-label" for="category-id">Kategori</label>
                    <select class="create-product-select" id="category-id" name="category_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="create-product-field">
                    <label class="create-product-label" for="product-price">Harga (Rp)</label>
                    <input
                        class="create-product-input"
                        id="product-price"
                        type="number"
                        name="price"
                        value="{{ old('price') }}"
                        placeholder="Contoh: 150000"
                        min="0"
                        step="any"
                        required
                    >
                    <small class="create-product-help">Masukkan harga jual produk.</small>
                </div>

                <div class="create-product-field">
                    <label class="create-product-label" for="product-stock">Stok</label>
                    <input
                        class="create-product-input"
                        id="product-stock"
                        type="number"
                        name="stock"
                        value="{{ old('stock') }}"
                        placeholder="Jumlah stok"
                        min="0"
                        required
                    >
                    <small class="create-product-help">Masukkan jumlah produk yang tersedia.</small>
                </div>

                <div class="create-product-field create-product-field-full">
                    <label class="create-product-label" for="images">Foto Produk</label>
                    <div class="create-product-upload">
                        <input
                            type="file"
                            name="images[]"
                            id="images"
                            multiple
                            accept="image/*"
                        >
                        <small class="create-product-help">
                            Pilih maksimal 5 foto. Format JPG, PNG, atau JPEG dengan ukuran maksimal 2 MB per foto.
                        </small>
                        <div id="preview" class="create-product-preview"></div>
                    </div>
                </div>

                <div class="create-product-field create-product-field-full">
                    <label class="create-product-label" for="product-description">Deskripsi</label>
                    <textarea
                        class="create-product-textarea"
                        id="product-description"
                        name="description"
                        placeholder="Tuliskan deskripsi dan detail produk..."
                        required
                    >{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="create-product-actions">
                <button type="submit" class="create-product-button create-product-button-primary">
                    Simpan Produk
                </button>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="create-product-button create-product-button-secondary"
                >
                    Kembali ke Produk
                </a>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="create-product-button create-product-button-dark"
                >
                    Dashboard
                </a>
            </div>
        </form>
    </section>
</div>

<script>
    const productImageInput = document.getElementById('images');

    if (productImageInput) {
        productImageInput.addEventListener('change', function (event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';

            const files = Array.from(event.target.files || []);

            if (files.length > 5) {
                alert('Maksimal upload 5 foto');
                this.value = '';
                return;
            }

            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            const invalidFile = files.find(function (file) {
                return !allowedTypes.includes(file.type) || file.size > 2 * 1024 * 1024;
            });

            if (invalidFile) {
                alert('Gunakan format JPG, PNG, atau JPEG dengan ukuran maksimal 2 MB per foto.');
                this.value = '';
                return;
            }

            files.forEach(function (file, index) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'create-product-preview-item';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Pratinjau foto produk ' + (index + 1);

                    const caption = document.createElement('div');
                    caption.className = 'create-product-preview-caption';
                    caption.textContent = 'Foto ' + (index + 1);

                    wrapper.appendChild(img);
                    wrapper.appendChild(caption);
                    preview.appendChild(wrapper);
                };

                reader.readAsDataURL(file);
            });
        });
    }
</script>
@endsection
