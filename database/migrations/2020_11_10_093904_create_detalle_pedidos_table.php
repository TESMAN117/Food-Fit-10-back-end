<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('CLV_Pedido')->unsigned();
            $table->foreign('CLV_Pedido')->references('id')->on('pedidos');
            $table->integer('CLV_Platillo')->unsigned();
            $table->foreign('CLV_Platillo')->references('id')->on('platillos');
            $table->string('Vch_Nombre_P_d',500);
            $table->string('Vch_Presentacion_P_d',500);
            $table->integer('int_Cantidad_d');
            $table->float('flt_Precio_d');
            $table->date('date_Fecha_Pedido_d');
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
        Schema::dropIfExists('detalle_pedidos');
    }
}
