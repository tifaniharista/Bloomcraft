@extends('layouts.admin')

@section('content')
<style>
    .edit-product-page {
        --ep-green: #496b55;
        --ep-green-dark: #304b39;
        --ep-sage: #edf3eb;
        --ep-cream: #faf9f5;
        --ep-border: #e3e8e0;
        --ep-text: #29332c;
        --ep-muted: #788078;
        color: var(--ep-text);
        width: 100%;
    }

    .edit-product-page * { box-sizing: border-box; }

    .edit-product-heading {
        margin-bottom: 24px;
    }

    .edit-product-eyebrow {
        margin: 0 0 8px;
        color: var(--ep-green);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .edit-product-title {
        margin: 0;
        color: var(--ep-text);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 600;
    }

    .edit-product-subtitle {
        margin: 9px 0 0;
        color: var(--ep-muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .edit-product-card {
        max-width: 900px;
        padding: clamp(20px, 4vw, 34px);
        background: #fff;
        border: 1px solid var(--ep-border);
        border-radius: 18px;
        box-shadow: 0 8px 28px rgba(40, 60, 42, .045);
    }

    .edit-product-section-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 18px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--ep-border);
    }

    .edit-product-step {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 38px;
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: var(--ep-sage);
        color: var(--ep-green-dark);
        font-size: 12px;
        font-weight: 700;
    }

    .edit-product-section-heading h2 {
        margin: 0 0 4px;
        font-size: 16px;
        font-weight: 700;
    }

    .edit-product-section-heading p {
        margin: 0;
        color: var(--ep-muted);
        font-size: 12px;
    }

    .edit-product-alert {
        margin-bottom: 22px;
        padding: 14px 16px;
        border-radius: 10px;
        font-size: 13px;
        line-height: 1.7;
    }

    .edit-product-alert ul { margin: 8px 0 0; padding-left: 20px; }
    .edit-product-alert-error {
        color: #a33131;
        background: #fff0ef;
        border: 1px solid #f1d0cd;
    }

    .edit-product-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .edit-product-field { min-width: 0; }
    .edit-product-field-full { grid-column: 1 / -1; }

    .edit-product-label {
        display: block;
        margin-bottom: 8px;
        color: var(--ep-text);
        font-size: 13px;
        font-weight: 700;
    }

    .edit-product-input,
    .edit-product-select,
    .edit-product-textarea {
        display: block;
        width: 100%;
        min-height: 46px;
        padding: 12px 14px;
        border: 1px solid #dce3da;
        border-radius: 9px;
        background: #fff;
        color: var(--ep-text);
        font: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .edit-product-input:focus,
    .edit-product-select:focus,
    .edit-product-textarea:focus {
        border-color: var(--ep-green);
        box-shadow: 0 0 0 3px rgba(73, 107, 85, .11);
    }

    .edit-product-textarea {
        min-height: 135px;
        resize: vertical;
        line-height: 1.7;
    }

    .edit-product-help {
        display: block;
        margin-top: 7px;
        color: var(--ep-muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .edit-product-upload {
        padding: 18px;
        border: 1px dashed #cbd7c9;
        border-radius: 12px;
        background: #fbfcfa;
    }

    .edit-product-upload input[type="file"] {
        display: block;
        width: 100%;
        max-width: 100%;
        color: var(--ep-muted);
        font: inherit;
        font-size: 12px;
    }

    .edit-product-preview,
    .edit-product-current-images {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 14px;
        margin-top: 16px;
    }

    .edit-product-preview-item,
    .edit-product-image-item {
        position: relative;
        min-width: 0;
    }

    .edit-product-preview img,
    .edit-product-current-image {
        display: block;
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border: 1px solid var(--ep-border);
        border-radius: 12px;
        background: var(--ep-cream);
    }

    .edit-product-image-caption {
        margin-top: 6px;
        color: var(--ep-muted);
        font-size: 10px;
        overflow-wrap: anywhere;
    }

    .edit-product-delete-image {
        position: absolute;
        top: -8px;
        right: -8px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 29px;
        height: 29px;
        border: 2px solid #fff;
        border-radius: 50%;
        background: #bd3e36;
        color: #fff;
        font-size: 19px;
        line-height: 1;
        cursor: pointer;
        box-shadow: 0 3px 9px rgba(0, 0, 0, .12);
    }

    .edit-product-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid var(--ep-border);
    }

    .edit-product-button {
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

    .edit-product-button:hover { transform: translateY(-1px); }
    .edit-product-button-primary {
        background: var(--ep-green);
        color: #fff !important;
    }
    .edit-product-button-primary:hover { background: var(--ep-green-dark); }
    .edit-product-button-secondary {
        background: #f0f2ed;
        color: #455247 !important;
    }
    .edit-product-button-secondary:hover { background: #e5e9e1; }

    .edit-product-existing {
        max-width: 900px;
        margin-top: 24px;
        padding: clamp(20px, 4vw, 30px);
        background: #fff;
        border: 1px solid var(--ep-border);
        border-radius: 18px;
        box-shadow: 0 8px 28px rgba(40, 60, 42, .035);
    }

    .edit-product-existing-heading {
        margin-bottom: 6px;
        font-size: 17px;
        font-weight: 700;
    }

    .edit-product-existing-description {
        margin: 0;
        color: var(--ep-muted);
        font-size: 12px;
        line-height: 1.7;
    }

    .edit-product-no-images {
        grid-column: 1 / -1;
        padding: 24px;
        border: 1px dashed var(--ep-border);
        border-radius: 12px;
        color: var(--ep-muted);
        background: var(--ep-cream);
        font-size: 13px;
        text-align: center;
    }

    .edit-product-dashboard-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 22px;
        color: var(--ep-green-dark) !important;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none !important;
    }

    .edit-product-dashboard-link:hover { text-decoration: underline !important; }

    @media (max-width: 600px) {
        .edit-product-grid { grid-template-columns: 1fr; gap: 17px; }
        .edit-product-field-full { grid-column: auto; }
        .edit-product-actions { align-items: stretch; }
        .edit-product-actions .edit-product-button { flex: 1 1 100%; }
        .edit-product-preview,
        .edit-product-current-images { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }
</style>

<div class="edit-product-page">
    <header class="edit-product-heading">
        <p class="edit-product-eyebrow">Bloomcraft Admin</p>
        <h1 class="edit-product-title">Edit Produk</h1>
        <p class="edit-product-subtitle">
            Perbarui informasi produk, harga, stok, deskripsi, dan foto katalog.
        </p>
    </header>

    <section class="edit-product-card">
        <div class="edit-product-section-heading">
            <div class="edit-product-step">01</div>
            <div>
                <h2>Informasi Produk</h2>
                <p>Pastikan data yang diperbarui sudah benar.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="edit-product-alert edit-product-alert-error" role="alert">
                <strong>Ada data yang perlu diperiksa.</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $images = $product->image;

            if (!is_array($images)) {
                $images = json_decode($product->image, true);
            }

            if (!is_array($images)) {
                $images = $product->image ? [$product->image] : [];
            }
        @endphp

        <form
            method="POST"
            action="{{ route('admin.products.update', $product->id) }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="edit-product-grid">
                <div class="edit-product-field edit-product-field-full">
                    <label class="edit-product-label" for="product-name">Nama Produk</label>
                    <input
                        class="edit-product-input"
                        id="product-name"
                        type="text"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        placeholder="Masukkan nama produk"
                        required
                    >
                </div>

                <div class="edit-product-field edit-product-field-full">
                    <label class="edit-product-label" for="category-id">Kategori</label>
                    <select class="edit-product-select" id="category-id" name="category_id" required>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="edit-product-field">
                    <label class="edit-product-label" for="product-price">Harga (Rp)</label>
                    <input
                        class="edit-product-input"
                        id="product-price"
                        type="number"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        min="0"
                        step="any"
                        required
                    >
                </div>

                <div class="edit-product-field">
                    <label class="edit-product-label" for="product-stock">Stok</label>
                    <input
                        class="edit-product-input"
                        id="product-stock"
                        type="number"
                        name="stock"
                        value="{{ old('stock', $product->stock) }}"
                        min="0"
                        required
                    >
                </div>

                <div class="edit-product-field edit-product-field-full">
                    <label class="edit-product-label" for="images">Tambah Foto Produk</label>
                    <div class="edit-product-upload">
                        <input
                            type="file"
                            name="images[]"
                            id="images"
                            multiple
                            accept="image/*"
                        >
                        <small class="edit-product-help">
                            Pilih maksimal 5 foto baru. Foto lama tetap tersimpan kecuali dihapus melalui bagian Foto Produk Saat Ini.
                        </small>
                        <div id="preview" class="edit-product-preview"></div>
                    </div>
                </div>

                <div class="edit-product-field edit-product-field-full">
                    <label class="edit-product-label" for="product-description">Deskripsi</label>
                    <textarea
                        class="edit-product-textarea"
                        id="product-description"
                        name="description"
                        placeholder="Jelaskan detail produk..."
                        required
                    >{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <div class="edit-product-actions">
                <button type="submit" class="edit-product-button edit-product-button-primary">
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="edit-product-button edit-product-button-secondary"
                >
                    Batal / Kembali
                </a>
            </div>
        </form>
    </section>

    <section class="edit-product-existing">
        <h2 class="edit-product-existing-heading">Foto Produk Saat Ini</h2>
        <p class="edit-product-existing-description">
            Foto yang sudah tersimpan. Gunakan tombol × untuk menghapus foto tertentu.
        </p>

        <div class="edit-product-current-images">
            @if(count($images) > 0)
                @foreach($images as $index => $image)
                    <div class="edit-product-image-item">
                        <img
                            src="{{ asset('storage/' . $image) }}"
                            alt="Foto {{ $product->name }} {{ $index + 1 }}"
                            class="edit-product-current-image"
                            loading="lazy"
                        >

                        <form
                            action="{{ route('admin.products.deleteImage', ['product' => $product->id, 'index' => $index]) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus foto ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="edit-product-delete-image"
                                aria-label="Hapus foto {{ $index + 1 }}"
                                title="Hapus foto"
                            >
                                &times;
                            </button>
                        </form>

                        <div class="edit-product-image-caption">Foto {{ $index + 1 }}</div>
                    </div>
                @endforeach
            @else
                <div class="edit-product-no-images">
                    Belum ada foto produk. Kamu dapat menambahkan foto melalui formulir di atas.
                </div>
            @endif
        </div>
    </section>

    <a href="{{ route('admin.dashboard') }}" class="edit-product-dashboard-link">
        <span aria-hidden="true">←</span> Kembali ke Dashboard
    </a>
</div>

<script>
    const imageInput = document.getElementById('images');

    if (imageInput) {
        imageInput.addEventListener('change', function (event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';

            const files = Array.from(event.target.files || []);

            if (files.length > 5) {
                alert('Maksimal upload 5 foto');
                this.value = '';
                return;
            }

            files.forEach(function (file) {
                if (!file.type.startsWith('image/')) {
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (e) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'edit-product-preview-item';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Pratinjau foto baru';

                    wrapper.appendChild(img);
                    preview.appendChild(wrapper);
                };

                reader.readAsDataURL(file);
            });
        });
    }
</script>
@endsection
