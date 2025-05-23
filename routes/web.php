<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use App\Models\Company;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(Admin::class)->group(function () {

    Route::get('/home', [CompanyController::class, 'index'])->name('home');
    Route::post('/home/create', [CompanyController::class, 'create'])->name('company.create');
    Route::get('/home/{id}', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/home/{id}/update', [CompanyController::class, 'update'])->name('company.update');
    
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    // Route::post('/products/new', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{gtin}', [ProductController::class, 'edit'])->name('company.edit');
});

require __DIR__ . '/auth.php';
