<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_ad_id');
            $table->unsignedBigInteger('attr_id');
            $table->string('answer_value');
            $table->string('answer_type');
            $table->foreign('attr_id')->references('id')->on('attributes')->onDelete('CASCADE');
            $table->foreign('client_ad_id')->references('id')->on('client_ads')->onDelete('CASCADE');
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
        Schema::dropIfExists('answers');
    }
}
