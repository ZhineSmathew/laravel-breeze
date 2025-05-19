<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('product', ProductController::class);
Route::post('addtocart/{id}', [ProductController::class, 'addToCart'])->name('addtocart');
Route::post('increase/{id}', [CartController::class, 'addMoreQuantiy'])->name('cart.increase');
Route::post('decrease/{id}', [CartController::class, 'removeQuantity'])->name('cart.decrease');


Route::resource('cart', CartController::class);

Route::resource('role', RoleController::class);

Route::get('/cacheclear', [ProfileController::class, 'cacheClear'])->name('cacheclear');
