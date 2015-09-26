<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
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
            $table->integer('image_id')->nullable()->unsigned();
            $table->integer('brand_id')->nullable()->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->text('body')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamp('publish_date');
            $table->timestamps();

            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
