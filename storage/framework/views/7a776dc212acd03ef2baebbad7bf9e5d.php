<!DOCTYPE html>
<html lang="id">


<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">



<title>

<?php echo $__env->yieldContent('title','Bloomcraft'); ?>

</title>




<link rel="stylesheet" href="<?php echo e(asset('assets/css/catalog.css')); ?>">





<style>


/* =========================
NAVBAR
========================= */


.navbar{


display:flex;

justify-content:space-between;

align-items:center;

padding:25px 80px;

background:white;

position:sticky;

top:0;

z-index:1000;


}





.logo{


font-family:Georgia,serif;

font-size:28px;

font-weight:bold;

color:#2c2118;


}






.nav-menu{


display:flex;

gap:30px;


}





.nav-menu a{


text-decoration:none;

color:#2c2118;

font-size:14px;


}







.icons{


display:flex;

align-items:center;

gap:20px;


}







.icons a{


text-decoration:none;

color:#2c2118;

font-size:20px;


}









/* =========================
CART
========================= */


.cart-icon{


position:relative;


}





.cart-count{


position:absolute;

top:-10px;

right:-15px;

background:#b8904a;

color:white;

font-size:11px;

width:20px;

height:20px;

border-radius:50%;

display:flex;

align-items:center;

justify-content:center;


}









/* =========================
ACCOUNT DROPDOWN
========================= */


.account-wrapper{


position:relative;


}







.account-button{


background:none;

border:none;

font-size:24px;

cursor:pointer;

color:#2c2118;


}








.account-panel{


display:none;

position:absolute;

right:0;

top:45px;

width:280px;

background:white;

padding:25px;

border-radius:20px;

box-shadow:0 15px 40px rgba(0,0,0,.15);

z-index:99999;


}







.account-panel.active{


display:block;


}








.account-header{


border-bottom:1px solid #eee;

padding-bottom:15px;

margin-bottom:15px;


}







.account-header h3{


font-family:Georgia,serif;

margin-bottom:8px;


}








.account-header p{


font-size:13px;

color:#777;


}







.account-links a{


display:block;

padding:10px 0;

text-decoration:none;

color:#333;


}





.account-links a:hover{


color:#b8904a;


}

.admin-dashboard-button{


display:block;

margin-top:15px;

padding:12px 15px;

background:#2c2118 !important;

color:white !important;

border-radius:30px;

text-align:center;

font-weight:bold;

transition:.3s;


}



.admin-dashboard-button:hover{


background:#b8904a !important;

color:white !important;


}




.logout-button{


width:100%;

padding:12px;

margin-top:15px;

border:none;

border-radius:30px;

background:#2c2118;

color:white;

cursor:pointer;


}





.logout-button:hover{


background:#b8904a;


}









/* =========================
FOOTER
========================= */


.footer{


display:grid;

grid-template-columns:repeat(4,1fr);

gap:40px;

padding:70px 80px;

background:#2c2118;

color:white;

margin-top:80px;


}







.footer h3{


font-family:Georgia,serif;

font-size:22px;

margin-bottom:20px;


}







.footer p{


color:#ddd;

font-size:14px;

line-height:1.8;


}







.footer a{


display:block;

text-decoration:none;

color:#ddd;

margin-bottom:10px;

font-size:14px;


}





.footer a:hover{


color:#b8904a;


}








.copy{


text-align:center;

padding:20px;

background:#21180f;

color:#aaa;

font-size:13px;


}






</style>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bloomcraft.css')); ?>">



</head>






<body>






<nav class="navbar">






<div class="logo">


Bloomcraft


</div>








<div class="nav-menu">



<a href="<?php echo e(route('home')); ?>">

HOME

</a>






<a href="<?php echo e(route('collection.index')); ?>">

COLLECTION

</a>



<a href="<?php echo e(route('home')); ?>#contact">

CONTACT

</a>



</div>









<div class="icons">







<a href="<?php echo e(route('cart.index')); ?>" class="cart-icon">


🛒



<?php if(session('cart')): ?>


<span class="cart-count">

<?php echo e(count(session('cart'))); ?>


</span>


<?php endif; ?>



</a>









<?php if(auth()->guard()->check()): ?>






<div class="account-wrapper">






<button

type="button"

class="account-button"

id="accountButton">


👤


</button>









<div id="accountPanel" class="account-panel">







<div class="account-header">


<h3>

<?php echo e(Auth::user()->name); ?>


</h3>






<p>

<?php echo e(Auth::user()->email); ?>


</p>




</div>


<div class="account-links">


<a href="#">

Profile Saya

</a>



<a href="<?php echo e(route('orders.index')); ?>">

Pesanan Saya

</a>





<?php if(Auth::user()->role === 'admin'): ?>


<a href="<?php echo e(route('admin.dashboard')); ?>"
class="admin-dashboard-button">


Dashboard Admin


</a>


<?php endif; ?>



</div>

<form action="<?php echo e(route('logout')); ?>" method="POST">


<?php echo csrf_field(); ?>



<button

type="submit"

class="logout-button">


Logout


</button>




</form>







</div>









</div>






<?php else: ?>






<a href="<?php echo e(route('login')); ?>">


👤


</a>






<?php endif; ?>







</div>







</nav>












<?php echo $__env->yieldContent('content'); ?>









<footer class="footer" id="contact">





<div>



<h3>

Bloomcraft

</h3>



<p>

Premium Product Collection

</p>



<p>

Produk pilihan dengan desain elegan dan kualitas terbaik.

</p>



</div>








<div>



<h3>

Explore

</h3>



<a href="<?php echo e(route('home')); ?>">

Home

</a>




<a href="<?php echo e(route('collection.index')); ?>">

Collection

</a>




<a href="<?php echo e(route('home')); ?>#story">

About

</a>



<a href="<?php echo e(route('home')); ?>#contact">

Contact

</a>



</div>




<div>



<h3>

Customer Care

</h3>



<a href="#">

FAQ

</a>




<a href="#">

Privacy Policy

</a>




<a href="#">

Terms & Conditions

</a>



</div>








<div>



<h3>

Follow Us

</h3>



<a
    href="https://www.instagram.com/bloomcraftbwi/"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Kunjungi Instagram Bloomcraft"
>
    Instagram
</a>


<p>

TikTok

</p>



</div>






</footer>









<div class="copy">


© <?php echo e(date('Y')); ?> Bloomcraft. All Rights Reserved.


</div>









<script>


const accountButton = document.getElementById(
"accountButton"
);


const accountPanel = document.getElementById(
"accountPanel"
);





if(accountButton){



accountButton.addEventListener(

"click",

function(event){



event.stopPropagation();



accountPanel.classList.toggle(
"active"
);



}

);



}








document.addEventListener(

"click",

function(){



if(accountPanel){



accountPanel.classList.remove(
"active"
);



}



}

);








if(accountPanel){



accountPanel.addEventListener(

"click",

function(event){



event.stopPropagation();



}

);



}



</script>







</body>


</html>
<?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/layouts/app.blade.php ENDPATH**/ ?>