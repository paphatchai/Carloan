<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaindatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maindatas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('code')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('name')->nullable();
            $table->string('tel')->nullable();
            $table->integer('type')->nullable();
            $table->string('description')->nullable();
            $table->string('generation')->nullable();
            $table->string('color')->nullable();
            $table->string('licenseplate')->nullable();
            $table->decimal('amount')->nullable();
            $table->double('percent')->nullable();
            $table->decimal('interest')->nullable();
            $table->string('image')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maindatas');
    }
}
