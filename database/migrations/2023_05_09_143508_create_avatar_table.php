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
        Schema::create('avatar', function (Blueprint $table) {
            $table->id();
            $table->string('image_avatar');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->on('users');
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
       Schema::table('likes', function (Blueprint $table){
            $table->dropForeign(['user_id']);
        });
    }
};