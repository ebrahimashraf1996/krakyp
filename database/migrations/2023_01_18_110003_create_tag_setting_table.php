<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('setting_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('setting_id')->references('id')->on('settings')->onDelete('CASCADE');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('CASCADE');
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
        Schema::dropIfExists('tag_setting');
    }
}
