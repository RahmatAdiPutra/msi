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
            $table->bigIncrements('id');
            $table->string('identity_card')->unique()->nullable();
            $table->string('full_name');
            $table->string('user_name')->unique();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->date('birthday')->nullable();
            $table->string('religion')->nullable();
            $table->string('photo')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('token')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->boolean('online')->default(0);
            $table->boolean('status')->default(1);
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
