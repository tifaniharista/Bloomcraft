<?php $__env->startSection('content'); ?>
<style>
    .create-category-page {
        --cc-green: #496b55;
        --cc-green-dark: #304b39;
        --cc-sage: #edf3eb;
        --cc-border: #e3e8e0;
        --cc-text: #29332c;
        --cc-muted: #788078;
        width: 100%;
        color: var(--cc-text);
    }

    .create-category-page * { box-sizing: border-box; }

    .create-category-heading { margin-bottom: 24px; }

    .create-category-eyebrow {
        margin: 0 0 8px;
        color: var(--cc-green);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .create-category-title {
        margin: 0;
        color: var(--cc-text);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 600;
    }

    .create-category-subtitle {
        margin: 9px 0 0;
        color: var(--cc-muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .create-category-card {
        max-width: 760px;
        padding: clamp(20px, 4vw, 34px);
        background: #fff;
        border: 1px solid var(--cc-border);
        border-radius: 18px;
        box-shadow: 0 8px 28px rgba(40, 60, 42, .045);
    }

    .create-category-section-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 18px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--cc-border);
    }

    .create-category-step {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 38px;
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: var(--cc-sage);
        color: var(--cc-green-dark);
        font-size: 12px;
        font-weight: 700;
    }

    .create-category-section-heading h2 {
        margin: 0 0 4px;
        font-size: 16px;
        font-weight: 700;
    }

    .create-category-section-heading p {
        margin: 0;
        color: var(--cc-muted);
        font-size: 12px;
    }

    .create-category-label {
        display: block;
        margin-bottom: 8px;
        color: var(--cc-text);
        font-size: 13px;
        font-weight: 700;
    }

    .create-category-input {
        display: block;
        width: 100%;
        max-width: 100%;
        min-height: 48px;
        padding: 13px 15px;
        border: 1px solid #dce3da;
        border-radius: 9px;
        background: #fff;
        color: var(--cc-text);
        font: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .create-category-input:focus {
        border-color: var(--cc-green);
        box-shadow: 0 0 0 3px rgba(73, 107, 85, .11);
    }

    .create-category-help {
        display: block;
        margin-top: 8px;
        color: var(--cc-muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .create-category-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid var(--cc-border);
    }

    .create-category-button {
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

    .create-category-button:hover { transform: translateY(-1px); }

    .create-category-primary {
        background: var(--cc-green);
        color: #fff !important;
    }

    .create-category-primary:hover { background: var(--cc-green-dark); }

    .create-category-secondary {
        background: #f0f2ed;
        color: #455247 !important;
    }

    .create-category-secondary:hover { background: #e5e9e1; }

    @media (max-width: 600px) {
        .create-category-actions { align-items: stretch; }
        .create-category-actions .create-category-button { flex: 1 1 100%; }
    }
</style>

<div class="create-category-page">
    <header class="create-category-heading">
        <p class="create-category-eyebrow">Bloomcraft Admin</p>
        <h1 class="create-category-title">Tambah Kategori</h1>
        <p class="create-category-subtitle">
            Buat kategori baru untuk mengelompokkan produk Bloomcraft.
        </p>
    </header>

    <section class="create-category-card">
        <div class="create-category-section-heading">
            <div class="create-category-step">01</div>
            <div>
                <h2>Informasi Kategori</h2>
                <p>Masukkan nama kategori yang akan ditampilkan pada katalog.</p>
            </div>
        </div>

        <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>">
            <?php echo csrf_field(); ?>

            <div>
                <label class="create-category-label" for="name">Nama Kategori</label>
                <input
                    class="create-category-input"
                    type="text"
                    id="name"
                    name="name"
                    value="<?php echo e(old('name')); ?>"
                    placeholder="Contoh: Buket Bunga"
                    required
                    autofocus
                >
                <small class="create-category-help">
                    Gunakan nama yang singkat, jelas, dan mudah dikenali pelanggan.
                </small>
            </div>

            <div class="create-category-actions">
                <button type="submit" class="create-category-button create-category-primary">
                    Simpan Kategori
                </button>

                <a
                    href="<?php echo e(route('admin.categories.index')); ?>"
                    class="create-category-button create-category-secondary"
                >
                    Kembali ke Kategori
                </a>
            </div>
        </form>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>