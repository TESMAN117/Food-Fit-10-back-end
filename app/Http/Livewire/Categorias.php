<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\platillo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Categorias extends Component
{
    use WithFileUploads;
    use WithPagination;

    /**
     * 
     * Variables para el controlador de CATEGORIAS
     * 
     */

    public $modalFormVisible = false;
    public $modal_ConfirmDeleteVisible = false;
    public $modalId = null;
    public $vch_cat;
    public $vch_des;
    public $vch_img;
    public $img_temp;
    public $iteration;
    public $Confirma = false;

    protected $rules = [
        'vch_cat' => 'required',
        'vch_des' => 'required',
        'vch_img' => 'required|image|mimes:jpeg,png,svg,jpg,gif|max:5120'

    ];

    /**                                            01
     * render
     * Funcion que visualiza la vista de categorias
     * @return void
     */
    public function render()
    {
        $datos['data'] = $this->read();
        return view('livewire.categorias', $datos);
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
        $this->iteration++;
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
        $this->iteration++;
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

        $data = Categoria::find($this->modalId);
        $this->img_temp = $data->vch_Imagen;
        $this->modal_ConfirmDeleteVisible = true;
    }

    /*   ++++++++++++++++++++++++++++++++++     VENTANAS MODALES FIN   ++++++++++++++++++++++++++++       */

    /*   ++++++++++++++++++++++++++++++++++     FUNCIONES DEL CRUD -- INICIO   ++++++++++++++++++++++++++++       */

    public function read()
    {
        return Categoria::paginate(4);
    }

    public function create()
    {
        $this->validate();
        if (Categoria::create($this->modelData())) {
            session()->flash('message_t', 'Registro Insertado');
        } else {
            session()->flash('message', 'Error al Insertar');
        }

        $this->modalFormVisible = false;
        $this->limpiar();
    }

    public function update()
    {
        $this->validate([
            'vch_cat' => 'required',
            'vch_des' => 'required',
        ]);

        if (Categoria::find($this->modalId)->update($this->modelData())) {
            if ($this->vch_img) {
                Storage::delete('categoria_upload/' . $this->img_temp);
            }
            session()->flash('message_t', 'Registro Actualizado');
        } else {
            session()->flash('message', 'Error al Actualizar');
        }
        $this->modalFormVisible = false;
        $this->Confirma = true;
    }

    public function delete()
    {
        if (Categoria::destroy($this->modalId)) {
            Storage::delete('categoria_upload/' . $this->img_temp);
            $this->modal_ConfirmDeleteVisible = false;
            $this->resetPage();
            session()->flash('message_t', 'Registro Eliminado');
        } else {
            if (platillo::find($this->modalId)) {
                session()->flash('message_pla', 'Hay un platillo utilizando esta categoria, no se puede eliminar :v');
            }
            session()->flash('message', 'Error al eliminar');
        }
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
        $data = Categoria::find($this->modalId);
        $this->vch_cat = $data->vch_Categoria;
        $this->vch_des = $data->vch_Descripcion;
        $this->img_temp = $data->vch_Imagen;
    }


    /**
     * modelData - Recupera los datos de los imputs del formulario
     *
     * @return void
     */
    public function modelData()
    {

        if ($this->vch_img) {
            $imagen = md5($this->vch_img . microtime()) . '.' . $this->vch_img->extension();
            $this->vch_img->storeAs('categoria_upload', $imagen);
            return [
                'vch_Categoria' => $this->vch_cat,
                'vch_Descripcion' => $this->vch_des,
                'vch_Imagen' => $imagen,
            ];
        } else {

            return [
                'vch_Categoria' => $this->vch_cat,
                'vch_Descripcion' => $this->vch_des,

            ];
        }
    }

    /**
     * limpiar los campos
     *
     * @return void
     */
    public function limpiar()
    {

        $this->modalId = null;
        $this->vch_cat = null;
        $this->vch_des = null;
        $this->vch_img = null;
        $this->img_temp = null;
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
