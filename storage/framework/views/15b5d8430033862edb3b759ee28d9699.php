<?php $__env->startSection('title'); ?>

<?php echo e($product->name); ?> - Bloomcraft

<?php $__env->stopSection(); ?>






<?php $__env->startSection('content'); ?>



<style>


.product-detail{


padding:80px;

display:grid;

grid-template-columns:1fr 1fr;

gap:60px;

align-items:start;


}





.product-gallery{


display:flex;

gap:20px;

flex-direction:column;


}





.product-gallery img{


width:100%;

height:550px;

object-fit:cover;

border-radius:30px;


}





.thumbnail-area{


display:flex;

gap:15px;

flex-wrap:wrap;


}





.thumbnail-area img{


width:90px;

height:90px;

object-fit:cover;

border-radius:15px;

cursor:pointer;


}






.product-info span{


color:#b8904a;

letter-spacing:3px;

font-size:13px;


}






.product-info h1{


font-family:Georgia,serif;

font-size:50px;

margin:25px 0;


}





.product-price{


font-size:28px;

color:#b8904a;

margin:20px 0;


}





.product-description{


color:#666;

line-height:1.8;

margin:25px 0;


}





.cart-actions{


display:flex;

gap:15px;

margin-top:30px;


}




.cart-button{


padding:15px 35px;

background:#2c2118;

color:white;

border:none;

border-radius:40px;

cursor:pointer;


}




.cart-button:hover{


background:#b8904a;


}





.cart-view{


padding:15px 35px;

background:#f3eee7;

color:#2c2118;

border-radius:40px;

text-decoration:none;


}





.recommend{


padding:50px 80px;


}





@media(max-width:900px){


.product-detail{


grid-template-columns:1fr;

padding:30px;


}


}



</style>









<section class="product-detail">





<div class="product-gallery">





<?php


$images=$product->image;



if(!is_array($images)){


$images=json_decode($images,true);


}


?>







<?php if(!empty($images)): ?>





<img

id="mainImage"

src="<?php echo e(asset('storage/'.$images[0])); ?>"

alt="<?php echo e($product->name); ?>"

>







<div class="thumbnail-area">


<?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



<img

src="<?php echo e(asset('storage/'.$image)); ?>"

onclick="changeImage('<?php echo e(asset('storage/'.$image)); ?>')"

>



<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


</div>





<?php else: ?>



<img

src="https://via.placeholder.com/500"

alt="No Image"

>


<?php endif; ?>







</div>









<div class="product-info">





<span>

PREMIUM COLLECTION

</span>








<h1>

<?php echo e($product->name); ?>


</h1>







<p>


Kategori :

<strong>

<?php echo e($product->category->name ?? '-'); ?>


</strong>


</p>







<div class="product-price">


Rp <?php echo e(number_format($product->price,0,',','.')); ?>



</div>







<div>


Stok tersedia :

<?php echo e($product->stock); ?>



</div>







<p class="product-description">


<?php echo e($product->description); ?>



</p>









<div class="cart-actions">





<form

action="<?php echo e(route('cart.add',$product->id)); ?>"

method="POST">


<?php echo csrf_field(); ?>



<button

type="submit"

class="cart-button">


🛒 Tambah Keranjang


</button>



</form>







<a

href="<?php echo e(route('cart.index')); ?>"

class="cart-view">


Lihat Keranjang


<?php if(session('cart')): ?>


(<?php echo e(count(session('cart'))); ?>)


<?php endif; ?>


</a>





</div>






</div>






</section>









<section class="recommend">

<div class="products">





<?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>






<div class="product">





<?php


$itemImages=$item->image;



if(!is_array($itemImages)){


$itemImages=json_decode($itemImages,true);


}


?>







<?php if(!empty($itemImages)): ?>


<img

src="<?php echo e(asset('storage/'.$itemImages[0])); ?>"

alt="<?php echo e($item->name); ?>"


>



<?php else: ?>


<img

src="https://via.placeholder.com/500"

>


<?php endif; ?>







<div class="product-content">





<h3>

<?php echo e($item->name); ?>


</h3>







<div class="price">


Rp <?php echo e(number_format($item->price,0,',','.')); ?>



</div>






<a

class="view-product"

href="<?php echo e(route('product.show',$item->slug)); ?>">


VIEW PRODUCT


</a>






</div>





</div>





<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>






</div>




</section>










<script>


function changeImage(image){


document.getElementById('mainImage').src=image;


}


</script>






<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/catalog/show.blade.php ENDPATH**/ ?>