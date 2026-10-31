<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Admin Bloomcraft
</title>


<style>


*{

margin:0;
padding:0;
box-sizing:border-box;

}



body{

font-family:Arial,sans-serif;

background:#f5f7fb;

display:flex;

}



/* SIDEBAR */


.sidebar{

width:260px;

height:100vh;

background:#111827;

color:white;

position:fixed;

padding:30px 20px;

}




.logo{

font-size:25px;

font-weight:bold;

margin-bottom:40px;

}




.sidebar a{

display:block;

color:#d1d5db;

text-decoration:none;

padding:14px;

border-radius:10px;

margin-bottom:8px;

}



.sidebar a:hover{

background:#2563eb;

color:white;

}





.logout button{


width:100%;

padding:12px;

background:#dc2626;

color:white;

border:none;

border-radius:10px;

cursor:pointer;


}







/* CONTENT */


.content{


margin-left:260px;

padding:40px;

width:100%;


}




</style>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bloomcraft.css')); ?>">


</head>



<body>






<div class="sidebar">





<div class="logo">

Bloomcraft Admin

</div>








<a href="<?php echo e(route('admin.dashboard')); ?>">

🏠 Dashboard

</a>








<a href="<?php echo e(route('admin.products.index')); ?>">

📦 Produk

</a>








<a href="<?php echo e(route('admin.categories.index')); ?>">

🗂 Kategori

</a>








<a href="<?php echo e(route('admin.orders.index')); ?>">

🛒 Pesanan

</a>









<a href="<?php echo e(route('admin.users.index')); ?>">

👥 Data User

</a>









<form class="logout"

action="<?php echo e(route('logout')); ?>"

method="POST">


<?php echo csrf_field(); ?>



<button type="submit">

Logout

</button>



</form>







</div>









<div class="content">


<?php echo $__env->yieldContent('content'); ?>


</div>






</body>


</html>
<?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/layouts/admin.blade.php ENDPATH**/ ?>