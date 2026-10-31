<?php $__env->startSection('content'); ?>



<h1>

Data Produk

</h1>


<br>





<?php if(session('success')): ?>


<div style="
background:#dcfce7;
color:#166534;
padding:15px;
border-radius:10px;
margin-bottom:20px;
">

<?php echo e(session('success')); ?>


</div>


<?php endif; ?>







<div style="
display:flex;
gap:15px;
margin-bottom:25px;
">



<a href="<?php echo e(route('admin.products.create')); ?>"

style="
background:#2563eb;
color:white;
padding:12px 20px;
border-radius:10px;
text-decoration:none;
">


+ Tambah Produk


</a>




</div>









<div style="
background:white;
padding:25px;
border-radius:20px;
">





<table style="
width:100%;
border-collapse:collapse;
">



<tr style="
background:#f3f4f6;
">


<th style="padding:15px;">
No
</th>


<th style="padding:15px;">
Gambar
</th>


<th style="padding:15px;">
Produk
</th>


<th style="padding:15px;">
Kategori
</th>


<th style="padding:15px;">
Harga
</th>


<th style="padding:15px;">
Stok
</th>


<th style="padding:15px;">
Aksi
</th>



</tr>









<?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>





<tr>





<td style="padding:15px;">

<?php echo e($loop->iteration); ?>


</td>









<td style="padding:15px;">



<?php



$images = $product->image;



// Jika data berbentuk JSON

if(!is_array($images)){


    $images = json_decode($images,true);


}



// Jika masih string biasa

if(!is_array($images)){


    $images = $product->image
    ? [$product->image]
    : [];


}



?>







<?php if(count($images) > 0): ?>





<img

src="<?php echo e(asset('storage/'.$images[0])); ?>"

width="80"

height="80"

style="
border-radius:12px;
object-fit:cover;
border:1px solid #ddd;
">







<?php if(count($images) > 1): ?>



<div style="
font-size:12px;
color:#666;
margin-top:5px;
">

<?php echo e(count($images)); ?> Foto

</div>



<?php endif; ?>







<?php else: ?>



<span>

Tidak ada

</span>



<?php endif; ?>





</td>









<td style="padding:15px;">


<strong>

<?php echo e($product->name); ?>


</strong>


</td>








<td style="padding:15px;">


<?php echo e($product->category->name ?? '-'); ?>



</td>









<td style="padding:15px;">


Rp <?php echo e(number_format($product->price,0,',','.')); ?>



</td>









<td style="padding:15px;">


<?php echo e($product->stock); ?>



</td>









<td style="padding:15px;">






<a href="<?php echo e(route('admin.products.edit',$product->id)); ?>"

style="
background:#16a34a;
color:white;
padding:8px 12px;
border-radius:8px;
text-decoration:none;
">


Edit


</a>










<form

action="<?php echo e(route('admin.products.destroy',$product->id)); ?>"

method="POST"

style="display:inline;">


<?php echo csrf_field(); ?>

<?php echo method_field('DELETE'); ?>



<button

onclick="return confirm('Hapus produk ini?')"

style="
background:#dc2626;
color:white;
padding:8px 12px;
border:none;
border-radius:8px;
cursor:pointer;
">


Hapus


</button>



</form>







</td>







</tr>








<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>




<tr>

<td colspan="7"

style="
padding:20px;
text-align:center;
">


Belum ada produk


</td>


</tr>





<?php endif; ?>







</table>







</div>







<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/admin/products/index.blade.php ENDPATH**/ ?>