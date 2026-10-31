<?php $__env->startSection('content'); ?>
<style>
    .bc-dashboard {
        --bc-green: #496b55;
        --bc-green-dark: #304b39;
        --bc-sage: #edf3eb;
        --bc-cream: #faf9f5;
        --bc-text: #29332c;
        --bc-muted: #788078;
        --bc-border: #e5e9e1;
        color: var(--bc-text);
        padding: 8px 0 28px;
    }

    .bc-dashboard * { box-sizing: border-box; }

    .bc-dashboard-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 28px;
    }

    .bc-eyebrow {
        margin: 0 0 8px;
        color: var(--bc-green);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
    }

    .bc-dashboard-title {
        margin: 0;
        font-size: clamp(26px, 3vw, 34px);
        font-weight: 750;
        letter-spacing: -0.8px;
        color: var(--bc-text);
    }

    .bc-dashboard-welcome {
        margin: 9px 0 0;
        color: var(--bc-muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .bc-admin-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border: 1px solid var(--bc-border);
        border-radius: 999px;
        background: #fff;
        color: var(--bc-green-dark);
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .bc-admin-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #6c9a72;
        box-shadow: 0 0 0 3px #e7f1e5;
    }

    .bc-stat-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 26px;
    }

    .bc-stat-card {
        position: relative;
        overflow: hidden;
        min-width: 0;
        padding: 22px;
        border: 1px solid var(--bc-border);
        border-radius: 17px;
        background: #fff;
        box-shadow: 0 5px 22px rgba(41, 51, 44, .035);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .bc-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(41, 51, 44, .08);
    }

    .bc-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 22px;
    }

    .bc-stat-label {
        margin: 0;
        color: var(--bc-muted);
        font-size: 13px;
        font-weight: 600;
    }

    .bc-stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        border-radius: 13px;
        background: var(--bc-sage);
        color: var(--bc-green);
        font-size: 20px;
    }

    .bc-stat-value {
        margin: 0;
        color: var(--bc-text);
        font-size: clamp(27px, 3vw, 35px);
        font-weight: 800;
        letter-spacing: -1px;
        line-height: 1.2;
        overflow-wrap: anywhere;
    }

    .bc-stat-caption {
        margin: 8px 0 0;
        color: #929990;
        font-size: 11px;
    }

    .bc-content-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.8fr) minmax(240px, .85fr);
        gap: 22px;
        align-items: start;
    }

    .bc-panel {
        min-width: 0;
        padding: 25px;
        border: 1px solid var(--bc-border);
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 5px 22px rgba(41, 51, 44, .035);
    }

    .bc-panel-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 22px;
    }

    .bc-panel-title {
        margin: 0;
        color: var(--bc-text);
        font-size: 18px;
        font-weight: 750;
        letter-spacing: -.3px;
    }

    .bc-panel-subtitle {
        margin: 6px 0 0;
        color: var(--bc-muted);
        font-size: 12px;
        line-height: 1.6;
    }

    .bc-text-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 12px;
        border: 1px solid #dce7da;
        border-radius: 9px;
        background: #f7faf5;
        color: var(--bc-green-dark);
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        transition: background .2s ease;
    }

    .bc-text-link:hover { background: var(--bc-sage); }

    .bc-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #edf0ea;
        border-radius: 12px;
    }

    .bc-product-table {
        width: 100%;
        min-width: 460px;
        border-collapse: collapse;
        text-align: left;
    }

    .bc-product-table thead { background: #f5f7f2; }

    .bc-product-table th {
        padding: 14px 16px;
        color: #667267;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .bc-product-table td {
        padding: 16px;
        border-top: 1px solid #edf0ea;
        color: #475148;
        font-size: 13px;
        vertical-align: middle;
    }

    .bc-product-table tbody tr { transition: background .15s ease; }
    .bc-product-table tbody tr:hover { background: #fbfcf9; }

    .bc-product-name {
        color: var(--bc-text) !important;
        font-weight: 700;
    }

    .bc-category-tag {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 7px;
        background: var(--bc-sage);
        color: var(--bc-green-dark);
        font-size: 11px;
        font-weight: 700;
    }

    .bc-product-price {
        color: var(--bc-green-dark) !important;
        font-weight: 750;
        white-space: nowrap;
    }

    .bc-empty-state {
        padding: 34px 18px;
        text-align: center;
        color: var(--bc-muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .bc-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        margin: 0 auto 12px;
        border-radius: 15px;
        background: var(--bc-sage);
        color: var(--bc-green);
        font-size: 22px;
    }

    .bc-quick-card {
        padding: 18px;
        border: 1px solid var(--bc-border);
        border-radius: 13px;
        background: #fff;
    }

    .bc-quick-card + .bc-quick-card { margin-top: 12px; }

    .bc-quick-link {
        display: flex;
        align-items: center;
        gap: 13px;
        color: var(--bc-text);
        text-decoration: none;
    }

    .bc-quick-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 43px;
        height: 43px;
        flex: 0 0 43px;
        border-radius: 12px;
        background: var(--bc-sage);
        color: var(--bc-green);
        font-size: 19px;
    }

    .bc-quick-title {
        display: block;
        font-size: 13px;
        font-weight: 750;
    }

    .bc-quick-description {
        display: block;
        margin-top: 4px;
        color: var(--bc-muted);
        font-size: 11px;
        line-height: 1.5;
    }

    .bc-quick-arrow {
        margin-left: auto;
        color: #8a9589;
        font-size: 18px;
    }

    .bc-quick-link:hover .bc-quick-title { color: var(--bc-green); }

    @media (max-width: 1100px) {
        .bc-stat-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .bc-content-grid { grid-template-columns: minmax(0, 1fr); }
    }

    @media (max-width: 600px) {
        .bc-dashboard { padding-top: 0; }
        .bc-dashboard-header { align-items: flex-start; margin-bottom: 20px; }
        .bc-admin-pill { font-size: 11px; }
        .bc-stat-grid { gap: 12px; margin-bottom: 18px; }
        .bc-stat-card { padding: 16px; border-radius: 14px; }
        .bc-stat-top { align-items: flex-start; margin-bottom: 17px; }
        .bc-stat-icon { width: 36px; height: 36px; flex-basis: 36px; font-size: 17px; }
        .bc-stat-label { font-size: 12px; }
        .bc-stat-value { font-size: 27px; }
        .bc-panel { padding: 18px 15px; border-radius: 15px; }
        .bc-panel-header { flex-wrap: wrap; }
        .bc-text-link { font-size: 11px; }
    }
</style>

<div class="bc-dashboard">
    <header class="bc-dashboard-header">
        <div>
            <p class="bc-eyebrow">Bloomcraft · Admin Workspace</p>
            <h1 class="bc-dashboard-title">Dashboard Admin</h1>
            <p class="bc-dashboard-welcome">
                Selamat datang kembali, <strong><?php echo e(Auth::user()->name); ?></strong>. Berikut ringkasan toko kamu.
            </p>
        </div>
        <div class="bc-admin-pill">
            <span class="bc-admin-dot" aria-hidden="true"></span>
            Panel Admin
        </div>
    </header>

    <section class="bc-stat-grid" aria-label="Ringkasan statistik">
        <article class="bc-stat-card">
            <div class="bc-stat-top">
                <p class="bc-stat-label">Total Produk</p>
                <span class="bc-stat-icon" aria-hidden="true">▤</span>
            </div>
            <p class="bc-stat-value"><?php echo e($totalProducts); ?></p>
            <p class="bc-stat-caption">Produk dalam katalog toko</p>
        </article>

        <article class="bc-stat-card">
            <div class="bc-stat-top">
                <p class="bc-stat-label">Total Kategori</p>
                <span class="bc-stat-icon" aria-hidden="true">▦</span>
            </div>
            <p class="bc-stat-value"><?php echo e($totalCategories); ?></p>
            <p class="bc-stat-caption">Kategori produk tersedia</p>
        </article>

        <article class="bc-stat-card">
            <div class="bc-stat-top">
                <p class="bc-stat-label">Total User</p>
                <span class="bc-stat-icon" aria-hidden="true">♙</span>
            </div>
            <p class="bc-stat-value"><?php echo e($totalUsers); ?></p>
            <p class="bc-stat-caption">Pengguna terdaftar</p>
        </article>

        <article class="bc-stat-card">
            <div class="bc-stat-top">
                <p class="bc-stat-label">Total Admin</p>
                <span class="bc-stat-icon" aria-hidden="true">♧</span>
            </div>
            <p class="bc-stat-value"><?php echo e($totalAdmins); ?></p>
            <p class="bc-stat-caption">Administrator terdaftar</p>
        </article>
    </section>

    <div class="bc-content-grid">
        <section class="bc-panel">
            <div class="bc-panel-header">
                <div>
                    <h2 class="bc-panel-title">Produk Terbaru</h2>
                    <p class="bc-panel-subtitle">Ringkasan produk yang ditampilkan di katalog.</p>
                </div>
                <a class="bc-text-link" href="<?php echo e(route('admin.products.index')); ?>">
                    Lihat semua <span aria-hidden="true">→</span>
                </a>
            </div>

            <?php if($products->count()): ?>
                <div class="bc-table-wrap">
                    <table class="bc-product-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="bc-product-name"><?php echo e($product->name); ?></td>
                                    <td><span class="bc-category-tag"><?php echo e($product->category->name ?? '-'); ?></span></td>
                                    <td class="bc-product-price">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="bc-empty-state">
                    <div class="bc-empty-icon" aria-hidden="true">▤</div>
                    <strong>Belum ada produk</strong><br>
                    Produk yang ditambahkan akan muncul di bagian ini.
                </div>
            <?php endif; ?>
        </section>

        <aside class="bc-panel">
            <div class="bc-panel-header">
                <div>
                    <h2 class="bc-panel-title">Aksi Cepat</h2>
                    <p class="bc-panel-subtitle">Akses singkat untuk mengelola toko.</p>
                </div>
            </div>

            <div class="bc-quick-card">
                <a class="bc-quick-link" href="<?php echo e(route('home')); ?>">
                    <span class="bc-quick-icon" aria-hidden="true">↗</span>
                    <span>
                        <span class="bc-quick-title">Lihat Website</span>
                        <span class="bc-quick-description">Buka tampilan toko untuk pengunjung.</span>
                    </span>
                    <span class="bc-quick-arrow" aria-hidden="true">›</span>
                </a>
            </div>

            <div class="bc-quick-card">
                <a class="bc-quick-link" href="<?php echo e(route('admin.products.index')); ?>">
                    <span class="bc-quick-icon" aria-hidden="true">＋</span>
                    <span>
                        <span class="bc-quick-title">Kelola Produk</span>
                        <span class="bc-quick-description">Lihat dan kelola katalog produk.</span>
                    </span>
                    <span class="bc-quick-arrow" aria-hidden="true">›</span>
                </a>
            </div>
        </aside>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>