<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->enum('type', ['with_options', 'yes_no', 'with_no_answers'])->default('with_options');
            $table->enum('type_of', ['main', 'other'])->default('select');
            $table->enum('appearance', ['select', 'buttons', 'check_box'])->default('select');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->bigInteger('start')->nullable();
            $table->bigInteger('end')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('unit')->nullable()->after('type');

            $table->enum('featured', ['yes', 'no'])->default('no');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('attributes')->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
}
