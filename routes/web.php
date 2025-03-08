<?php

use App\Http\Controllers\admin\AssetController;
use App\Http\Controllers\admin\OwnershipController;
use Illuminate\Support\Facades\Auth;
// admin
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DivisionController;
// divisi
use App\Http\Controllers\user\DashboardController as DashboardUser;
// user
use App\Http\Controllers\admin\DashboardController as DashboardAdmin;
use App\Http\Controllers\division\DashboardController as DashboardDivision;

// AUTH
Route::prefix('auth')->group(function(){
    Route::get('', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.looutg');
});

// STAFF / GURU
Route::middleware(['auth', 'role:Staff'])->group(
    function () {
        Route::get('/', [DashboardUser::class, 'index'])->name('dashboard.user');
});


// ADMIN
        Route::prefix('admin')->middleware(['auth', 'role:Admin'])->group(function () {
            Route::get('', [DashboardAdmin::class, 'index'])->name('dashboard.admin');

            // CATEGORY
            Route::prefix('category')->group(function () {
                Route::get('', [CategoryController::class, 'index'])->name('category');
                // create
                Route::get('create', [CategoryController::class, 'create'])->name('category.create');
                // store
                Route::post('store', [CategoryController::class, 'store'])->name('category.store');
                // edit
                Route::get('edit/{name}', [CategoryController::class, 'edit'])->name('category.edit');
                Route::put('update/{name}', [CategoryController::class, 'update'])->name('category.update');
                // delete
                Route::delete('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
            });

            // DIVISION
            Route::prefix('division')->group(function () {
                Route::get('', [DivisionController::class, 'index'])->name('division');
                // create
                Route::get('create', [DivisionController::class, 'create'])->name('division.create');
                Route::post('store', [DivisionController::class, 'store'])->name('division.store');
                // edit
                Route::get('edit/{name}', [DivisionController::class, 'edit'])->name('division.edit');
                Route::put('update/{id}', [DivisionController::class, 'update'])->name('division.update');
                // delete
                Route::delete('delete/{id}', [DivisionController::class, 'delete'])->name('division.delete');
            });

            // USER
            Route::prefix('user')->group(function () {
                Route::get('', [UserController::class, 'index'])->name('user');
                // create
                Route::get('create', [UserController::class, 'create'])->name('user.create');
                Route::post('store', [UserController::class, 'store'])->name('user.store');
                // edit
                Route::get('edit/{slug}', [UserController::class, 'edit'])->name('user.edit');
                Route::put('update/{id}', [UserController::class, 'update'])->name('user.update');
                // delete
                Route::delete('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
            });

            // ASSET
            Route::prefix('asset')->group(function () {
                Route::get('', [AssetController::class, 'index'])->name('asset');
                // DETAILS
                Route::get('detail/{code}', [AssetController::class, 'detail'])->name('asset.detail');
                // CREATE
                Route::get('create', [AssetController::class, 'create'])->name('asset.create');
                Route::post('store', [AssetController::class, 'store'])->name('asset.store');
                // EDIT
                Route::get('edit/{code}', [AssetController::class, 'edit'])->name('asset.edit');
                Route::put('update/{id}', [AssetController::class, 'update'])->name('asset.update');
                // DELETE
                Route::delete('delete/{id}', [AssetController::class, 'delete'])->name('asset.delete');
            });

            Route::prefix('ownership')->group(function() {
                Route::get('', [OwnershipController::class, 'index'])->name('ownership');
                // CREATE
                Route::get('create', [OwnershipController::class, 'create'])->name('ownership.create');
                Route::post('store', [OwnershipController::class, 'store'])->name('ownership.store');
                // EDIT
                Route::get('edit/{code}', [OwnershipController::class, 'edit'])->name('ownership.edit');
                Route::put('update/{id}', [OwnershipController::class, 'update'])->name('ownership.update');
                // DELETE
                Route::delete('delete/{id}', [OwnershipController::class, 'delete'])->name('ownership.delete');
                // detail
                Route::get('detail/{code}', [OwnershipController::class, 'detail'])->name('ownership.detail');
                // LAMPIRAN
                Route::get('attachment', [OwnershipController::class, 'attachment'])->name('ownership.attachment');
                Route::get('return-attachment', [OwnershipController::class, 'return_attachment'])->name('ownership.return-attachment');
                // RETURN
                Route::get('return/{code}', [OwnershipController::class, 'return'])->name('ownership.return');
                Route::post('return/{id}', [OwnershipController::class, 'return_update'])->name('ownership.return_update');
            });

        });


// AKSES DIVISI
Route::prefix('{division}')->middleware(['auth', 'checkDivision'])->group(function () {
    Route::get('',
        [DashboardDivision::class, 'index']
    )->name('dashboard.division');
});



