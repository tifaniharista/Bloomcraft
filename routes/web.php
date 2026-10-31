<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;

/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE / USER
|--------------------------------------------------------------------------
*/

Route::get('/', [CatalogController::class, 'index'])
    ->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])
    ->name('catalog.index');

Route::get('/collection', [CatalogController::class, 'collection'])
    ->name('collection.index');

Route::get('/product/{slug}', [CatalogController::class, 'show'])
    ->name('product.show');

/*
|--------------------------------------------------------------------------
| CART SYSTEM
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add/{id}', [CartController::class, 'add'])
    ->name('cart.add');

Route::post('/cart/update/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

/*
|--------------------------------------------------------------------------
| USER ACCOUNT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    // Invoice hanya dapat dibuka customer yang login; controller memeriksa
    // kepemilikan pesanan dan memastikan bukti pembayaran sudah diunggah.
    Route::get('/orders/{order}/invoice', [OrderController::class, 'invoice'])
        ->name('orders.invoice');

    // Update nomor telepon pesanan milik customer yang sedang login.
    // Otorisasi kepemilikan dan aturan status pesanan tetap wajib
    // diperiksa di OrderController::updatePhone().
    Route::post('/orders/{order}/phone', [OrderController::class, 'updatePhone'])
        ->name('orders.phone.update');

    Route::post('/orders/{order}/payment-proof', [PaymentController::class, 'upload'])
        ->name('orders.payment-proof');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Category Management
        |--------------------------------------------------------------------------
        */

        Route::resource('categories', CategoryController::class);

        /*
        |--------------------------------------------------------------------------
        | Product Management
        |--------------------------------------------------------------------------
        */

        // Harus berada di atas resource products agar tidak tertangkap destroy().
        Route::delete(
            'products/{product}/image/{index}',
            [ProductController::class, 'deleteImage']
        )->name('products.deleteImage');

        Route::resource('products', ProductController::class);

        /*
        |--------------------------------------------------------------------------
        | Order Management
        |--------------------------------------------------------------------------
        */

        Route::get('orders/{order}/payment-proof', [AdminPaymentController::class, 'proof'])
            ->name('orders.payment-proof');

        Route::post('orders/{order}/verify-payment', [AdminPaymentController::class, 'verify'])
            ->name('orders.verify-payment');

        Route::post('orders/{order}/ready-to-ship', [AdminPaymentController::class, 'readyToShip'])
            ->name('orders.ready-to-ship');

        Route::resource('orders', AdminOrderController::class)
            ->only([
                'index',
                'show',
                'update',
                'destroy',
            ]);
    });
