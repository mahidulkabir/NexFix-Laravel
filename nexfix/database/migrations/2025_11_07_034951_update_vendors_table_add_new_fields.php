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
        Schema::table('vendors',function(Blueprint $table){
            //add new fields from update erd
            $table->text('bio')->nullable()->after('company_name');
            $table->float('rating')->default(0)->after('bio');
            $table->boolean('available')->default(true);
            $table->string('documents')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn(['bio', 'rating', 'experience_years', 'available', 'documents']);
        });
    }
};
