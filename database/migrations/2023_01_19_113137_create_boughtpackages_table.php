<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoughtpackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bought_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('user_id');
            $table->string('duration');
            $table->string('ads_count');
            $table->boolean('full_ads')->default(0);
            $table->string('price');
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boughtpackages');
    }
}
