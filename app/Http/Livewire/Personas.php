<?php

namespace App\Http\Livewire;

use App\Models\persona;
use Livewire\Component;
use Livewire\WithPagination;

class Personas extends Component
{

    use WithPagination;
    /**
     * 
     * Variables para el controlador de CATEGORIAS
     * 
     */

    public $modalFormVisible = false;
    public $modal_ConfirmDeleteVisible = false;
    public $modalId;

    public $Nombres;
    public $A_Paterno;
    public $A_Materno;
    PUBLIC $Direccion;
    public $Telefono;

    public $Confirma = false;

    /**                                            01
     * render
     * Funcion que visualiza la vista de categorias
     * @return void
     */
    public function render()
    {
        $datos['data'] = $this->read();
        
        return view('livewire.personas', $datos);
    }

    /*   ++++++++++++++++++++++++++++++++++     VENTANAS MODALES INICIO   ++++++++++++++++++++++++++++       */

    /**                                             02
     * createShowModal
     * Funcion que abre el modal de INSERTAR
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->limpiar();
        $this->modalFormVisible = true;
    }

    /**                                             03
     * updateShowModal - Funcion para abrir el Modal de Actualizar   
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->limpiar();
        $this->modalId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }

    /**                                             04
     * deleteShowModal - Funcion para abrir el Modal de Eliminar   
     *
     * @param  mixed $id
     * @return void
     */

    public function deleteShowModal($id)
    {
        $this->modalId = $id;
        $data = persona::find($this->modalId);
        $this->modal_ConfirmDeleteVisible = true;
    }

    /*   ++++++++++++++++++++++++++++++++++     VENTANAS MODALES FIN   ++++++++++++++++++++++++++++       */

    /*   ++++++++++++++++++++++++++++++++++     FUNCIONES DEL CRUD -- INICIO   ++++++++++++++++++++++++++++       */

    public function read()
    {
        return persona::paginate(4);
    }

    public function create()
    {
        $this->validate();
        if(persona::create($this->modelData())){
            session()->flash('message_t', 'Registro Insertado');
        } else {
            session()->flash('message', 'Error al Insertar');
        }
        
        $this->modalFormVisible = false;
        $this->limpiar();
        $this->Confirma = true;
    }

    public function update()
    {
        $this->validate();
        if( persona::find($this->modalId)->update($this->modelData())){
            session()->flash('message_t', 'Registro Actualizado');
        } else {
            session()->flash('message', 'Error al Actualizar');
        }
       
        $this->modalFormVisible = false;
        $this->Confirma = true;
    }

    public function delete()
    {
        if(persona::destroy($this->modalId)){
            session()->flash('message_t', 'Registro Eliminado');
        } else {
            session()->flash('message', 'Error al Eliminar');
        }
            
            $this->modal_ConfirmDeleteVisible = false;
            $this->resetPage();
            $this->Confirma = true;
    }

    /*   ++++++++++++++++++++++++++++++++++     FUNCIONES DEL CRUD -- FIN   ++++++++++++++++++++++++++++       */


    /*   ++++++++++++++++++++++++++++++++++     OTRAS FUNCIONES -- INICIO   ++++++++++++++++++++++++++++       */
    
        
    /**
     * loadModel - Carga los datos en el formulario de actualizar de un registro
     * especifico
     *
     * @return void
     */
    public function loadModel()
    {
        $data = persona::find($this->modalId);
        $this->Nombres = $data->vch_Nombres;
        $this->A_Paterno =  $data->vch_A_Paterno;
        $this->A_Materno =  $data->vch_A_Materno;
        $this->Direccion =  $data->vch_Direccion;
        $this->Telefono =  $data->vch_Telefono;
        
    }


    /**
     * modelData - Recupera los datos de los imputs del formulario
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'vch_Nombres' => $this->Nombres,
            'vch_A_Paterno' => $this->A_Paterno,
            'vch_A_Materno' => $this->A_Materno,
            'vch_Direccion' => $this->Direccion,
            'vch_Telefono' => $this->Telefono,
        ];
    }

    /**
     * limpiar los campos
     *
     * @return void
     */
    public function limpiar()
    {
        $this->modalId = null;
        $this->Nombres = null;
        $this->A_Paterno = null;
        $this->A_Materno = null;
        $this->Direccion = null;
        $this->Telefono = null;
    }
    
    /**
     * rules - Reglas para el formulario
     *
     * @return void
     */
    public function rules()
    {
        return [

            'Nombres' => 'required',
            'A_Paterno' => 'required',
            'A_Materno' => 'required',
            'Direccion' => 'required',
            'Telefono' => 'required',
        ];
    }


    /** The livewire mount function
     * mount
     *
     * @return void
     */
    public function mount()
    {
        // Resets the pagination after reloading the page
        $this->resetPage();
    }

}
