<?php $__env->startSection('content'); ?>



<div class="dashboard-header">


<h1>

Dashboard Admin

</h1>


<p style="
color:#6b7280;
margin-top:8px;
">

Selamat datang kembali,
<?php echo e(Auth::user()->name); ?>


👋

</p>



</div>





<br>





<div style="
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
">





<div style="
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 20px rgba(0,0,0,.05);
">


<p style="
color:#6b7280;
">

Total Produk

</p>



<h1>

<?php echo e($totalProducts); ?>


</h1>



</div>








<div style="
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 20px rgba(0,0,0,.05);
">


<p style="
color:#6b7280;
">

Total Kategori

</p>



<h1>

<?php echo e($totalCategories); ?>


</h1>



</div>







<div style="
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 20px rgba(0,0,0,.05);
">


<p style="
color:#6b7280;
">

Total User

</p>



<h1>

<?php echo e($totalUsers); ?>


</h1>



</div>








<div style="
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 20px rgba(0,0,0,.05);
">


<p style="
color:#6b7280;
">

Total Admin

</p>



<h1>

<?php echo e($totalAdmins); ?>


</h1>



</div>





</div>









<br><br>








<div style="
display:grid;
grid-template-columns:2fr 1fr;
gap:25px;
">








<div style="
background:white;
padding:30px;
border-radius:20px;
">



<div style="
display:flex;
justify-content:space-between;
margin-bottom:20px;
">


<h2>

Produk Terbaru

</h2>



<a href="<?php echo e(route('admin.products.index')); ?>">

Lihat Semua →

</a>


</div>








<?php if($products->count()): ?>



<table style="
width:100%;
border-collapse:collapse;
">


<tr style="
background:#f3f4f6;
">


<th style="padding:12px;">
Produk
</th>


<th style="padding:12px;">
Kategori
</th>


<th style="padding:12px;">
Harga
</th>


</tr>





<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



<tr>


<td style="padding:12px;">

<?php echo e($product->name); ?>


</td>



<td style="padding:12px;">

<?php echo e($product->category->name ?? '-'); ?>


</td>




<td style="padding:12px;">

Rp <?php echo e(number_format($product->price,0,',','.')); ?>


</td>



</tr>



<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





</table>




<?php else: ?>


<p>

Belum ada produk.

</p>



<?php endif; ?>





</div>









<div style="
background:white;
padding:30px;
border-radius:20px;
">



<h2>

Aksi Cepat

</h2>


<br>

<a href="<?php echo e(route('home')); ?>"

style="
display:block;
padding:15px;
background:#fef3c7;
border-radius:12px;
text-decoration:none;
color:#111827;
">


🌐 Lihat Website


</a>





</div>






</div>







<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>