<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vendor_payouts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade');

            $table->decimal('total_amount', 10, 2);
            $table->decimal('commission_amount', 10, 2);
            $table->decimal('vendor_earning', 10, 2);

            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_payouts');
    }
};
