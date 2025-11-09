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
            // Add the new column and foreign key
            $table->foreignId('service_id')
                  ->after('vendor_service_id')
                  ->constrained('services')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the foreign key first, then the column
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');
        });
    }
};
