<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Frontend\PageController;

Route::get('/', [PageController::class, 'homePage'])->name('home');
Route::get('/about', [PageController::class, 'aboutPage'])->name('about');
Route::get('/rentals', [PageController::class, 'rentalPage'])->name('rentals');
Route::get('/car_details/{id}', [PageController::class, 'carDetailsPage'])->name('car_details');
Route::get('/contact', [PageController::class, 'contactPage'])->name('contact');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/customer', [PageController::class, 'customerIndex'])->name('customer.index');
    Route::get('/customer/form', [PageController::class, 'customerForm'])->name('customer.form');
    Route::get('/rental', [PageController::class, 'rentalIndex'])->name('rental.index');
    Route::get('/rental/form', [PageController::class, 'rentalForm'])->name('rental.form');
    // Route::get('/car', [PageController::class, 'carIndex'])->name('car.index');
    // Route::get('/car/form', [PageController::class, 'carForm'])->name('car.form');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'verified'])->prefix('car')->group(function () {
    Route::get('/', [CarController::class, 'list'])->name('car.list');
    Route::get('/create', [CarController::class, 'create'])->name('car.create');
    Route::post('/store', [CarController::class, 'store'])->name('car.store');
    Route::get('/edit/{id}', [CarController::class, 'edit'])->name('car.edit');
    Route::get('/details/{id}', [CarController::class, 'details'])->name('car.details');
    Route::get('/delete/{id}', [CarController::class, 'delete'])->name('car.delete');
});




