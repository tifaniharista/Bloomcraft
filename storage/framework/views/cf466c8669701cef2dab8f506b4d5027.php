<?php $__env->startSection('content'); ?>


<div style="
background:white;
padding:35px;
border-radius:20px;
max-width:750px;
">


<h1>

Edit Produk

</h1>


<br>




<?php if($errors->any()): ?>


<div style="
background:#fee2e2;
color:#b91c1c;
padding:15px;
border-radius:10px;
margin-bottom:20px;
">


<ul>

<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<li>

<?php echo e($error); ?>


</li>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</ul>


</div>


<?php endif; ?>







<?php


$images = $product->image;



if(!is_array($images)){


    $images = json_decode($product->image,true);


}



if(!is_array($images)){


    $images = $product->image ? [$product->image] : [];


}


?>







<!-- ==========================
FORM UPDATE PRODUK
========================== -->


<form

method="POST"

action="<?php echo e(route('admin.products.update',$product->id)); ?>"

enctype="multipart/form-data">


<?php echo csrf_field(); ?>

<?php echo method_field('PUT'); ?>









<!-- NAMA PRODUK -->


<div style="margin-bottom:20px;">


<label>

Nama Produk

</label>


<br>



<input

type="text"

name="name"

value="<?php echo e($product->name); ?>"

required

style="
width:100%;
padding:12px;
border-radius:10px;
border:1px solid #ddd;
">


</div>









<!-- KATEGORI -->


<div style="margin-bottom:20px;">


<label>

Kategori

</label>


<br>



<select

name="category_id"

required

style="
width:100%;
padding:12px;
border-radius:10px;
border:1px solid #ddd;
">


<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


<option

value="<?php echo e($category->id); ?>"

<?php echo e($product->category_id == $category->id ? 'selected':''); ?>


>

<?php echo e($category->name); ?>


</option>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



</select>


</div>









<!-- HARGA -->


<div style="margin-bottom:20px;">


<label>

Harga

</label>


<br>



<input

type="number"

name="price"

value="<?php echo e($product->price); ?>"

required

style="
width:100%;
padding:12px;
border-radius:10px;
border:1px solid #ddd;
">


</div>









<!-- STOK -->


<div style="margin-bottom:20px;">


<label>

Stok

</label>


<br>



<input

type="number"

name="stock"

value="<?php echo e($product->stock); ?>"

required

style="
width:100%;
padding:12px;
border-radius:10px;
border:1px solid #ddd;
">


</div>









<!-- TAMBAH FOTO -->


<div style="margin-bottom:20px;">


<label>

Tambah Foto Produk

</label>


<br><br>



<input

type="file"

name="images[]"

id="images"

multiple

accept="image/*"

>



<p style="
font-size:12px;
color:#777;
">


Upload maksimal 5 foto.


</p>





<div

id="preview"

style="
display:flex;
gap:15px;
flex-wrap:wrap;
margin-top:15px;
">


</div>



</div>









<!-- DESKRIPSI -->


<div style="margin-bottom:20px;">


<label>

Deskripsi

</label>


<br>




<textarea

name="description"

required

style="
width:100%;
height:130px;
padding:12px;
border-radius:10px;
border:1px solid #ddd;
"><?php echo e($product->description); ?></textarea>



</div>









<button

type="submit"

style="
background:#2563eb;
color:white;
padding:12px 25px;
border:none;
border-radius:10px;
cursor:pointer;
">


Update Produk


</button>





<a

href="<?php echo e(route('admin.products.index')); ?>"

style="
margin-left:10px;
background:#e5e7eb;
padding:12px 20px;
border-radius:10px;
text-decoration:none;
color:#374151;
">


Kembali


</a>



</form>









<br><br>





<!-- ==========================
FOTO LAMA
========================== -->



<div>


<h3>

Foto Produk Saat Ini

</h3>




<div style="
display:flex;
gap:20px;
flex-wrap:wrap;
">





<?php if(count($images)>0): ?>



<?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



<div style="
position:relative;
">





<img

src="<?php echo e(asset('storage/'.$image)); ?>"

width="120"

height="120"

style="
object-fit:cover;
border-radius:15px;
border:1px solid #ddd;
">







<!-- FORM HAPUS FOTO TERPISAH -->


<form

action="<?php echo e(route('admin.products.deleteImage',
[
'product'=>$product->id,
'index'=>$index
])); ?>"

method="POST"

style="
position:absolute;
top:-10px;
right:-10px;
">


<?php echo csrf_field(); ?>

<?php echo method_field('DELETE'); ?>




<button

type="submit"

onclick="return confirm('Hapus foto ini?')"

style="
width:32px;
height:32px;
border-radius:50%;
border:none;
background:#dc2626;
color:white;
font-size:20px;
cursor:pointer;
">


×


</button>



</form>







</div>





<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<?php else: ?>


<p>

Belum ada foto produk

</p>


<?php endif; ?>




</div>



</div>






<a href="<?php echo e(route('admin.dashboard')); ?>"

style="
display:inline-block;
margin-top:30px;
background:#111827;
padding:12px 20px;
border-radius:10px;
text-decoration:none;
color:white;
">


⌂ Dashboard


</a>





</div>









<script>


document

.getElementById('images')

.addEventListener('change',function(event){



let preview=document.getElementById('preview');


preview.innerHTML='';




let files=event.target.files;





if(files.length > 5){


alert('Maksimal upload 5 foto');


this.value='';


return;


}





Array.from(files).forEach(file=>{


let reader=new FileReader();



reader.onload=function(e){


let img=document.createElement('img');


img.src=e.target.result;


img.width=120;

img.height=120;


img.style.objectFit='cover';


img.style.borderRadius='15px';


img.style.border='1px solid #ddd';



preview.appendChild(img);



}



reader.readAsDataURL(file);



});



});



</script>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>