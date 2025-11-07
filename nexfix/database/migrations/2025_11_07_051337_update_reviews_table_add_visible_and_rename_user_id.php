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
            Schema::table('reviews', function (Blueprint $table) {
            

            // Add visible column if not exists
            if (!Schema::hasColumn('reviews', 'visible')) {
                $table->boolean('visible')->default(true)->after('comment');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'visible')) {
                $table->dropColumn('visible');
            }
        });
    }
};
