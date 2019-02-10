<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profilepic')->nullable();
            $table->string('resume')->nullable();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('position');
            $table->string('gender');
            $table->date('bday');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('city');
            $table->integer('contact');
            $table->string('client');
            $table->string('status');
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
        Schema::dropIfExists('profile');
    }
}
