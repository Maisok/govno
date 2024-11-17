<?php

use App\Http\Controllers\catalogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ModelsCarsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarImportController;
use App\Http\Controllers\CarsExportController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\SalesExportController;





Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [catalogController::class, 'index'])->name('catalog');
Route::get('/cars/{model}', [CardController::class, 'show'])->name('cars.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

    Route::get('/account', [UserController::class, 'show'])->name('account');
    Route::get('/user/edit', [UserController::class, 'showEditForm'])->name('edit');    
    Route::post('/user/update', [UserController::class, 'update'])->name('update');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/cars', [CarsController::class, 'index'])->name('cars.index');
    Route::post('/cars', [CarsController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}/edit', [CarsController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarsController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarsController::class, 'destroy'])->name('cars.destroy');
    Route::delete('/cars/{car}/images/{image}', [CarsController::class, 'deleteImage'])->name('cars.deleteImage');

    Route::post('/cars/book', [BookingController::class, 'book'])->name('book');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/purchase', [BookingController::class, 'purchase'])->name('purchase');
    Route::post('/purchases/{purchase}/cancel', [BookingController::class, 'cancelPurchase'])->name('purchases.cancel');

    Route::post('/admin/cars/import', [CarImportController::class, 'import'])->name('cars.import');
    Route::view("/admin/cars/import", 'cars.import')->name('cars.import.form');
    Route::get('/admin/cars/export', [CarsExportController::class, 'export'])->name('cars.export');
    
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
    Route::post('/manager/update-availability/{id}', [ManagerController::class, 'updateAvailability'])->name('manager.updateAvailability');
    Route::post('/manager/mark-as-sold/{id}', [ManagerController::class, 'markAsSold'])->name('manager.markAsSold');

    Route::get('/sales/export', [SalesExportController::class, 'export'])->name('sales.export');
});