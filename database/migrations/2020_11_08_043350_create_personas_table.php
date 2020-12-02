<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
           
            $table->increments('id');
            $table->string('vch_Nombres',500);
            $table->string('vch_A_Paterno',500);
            $table->string('vch_A_Materno',500);
            $table->string('vch_Direccion',1000);
            $table->string('vch_Telefono',13);
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
        Schema::dropIfExists('personas');
    }
}
