<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use App\Models\Company;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware(Admin::class)->group(function () {

    Route::get('/', [CompanyController::class, 'index'])->name('home');

    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/{gtin}', [ProductController::class, 'edit'])->name('product.edit');

    Route::post('/create', [CompanyController::class, 'create'])->name('company.create');
    Route::get('/{id}', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/{id}/update', [CompanyController::class, 'update'])->name('company.update');
    
    // Route::post('/products/new', [ProductController::class, 'create'])->name('products.create');
});

