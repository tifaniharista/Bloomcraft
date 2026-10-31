<?php $__env->startSection('content'); ?>


<h1>
Data Kategori
</h1>


<br>



<?php if(session('success')): ?>

<div style="
background:#dcfce7;
padding:15px;
border-radius:10px;
margin-bottom:20px;
">

<?php echo e(session('success')); ?>


</div>

<?php endif; ?>




<a href="<?php echo e(route('admin.categories.create')); ?>"
style="
background:#2563eb;
color:white;
padding:12px 20px;
border-radius:10px;
text-decoration:none;
">

+ Tambah Kategori

</a>





<table style="
width:100%;
background:white;
margin-top:30px;
border-collapse:collapse;
">


<tr>

<th style="padding:15px">
No
</th>


<th style="padding:15px">
Nama
</th>


<th style="padding:15px">
Slug
</th>


<th style="padding:15px">
Aksi
</th>


</tr>





<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


<tr>


<td style="padding:15px">

<?php echo e($loop->iteration); ?>


</td>


<td style="padding:15px">

<?php echo e($category->name); ?>


</td>


<td style="padding:15px">

<?php echo e($category->slug); ?>


</td>



<td style="padding:15px">


<a href="<?php echo e(route('admin.categories.edit',$category->id)); ?>">

Edit

</a>





<form action="<?php echo e(route('admin.categories.destroy',$category->id)); ?>"

method="POST"

style="display:inline">


<?php echo csrf_field(); ?>

<?php echo method_field('DELETE'); ?>


<button>

Hapus

</button>


</form>



</td>


</tr>



<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



</table>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>