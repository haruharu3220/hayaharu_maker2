<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweet_user', function (Blueprint $table) {
            $table->id();
            //今回はカラム名が命名規則に従っているため，constrained() の () 内は設定する必要がない．
            $table->foreignId('tweet_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            //同じtweet_idとuser_idの組み合わせが複数回登録されることを防止するための制約
            $table->unique(['tweet_id', 'user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweet_user');
    }
};
