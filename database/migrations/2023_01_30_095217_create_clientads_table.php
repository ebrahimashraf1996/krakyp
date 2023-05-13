<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('slug_keyword');
            $table->longText('description');
            $table->string('price');
            $table->longText('cover')->nullable();
            $table->longText('images');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->boolean('is_published')->default(0);
            $table->boolean('is_canceled')->default(0);
            $table->longText('serial_num')->nullable();
            $table->unsignedBigInteger('reason_id')->nullable();

            $table->enum('status', ['free', 'paid'])->default('free');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('user_package_id')->nullable();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('user_package_id')->references('id')->on('bought_packages')->onDelete('SET NULL');
            $table->foreign('country_id')->references('id')->on('locations')->onDelete('SET NULL');
            $table->foreign('city_id')->references('id')->on('locations')->onDelete('SET NULL');
            $table->foreign('state_id')->references('id')->on('locations')->onDelete('SET NULL');
            $table->foreign('reason_id')->references('id')->on('reasons')->onDelete('SET NULL');
            $table->unsignedBigInteger('maincat_id')->nullable();
            $table->foreign('maincat_id')->references('id')->on('categories')->onDelete('CASCADE');

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
        Schema::dropIfExists('clientads');
    }
}
