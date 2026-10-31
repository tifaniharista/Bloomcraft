<?php $__env->startSection('content'); ?>
<style>
    .edit-category-page {
        --ec-green: #496b55;
        --ec-green-dark: #304b39;
        --ec-sage: #edf3eb;
        --ec-border: #e3e8e0;
        --ec-text: #29332c;
        --ec-muted: #788078;
        width: 100%;
        color: var(--ec-text);
    }

    .edit-category-page * { box-sizing: border-box; }

    .edit-category-heading { margin-bottom: 24px; }

    .edit-category-eyebrow {
        margin: 0 0 8px;
        color: var(--ec-green);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .edit-category-title {
        margin: 0;
        color: var(--ec-text);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 600;
    }

    .edit-category-subtitle {
        margin: 9px 0 0;
        color: var(--ec-muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .edit-category-card {
        max-width: 760px;
        padding: clamp(20px, 4vw, 34px);
        background: #fff;
        border: 1px solid var(--ec-border);
        border-radius: 18px;
        box-shadow: 0 8px 28px rgba(40, 60, 42, .045);
    }

    .edit-category-section-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 18px;
        margin-bottom: 24px;
        border-bottom: 1px solid var(--ec-border);
    }

    .edit-category-step {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 38px;
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: var(--ec-sage);
        color: var(--ec-green-dark);
        font-size: 12px;
        font-weight: 700;
    }

    .edit-category-section-heading h2 {
        margin: 0 0 4px;
        font-size: 16px;
        font-weight: 700;
    }

    .edit-category-section-heading p {
        margin: 0;
        color: var(--ec-muted);
        font-size: 12px;
    }

    .edit-category-error {
        margin-bottom: 22px;
        padding: 14px 16px;
        border: 1px solid #f1d0cd;
        border-radius: 10px;
        background: #fff0ef;
        color: #a33131;
        font-size: 13px;
        line-height: 1.7;
    }

    .edit-category-error ul { margin: 8px 0 0; padding-left: 20px; }

    .edit-category-label {
        display: block;
        margin-bottom: 8px;
        color: var(--ec-text);
        font-size: 13px;
        font-weight: 700;
    }

    .edit-category-input {
        display: block;
        width: 100%;
        min-height: 48px;
        padding: 13px 15px;
        border: 1px solid #dce3da;
        border-radius: 9px;
        background: #fff;
        color: var(--ec-text);
        font: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .edit-category-input:focus {
        border-color: var(--ec-green);
        box-shadow: 0 0 0 3px rgba(73, 107, 85, .11);
    }

    .edit-category-help {
        display: block;
        margin-top: 8px;
        color: var(--ec-muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .edit-category-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid var(--ec-border);
    }

    .edit-category-button {
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

    .edit-category-button:hover { transform: translateY(-1px); }

    .edit-category-primary {
        background: var(--ec-green);
        color: #fff !important;
    }

    .edit-category-primary:hover { background: var(--ec-green-dark); }

    .edit-category-secondary {
        background: #f0f2ed;
        color: #455247 !important;
    }

    .edit-category-secondary:hover { background: #e5e9e1; }

    .edit-category-dashboard {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 22px;
        color: var(--ec-green-dark) !important;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none !important;
    }

    .edit-category-dashboard:hover { text-decoration: underline !important; }

    @media (max-width: 600px) {
        .edit-category-actions { align-items: stretch; }
        .edit-category-actions .edit-category-button { flex: 1 1 100%; }
    }
</style>

<div class="edit-category-page">
    <header class="edit-category-heading">
        <p class="edit-category-eyebrow">Bloomcraft Admin</p>
        <h1 class="edit-category-title">Edit Kategori</h1>
        <p class="edit-category-subtitle">
            Perbarui nama kategori untuk menjaga katalog produk tetap terorganisir.
        </p>
    </header>

    <section class="edit-category-card">
        <div class="edit-category-section-heading">
            <div class="edit-category-step">01</div>
            <div>
                <h2>Informasi Kategori</h2>
                <p>Ubah nama kategori, lalu simpan perubahan.</p>
            </div>
        </div>

        <?php if($errors->any()): ?>
            <div class="edit-category-error" role="alert">
                <strong>Kategori belum dapat diperbarui. Periksa data berikut:</strong>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('admin.categories.update', $category->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div>
                <label class="edit-category-label" for="name">Nama Kategori</label>
                <input
                    class="edit-category-input"
                    type="text"
                    id="name"
                    name="name"
                    value="<?php echo e(old('name', $category->name)); ?>"
                    placeholder="Masukkan nama kategori"
                    required
                    autofocus
                >
                <small class="edit-category-help">
                    Gunakan nama yang singkat dan mudah dikenali oleh pelanggan.
                </small>
            </div>

            <div class="edit-category-actions">
                <button type="submit" class="edit-category-button edit-category-primary">
                    Update Kategori
                </button>

                <a
                    href="<?php echo e(route('admin.categories.index')); ?>"
                    class="edit-category-button edit-category-secondary"
                >
                    Kembali ke Kategori
                </a>
            </div>
        </form>
    </section>

    <a href="<?php echo e(route('admin.dashboard')); ?>" class="edit-category-dashboard">
        <span aria-hidden="true">←</span> Kembali ke Dashboard
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>