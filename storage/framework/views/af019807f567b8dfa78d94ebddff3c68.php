<!DOCTYPE html>
<html>

<head>

<title>
Checkout
</title>


<link rel="stylesheet"
href="<?php echo e(asset('assets/css/catalog.css')); ?>">


</head>


<body>



<nav class="navbar">


<div class="logo">

Bloomcraft

</div>


</nav>





<div class="cart-container">



<h1 class="cart-title">

Checkout

</h1>





<?php if($errors->any()): ?>
<div class="alert alert-error">
    <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
</div>
<?php endif; ?>

<?php if(session('error')): ?><div class="alert alert-error"><?php echo e(session('error')); ?></div><?php endif; ?>

<p>Ongkos kirim gratis. Kamu hanya membayar harga produk. Setelah pesanan dibuat, transfer ke rekening admin yang ditampilkan pada halaman pesanan, lalu unggah bukti transfer.</p>

<form method="POST"

action="<?php echo e(route('checkout.store')); ?>">


<?php echo csrf_field(); ?>



<input

name="name"

placeholder="Nama Lengkap"

value="<?php echo e(auth()->user()->name ?? ''); ?>"

required>



<br><br>



<input

type="email"

name="email"

placeholder="Email"

value="<?php echo e(auth()->user()->email ?? ''); ?>"

required>



<br><br>



<input

name="phone"

placeholder="Nomor Telepon"

required>



<br><br>



<textarea

name="address"

placeholder="Alamat Lengkap"

required></textarea>



<br><br>




<h2>

Total:

Rp <?php echo e(number_format($total,0,",",".")); ?>


</h2>



<br>

<button
type="submit"
class="checkout">

Buat Pesanan

</button>

</form>




</div>



</body>


</html>
<?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/checkout/index.blade.php ENDPATH**/ ?>