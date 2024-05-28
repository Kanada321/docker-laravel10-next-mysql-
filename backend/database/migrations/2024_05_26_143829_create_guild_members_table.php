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
        Schema::create('guild_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guild_id'); // ギルドID
            $table->string('guild_member'); // ギルド内メンバー番号
            $table->string('name'); // メンバーの名前
            $table->integer('lv'); // キャラクターのレベル
            $table->string('job'); // キャラクターの職業
            $table->timestamps(); // 作成日時と更新日時
            $table->softDeletes(); // 論理削除用のカラムを追加

            // 外部キー設定
            $table->foreign('guild_id')->references('id')->on('guilds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guild_members');
    }
};
