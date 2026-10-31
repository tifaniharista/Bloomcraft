<?php $__env->startSection('title', 'Masuk - Bloomcraft'); ?>

<?php $__env->startSection('content'); ?>

<section class="auth-section">

    <div class="auth-container">

        <div class="auth-header">

            <div class="auth-label">
                SELAMAT DATANG KEMBALI
            </div>

            <h1>
                Masuk ke Akun
            </h1>

            <p>
                Masuk untuk melihat akun dan pesanan Anda.
            </p>

        </div>


        <?php if(session('success')): ?>

            <div class="alert success">
                <?php echo e(session('success')); ?>

            </div>

        <?php endif; ?>


        <?php if($errors->any()): ?>

            <div class="alert error">

                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div>
                        <?php echo e($error); ?>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        <?php endif; ?>


        <form
            action="<?php echo e(route('login.store')); ?>"
            method="POST"
            class="auth-form"
        >

            <?php echo csrf_field(); ?>


            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?php echo e(old('email')); ?>"
                    placeholder="Masukkan email Anda"
                    required
                    autofocus
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Kata sandi
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >

            </div>


            <div class="remember-row">

                <label>

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    Ingat saya

                </label>

            </div>


            <button
                type="submit"
                class="auth-button"
            >
                Masuk ke Akun
            </button>

        </form>


        <div class="auth-footer">

            Belum memiliki akun?

            <a href="<?php echo e(route('register')); ?>">
                Buat akun
            </a>

        </div>

    </div>

</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/auth/login.blade.php ENDPATH**/ ?>