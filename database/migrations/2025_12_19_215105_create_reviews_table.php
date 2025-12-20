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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('review');
            $table->unsignedTinyInteger('rating');
            $table->timestamps();
            //$table->unsignedBigInteger('book_id');
            //$table->foreign('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('restrict');//第一种方法
            $table->foreignId('book_id')->constrained()->cascadeOnDelete()->restrictOnUpdate();//第二种方法 因为数据库表名为books，主键是id，默认外键名为book_id，所以这里可以直接用foreignId方法将会自动创建reviews表的外键约束与books表进行关联
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
