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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_gateway')->nullable()->after('method');
            $table->enum('status', ['success', 'failed', 'pending'])->default('pending')->change();
            $table->string('transaction_id')->nullable()->after('payment_gateway');
            $table->timestamp('created_at')->useCurrent()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['payment_gateway', 'transaction_id']);
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending')->change();
        });
    }
};
