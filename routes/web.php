<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'home']);
Route::get('/dashboard',[HomeController::class,'login_home'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('myorders',[HomeController::class,'viewmyorders'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard', [HomeController::class,'index'])->middleware(['auth','admin']);
Route::get('view_category', [AdminController::class,'view_category'])->middleware(['auth','admin']);
Route::post('add_category', [AdminController::class,'add_category'])->middleware(['auth','admin']);
Route::get('delete-category/{id}', [AdminController::class,'deletecategory'])->middleware(['auth','admin']);
Route::get('edit-category/{id}', [AdminController::class,'editcategory'])->middleware(['auth','admin']);
Route::post('update-category/{id}', [AdminController::class,'updatecategory'])->middleware(['auth','admin']);
Route::get('add_product', [AdminController::class,'addproduct'])->middleware(['auth','admin']);
Route::post('upload_product', [AdminController::class,'uploadproduct'])->middleware(['auth','admin']);
Route::get('view_product', [AdminController::class,'viewproduct'])->middleware(['auth','admin']);
Route::get('delete_product/{id}', [AdminController::class,'deleteproduct'])->middleware(['auth','admin']);
Route::get('edit_product/{id}', [AdminController::class,'editproduct'])->middleware(['auth','admin']);
Route::post('update_product/{id}', [AdminController::class,'updateproduct'])->middleware(['auth','admin']);
Route::get('search_product', [AdminController::class,'searchproduct'])->middleware(['auth','admin']);
Route::get('product_details/{id}', [HomeController::class,'productdetails']);
Route::get('shop', [HomeController::class,'shop']);
Route::get('why', [HomeController::class,'why']);
Route::get('testimonial', [HomeController::class,'testimonial']);
Route::get('contact', [HomeController::class,'contact']);
Route::get('add_cart/{id}', [HomeController::class,'addcart'])->middleware(['auth', 'verified']);
Route::get('mycart', [HomeController::class,'mycart'])->middleware(['auth', 'verified']);
Route::post('update_cart', [HomeController::class,'update_cart'])->middleware(['auth', 'verified']);
Route::get('remove_cart/{id}', [HomeController::class,'remove_cart'])->middleware(['auth', 'verified']);
Route::get('view_orders', [AdminController::class,'view_orders'])->middleware(['auth','admin']);
Route::get('on_the_way/{id}', [AdminController::class,'on_the_way'])->middleware(['auth','admin']);
Route::get('delivered/{id}', [AdminController::class,'delivered'])->middleware(['auth','admin']);
Route::get('print_PDF/{id}', [AdminController::class,'print_PDF'])->middleware(['auth','admin']);
Route::controller(HomeController::class)->group(function(){
    Route::get('stripe/{value}', 'stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});
