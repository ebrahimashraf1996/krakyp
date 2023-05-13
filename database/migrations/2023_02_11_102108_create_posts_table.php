<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->json('title')->nullable();
            $table->string('slug')->unique();
            $table->json('article')->nullable();
            $table->json('summary')->nullable();
            $table->longtext('image')->nullable();
            $table->longtext('video')->nullable();
            $table->unsignedBigInteger('blogcategory_id');
            $table->enum('is_featured',['featured','Not'])->default('Not');
            $table->enum('status',['active','inactive'])->default('active');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
            $table->foreign('blogcategory_id')->references('id')->on('blogcategories')->onDelete('CASCADE');
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
