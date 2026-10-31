<?php $__env->startSection('content'); ?>
<style>
    .products-page {
        --bp-green: #496b55;
        --bp-green-dark: #304b39;
        --bp-sage: #edf3eb;
        --bp-cream: #faf9f5;
        --bp-border: #e5e9e2;
        --bp-text: #29332c;
        --bp-muted: #788078;
        color: var(--bp-text);
        width: 100%;
    }

    .products-page * { box-sizing: border-box; }

    .products-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 26px;
    }

    .products-eyebrow {
        color: var(--bp-green);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 11px;
        font-weight: 700;
        margin: 0 0 8px;
    }

    .products-title {
        margin: 0;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 600;
        letter-spacing: -.5px;
        color: var(--bp-text);
    }

    .products-description {
        margin: 9px 0 0;
        color: var(--bp-muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .products-add-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 12px 18px;
        border-radius: 10px;
        background: var(--bp-green);
        color: #fff !important;
        text-decoration: none !important;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 5px 14px rgba(73, 107, 85, .15);
        transition: background .2s, transform .2s;
    }

    .products-add-button:hover {
        background: var(--bp-green-dark);
        transform: translateY(-1px);
    }

    .products-alert {
        padding: 14px 16px;
        border-radius: 11px;
        margin-bottom: 20px;
        font-size: 13px;
        line-height: 1.7;
    }

    .products-alert-success {
        background: #edf7ed;
        color: #27613a;
        border: 1px solid #d2e8d3;
    }

    .products-card {
        background: #fff;
        border: 1px solid var(--bp-border);
        border-radius: 16px;
        box-shadow: 0 8px 26px rgba(40, 60, 42, .045);
        overflow: hidden;
    }

    .products-card-top {
        padding: 20px 23px;
        border-bottom: 1px solid var(--bp-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .products-card-top h2 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: var(--bp-text);
    }

    .products-count {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        background: var(--bp-sage);
        color: var(--bp-green-dark);
        font-size: 11px;
        font-weight: 700;
    }

    .products-table-scroll { width: 100%; overflow-x: auto; }

    .products-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 760px;
    }

    .products-table thead th {
        background: #f7f8f5;
        color: #68736a;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .8px;
        font-weight: 700;
        text-align: left;
        padding: 15px 18px;
        border-bottom: 1px solid var(--bp-border);
        white-space: nowrap;
    }

    .products-table tbody td {
        padding: 15px 18px;
        border-bottom: 1px solid #eef0eb;
        font-size: 13px;
        vertical-align: middle;
    }

    .products-table tbody tr:last-child td { border-bottom: 0; }
    .products-table tbody tr { transition: background .15s; }
    .products-table tbody tr:hover { background: #fcfdfb; }

    .product-number {
        color: #8b948b;
        font-size: 12px;
        font-weight: 600;
    }

    .product-image {
        display: block;
        width: 62px;
        height: 62px;
        object-fit: cover;
        object-position: center;
        border-radius: 11px;
        border: 1px solid var(--bp-border);
        background: var(--bp-cream);
    }

    .product-image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 62px;
        height: 62px;
        border-radius: 11px;
        border: 1px dashed #d8ded5;
        background: var(--bp-cream);
        color: #879087;
        font-size: 10px;
        text-align: center;
        padding: 5px;
    }

    .product-name {
        color: var(--bp-text);
        font-size: 13px;
        font-weight: 700;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .product-category { color: var(--bp-muted); }

    .product-price {
        color: var(--bp-green-dark);
        font-weight: 700;
        white-space: nowrap;
    }

    .product-stock {
        display: inline-flex;
        min-width: 36px;
        justify-content: center;
        padding: 6px 9px;
        border-radius: 8px;
        background: var(--bp-sage);
        color: var(--bp-green-dark);
        font-size: 12px;
        font-weight: 700;
    }

    .product-stock-low {
        background: #fff2dd;
        color: #996318;
    }

    .product-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        white-space: nowrap;
    }

    .product-action {
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
        transition: filter .2s, transform .2s;
    }

    .product-action:hover { filter: brightness(.94); transform: translateY(-1px); }
    .product-action-edit { background: #e8f1e7; color: #365b3e !important; }
    .product-action-delete { background: #fff0ee; color: #b33c34; }

    .products-empty {
        text-align: center;
        padding: 48px 20px !important;
        color: var(--bp-muted);
    }

    .products-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        height: 54px;
        margin: 0 auto 14px;
        border-radius: 16px;
        background: var(--bp-sage);
        color: var(--bp-green);
        font-size: 23px;
    }

    .products-empty strong {
        display: block;
        margin-bottom: 5px;
        color: var(--bp-text);
        font-size: 14px;
    }

    .products-empty span { font-size: 12px; }

    @media (max-width: 640px) {
        .products-heading { align-items: stretch; }
        .products-add-button { width: 100%; }
        .products-card-top { padding: 17px; }
        .products-table thead th,
        .products-table tbody td { padding: 12px; }
    }
</style>

<div class="products-page">
    <header class="products-heading">
        <div>
            <p class="products-eyebrow">Bloomcraft Admin</p>
            <h1 class="products-title">Data Produk</h1>
            <p class="products-description">
                Kelola katalog, harga, kategori, dan stok produk Bloomcraft.
            </p>
        </div>

        <a href="<?php echo e(route('admin.products.create')); ?>" class="products-add-button">
            <span aria-hidden="true">+</span>
            Tambah Produk
        </a>
    </header>

    <?php if(session('success')): ?>
        <div class="products-alert products-alert-success" role="status">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <section class="products-card">
        <div class="products-card-top">
            <h2>Daftar Produk</h2>
            <span class="products-count">
                <?php echo e($products->count()); ?> produk
            </span>
        </div>

        <div class="products-table-scroll">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <span class="product-number"><?php echo e($loop->iteration); ?></span>
                            </td>

                            <td>
                                <?php
                                    $images = $product->image;

                                    // Pertahankan dukungan untuk data gambar berupa JSON atau string.
                                    if (!is_array($images)) {
                                        $images = json_decode($images, true);
                                    }

                                    if (!is_array($images)) {
                                        $images = $product->image
                                            ? [$product->image]
                                            : [];
                                    }
                                ?>

                                <?php if(count($images) > 0): ?>
                                    <img
                                        src="<?php echo e(asset('storage/' . $images[0])); ?>"
                                        alt="<?php echo e($product->name); ?>"
                                        class="product-image"
                                        loading="lazy"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                    >
                                    <div class="product-image-placeholder" style="display:none;">
                                        Gambar tidak tersedia
                                    </div>

                                    <?php if(count($images) > 1): ?>
                                        <div style="font-size:10px;color:#788078;margin-top:5px;">
                                            <?php echo e(count($images)); ?> foto
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="product-image-placeholder">
                                        Tidak ada gambar
                                    </div>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="product-name"><?php echo e($product->name); ?></div>
                            </td>

                            <td>
                                <span class="product-category">
                                    <?php echo e($product->category->name ?? '-'); ?>

                                </span>
                            </td>

                            <td>
                                <span class="product-price">
                                    Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                                </span>
                            </td>

                            <td>
                                <span class="product-stock <?php echo e($product->stock <= 5 ? 'product-stock-low' : ''); ?>">
                                    <?php echo e($product->stock); ?>

                                </span>
                            </td>

                            <td>
                                <div class="product-actions">
                                    <a
                                        href="<?php echo e(route('admin.products.edit', $product->id)); ?>"
                                        class="product-action product-action-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="<?php echo e(route('admin.products.destroy', $product->id)); ?>"
                                        method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Hapus produk ini?')"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button
                                            type="submit"
                                            class="product-action product-action-delete"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="products-empty">
                                <div class="products-empty-icon" aria-hidden="true">♡</div>
                                <strong>Belum ada produk</strong>
                                <span>Tambahkan produk pertama untuk mulai mengisi katalog Bloomcraft.</span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/admin/products/index.blade.php ENDPATH**/ ?>