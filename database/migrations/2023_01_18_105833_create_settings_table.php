<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->json('type')->nullable();
            $table->json('description')->nullable();
            $table->json('short_des')->nullable();
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->string('about_us_image')->nullable();
            $table->json('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('email')->nullable();
            $table->string('behance')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->longtext('rights')->nullable();
            $table->longtext('terms')->nullable();
            $table->longtext('map')->nullable();
            $table->longText('snap_chat')->nullable();
            $table->longText('youtube')->nullable();
            $table->longText('skype')->nullable();
            $table->longText('general_bg')->nullable();
            $table->longText('search_bg')->nullable();


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
        Schema::dropIfExists('settings');
    }
}
