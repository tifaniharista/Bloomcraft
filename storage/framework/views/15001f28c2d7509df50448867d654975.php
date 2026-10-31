<?php $__env->startSection('title', 'Create Account - Maison'); ?>

<?php $__env->startSection('content'); ?>

<section class="auth-section">

    <div class="auth-container">

        <div class="auth-header">

            <div class="auth-label">
                New Customer
            </div>

            <h1>
                Create Account
            </h1>

            <p>
                Create an account to manage your orders
                and checkout faster.
            </p>

        </div>


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
            action="<?php echo e(route('register.store')); ?>"
            method="POST"
            class="auth-form"
        >

            <?php echo csrf_field(); ?>


            <div class="form-group">

                <label for="name">
                    Full Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?php echo e(old('name')); ?>"
                    placeholder="Enter your name"
                    required
                    autofocus
                >

            </div>


            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?php echo e(old('email')); ?>"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum 8 characters"
                    required
                >

            </div>


            <div class="form-group">

                <label for="password_confirmation">
                    Confirm Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Repeat your password"
                    required
                >

            </div>


            <button
                type="submit"
                class="auth-button"
            >
                Create Account
            </button>

        </form>


        <div class="auth-footer">

            Already have an account?

            <a href="<?php echo e(route('login')); ?>">
                Sign in
            </a>

        </div>

    </div>

</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/auth/register.blade.php ENDPATH**/ ?>