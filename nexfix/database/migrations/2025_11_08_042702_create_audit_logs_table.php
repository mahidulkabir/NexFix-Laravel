<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('action'); // e.g., "Created booking", "Updated service"
            $table->string('table_name'); // affected table
            $table->unsignedBigInteger('record_id'); // ID of affected record
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent(); // time of action
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
