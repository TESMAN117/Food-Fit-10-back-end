<?php

namespace App\Http\Livewire;

use App\Models\platillo;
use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class Platillos extends Component
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
    public $modalId;
    public $vch_Nombre;
    public $vch_Presentacion;
    public $flt_Precio;
    public $CLV_Categoria;
    public $vch_Imagen;
    public $img_temp;
    public $iteration;
    public $Confirma = false;

    public $CLV_Categoria_carga = 0;

    protected $rules = [
        'vch_Nombre' => 'required',
        'vch_Presentacion' => 'required',
        'flt_Precio' => 'required',
        'CLV_Categoria' => 'required',
        'vch_Imagen' => 'required|image|mimes:jpeg,png,svg,jpg,gif|max:1024',
    ];

    public function render()
    {
        if ($this->CLV_Categoria_carga == 0) {
            return view('livewire.platillos', [
                'data' => $this->leo()->paginate(10),
                'categoria' => Categoria::all(),
            ]);
        }else{
            return view('livewire.platillos', [
                'data' => $this->carga_categoria()->paginate(10),
                'categoria' => Categoria::all(),
            ]);
        }

    }


    public function leo()
    {
        return
            DB::table('platillos')
            ->join('categorias', 'categorias.id', '=', 'platillos.CLV_Categoria')
            ->select(
                'platillos.id',
                'platillos.vch_Nombre',
                'platillos.vch_Presentacion',
                'platillos.flt_Precio',
                'categorias.vch_Categoria',
                'platillos.vch_Imagen'
            );
    }

    public function createShowModal()
    {
        $this->resetValidation();
        $this->limpiar();
        $this->modalFormVisible = true;
        $this->iteration++;
    }

    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->limpiar();
        $this->modalId = $id;
        $this->modalFormVisible = true;
        $this->iteration++;
        $this->loadModel();
    }

    public function deleteShowModal($id)
    {
        $this->modalId = $id;

        $data = platillo::find($this->modalId);
        $this->img_temp = $data->vch_Imagen;
        $this->modal_ConfirmDeleteVisible = true;
    }

    public function read()
    {
        return platillo::paginate(1);
    }

    public function create()
    {
        $this->validate();

        if (platillo::create($this->modelData())) {
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
        $this->validate([
            'vch_Nombre' => 'required',
            'vch_Presentacion' => 'required',
            'flt_Precio' => 'required',
            'CLV_Categoria' => 'required',

        ]);


        if (platillo::find($this->modalId)->update($this->modelData())) {
            if ($this->vch_img) {
                Storage::delete('platillo_upload/' . $this->img_temp);
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

        if (platillo::destroy($this->modalId)) {
            Storage::delete('platillo_upload/' . $this->img_temp);
            $this->modal_ConfirmDeleteVisible = false;
            $this->resetPage();
            session()->flash('message_t', 'Registro Eliminado');
        } else {

            session()->flash('message', 'Error al eliminar');
        }
        $this->Confirma = true;
    }

    public function loadModel()
    {
        $data = platillo::find($this->modalId);
        $this->vch_Nombre = $data->vch_Nombre;
        $this->vch_Presentacion = $data->vch_Presentacion;
        $this->flt_Precio = $data->flt_Precio;
        $this->CLV_Categoria = $data->CLV_Categoria;
        $this->img_temp = $data->vch_Imagen;
    }

    public function modelData()
    {
        if ($this->vch_Imagen) {
            $imagen = md5($this->vch_Imagen . microtime()) . '.' . $this->vch_Imagen->extension();
            $this->vch_Imagen->storeAs('platillo_upload', $imagen);
            return [
                'vch_Nombre' => $this->vch_Nombre,
                'vch_Presentacion' => $this->vch_Presentacion,
                'flt_Precio' => $this->flt_Precio,
                'CLV_Categoria' => $this->CLV_Categoria,
                'vch_Imagen' => $imagen,
            ];
        } else {

            return [
                'vch_Nombre' => $this->vch_Nombre,
                'vch_Presentacion' => $this->vch_Presentacion,
                'flt_Precio' => $this->flt_Precio,
                'CLV_Categoria' => $this->CLV_Categoria,

            ];
        }
    }

    public function limpiar()
    {
        $this->modalId = null;
        $this->vch_Nombre = null;
        $this->vch_Presentacion = null;
        $this->flt_Precio = null;
        $this->CLV_Categoria = null;
        $this->vch_Imagen = null;
        $this->img_temp = null;
        $this->iteration = null;
    }


    public function mount()
    {
        // Resets the pagination after reloading the page
        $this->resetPage();
    }

    public function carga_categoria()
    {

        return
            DB::table('platillos')
            ->join('categorias', 'categorias.id', '=', 'platillos.CLV_Categoria')
            ->where('platillos.CLV_Categoria', '=', $this->CLV_Categoria_carga)
            ->select(
                'platillos.id',
                'platillos.vch_Nombre',
                'platillos.vch_Presentacion',
                'platillos.flt_Precio',
                'categorias.vch_Categoria',
                'platillos.vch_Imagen'
            );
    }
}
