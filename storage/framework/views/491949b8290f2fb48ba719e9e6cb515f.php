<?php $__env->startSection('title'); ?>

Bloomcraft - Collection

<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>



<section class="collection-header">


<h1>

Koleksi Bloomcraft

</h1>



<p>

Temukan rangkaian bunga dan hadiah yang dibuat dengan perhatian

</p>



</section>








<section class="catalog-area">


<div class="products">


<?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


<div class="product">


<?php

$images = $product->image;

if(!is_array($images)){


$images = json_decode($images,true);


}



?>







<?php if(!empty($images)): ?>


<img

src="<?php echo e(asset('storage/'.$images[0])); ?>"

alt="<?php echo e($product->name); ?>"

>



<?php else: ?>



<img

src="https://via.placeholder.com/500"

alt="No Image"

>



<?php endif; ?>







<div class="product-content">





<h3>

<?php echo e($product->name); ?>


</h3>






<p>

<?php echo e($product->category->name ?? 'Premium Product'); ?>


</p>






<div class="price">


Rp <?php echo e(number_format($product->price,0,',','.')); ?>



</div>








<a

class="view-product"

href="<?php echo e(route('product.show',$product->slug)); ?>">



LIHAT DETAIL



</a>






</div>






</div>






<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>



<p>

Belum ada produk tersedia.

</p>



<?php endif; ?>







</div>







</section>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/catalog/collection.blade.php ENDPATH**/ ?>