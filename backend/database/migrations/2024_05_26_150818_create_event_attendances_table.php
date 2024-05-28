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
        Schema::create('event_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guild_id')->constrained()->onDelete('cascade');
            $table->integer('guild_event_no');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('guild_member_id')->constrained()->onDelete('cascade');
            $table->enum('status', [1, 2, 3, 4])->default(1)->comment('1:未定, 2:参加, 3:不参加, 4:検討中');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_attendances');
    }
};
