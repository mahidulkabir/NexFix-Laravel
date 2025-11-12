<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify the status_user enum to include 'pending'
        DB::statement("ALTER TABLE `bookings` MODIFY `status_user` ENUM('completed', 'cancelled', 'pending') NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum
        DB::statement("ALTER TABLE `bookings` MODIFY `status_user` ENUM('completed', 'cancelled') NULL");
    }
};
