<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('whats_app')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('provider_id')->nullable();
            $table->longText('serial_num')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('phone_verified')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('otp_expiration')->nullable();

            $table->boolean('terms_agreed')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
