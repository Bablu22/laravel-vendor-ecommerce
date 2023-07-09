<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;

Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'update'])->name('profile.update');
Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

// vendor shop profile routes
Route::resource('shop-profile', VendorShopProfileController::class);

// vendor product routes
Route::put('product/change-status', [VendorProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('product', VendorProductController::class);


/** Get sub categories and child categorirs */
Route::get('get-subcategory', [ChildCategoryController::class, 'getSubcategories'])->name('get-subcategories');
Route::get('get-childcategory', [ChildCategoryController::class, 'getChildcategories'])->name('get-childcategories');

// vendor product image gallery routes
Route::resource('product-image-gallery', VendorProductImageGalleryController::class);

// Product variation routes
Route::put('products-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', VendorProductVariantController::class);


// Product variation item routes
Route::get('products-variant-item/{productId}/{variantId}', [VendorProductVariantItemController::class, 'index'])->name('products-variant-item.index');

Route::get('products-variant-item/create/{productId}/{variantId}', [VendorProductVariantItemController::class, 'create'])->name('products-variant-item.create');

Route::post('products-variant-item', [VendorProductVariantItemController::class, 'store'])->name('products-variant-item.store');

Route::get('products-variant-item-edit/{variantItemId}', [VendorProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');

Route::put('products-variant-item-update/{variantItemId}', [VendorProductVariantItemController::class, 'update'])->name('products-variant-item.update');

Route::delete('products-variant-item/{variantItemId}', [VendorProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');

Route::put('products-variant-item-status', [VendorProductVariantItemController::class, 'chageStatus'])->name('products-variant-item.chages-status');