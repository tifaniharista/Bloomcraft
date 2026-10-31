<?php $__env->startSection('content'); ?>
<style>
    .users-page {
        --up-green: #496b55;
        --up-green-dark: #304b39;
        --up-sage: #edf3eb;
        --up-border: #e3e8e0;
        --up-text: #29332c;
        --up-muted: #788078;
        width: 100%;
        color: var(--up-text);
    }

    .users-page * { box-sizing: border-box; }

    .users-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 26px;
    }

    .users-eyebrow {
        margin: 0 0 8px;
        color: var(--up-green);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .users-title {
        margin: 0;
        color: var(--up-text);
        font-family: Georgia, 'Times New Roman', serif;
        font-size: clamp(28px, 4vw, 38px);
        font-weight: 600;
    }

    .users-description {
        margin: 9px 0 0;
        color: var(--up-muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .users-total {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border: 1px solid #dce8d9;
        border-radius: 11px;
        background: var(--up-sage);
        color: var(--up-green-dark);
        font-size: 12px;
        font-weight: 700;
    }

    .users-total-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 29px;
        height: 29px;
        padding: 0 7px;
        border-radius: 8px;
        background: #fff;
        font-size: 12px;
    }

    .users-card {
        overflow: hidden;
        border: 1px solid var(--up-border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 8px 26px rgba(40, 60, 42, .045);
    }

    .users-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        padding: 20px 23px;
        border-bottom: 1px solid var(--up-border);
    }

    .users-card-header h2 {
        margin: 0;
        color: var(--up-text);
        font-size: 16px;
        font-weight: 700;
    }

    .users-card-header p {
        margin: 5px 0 0;
        color: var(--up-muted);
        font-size: 12px;
    }

    .users-table-wrap { width: 100%; overflow-x: auto; }

    .users-table {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
    }

    .users-table thead th {
        padding: 15px 18px;
        border-bottom: 1px solid var(--up-border);
        background: #f7f8f5;
        color: #68736a;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .8px;
        text-align: left;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .users-table tbody td {
        padding: 16px 18px;
        border-bottom: 1px solid #eef0eb;
        color: var(--up-text);
        font-size: 13px;
        vertical-align: middle;
    }

    .users-table tbody tr:last-child td { border-bottom: 0; }
    .users-table tbody tr { transition: background .15s; }
    .users-table tbody tr:hover { background: #fcfdfb; }

    .user-number {
        color: #8b948b;
        font-size: 12px;
        font-weight: 600;
    }

    .user-avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        margin-right: 10px;
        border-radius: 11px;
        background: var(--up-sage);
        color: var(--up-green-dark);
        font-size: 13px;
        font-weight: 700;
        vertical-align: middle;
    }

    .user-name {
        color: var(--up-text);
        font-weight: 700;
    }

    .user-email {
        color: #58645a;
        overflow-wrap: anywhere;
    }

    .user-password {
        display: inline-flex;
        padding: 6px 9px;
        border: 1px solid #e8ece6;
        border-radius: 7px;
        background: #fafbf9;
        color: var(--up-muted);
        font-family: Consolas, Monaco, monospace;
        font-size: 11px;
        letter-spacing: 1px;
    }

    .user-role {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .user-role-admin {
        background: #e4f3e5;
        color: #27613a;
    }

    .user-role-user {
        background: #eef1f3;
        color: #53616b;
    }

    .user-date {
        color: var(--up-muted);
        font-size: 12px;
        white-space: nowrap;
    }

    .users-empty {
        padding: 48px 20px !important;
        color: var(--up-muted) !important;
        text-align: center;
    }

    .users-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        height: 54px;
        margin: 0 auto 14px;
        border-radius: 16px;
        background: var(--up-sage);
        color: var(--up-green);
        font-size: 24px;
    }

    .users-empty strong {
        display: block;
        margin-bottom: 5px;
        color: var(--up-text);
        font-size: 14px;
    }

    .users-empty span { font-size: 12px; }

    @media (max-width: 640px) {
        .users-heading { align-items: stretch; }
        .users-total { justify-content: space-between; }
        .users-card-header { padding: 17px; }
        .users-table thead th,
        .users-table tbody td { padding: 13px; }
    }
</style>

<div class="users-page">
    <header class="users-heading">
        <div>
            <p class="users-eyebrow">Bloomcraft Admin</p>
            <h1 class="users-title">Data User Website</h1>
            <p class="users-description">
                Daftar pengguna yang telah melakukan registrasi pada website Bloomcraft.
            </p>
        </div>

        <div class="users-total">
            <span>Total pengguna</span>
            <span class="users-total-number"><?php echo e($users->count()); ?></span>
        </div>
    </header>

    <section class="users-card">
        <div class="users-card-header">
            <div>
                <h2>Daftar Pengguna</h2>
                <p>Informasi akun dan tanggal registrasi pengguna.</p>
            </div>
        </div>

        <div class="users-table-wrap">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <span class="user-number"><?php echo e($loop->iteration); ?></span>
                            </td>

                            <td>
                                <span class="user-avatar" aria-hidden="true">
                                    <?php echo e(strtoupper(substr($user->name ?? 'U', 0, 1))); ?>

                                </span>
                                <span class="user-name"><?php echo e($user->name); ?></span>
                            </td>

                            <td>
                                <span class="user-email"><?php echo e($user->email); ?></span>
                            </td>

                            <td>
                                <span class="user-password" aria-label="Password disembunyikan">
                                    ********
                                </span>
                            </td>

                            <td>
                                <?php if($user->role == 'admin'): ?>
                                    <span class="user-role user-role-admin">Administrator</span>
                                <?php else: ?>
                                    <span class="user-role user-role-user">User</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <span class="user-date">
                                    <?php echo e(optional($user->created_at)->format('d M Y') ?: '-'); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="users-empty">
                                <div class="users-empty-icon" aria-hidden="true">♡</div>
                                <strong>Belum ada pengguna</strong>
                                <span>Pengguna yang mendaftar akan ditampilkan di sini.</span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/admin/users/index.blade.php ENDPATH**/ ?>