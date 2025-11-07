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
        Schema::table('users', function (Blueprint $table) {
    $table->string('phone')->nullable()->after('email');
    $table->text('address')->nullable()->after('role');
    $table->string('avatar')->nullable()->after('address');
    $table->dateTime('last_login_at')->nullable()->after('avatar');
    $table->enum('role', ['user', 'vendor', 'admin'])->default('user')->change();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
