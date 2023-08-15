<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            //$table->unsignedInteger('followed_id');
            //$table->unsignedInteger('following_id');
            $table->integer('following_id')->index();
            $table->integer('followed_id')->index();

            $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('followed_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique([
                'following_id',
                'followed_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
