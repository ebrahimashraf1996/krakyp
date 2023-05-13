<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatpackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_packages', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('cat_id');
            $table->string('duration')->nullable();
            $table->string('ads_count')->nullable();
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catpackages');
    }
}
