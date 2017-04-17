<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('external_id');

            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('authors');

            $table->integer('meta_data_id')->unsigned();
            $table->foreign('meta_data_id')->references('id')->on('meta_data');

            $table->string('title');
            $table->string('slug');

            $table->text('excerpt');
            $table->text('content');

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
        Schema::dropIfExists('posts');
    }
}