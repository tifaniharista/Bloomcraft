<?php $__env->startSection('content'); ?>


<div style="
background:white;
padding:30px;
border-radius:20px;
">


<h1>

Data User Website

</h1>


<p style="
color:#777;
margin-bottom:25px;
">

Daftar pengguna yang telah melakukan registrasi.

</p>





<table style="
width:100%;
border-collapse:collapse;
">


<thead>


<tr style="
background:#f3f4f6;
">


<th style="padding:15px;">
No
</th>


<th style="padding:15px;">
Nama
</th>


<th style="padding:15px;">
Email
</th>


<th style="padding:15px;">
Password
</th>


<th style="padding:15px;">
Role
</th>


<th style="padding:15px;">
Tanggal Daftar
</th>


</tr>


</thead>




<tbody>



<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



<tr>


<td style="padding:15px;">

<?php echo e($loop->iteration); ?>


</td>



<td style="padding:15px;">

<?php echo e($user->name); ?>


</td>



<td style="padding:15px;">

<?php echo e($user->email); ?>


</td>




<td style="padding:15px;">

********

</td>




<td style="padding:15px;">

<?php if($user->role == 'admin'): ?>


<span style="
background:#dcfce7;
color:#166534;
padding:6px 12px;
border-radius:20px;
">

Administrator

</span>


<?php else: ?>


<span style="
background:#e5e7eb;
color:#374151;
padding:6px 12px;
border-radius:20px;
">

User

</span>


<?php endif; ?>


</td>




<td style="padding:15px;">

<?php echo e($user->created_at->format('d M Y')); ?>


</td>



</tr>




<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




</tbody>



</table>



</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/admin/users/index.blade.php ENDPATH**/ ?>