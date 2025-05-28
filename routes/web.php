<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FacingPages;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use App\Models\Company;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware('guest')->group(function () {
    Route::get('/', [FacingPages::class, 'indexGtin'])->name('gtin.bulk');
    Route::post('/', [FacingPages::class, 'validateGtin']);
    Route::get('/01/{gtin}', [FacingPages::class, 'indexProd'])->name('product.page');
    Route::get('products.json', [ProductController::class, 'getAll']);
    Route::get('products/{gtin}.json', [ProductController::class, 'getSingle']);

});


Route::middleware(Admin::class)->group(function () {

    Route::get('/home', [CompanyController::class, 'index'])->name('home');

    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('products/new', [ProductController::class, 'new'])->name('products.new');
    Route::get('/products/{gtin}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/products/{gtin?}', [ProductController::class, 'updateCreate'])->name('product.update.create');
    Route::post('/products/{gtin}/toggle', [ProductController::class, 'toggle'])->name('product.toggle');
    Route::post('/products/{gtin}/delete', [ProductController::class, 'delete'])->name('product.delete');
    Route::post('/products/{gtin}/image', [ProductController::class, 'deleteImage'])->name('product.delete.image');

    Route::post('/create', [CompanyController::class, 'create'])->name('company.create');
    Route::get('/{id}', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/{id}/update', [CompanyController::class, 'update'])->name('company.update');

    // Route::post('/products/new', [ProductController::class, 'create'])->name('products.create');
});
