<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Shopping Cart</title>

    <link
        rel="stylesheet"
        href="<?php echo e(asset('assets/css/catalog.css')); ?>"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f8f6f2;
            color: #2c2118;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            width: 100%;
            background: white;
            padding: 35px 70px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: Georgia, serif;
            font-size: 34px;
            color: #2c2118;
        }

        .nav-menu a {
            color: #2c2118;
            text-decoration: none;
            letter-spacing: 3px;
            font-size: 14px;
        }

        /* =========================
           CART
        ========================= */

        .cart-container {
            max-width: 1200px;
            margin: auto;
            padding: 70px 60px 100px;
        }

        .cart-title {
            font-family: Georgia, serif;
            font-size: 55px;
            margin: 0 0 50px;
            color: #2c2118;
        }

        .cart-table {
            width: 100%;
            background: white;
            border-radius: 30px;
            padding: 35px 45px;
        }

        /* =========================
           CART ITEM
        ========================= */

        .cart-item {
            display: grid;

            grid-template-columns:
                130px
                minmax(180px, 1fr)
                180px
                180px
                80px;

            align-items: center;
            gap: 25px;

            padding: 25px 0;

            border-bottom: 1px solid #eee;
        }

        /* =========================
           GAMBAR PRODUK
        ========================= */

        .product-image-wrapper {
            width: 120px;
            height: 120px;
            border-radius: 20px;
            overflow: hidden;

            background: #f4f4f4;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image-wrapper img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            object-position: center;
        }

        .no-image {
            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            text-align: center;

            padding: 10px;

            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #999;
        }

        /* =========================
           PRODUK
        ========================= */

        .product-info h3 {
            margin: 0;

            font-family: Arial, sans-serif;

            font-size: 21px;
            line-height: 1.4;

            color: #171717;
        }

        .price {
            color: #b8904a;
            font-weight: bold;
            font-size: 19px;
            white-space: nowrap;
        }

        /* =========================
           QUANTITY
        ========================= */

        .qty-form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .qty-form input {
            width: 70px;

            padding: 12px;

            border: 1px solid #aaa;
            border-radius: 5px;

            font-size: 16px;
        }

        .update-button {
            border: none;

            padding: 12px 14px;

            border-radius: 7px;

            background: #2c2118;
            color: white;

            cursor: pointer;

            transition: 0.2s;
        }

        .update-button:hover {
            background: #b8904a;
        }

        /* =========================
           REMOVE
        ========================= */

        .remove {
            color: #dc2626;

            text-decoration: none;

            font-family: Arial, sans-serif;

            font-size: 15px;
        }

        .remove:hover {
            text-decoration: underline;
        }

        /* =========================
           TOTAL
        ========================= */

        .total {
            margin-top: 40px;

            background: #2c2118;

            color: white;

            padding: 40px;

            border-radius: 25px;

            font-family: Arial, sans-serif;
        }

        .total-text {
            font-size: 28px;
            margin-bottom: 25px;
        }

        .checkout {
            display: inline-block;

            background: #b8904a;
            color: white;

            padding: 17px 45px;

            border-radius: 40px;

            text-decoration: none;

            font-size: 20px;

            transition: 0.2s;
        }

        .checkout:hover {
            background: #a07b3c;
        }

        /* =========================
           ALERT
        ========================= */

        .alert {
            padding: 15px 20px;

            margin-bottom: 25px;

            border-radius: 10px;

            font-family: Arial, sans-serif;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* =========================
           EMPTY CART
        ========================= */

        .empty-cart {
            background: white;

            padding: 50px;

            text-align: center;

            border-radius: 25px;
        }

        .empty-cart h2 {
            font-family: Georgia, serif;

            margin-bottom: 25px;
        }

        .shopping-button {
            display: inline-block;

            padding: 14px 30px;

            background: #2c2118;
            color: white;

            border-radius: 30px;

            text-decoration: none;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media(max-width: 900px) {

            .cart-container {
                padding: 40px 25px;
            }

            .cart-title {
                font-size: 40px;
            }

            .cart-table {
                padding: 20px;
            }

            .cart-item {
                grid-template-columns:
                    100px
                    1fr;

                gap: 15px;
            }

            .product-image-wrapper {
                width: 90px;
                height: 90px;
            }

            .price,
            .qty,
            .remove-wrapper {
                grid-column: 2;
            }

        }

    </style>

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

    </div>

</nav>



<div class="cart-container">


    <h1 class="cart-title">
        Your Shopping Cart
    </h1>


    

    <?php if(session('success')): ?>

        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>

    <?php endif; ?>


    

    <?php if(session('error')): ?>

        <div class="alert alert-error">
            <?php echo e(session('error')); ?>

        </div>

    <?php endif; ?>



    <?php if(count($cart) > 0): ?>


        <div class="cart-table">


            <?php
                $total = 0;
            ?>



            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <?php

                    /*
                    |--------------------------------------------------------------------------
                    | HITUNG TOTAL
                    |--------------------------------------------------------------------------
                    */

                    $price = $item['price'] ?? 0;

                    $quantity = $item['quantity'] ?? 1;

                    $total += $price * $quantity;


                    /*
                    |--------------------------------------------------------------------------
                    | AMBIL GAMBAR PRODUK
                    |--------------------------------------------------------------------------
                    */

                    $images = $item['image'] ?? [];


                    /*
                     * Dukungan untuk session cart lama
                     * jika image masih berupa JSON string.
                     */
                    if (!is_array($images)) {

                        $decodedImages = json_decode(
                            $images,
                            true
                        );

                        if (is_array($decodedImages)) {

                            $images = $decodedImages;

                        } else {

                            $images = $images
                                ? [$images]
                                : [];

                        }

                    }


                    /*
                     * Ambil gambar pertama.
                     */
                    $productImage =
                        count($images) > 0
                        ? $images[0]
                        : null;

                ?>



                <div class="cart-item">


                    

                    <div class="product-image-wrapper">


                        <?php if($productImage): ?>


                            <img
                                src="<?php echo e(asset('storage/' . $productImage)); ?>"

                                alt="<?php echo e($item['name'] ?? 'Produk'); ?>"

                                onerror="
                                    this.style.display='none';
                                    this.nextElementSibling.style.display='flex';
                                "
                            >


                            <div
                                class="no-image"
                                style="display:none;"
                            >

                                Gambar tidak ditemukan

                            </div>


                        <?php else: ?>


                            <div class="no-image">

                                Tidak ada gambar

                            </div>


                        <?php endif; ?>


                    </div>



                    

                    <div class="product-info">

                        <h3>
                            <?php echo e($item['name'] ?? 'Produk'); ?>

                        </h3>

                    </div>



                    

                    <div class="price">

                        Rp <?php echo e(number_format(
                                $price,
                                0,
                                ',',
                                '.'
                            )); ?>


                    </div>



                    

                    <div class="qty">


                        <form
                            class="qty-form"

                            action="<?php echo e(route(
                                    'cart.update',
                                    $id
                                )); ?>"

                            method="POST"
                        >


                            <?php echo csrf_field(); ?>


                            <input

                                type="number"

                                name="quantity"

                                value="<?php echo e($quantity); ?>"

                                min="1"

                                required
                            >


                            <button
                                type="submit"
                                class="update-button"
                            >

                                Update

                            </button>


                        </form>


                    </div>



                    

                    <div class="remove-wrapper">

                        <form action="<?php echo e(route('cart.remove', $id)); ?>" method="POST"
                              onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="remove" style="background:none;border:0;padding:0;cursor:pointer;">
                                Hapus
                            </button>
                        </form>

                    </div>


                </div>


            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



            

            <div class="total">


                <div class="total-text">

                    Total:

                    <strong>

                        Rp <?php echo e(number_format(
                                $total,
                                0,
                                ',',
                                '.'
                            )); ?>


                    </strong>

                </div>



                <a
                    href="<?php echo e(route('checkout.index')); ?>"
                    class="checkout"
                >

                    Checkout

                </a>


            </div>


        </div>


    <?php else: ?>


        <div class="empty-cart">


            <h2>
                Keranjang masih kosong
            </h2>


            <a
                href="<?php echo e(route('home')); ?>"
                class="shopping-button"
            >

                Mulai Belanja

            </a>


        </div>


    <?php endif; ?>


</div>


</body>

</html>
<?php /**PATH C:\laragon\www\katalogku_ver2\resources\views/cart/index.blade.php ENDPATH**/ ?>