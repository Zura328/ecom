<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopControler;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
});

//checks if logged in
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('test');
//Authentication of users
Auth::routes();

//landing page
Route::get('/', [App\Http\Controllers\ShopControler::class, 'index'])->name('home');
//show all of the products
Route::get('/products', [App\Http\Controllers\ShopControler::class, 'products'])->name('products');

//add to cart a product
Route::post('/cart/add/{product}', [ShopControler::class, 'addtocart'])->name('cart.add')->middleware('role:customer');

//shows the pending orders
Route::get('/orders/pending', [OrderController::class, 'getPendingOrders'])->name('orders.pending');

//checkout list
Route::get('/checkout', [ShopControler::class, 'checkout'])->name('checkout');

//process the checkout
Route::post('/processcheckout', [ShopControler::class, 'processCheckout'])->name('process.checkout');

//show the shipping informations 
Route::get('/shipping/pending', [ShopControler::class, 'pending'])->name('shipping.pending');

//show the deliveries
Route::get('/delivery', [ShopControler::class, 'delivery'])->name('delivery')->middleware('role:delivery');


Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');

Route::post('/contact/us', [ContactController::class, 'submitForm'])->name('contact.submit');


Route::put('/delivery/{id}/update', [ShopControler::class, 'updateStatusDelivery'])->name('delivery.update');

Route::get('send-mail', [MailController::class, 'index']);

Route::get('/upload-csv', [ProductController::class, 'showUploadForm']);
Route::post('/upload-csv/upload', [ProductController::class, 'uploadCSV']);

Route::get('/products/table', [ProductController::class, 'productTable'])->name('products.index');


Route::get('/shipping/table', [ProductController::class, 'shippingTable'])->name('shipping.index');

Route::get('/order/table', [ProductController::class, 'orderTable'])->name('orders.index');

Route::post('/products/add', [ProductController::class, 'store'])->name('products.store');

Route::put('/shipping/{id}/update-status', [ShopControler::class, 'updateStatus'])->name('shipping.updateStatus');

Route::put('/products/{id}/update-stock', [ProductController::class, 'updateStock'])->name('products.updateStock');