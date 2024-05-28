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
        Schema::create('inquiry_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inquiry_id'); // お問い合わせID
            $table->text('reply_content'); // 返信内容
            $table->boolean('public_flag')->default(false); // 公開フラグ
            $table->timestamp('published_at')->nullable(); // 初回公開日時
            $table->timestamps(); // 作成日時と更新日時
            $table->softDeletes(); // 論理削除用のカラムを追加

            // 外部キー設定
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry_replies');
    }
};
