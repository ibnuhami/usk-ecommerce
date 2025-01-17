<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('home');

Route::get('/product', [ProductController::class, 'indexProduct'])->name('indexProduct');
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::put('account/verify-store', [StoreController::class, 'verifyAccount'])->name('verifyAccount');

    Route::get('/product-by-store', [ProductController::class, 'getProductByStore'])->name('getProductByStore');
    Route::get('/product', [ProductController::class, 'createProductPage'])->name('createProductPage');
    Route::get('/product/{id}', [ProductController::class, 'updateProductPage'])->name('updateProductPage');
    Route::post('/product', [ProductController::class, 'insertProduct'])->name('insertProduct');
    Route::put('/product-update/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
    Route::delete('/product/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');

    Route::get('/carts', [CartController::class, 'cartPage'])->name('cartPage');
    Route::post('/carts', [CartController::class, 'insertToCart'])->name('insertToCart');
    Route::delete('/cart/cancel/{cartId}', [CartController::class, 'cancelCart'])->name('cancelCart');

    Route::get('/order-checkout/{cartId}', [TransactionController::class, 'checkoutTransactionPage'])->name('checkoutTransactionPage');
    Route::match(['post', 'get'],'/transaction-payment', [TransactionController::class, 'createTransactionPayment'])->name('transactionPayment');
    Route::post('/transaction-paid', [TransactionController::class, 'paidOrder'])->name('transactionPaid');

    Route::post('/report/pdf/order-transaction/{order_id}', [PdfController::class, 'reportPaymentOrder'])->name('reportPaymentOrder');

    Route::get('/order', [OrderController::class, 'orderPage'])->name('orderPage');
    Route::delete('/order/delete/{id}', [OrderController::class, 'cancelOrder'])->name('cancelOrder');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
