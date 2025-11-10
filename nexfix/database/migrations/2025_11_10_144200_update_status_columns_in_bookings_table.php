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
            // Drop old status column
            $table->dropColumn('status');

            // Add new nullable status columns (no default values)
            $table->enum('status_user', ['completed', 'cancelled'])->nullable()->after('payment_method');
            $table->enum('status_vendor', ['accepted', 'completed', 'cancelled'])->nullable()->after('status_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Restore old status column
            $table->enum('status', ['pending', 'accepted', 'completed', 'cancelled'])->default('pending');

            // Drop new ones
            $table->dropColumn(['status_user', 'status_vendor']);
        });
    }
};
