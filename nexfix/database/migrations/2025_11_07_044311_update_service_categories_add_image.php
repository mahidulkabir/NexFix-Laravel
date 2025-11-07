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
         // Only add if the column doesn't already exist (safe for repeated runs)
        if (! Schema::hasColumn('service_categories', 'image')) {
            Schema::table('service_categories', function (Blueprint $table) {
                $table->string('image')->nullable()->after('description');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         if (Schema::hasColumn('service_categories', 'image')) {
            Schema::table('service_categories', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
};
