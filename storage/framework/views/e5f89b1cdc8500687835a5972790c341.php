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
        :root {
            --ink: #30251d;
            --ink-soft: #66584d;
            --gold: #b58a4a;
            --gold-dark: #98703a;
            --cream: #faf8f4;
            --sage: #e9eee5;
            --line: #ebe6de;
            --white: #fff;
            --danger: #b42318;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            background: var(--cream);
            color: var(--ink);
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.55;
        }

        button, input { font: inherit; }

        .navbar {
            width: 100%;
            min-height: 86px;
            padding: 20px clamp(20px, 6vw, 84px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            background: rgba(255,255,255,.96);
            border-bottom: 1px solid var(--line);
        }

        .logo {
            color: var(--ink);
            font-family: Georgia, 'Times New Roman', serif;
            font-size: clamp(27px, 3vw, 35px);
            font-weight: 600;
            letter-spacing: -.8px;
        }

        .nav-menu a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 18px;
            border: 1px solid var(--line);
            border-radius: 999px;
            color: var(--ink);
            background: var(--white);
            text-decoration: none;
            letter-spacing: 1.5px;
            font-size: 12px;
            font-weight: 700;
            transition: background .2s, color .2s, border-color .2s;
        }

        .nav-menu a:hover {
            background: var(--ink);
            border-color: var(--ink);
            color: var(--white);
        }

        .cart-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: clamp(34px, 6vw, 72px) clamp(16px, 5vw, 60px) 90px;
        }

        .cart-title {
            margin: 0 0 12px;
            color: var(--ink);
            font-family: Georgia, 'Times New Roman', serif;
            font-size: clamp(36px, 5vw, 56px);
            font-weight: 500;
            letter-spacing: -1.2px;
            line-height: 1.15;
        }

        .cart-title::after {
            content: '';
            display: block;
            width: 64px;
            height: 3px;
            margin-top: 19px;
            border-radius: 10px;
            background: var(--gold);
        }

        .cart-table {
            width: 100%;
            margin-top: 34px;
            padding: clamp(18px, 3.5vw, 38px);
            overflow: hidden;
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: 0 16px 45px rgba(48, 37, 29, .055);
        }

        .cart-item {
            display: grid;
            grid-template-columns: 112px minmax(160px, 1fr) minmax(120px, 160px) minmax(150px, 190px) 62px;
            align-items: center;
            gap: 22px;
            padding: 25px 0;
            border-bottom: 1px solid var(--line);
        }

        .cart-item:first-child { padding-top: 0; }
        .cart-item:last-of-type { border-bottom: 0; }

        .product-image-wrapper {
            width: 112px;
            height: 112px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f3f0ea;
            border: 1px solid #f0ece5;
            border-radius: 16px;
        }

        .product-image-wrapper img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform .35s ease;
        }

        .product-image-wrapper:hover img { transform: scale(1.05); }

        .no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            color: #8c8175;
            font-size: 12px;
            text-align: center;
        }

        .product-info h3 {
            margin: 0;
            color: var(--ink);
            font-family: Georgia, 'Times New Roman', serif;
            font-size: clamp(17px, 2vw, 21px);
            font-weight: 500;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .price {
            color: var(--gold-dark);
            font-size: 17px;
            font-weight: 700;
            white-space: nowrap;
        }

        .qty-form {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .qty-form input {
            width: 72px;
            min-height: 43px;
            padding: 9px 10px;
            color: var(--ink);
            background: #fff;
            border: 1px solid #d9d1c6;
            border-radius: 9px;
            font-size: 15px;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .qty-form input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(181, 138, 74, .15);
        }

        .update-button {
            min-height: 43px;
            padding: 10px 13px;
            border: 0;
            border-radius: 9px;
            background: var(--ink);
            color: var(--white);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .update-button:hover {
            background: var(--gold-dark);
            transform: translateY(-1px);
        }

        .remove {
            padding: 8px 0;
            border: 0;
            background: transparent;
            color: var(--danger);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .remove:hover { text-decoration: underline; }

        .total {
            margin-top: 28px;
            padding: clamp(24px, 4vw, 38px);
            border-radius: 20px;
            background: var(--ink);
            color: var(--white);
        }

        .total-text {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 24px;
            font-size: 17px;
            color: #e8dfd5;
        }

        .total-text strong {
            color: var(--white);
            font-family: Georgia, 'Times New Roman', serif;
            font-size: clamp(25px, 3.5vw, 34px);
            font-weight: 600;
        }

        .checkout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 52px;
            padding: 15px 32px;
            border: 1px solid var(--gold);
            border-radius: 999px;
            background: var(--gold);
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            transition: background .2s, border-color .2s, transform .2s;
        }

        .checkout::after {
            content: '→';
            margin-left: 12px;
            font-size: 18px;
        }

        .checkout:hover {
            background: var(--gold-dark);
            border-color: var(--gold-dark);
            transform: translateY(-1px);
        }

        .alert {
            padding: 15px 18px;
            margin: 24px 0 0;
            border: 1px solid transparent;
            border-radius: 12px;
            font-size: 14px;
        }

        .alert-success {
            background: #edf7ed;
            border-color: #d4ead3;
            color: #286338;
        }

        .alert-error {
            background: #fff0ef;
            border-color: #f4d0cd;
            color: #991b1b;
        }

        .empty-cart {
            margin-top: 34px;
            padding: clamp(35px, 7vw, 70px) 24px;
            border: 1px solid var(--line);
            border-radius: 24px;
            background: var(--white);
            box-shadow: 0 16px 45px rgba(48, 37, 29, .045);
            text-align: center;
        }

        .empty-cart h2 {
            margin: 0 0 25px;
            color: var(--ink);
            font-family: Georgia, 'Times New Roman', serif;
            font-size: clamp(25px, 4vw, 34px);
            font-weight: 500;
        }

        .shopping-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 28px;
            border-radius: 999px;
            background: var(--ink);
            color: var(--white);
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: background .2s;
        }

        .shopping-button:hover { background: var(--gold-dark); }

        button:focus-visible, a:focus-visible {
            outline: 3px solid rgba(181, 138, 74, .45);
            outline-offset: 3px;
        }

        @media (max-width: 1000px) {
            .cart-container { padding-top: 42px; }
            .cart-item {
                grid-template-columns: 92px minmax(0, 1fr) minmax(110px, auto);
                gap: 16px;
            }
            .product-image-wrapper {
                width: 92px;
                height: 92px;
                grid-row: span 2;
            }
            .product-info { grid-column: 2 / 4; }
            .price { grid-column: 2; }
            .qty { grid-column: 3; }
            .remove-wrapper {
                grid-column: 2 / 4;
                justify-self: start;
            }
        }

        @media (max-width: 560px) {
            .navbar {
                min-height: 72px;
                padding: 16px 20px;
            }
            .logo { font-size: 27px; }
            .nav-menu a {
                padding: 9px 13px;
                font-size: 11px;
                letter-spacing: 1px;
            }
            .cart-container {
                padding: 34px 14px 55px;
            }
            .cart-title { font-size: 37px; }
            .cart-table {
                padding: 18px 15px;
                margin-top: 25px;
                border-radius: 17px;
            }
            .cart-item {
                grid-template-columns: 76px minmax(0, 1fr);
                gap: 12px;
                padding: 20px 0;
            }
            .product-image-wrapper {
                width: 76px;
                height: 82px;
                grid-row: span 2;
                border-radius: 12px;
            }
            .product-info { grid-column: 2; }
            .product-info h3 { font-size: 17px; }
            .price {
                grid-column: 2;
                font-size: 16px;
            }
            .qty {
                grid-column: 2;
            }
            .qty-form input { width: 76px; }
            .update-button { padding: 10px 12px; }
            .remove-wrapper {
                grid-column: 2;
                justify-self: start;
            }
            .total {
                margin-top: 22px;
                padding: 23px 19px;
                border-radius: 16px;
            }
            .total-text {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
                font-size: 15px;
            }
            .total-text strong { font-size: 28px; }
            .checkout { width: 100%; padding: 14px 20px; }
            .empty-cart { border-radius: 17px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
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
<?php /**PATH C:\laragon\www\Bloomcraft-main\resources\views/cart/index.blade.php ENDPATH**/ ?>