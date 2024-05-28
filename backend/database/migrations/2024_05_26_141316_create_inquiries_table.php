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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('related_inquiry_id')->nullable()->comment('関連するInquiryのID'); // 関連する問い合わせID
            $table->unsignedBigInteger('user_id'); // ユーザーID
            $table->string('subject'); // お問い合わせの件名
            $table->text('inquiry_content'); // お問い合わせの内容
            $table->boolean('public_flag')->default(false); // 公開フラグ
            $table->boolean('complet_flag')->default(false); // 完了フラグ
            $table->timestamp('published_at')->nullable(); // 公開日時
            $table->timestamp('completed_at')->nullable(); // 完了日時
            $table->timestamps(); // 作成日時と更新日時
            $table->softDeletes();

            // 外部キー設定
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
