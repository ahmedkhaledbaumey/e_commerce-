<?php

use App\Http\Middleware\IsAdmin;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Route::middleware(['auth'])->group(function () {
    //     Jetstream::profileShowRoute();
    // });
});


Route::get('redirect', [HomeController::class, 'redirect'])->name('redirect');;
// Route::controller(ProductController::class)->group(function(){
// Route::get('products' , 'index')->name('product.index')  ;
// Route::get('products/create' , 'create')->name('product.create')  ;
// Route::post('products/store' , 'store')->name('product.store')  ;
// });
Route::middleware(IsAdmin::class)->group(function () {

    Route::prefix('products')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('products.index');
        Route::get('create', [ProductController::class, 'create'])->name('products.create');
        Route::post('', [ProductController::class, 'store'])->name('products.store');
        Route::get('{product}', [ProductController::class, 'show'])->name("admin.products.show");
        Route::get('edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
});
Route::get("change/{lang}", function ($lang) {
    if ($lang == "ar") {
        session()->put("lang", "ar");
    } else {
        session()->put("lang", "en");
    }
    return redirect()->back();
})->name("change");


Route::get('', [UserProductController::class, 'index'])->name('user');
Route::get('search', [UserProductController::class, 'search'])->name('search');
Route::get('products/products/{product}', [UserProductController::class, 'show'])->name('products.show');
Route::post('add_to_cart/{id}', [UserProductController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('cart', [UserProductController::class, 'mycart'])->name('mycart');
Route::post('makeOrder', [UserProductController::class, 'makeOrder'])->name('makeOrder');
