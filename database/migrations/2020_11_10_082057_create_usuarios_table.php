<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vch_Nick',250);
            $table->string('vch_Password',250);
            $table->string('vch_Email')->unique();
            $table->unsignedInteger('CLV_Persona');
            $table->foreign('CLV_Persona')->references('id')->on('personas');
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
        Schema::dropIfExists('usuarios');
    }
}
