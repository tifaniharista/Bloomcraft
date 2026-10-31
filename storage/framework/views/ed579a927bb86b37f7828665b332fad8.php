<?php $__env->startSection('content'); ?>



<h1>

Detail Pesanan

</h1>

<?php if(session('success')): ?>


<div style="
background:#dcfce7;
color:#166534;
padding:15px;
border-radius:10px;
margin:20px 0;
">


<?php echo e(session('success')); ?>



</div>


<?php endif; ?>

<br>


<div style="
background:white;
padding:30px;
border-radius:20px;
">

<h2>

Informasi Pelanggan

</h2>




<p>

<strong>

Nama:

</strong>

<?php echo e($order->name); ?>


</p>



<p>

<strong>

Telepon:

</strong>

<?php echo e($order->phone); ?>


</p>




<p>

<strong>

Alamat:

</strong>

<?php echo e($order->address); ?>


</p>







<hr style="margin:25px 0;">






<h2>

Produk Dibeli

</h2>






<?php $__currentLoopData = $order->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>





<div style="
display:flex;
gap:20px;
align-items:center;
padding:15px 0;
border-bottom:1px solid #ddd;
">





<?php if($detail->product && $detail->product->image && count($detail->product->image)): ?>
<img
src="<?php echo e(asset('storage/'.$detail->product->image[0])); ?>"

style="
width:80px;
height:80px;
object-fit:cover;
border-radius:15px;
">


<?php endif; ?>






<div>


<h3>

<?php echo e($detail->product_name); ?>


</h3>



<p>

Jumlah :

<?php echo e($detail->quantity); ?>


</p>



<p>

Harga :

Rp <?php echo e(number_format($detail->price,0,',','.')); ?>


</p>



</div>




</div>





<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>







<p><strong>Nomor pesanan:</strong> <?php echo e($order->order_number); ?></p>
<p><strong>Status pembayaran:</strong> <?php echo e($order->payment_status); ?></p>
<p><strong>Ongkir:</strong> Gratis (Rp 0)</p>
<?php if($order->payments->isNotEmpty()): ?>
  <?php ($payment = $order->payments->sortByDesc('id')->first()); ?>
  <h2>Bukti Pembayaran</h2>
  <p>Status: <?php echo e($payment->status); ?></p>
  <?php if($payment->proof_path): ?><p><a href="<?php echo e(route('admin.orders.payment-proof',$order)); ?>" target="_blank" rel="noopener">Lihat bukti transfer</a></p><?php endif; ?>
  <?php if($payment->proof_path && $order->payment_status !== 'paid'): ?>
  <form method="POST" action="<?php echo e(route('admin.orders.verify-payment',$order)); ?>" style="margin:20px 0"><?php echo csrf_field(); ?>
    <textarea name="admin_note" placeholder="Catatan untuk customer (wajib diisi jika menolak)"></textarea><br>
    <button name="decision" value="approve" type="submit">Verifikasi Pembayaran</button>
    <button name="decision" value="reject" type="submit">Tolak Bukti</button>
  </form>
  <?php endif; ?>
<?php endif; ?>
<?php if($order->payment_status === 'paid' && !in_array($order->order_status,['ready_to_ship','completed'])): ?>
<h2>Barang Siap Dikirim</h2>
<form method="POST" action="<?php echo e(route('admin.orders.ready-to-ship',$order)); ?>"><?php echo csrf_field(); ?>
  <input name="shipping_courier" placeholder="Kurir (opsional)"><input name="shipping_service" placeholder="Layanan (opsional)"><input name="tracking_number" placeholder="Nomor resi (opsional)">
  <button type="submit">Tandai Siap Dikirim</button>
</form>
<?php endif; ?>
<?php ($waText = 'Halo '.$order->name.', pesanan Bloomcraft '.$order->order_number.' siap dikirim. Ongkir gratis. Total: Rp '.number_format((float)$order->total,0,',','.').($order->tracking_number ? '. Resi: '.$order->tracking_number : '').'.'); ?>
<p><a target="_blank" rel="noopener" href="https://wa.me/<?php echo e(preg_replace('/\D/','',$order->phone)); ?>?text=<?php echo e(urlencode($waText)); ?>">Hubungi customer melalui WhatsApp</a></p>

<h2 style="margin-top:30px;">

Total:

Rp <?php echo e(number_format($order->total,0,',','.')); ?>



</h2>









<br>





<form method="POST"

action="<?php echo e(route('admin.orders.update',$order->id)); ?>">


<?php echo csrf_field(); ?>

<?php echo method_field('PUT'); ?>





<label>

Status Pesanan

</label>




<br><br>





<select name="status"

style="
padding:12px;
border-radius:8px;
">



<option value="pending"

<?php if($order->status=='pending'): ?>

selected

<?php endif; ?>

>

Pending

</option>






<option value="process"

<?php if($order->status=='process'): ?>

selected

<?php endif; ?>

>

Process

</option>







<option value="success"

<?php if($order->status=='success'): ?>

selected

<?php endif; ?>

>

Success

</option>






<option value="cancel"

<?php if($order->status=='cancel'): ?>

selected

<?php endif; ?>

>

Cancel

</option>



</select>







<button

style="
margin-left:10px;
padding:12px 20px;
background:#2563eb;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
">


Update Status


</button>







</form>







</div>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>