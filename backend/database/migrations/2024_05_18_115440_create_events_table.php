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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('guild_event_no')->nullable();
            $table->foreignId('guild_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->date('event_date')->nullable();
            $table->time('event_time')->nullable();
            $table->integer('maximum_people')->nullable()->default(300)->comment('参加上限人数');
            $table->text('explanation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
