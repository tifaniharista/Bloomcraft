@extends('layouts.app')


@section('title')

{{ $product->name }} - Bloomcraft

@endsection






@section('content')



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





@php


$images=$product->image;



if(!is_array($images)){


$images=json_decode($images,true);


}


@endphp







@if(!empty($images))





<img

id="mainImage"

src="{{asset('storage/'.$images[0])}}"

alt="{{$product->name}}"

>







<div class="thumbnail-area">


@foreach($images as $image)



<img

src="{{asset('storage/'.$image)}}"

onclick="changeImage('{{asset('storage/'.$image)}}')"

>



@endforeach


</div>





@else



<img

src="https://via.placeholder.com/500"

alt="No Image"

>


@endif







</div>









<div class="product-info">





<span>

PREMIUM COLLECTION

</span>








<h1>

{{ $product->name }}

</h1>







<p>


Kategori :

<strong>

{{ $product->category->name ?? '-' }}

</strong>


</p>







<div class="product-price">


Rp {{number_format($product->price,0,',','.')}}


</div>







<div>


Stok tersedia :

{{$product->stock}}


</div>







<p class="product-description">


{{$product->description}}


</p>









<div class="cart-actions">





<form

action="{{route('cart.add',$product->id)}}"

method="POST">


@csrf



<button

type="submit"

class="cart-button">


🛒 Tambah Keranjang


</button>



</form>







<a

href="{{route('cart.index')}}"

class="cart-view">


Lihat Keranjang


@if(session('cart'))


({{count(session('cart'))}})


@endif


</a>





</div>






</div>






</section>









<section class="recommend">

<div class="products">





@foreach($relatedProducts as $item)






<div class="product">





@php


$itemImages=$item->image;



if(!is_array($itemImages)){


$itemImages=json_decode($itemImages,true);


}


@endphp







@if(!empty($itemImages))


<img

src="{{asset('storage/'.$itemImages[0])}}"

alt="{{$item->name}}"


>



@else


<img

src="https://via.placeholder.com/500"

>


@endif







<div class="product-content">





<h3>

{{$item->name}}

</h3>







<div class="price">


Rp {{number_format($item->price,0,',','.')}}


</div>






<a

class="view-product"

href="{{route('product.show',$item->slug)}}">


VIEW PRODUCT


</a>






</div>





</div>





@endforeach






</div>




</section>










<script>


function changeImage(image){


document.getElementById('mainImage').src=image;


}


</script>






@endsection
