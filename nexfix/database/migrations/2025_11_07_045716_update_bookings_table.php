<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'booking_date')) {
                $table->dateTime('booking_date')->nullable()->after('vendor_service_id');
            }

            if (!Schema::hasColumn('bookings', 'scheduled_at')) {
                $table->dateTime('scheduled_at')->nullable()->after('booking_date');
            }

            if (!Schema::hasColumn('bookings', 'total_amount')) {
                $table->decimal('total_amount', 10, 2)->default(0)->after('address');
            }

            if (!Schema::hasColumn('bookings', 'payment_status')) {
                $table->enum('payment_status', ['unpaid', 'paid', 'refunded'])->default('unpaid')->after('status');
            }

            if (!Schema::hasColumn('bookings', 'notes')) {
                $table->text('notes')->nullable()->after('payment_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['booking_date', 'scheduled_at', 'total_amount', 'payment_status', 'notes']);
        });

    }
};
