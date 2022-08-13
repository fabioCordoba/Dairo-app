<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Livewire\WithFileUploads;

class Productos extends Component
{
    use WithFileUploads;

    public $user, $product, $catego, $subCat, $nombre, $precio, $Descripcion, $foto, $stock, $swstore, $cantidadMin, $anticipacionDias;
    protected $listeners = ['say-delete' => 'delete'];
    
    public function abrirModal($id, $modal){

        if($modal == 'Edit'){
            $this->product = Products::find($id);
            $this->swstore = 'Edit';

            $this->catego = $this->product->subCategoryProduct->Category->id;
            $this->subCat = $this->product->subcategoria_id;
            $this->nombre = $this->product->nombre;
            $this->Descripcion = $this->product->Descripcion;
            $this->precio = $this->product->precio;
            $this->cantidadMin = $this->product->cantidadMin;
            $this->anticipacionDias = $this->product->anticipacionDias;
            $this->foto = $this->product->foto;
            $this->stock = $this->product->stock;
            
            $this->dispatchBrowserEvent('openModal', ['modal' => 'Create']);

        }else if($modal == 'Create'){
            
            $this->swstore = 'Create';
            $this->dispatchBrowserEvent('openModal', ['modal' => $modal]);
            
        }else if($modal == 'Show'){
            $this->product = Products::find($id);
            $this->swstore = 'Show';
            $this->dispatchBrowserEvent('openModal', ['modal' => $modal]);
            
        }

    }

    public function Store(){

        if($this->swstore == 'Edit'){
            $validatedData = $this->validate([
                'nombre' => 'required',
                'precio' => 'required',
                'Descripcion' => 'required',
                
            ]);
        }else{
            $validatedData = $this->validate([
                'nombre' => 'required|unique:products',
                'precio' => 'required',
                'Descripcion' => 'required',
                'foto' => 'required',
                'anticipacionDias' => 'required',
                'cantidadMin' => 'required',
                'stock' => 'required',

            ]);

        }


        if($this->swstore == 'Create'){

            $path = $this->foto->store('images/fotos', 'public_up');

            Products::create([
                'subcategoria_id' => $this->subCat,
                'nombre' => $this->nombre,
                'Descripcion' => $this->Descripcion,
                'cantidadMin' => $this->cantidadMin,
                'anticipacionDias' => $this->anticipacionDias,
                'precio' => $this->precio,
                'stock' =>$this->stock,
                'foto' => $path,
                'estado' => 'Activo'
            ]);

            $this->closeModal('Create');
            $this->dispatchBrowserEvent('success');

        }else if($this->swstore == 'Edit'){

            if($this->foto != $this->product->foto){
                $path = $this->foto->store('images/fotos', 'public_up');
            }else{
                $path = $this->foto;
            }

            Products::find($this->product->id)->update([
                'subcategoria_id' => $this->subCat,
                'nombre' => $this->nombre,
                'Descripcion' => $this->Descripcion,
                'precio' => $this->precio,
                'cantidadMin' => $this->cantidadMin,
                'anticipacionDias' => $this->anticipacionDias,
                'stock' =>$this->stock,
                'foto' => $path,
                'estado' => 'Activo'

            ]);

            $this->closeModal('Create');
            $this->dispatchBrowserEvent('success');

        }

    }

    public function closeModal($modal){
        $this->dispatchBrowserEvent('closeModal', ['modal' => $modal]);
        $this->resetInputs();
    }

    public function resetInputs(){
        $this->nombre = null;
        $this->precio = null;
        $this->Descripcion = null;
        $this->foto = null;
        $this->subCat = null;
        $this->catego = null;
        $this->cantidadMin = null;
        $this->anticipacionDias = null;
        $this->swstore = null;
        $this->stock = null;
    }

    public function delProduct($id){
        $this->dispatchBrowserEvent('eliminar', ['id' => $id]);
    }

    public function delete($id){

        Products::find($id)->update([
            'estado' => 'Eliminado'
        ]);

        $this->dispatchBrowserEvent('Delete');
    }

    public function render()
    {
        return view('livewire.productos',[
            'products' => Products::orderBy('id', 'DESC')->paginate(10),
            'categorias' => Categoria::all(),
            'subcategoria' => Subcategoria::all()
        ]);
    }
}
