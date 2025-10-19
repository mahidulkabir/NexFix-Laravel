<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
  
public function run(): void

{
    $this->call(AdminUserSeeder::class);
    $this->call([
    UserSeeder::class,
    VendorSeeder::class,
    ServiceSeeder::class,
    BookingSeeder::class,
]);

    $category = \App\Models\ServiceCategory::create([
        'name' => 'Home Cleaning',
        'description' => 'All types of cleaning services.'
    ]);

    $service = \App\Models\Service::create([
        'service_category_id' => $category->id,
        'name' => 'Bathroom Cleaning',
        'base_price' => 500
    ]);

    $vendor = \App\Models\Vendor::create([
        'user_id' => 1,
        'company_name' => 'CleanCo',
        'phone' => '01700000000',
        'address' => 'Dhaka',
        'verified' => true
    ]);

    $vendorService = \App\Models\VendorService::create([
        'vendor_id' => $vendor->id,
        'service_id' => $service->id,
        'custom_price' => 600
    ]);

    $booking = \App\Models\Booking::create([
        'user_id' => 2,
        'vendor_service_id' => $vendorService->id,
        'date' => now(),
        'address' => 'Dhanmondi, Dhaka'
    ]);

    \App\Models\Payment::create([
        'booking_id' => $booking->id,
        'amount' => 600,
        'payment_method' => 'cash',
        'payment_status' => 'paid'
    ]);

    \App\Models\Review::create([
        'booking_id' => $booking->id,
        'user_id' => 2,
        'vendor_id' => $vendor->id,
        'rating' => 5,
        'comment' => 'Excellent service!'
    ]);
}


}
