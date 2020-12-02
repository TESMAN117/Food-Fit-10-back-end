<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Pedidos extends Component
{
    use WithPagination;

    /**
     * 
     * Variables para el controlador de CATEGORIAS
     * 
     */

    public $ID;
    public $vch_Estado;
    public $flt_Total;
    public $date_Fecha_P;
    public $date_Fecha_E;
    public $CLV_Platillo;



    public function render()
    {

        return view('livewire.pedidos',[
            'data'=>$this->leo()->paginate(3),           
        ]);
    }

    
    public function leo()
    {
        return
            DB::table('pedidos')
            ->join('usuarios', 'pedidos.CLV_Usuario', '=', 'usuarios.id')
            ->join('personas', 'usuarios.CLV_Persona', '=', 'personas.id')
            ->select(
                 'pedidos.id'
                ,'pedidos.vch_Num_Venta'
                ,'pedidos.flt_Total'
                ,'pedidos.vch_Estado'
                ,'pedidos.date_Fecha_Pedido'
                ,'pedidos.CLV_Usuario'
                ,'usuarios.vch_Nick'
                ,'usuarios.CLV_Persona'
                ,'personas.vch_Nombres'
                ,'personas.vch_A_Paterno'
                ,'personas.vch_A_Materno'
                ,'personas.vch_Direccion'
                ,'personas.vch_Telefono'
            );
    }

   
}
