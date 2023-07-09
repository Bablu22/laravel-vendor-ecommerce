<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProductImageGalleryController;


Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

// Profile routes
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

// Slider routes
Route::resource('slider', SliderController::class);

// Category routes
Route::put('category/status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

// Subcategory routes
Route::put('subcategory/status', [SubCategoryController::class, 'changeStatus'])->name('subcategory.change-status');
Route::resource('subcategory', SubCategoryController::class);


// Childcategory routes


Route::put('childcategory/status', [ChildCategoryController::class, 'changeStatus'])->name('childcategory.change-status');

/** Get sub categories and child categorirs */

Route::get('get-subcategory', [ChildCategoryController::class, 'getSubcategories'])->name('get-subcategories');
Route::get('get-childcategory', [ChildCategoryController::class, 'getChildcategories'])->name('get-childcategories');

Route::resource('childcategory', ChildCategoryController::class);

// Brand routes
Route::put('brand/status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);


// vendor routes
Route::put('vendor/status', [AdminVendorProfileController::class, 'changeStatus'])->name('vendor.change-status');
Route::resource('vendor-profile', AdminVendorProfileController::class);

// Product routes
Route::put('product/status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('product', ProductController::class);

// Product image gallery
Route::resource('product-image-gallery', ProductImageGalleryController::class);

// Product variant
Route::put('product-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
Route::resource('product-variant', ProductVariantController::class);

// Product-varient
/** Products variant item route */
Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');

Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');

Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');

Route::get('products-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');

Route::put('products-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');

Route::delete('products-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');

Route::put('products-variant-item-status', [ProductVariantItemController::class, 'chageStatus'])->name('products-variant-item.chages-status');

// Seller product routes
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products');
Route::get('seller-pending-products', [SellerProductController::class, 'pendingProducts'])->name('seller-pending-products');