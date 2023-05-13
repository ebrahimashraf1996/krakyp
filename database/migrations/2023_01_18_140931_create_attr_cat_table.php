<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttrCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attr_cat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('attr_id');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->foreign('attr_id')->references('id')->on('attributes')->onDelete('CASCADE');
            $table->timestamps();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
            $table->string('type_of')->nullable();
            $table->enum('main_other', ['main','other'])->default('main');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attr_cat');
    }
}
