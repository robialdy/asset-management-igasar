<?php

use App\Http\Controllers\admin\ProcurementController;
use App\Http\Controllers\division\DivisionAssetController;
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// admin
use App\Http\Controllers\admin\AssetController;
use App\Http\Controllers\admin\OwnershipController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DivisionController;
use App\Http\Controllers\admin\IssueController as AdminIssueController;
// divisi
use App\Http\Controllers\user\DashboardController as DashboardUser;
use App\Http\Controllers\division\IssueController as DivisionIssueController;

use App\Http\Controllers\division\ProcurementController as DivisionProcurementController;
// user
use App\Http\Controllers\user\YourAssetController;
use App\Http\Controllers\admin\DashboardController as DashboardAdmin;
use App\Http\Controllers\division\BorrowingController;
use App\Http\Controllers\division\DashboardController as DashboardDivision;
use App\Http\Controllers\user\IssueController;
use App\Http\Controllers\user\ProcurementController as UserProcurementController;

// AUTH
Route::prefix('auth')->group(function(){
    Route::get('', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.looutg');
});

// STAFF / GURU
Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/', [DashboardUser::class, 'index'])->name('dashboard.user');
    // ISSUe
    Route::prefix('issue')->group(function () {
        Route::get('', [IssueController::class, 'index'])->name('issue');
        // CREATE
        Route::get('create', [IssueController::class, 'create'])->name('issue.create');
        Route::post('store', [IssueController::class, 'store'])->name('issue.store');
        // EDIT
        Route::get('edit/{code_asset}', [IssueController::class, 'edit'])->name('issue.edit');
        Route::put('update/{id}', [IssueController::class, 'update'])->name('issue.update');
    });
    // YOUR ASSET
    Route::prefix('your-assets')->group(function (){
        Route::get('', [YourAssetController::class, 'index'])->name('your-asset');
    });

    // PENGADAAN
    Route::prefix('procurement')->group(function () {
        Route::get('', [UserProcurementController::class, 'index'])->name('user.procurement');
        // CREATE
        Route::get('create', [UserProcurementController::class, 'create'])->name('user.procurement.create');
        Route::post('store', [UserProcurementController::class, 'store'])->name('user.procurement.store');
        // VIEW DETAILS
        Route::get('details/{code}', [UserProcurementController::class, 'view_details'])->name('user.procurement.detail');
    });

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

            // ISSUE
            Route::prefix('issue')->group(function() {
                Route::get('', [AdminIssueController::class, 'index'])->name('admin.issue');
                // UPDATE STATuS
                Route::put('update/{id}', [AdminIssueController::class, 'updateStatus'])->name('admin.issue.updateStatus');
                // PERBAIKAN
                Route::get('repair/{code}', [AdminIssueController::class, 'repair'])->name('admin.issue.repair');
                Route::put('repair/update/{id}', [AdminIssueController::class, 'repairUpdate'])->name('admin.issue.repairUpdate');
            });

            // PROCUREMENT
            Route::prefix('procurement')->group(function () {
                Route::get('', [ProcurementController::class, 'index'])->name('procurement');
                // EDIT (APPROVED)
                Route::get('confirm/{code}', [ProcurementController::class, 'confirm'])->name('procurement.confirm');
                Route::put('update/{id}', [ProcurementController::class, 'update'])->name('procurement.update');
                // REJECTED
                Route::put('rejected/{id}', [ProcurementController::class, 'rejected'])->name('procurement.rejected');
                // HAPUS
                Route::delete('deleted/{id}', [ProcurementController::class, 'rejected_details'])->name('procurement.delete');
                // TODO
                Route::get('to-do/{code}', [ProcurementController::class, 'to_do'])->name('procurement.to-do');
                //KIRIM TODO
                Route::put('to-do/send/{id}', [ProcurementController::class, 'send_todo'])->name('procurement.send-todo');
            });

        });


// AKSES DIVISI
Route::prefix('{division}')->middleware(['auth', 'checkDivision'])->group(function () {
    Route::get('',
        [DashboardDivision::class, 'index']
    )->name('dashboard.division');

    // ISSUE
    Route::prefix('issue')->group(function() {
        Route::get('', [DivisionIssueController::class, 'index'])->name('division.issue');
        // CREATE
        Route::get('create', [DivisionIssueController::class, 'create'])->name('division.issue.create');
        Route::post('store', [DivisionIssueController::class, 'store'])->name('division.issue.store');
        // EDIT
        Route::get('edit/{code_asset}', [DivisionIssueController::class, 'edit'])->name('division.issue.edit');
        Route::put('update/{id}', [DivisionIssueController::class, 'update'])->name('division.issue.update');
    });

    // YOUR ASSET
    Route::prefix('division-assets')->group(function () {
        Route::get('', [DivisionAssetController::class, 'index'])->name('division-asset');
    });

    // PENGADAAN
    Route::prefix('procurement')->group(function() {
        Route::get('', [DivisionProcurementController::class, 'index'])->name('division.procurement');
        // CREATE
        Route::get('create', [DivisionProcurementController::class, 'create'])->name('division.procurement.create');
        Route::post('store', [DivisionProcurementController::class, 'store'])->name('division.procurement.store');
        // VIEW DETAILS
        Route::get('details/{code}', [DivisionProcurementController::class, 'view_details'])->name('division.procurement.detail');
    });

    // PEMINJAMAN
    Route::prefix('borrowing')->group(function() {
        Route::get('', [BorrowingController::class, 'index'])->name('borrowing');
        // CREATE
        Route::get('create', [BorrowingController::class, 'create'])->name('borrowing.create');
        Route::post('store', [BorrowingController::class, 'store'])->name('borrowing.store');
        // UPDATE STATUS
        Route::put('update-status/{id}', [BorrowingController::class, 'updateStatus'])->name('borrowing.updateStatus');
    });

});

// QRCODE
Route::get('assets/{code_asset}', [QrCodeController::class, 'index'])->name('asset.qrcode');



