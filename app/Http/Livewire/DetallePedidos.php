<?php

namespace App\Http\Livewire;

use App\Models\detalle_pedido;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DetallePedidos extends Component
{

    public $ID_peido;

    public function render()
    {
        return view('livewire.detalle-pedidos',[
            'data' => $this->Listar(),
            'usuario' => $this->sacaUser(),
        ]);
    }

    public function mount($post)
    {
        $this->ID_peido = $post;
        
    }

    public function Listar()
    {
      return DB::table('detalle_pedidos')->where('CLV_Platillo', '=', $this->ID_peido)->get();
    }

    public function sacaUser()
    {
        return
            DB::table('personas')
            ->join('usuarios', 'usuarios.CLV_Persona', '=', 'personas.id')
            ->join('pedidos', 'pedidos.CLV_Usuario', '=', 'usuarios.id')
            ->where('pedidos.id', '=', $this->ID_peido)
            ->select(
                'personas.vch_Nombres',
                'personas.vch_A_Paterno',
                'personas.vch_A_Materno',
                'usuarios.vch_Nick'
            )->get();
    }

   
   
}
