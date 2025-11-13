<?php

use App\Http\Controllers\Admin\AdminReportController;
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
use App\Http\Controllers\VendorController as ControllersVendorController;
use App\Http\Controllers\VendorDashboardController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\User\UserBookingController as UserViewBooking;
use App\Http\Controllers\Vendor\VendorBookingController;
use App\Http\Controllers\AdminPayoutController;

Route::get('/', function () {
    return view('portal.index');
});
Route::get('/service-detail/{id}', [PortalController::class, 'serviceDetail'])->name('portal.serviceDetail');

Route::get('/checkout/{id}', [PortalController::class, 'checkoutRedirect'])->name('checkout.redirect');

Route::post('/checkoutOrder', [UserBookingController::class, 'store'])->name('checkout.store');

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

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/myBookings', [UserViewBooking::class, 'showBooking'])->name('user.myBooking');

    Route::post('/user/update-booking-status', [UserViewBooking::class, 'updateStatus'])->name('user.updateBookingStatus');
});

// Route::middleware(['auth', 'role:vendor'])->get('/vendor/dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');
Route::middleware(['auth', 'role:admin'])
    ->get('/admin/dashboard', [AdminController::class, 'index'])
    ->name('admin.dashboard');

Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');
    Route::get('/vendor/bookings', [VendorDashboardController::class, 'bookings'])->name('vendor.bookings');

    // 🆕 New routes
    Route::get('/vendor/collect-orders', [VendorBookingController::class, 'collectOrders'])->name('vendor.collect.orders');
    Route::post('/vendor/accept-order/{id}', [VendorBookingController::class, 'acceptOrder'])->name('vendor.accept.order');
    Route::get('/vendor/my-orders', [VendorBookingController::class, 'myOrders'])->name('vendor.my.orders');
    Route::post('/vendor/orders/{id}/update-status', [VendorBookingController::class, 'updateStatus'])->name('vendor.update.status');
});
// route for admin dashboard

// Routes for service category

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::resource('service-categories', ServiceCategoryController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('vendors', VendorController::class);
        Route::resource('bookings', BookingController::class);
        Route::resource('payments', PaymentController::class);
        Route::post('bookings/{id}/ajax-update', [BookingController::class, 'ajaxUpdate'])->name('bookings.ajaxUpdate');

        Route::get('/payouts', [AdminPayoutController::class, 'index'])->name('admin.payouts.index');
        Route::post('/payouts/{id}/paid', [AdminPayoutController::class, 'markAsPaid'])->name('admin.payouts.markPaid');
         Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');


    });

require __DIR__ . '/auth.php';
