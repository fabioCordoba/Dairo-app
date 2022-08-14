<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Domicilio;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;


class Domicilios extends Component
{
    use WithFileUploads;

    public $domicilio, $admin, $domiciliario, $swstore;
    protected $listeners = ['say-delete' => 'delete'];

    public function abrirModal($id, $modal){

        //dd($id, $modal);

        if($modal == 'Edit'){
            $this->domicilio = Domicilio::find($id);
            $this->swstore = 'Edit';

            $this->admin = $this->domicilio->admin->id;
            $this->domiciliario = $this->domicilio->domiciliario->id;
            
            $this->dispatchBrowserEvent('openModal', ['modal' => 'Create']);

        }else if($modal == 'Create'){
            
            $this->swstore = 'Create';
            $this->dispatchBrowserEvent('openModal', ['modal' => $modal]);
            
        }else if($modal == 'Show'){
            $this->domicilio = Domicilio::find($id);
            $this->swstore = 'Show';
            $this->dispatchBrowserEvent('openModal', ['modal' => $modal]);
            
        }

    }

    public function closeModal($modal){
        $this->dispatchBrowserEvent('closeModal', ['modal' => $modal]);
        $this->resetInputs();
    }

    public function resetInputs(){
        $this->domicilio = null;
        $this->admin = null;
        $this->domiciliario = null;
        $this->swstore = null;
    }

    public function Store(){

        if($this->swstore == 'Edit'){
            $validatedData = $this->validate([
                'domiciliario' => 'required',
                
            ]);
        }


        if($this->swstore == 'Create'){

            $ultimo = Domicilio::all();
        
            if($ultimo->count() > 0){
                $codigo = ($ultimo->last()->id + 1);
            }else{
                $codigo = 1;
            }
            
            $codigo = sprintf("%05d", $codigo);

            Domicilio::create([
                'codigo' => 'DM'.$codigo,
                'admin_id' => Auth::user()->id,
                'domiciliario_id' => $this->domiciliario,
                'estado' => 'Asignado'
            ]);

            $this->closeModal('Create');
            $this->dispatchBrowserEvent('success');

        }else if($this->swstore == 'Edit'){

            Domicilio::find($this->domicilio->id)->update([
                'domiciliario_id' => $this->domiciliario,
            ]);

            $this->closeModal('Create');
            $this->dispatchBrowserEvent('msj',['msj' => 'Registro Actualizado con exito.', 'tipo' => 'alert-success']);

        }

    }

    public function deldomicilio($id){
        $this->dispatchBrowserEvent('eliminar', ['id' => $id]);
    }

    public function delete($id){

        Domicilio::find($id)->update([
            'estado' => 'Eliminado'
        ]);

        $this->dispatchBrowserEvent('Delete');
    }

    public function storeAuto(){

        $dom = User::role('DOMICILIARIO')->where('estado','Activo')->orderBy('id', 'ASC')->get();
        $dm = Domicilio::all();

        $next = User::role('DOMICILIARIO')
            ->where('estado','Activo')
            ->where('id', '>', $dm->last()->domiciliario_id)
            ->orderBy('id', 'ASC')
            ->first();

        if($dm->count() > 0){
            $codigo = ($dm->last()->id + 1);
        }else{
            $codigo = 1;
        }
        
        $codigo = sprintf("%05d", $codigo);
            
        if($next){

            Domicilio::create([
                'codigo' => 'DM'.$codigo,
                'admin_id' => Auth::user()->id,
                'domiciliario_id' => $next->id,
                'estado' => 'Asignado'
            ]);

            $this->closeModal('Create');
            $this->dispatchBrowserEvent('msj',['msj' => 'Registro creado con exito.', 'tipo' => 'alert-success']);
            

        }else{

            Domicilio::create([
                'codigo' => 'DM'.$codigo,
                'admin_id' => Auth::user()->id,
                'domiciliario_id' => $dom->first()->id,
                'estado' => 'Asignado'
            ]);

            $this->closeModal('Create');
            $this->dispatchBrowserEvent('msj',['msj' => 'Registro creado con exito.', 'tipo' => 'alert-success']);
        }


    
        
        
    }

    public function render()
    {
        return view('livewire.domicilios',[
            'domicilios' => Domicilio::orderBy('id', 'DESC')->paginate(10),
            'domiciliarios' => User::role('DOMICILIARIO')->where('estado','Activo')->get()
        ]);
    }
}
