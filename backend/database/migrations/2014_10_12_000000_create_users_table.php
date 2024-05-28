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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_identification')->unique();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->index();
            $table->timestamp('email_verified_at')->nullable()->index();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable()->index();
            $table->foreignId('role_id')->constrained('roles');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
