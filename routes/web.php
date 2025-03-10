<?php

use App\Models\User;
use App\Models\Rental;
use App\Mail\RentalConfirmMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Admin\CustomerController;

Route::get('/', [PageController::class, 'homePage'])->name('home');
Route::get('/about', [PageController::class, 'aboutPage'])->name('about');
Route::get('/rentals', [PageController::class, 'rentalPage'])->name('rentals');
Route::get('/car_details/{id}', [PageController::class, 'carDetailsPage'])->name('car_details');
Route::get('/contact', [PageController::class, 'contactPage'])->name('contact');


Route::middleware(['auth', 'verified', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [PageController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::prefix('car')->group(function () {
        Route::get('/', [CarController::class, 'list'])->name('admin.car.list');
        Route::get('/create', [CarController::class, 'create'])->name('admin.car.create');
        Route::post('/store', [CarController::class, 'store'])->name('admin.car.store');
        Route::get('/edit/{id}', [CarController::class, 'edit'])->name('admin.car.edit');
        Route::get('/details/{id}', [CarController::class, 'details'])->name('admin.car.details');
        Route::delete('/delete/{id}', [CarController::class, 'delete'])->name('admin.car.delete');
    });
    

    
    Route::prefix('customer')->group(function () {
        Route::get('/', [CustomerController::class, 'list'])->name('admin.customer.list');
        Route::get('/create', [CustomerController::class, 'create'])->name('admin.customer.create');
        Route::post('/store', [CustomerController::class, 'store'])->name('admin.customer.store');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
        Route::get('/details/{id}', [CustomerController::class, 'details'])->name('admin.customer.details');
        Route::delete('/delete/{id}', [CustomerController::class, 'delete'])->name('admin.customer.delete');
    });


});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('rental')->group(function () {
        Route::get('/', [RentalController::class, 'list'])->name('rental.list');
        Route::get('/create', [RentalController::class, 'create'])->name('rental.create');
        Route::post('/store', [RentalController::class, 'store'])->name('rental.store');
        Route::get('/edit/{id}', [RentalController::class, 'edit'])->name('rental.edit');
        Route::get('/details/{id}', [RentalController::class, 'details'])->name('rental.details');
        Route::delete('/delete/{id}', [RentalController::class, 'delete'])->name('rental.delete');
    });
});

Route::middleware(['auth', 'verified', 'isCustomer'])->prefix('customer')->group(function () {
    Route::get('dashboard', [PageController::class, 'customerDashboard'])->name('customer.dashboard');
    
    Route::prefix('rental')->group(function () {
        Route::get('/', [RentalController::class, 'customerRentallist'])->name('customer.rental.list');
        Route::get('/history', [RentalController::class, 'customerRentalHistorylist'])->name('customer.rental_history.list');
        Route::delete('/delete/{id}', [RentalController::class, 'customerRentalDelete'])->name('customer.rental.delete');
    });

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/test-email', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('mainuromayer@gmail.com')->subject('Test Email');
    });

    return 'Email sent!';
});







