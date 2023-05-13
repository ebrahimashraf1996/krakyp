<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_number')->unique();
            $table->integer('quantity');
            $table->float('total_amount');
            $table->string('first_name');
            $table->string('last_name');
            $table->text('address1');
            $table->text('address2')->nullable();
            $table->string('state');
            $table->string('phone');
            $table->string('email');
            $table->enum('payment_method',['fawry','visa', 'vcash'])->default('vcash');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->enum('status',['new','cancel'])->default('new');
            $table->longText('notes')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('orders');
    }
}
