<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vch_Num_Venta',4000);
            $table->float('flt_Total');
            $table->string('vch_Estado',250);
            $table->date('date_Fecha_Pedido');
            $table->unsignedInteger('CLV_Usuario');
            $table->foreign('CLV_Usuario')->references('id')->on('usuarios');
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
        Schema::dropIfExists('pedidos');
    }
}
