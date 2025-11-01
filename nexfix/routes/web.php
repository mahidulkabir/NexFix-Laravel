<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\PortalController;

Route::get('/', function () {
    return view('portal.index');
});

// Route::get('/', [ServiceCategoryController::class, 'showServiceCategory'])->name('portal.index');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [PortalController::class, 'index'])->name('portal.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:user'])->get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
Route::middleware(['auth', 'role:vendor'])->get('/vendor/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// route for admin dashboard 

// Routes for service category 


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('service-categories', ServiceCategoryController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('payments', PaymentController::class);

});





require __DIR__.'/auth.php';
