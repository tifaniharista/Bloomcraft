<?php $__env->startSection('title'); ?>

Bloomcraft - Home

<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>

<style>
    /*
     * Bloomcraft hero background:
     * Letakkan gambar samar di public/images/hero-bg.png
     */
    .hero {
        position: relative;
        isolation: isolate;
        overflow: hidden;
        background-color: #f7f6f0;
    }

    .hero::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background-image:
            linear-gradient(
                90deg,
                rgba(247, 246, 240, 0.97) 0%,
                rgba(247, 246, 240, 0.91) 42%,
                rgba(232, 236, 224, 0.78) 100%
            ),
            url("<?php echo e(asset('images/hero-bg.png')); ?>");
        background-size: cover;
        background-position: center, right center;
        background-repeat: no-repeat;
    }

    .hero .hero-content {
        position: relative;
        z-index: 1;
    }

    @media (max-width: 768px) {
        .hero::before {
            background-image:
                linear-gradient(
                    180deg,
                    rgba(247, 246, 240, 0.94) 0%,
                    rgba(247, 246, 240, 0.84) 100%
                ),
                url("<?php echo e(asset('images/hero-bg.png')); ?>");
            background-position: center;
        }
    }
</style>





<section class="hero">



<div class="hero-content">



<span>

DIBUAT DENGAN HATI

</span>





<h1>

Crafted

<br>

With

<br>

Care

</h1>





<p>

Rangkaian bunga dan hadiah yang dirangkai dengan perhatian,
untuk momen kecil maupun hari istimewa.

</p>







<a href="<?php echo e(route('collection.index')); ?>"

class="btn-primary">


JELAJAHI KOLEKSI


</a>





</div>



</section>









<section class="features">



<div class="feature">


<h3>

Pilihan Penuh Makna

</h3>


<p>

Setiap detail dipilih dengan cermat

</p>


</div>





<div class="feature">


<h3>

Gratis Pengiriman

</h3>


<p>

Ongkir gratis untuk setiap pesanan

</p>


</div>





<div class="feature">


<h3>

Pembayaran Aman

</h3>


<p>

Transfer bank dengan verifikasi admin

</p>


</div>





<div class="feature">


<h3>

Dibuat untuk Anda

</h3>


<p>

Kami siap membantu setiap langkah

</p>


</div>




</section>









<section class="story" id="story">



<div class="story-text">



<h2>

Cerita Bloomcraft

</h2>





<p>

Kami menghadirkan produk berkualitas

dengan perpaduan desain elegan,

kualitas terbaik, dan pengalaman

berbelanja yang nyaman.

</p>



</div>

<img
    src="<?php echo e(asset('images/bloomcraft-story.png')); ?>"
    alt="Cerita Bloomcraft"
>

</section>









<section class="section">



<div class="section-title">


<h2>

Pilihan untuk Momen Spesial

</h2>


</div>









<div class="products">






<?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>





<div class="product">





<?php


$images = $product->image;



if(!is_array($images)){


$images=json_decode($images,true);


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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/catalog/index.blade.php ENDPATH**/ ?>