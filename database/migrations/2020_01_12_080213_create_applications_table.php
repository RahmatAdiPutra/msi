<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('alias')->unique()->nullable();
            $table->string('hostname')->unique();
            $table->string('ip')->unique();
            $table->string('port')->unique();
            $table->string('url')->unique();
            $table->string('logo')->nullable();
            $table->string('token')->nullable();
            $table->string('version')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
