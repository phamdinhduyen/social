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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table){
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('posts');
    }
};
