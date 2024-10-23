<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SupplierController;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Master Data Routes
Route::prefix('master-data')->group(function() {
    // User Routes
    Route::get('user', [MasterDataController::class, 'showUsers'])->name('master-data.user');
    Route::get('user/create', [MasterDataController::class, 'createUser'])->name('master-data.create_user');
    Route::post('user', [MasterDataController::class, 'storeUser'])->name('users.store');
    Route::get('user/{id}/edit', [MasterDataController::class, 'edit'])->name('master-data.edit_user');
    Route::put('user/{id}/update', [MasterDataController::class, 'update'])->name('master-data.update_user');
    Route::delete('user/{id}', [MasterDataController::class, 'destroyUser'])->name('master-data.delete_user');

    // Supplier Routes
    Route::get('supplier', [SupplierController::class, 'showSuppliers'])->name('master-data.supplier');
    Route::get('supplier/create', [MasterDataController::class, 'createSupplier'])->name('master-data.create_supplier');
    Route::post('supplier', [MasterDataController::class, 'storeSupplier'])->name('suppliers.store');
    Route::get('supplier/{id}/edit', [SupplierController::class, 'edit'])->name('master-data.edit_supplier');
    Route::put('supplier/{id}', [SupplierController::class, 'update'])->name('master-data.update_supplier');
    Route::delete('/suppliers/reset', [SupplierController::class, 'deleteSuppliers'])->name('suppliers.reset');
    Route::delete('{id}', [SupplierController::class, 'destroy'])->name('master-data.destroy_supplier');
    Route::put('{id}/update', [SupplierController::class, 'update'])->name('suppliers.update');

    // Material Routes
    Route::get('material', [MasterDataController::class, 'ShowMaterials'])->name('master-data.material');
    Route::get('material/create', [MasterDataController::class, 'createMaterial'])->name('master-data.create_material');
    Route::post('material', [MasterDataController::class, 'storeMaterial'])->name('master-data.store_material');
    Route::get('material/{id}/edit', [MaterialController::class, 'edit'])->name('master-data.edit_material');
    Route::put('material/{id}', [MaterialController::class, 'update'])->name('master-data.update_material');
    Route::delete('material/{id}', [MaterialController::class, 'destroyMaterial'])->name('master-data.delete_material');

    // Purchase Order Routes
    Route::get('purchase-order', [MasterDataController::class, 'showPurchaseOrders'])->name('master-data.purchase_order');
    Route::get('purchase-order/create', [MasterDataController::class, 'createPurchaseOrder'])->name('master-data.create_purchase_order');
    Route::post('purchase-order', [MasterDataController::class, 'storePurchaseOrder'])->name('purchase_orders.store');
    Route::get('purchase-order/{id}/edit', [MasterDataController::class, 'editPurchaseOrder'])->name('master-data.edit_purchase_order');
    Route::put('purchase-order/{id}', [MasterDataController::class, 'updatePurchaseOrder'])->name('master-data.update_purchase_order');
    Route::delete('purchase-order/{id}', [MasterDataController::class, 'destroyPurchaseOrder'])->name('master-data.delete_purchase_order');
    Route::get('master-data/purchase-order/create-reset', [MasterDataController::class, 'createPurchaseOrder'])->name('purchase_orders.create_reset');
Route::get('master-data/purchase-order/reset', [MasterDataController::class, 'resetPurchaseOrders'])->name('purchase_orders.reset');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
