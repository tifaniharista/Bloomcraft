@extends('layouts.app')


@section('title')

Bloomcraft - Collection

@endsection




@section('content')



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


@forelse($products as $product)


<div class="product">


@php

$images = $product->image;

if(!is_array($images)){


$images = json_decode($images,true);


}



@endphp







@if(!empty($images))


<img

src="{{ asset('storage/'.$images[0]) }}"

alt="{{ $product->name }}"

>



@else



<img

src="https://via.placeholder.com/500"

alt="No Image"

>



@endif







<div class="product-content">





<h3>

{{ $product->name }}

</h3>






<p>

{{ $product->category->name ?? 'Premium Product' }}

</p>






<div class="price">


Rp {{ number_format($product->price,0,',','.') }}


</div>








<a

class="view-product"

href="{{ route('product.show',$product->slug) }}">



LIHAT DETAIL



</a>






</div>






</div>






@empty



<p>

Belum ada produk tersedia.

</p>



@endforelse







</div>







</section>





@endsection
