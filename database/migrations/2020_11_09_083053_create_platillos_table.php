<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatillosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platillos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vch_Nombre',300);
            $table->string('vch_Presentacion',1000);
            $table->float('flt_Precio');
            $table->unsignedInteger('CLV_Categoria');
            $table->foreign('CLV_Categoria')->references('id')->on('categorias');
            $table->string('vch_Imagen',2000);
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
        Schema::dropIfExists('platillos');
    }
}
