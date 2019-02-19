<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienthistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clienthistory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('email');
            $table->string('pastcompany');
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
        Schema::dropIfExists('clienthistory');
    }
}
