<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Domicilio;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Events\TestEvent;
use App\Notifications\RealTimeNotification;
use App\Events\DomicilioLibreEvent;


class Domicilios extends Component
{
    use WithFileUploads;

    public $domicilio, $admin, $domiciliario, $swstore, $domicilios, $estado, $swSiguiente;
    protected $listeners = ['say-delete' => 'delete'];

    public function abrirModal($id, $modal){

        //dd($id, $modal);

        if($modal == 'Edit'){
            $this->domicilio = Domicilio::find($id);
            $this->swstore = 'Edit';

            $this->admin = $this->domicilio->admin->id;
            if($this->domicilio->domiciliario){

                $this->domiciliario = $this->domicilio->domiciliario->id;
            }
            
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
        $this->estado = null;
    }

    public function Store(){

        if($this->swstore == 'Edit'){
            /*$validatedData = $this->validate([
                'domiciliario' => 'required',
                
            ]);*/

            if($this->domiciliario == null){
                $this->domiciliario = Auth::user()->id;
            }else{
                $user = User::find($this->domiciliario);
            }

            //dd($this->domiciliario);
        }


        if($this->swstore == 'Create'){

            $ultimo = Domicilio::all();
        
            if($ultimo->count() > 0){
                $codigo = ($ultimo->last()->id + 1);
            }else{
                $codigo = 1;
            }
            
            $codigo = sprintf("%05d", $codigo);

            $user = User::find($this->domiciliario);

            $domi = Domicilio::create([
                'codigo' => 'DM'.$codigo,
                'admin_id' => Auth::user()->id,
                'domiciliario_id' => $user->id,
                'estado' => 'Asignado'
            ]);

            $user->notify(new RealTimeNotification('Se te asigno un nuevo Domicilio, cod: ' . $domi->codigo));

            $this->swSiguiente = true;

            $this->closeModal('Create');
            $this->dispatchBrowserEvent('success');

        }else if($this->swstore == 'Edit'){

            if($this->domiciliario != Auth::user()->id){

                if($this->estado != null){
                    $this->domicilio->update([
                        'domiciliario_id' => $user->id,
                        'estado' => $this->estado
                    ]);
    
                }else{
                    $this->domicilio->update([
                        'domiciliario_id' => $user->id,
                    ]);
                }

                $user->notify(new RealTimeNotification('Se te asigno un nuevo Domicilio, cod: ' . $this->domicilio->codigo));

            }else{

                if($this->estado != null){
                    $this->domicilio->update([
                        'domiciliario_id' => $this->domiciliario,
                        'estado' => $this->estado
                    ]);
    
                }else{
                    $this->domicilio->update([
                        'domiciliario_id' => $this->domiciliario,
                    ]);
                }

            }

            $this->swSiguiente = true;
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

        if($dm->last()->domiciliario_id == null){
            $this->swSiguiente = false;
        }else{
            if($dm->count() > 0){
                $next = User::role('DOMICILIARIO')
                    ->where('estado','Activo')
                    ->where('id', '>', $dm->last()->domiciliario_id)
                    ->orderBy('id', 'ASC')
                    ->first();
            }else{
                $next = User::role('DOMICILIARIO')
                    ->where('estado','Activo')
                    ->orderBy('id', 'ASC')
                    ->first();
            }
    
            if($dm->count() > 0){
                $codigo = ($dm->last()->id + 1);
            }else{
                $codigo = 1;
            }
            
            $codigo = sprintf("%05d", $codigo);
    
            
                
            if($next){
    
                $domi = Domicilio::create([
                    'codigo' => 'DM'.$codigo,
                    'admin_id' => Auth::user()->id,
                    'domiciliario_id' => $next->id,
                    'estado' => 'Asignado'
                ]);

                $next->notify(new RealTimeNotification('Se te asigno un nuevo Domicilio, cod: ' . $domi->codigo));
    
                $this->closeModal('Create');
                $this->dispatchBrowserEvent('msj',['msj' => 'Registro creado con exito.', 'tipo' => 'alert-success']);
                
    
            }else{
    
                $user = $dom->first();
                $domi = Domicilio::create([
                    'codigo' => 'DM'.$codigo,
                    'admin_id' => Auth::user()->id,
                    'domiciliario_id' => $user->id,
                    'estado' => 'Asignado'
                ]);

                $user->notify(new RealTimeNotification('Se te asigno un nuevo Domicilio, cod: ' . $domi->codigo));
    
                $this->closeModal('Create');
                $this->dispatchBrowserEvent('msj',['msj' => 'Registro creado con exito.', 'tipo' => 'alert-success']);
            }
        }
         
    }

    public function entregar($id){
        Domicilio::find($id)->update([
            'estado' => 'Entregado'
        ]);
        $this->dispatchBrowserEvent('msj',['msj' => 'Domicilio Marcado Como Entregado.', 'tipo' => 'alert-success']);
    }

    public function storeLibre(){
        
        $dom = User::role('DOMICILIARIO')->where('estado','Activo')->orderBy('id', 'ASC')->get();
        $dm = Domicilio::all();

        if($dm->count() > 0){
            $codigo = ($dm->last()->id + 1);
        }else{
            $codigo = 1;
        }
        
        $codigo = sprintf("%05d", $codigo);

        Domicilio::create([
            'codigo' => 'DM'.$codigo,
            'admin_id' => Auth::user()->id,
            'estado' => 'Libre'
        ]);

        

        $this->swSiguiente = false;
        $this->closeModal('Create');
        $this->dispatchBrowserEvent('msj',['msj' => 'Registro creado con exito.', 'tipo' => 'alert-success']);

        event(new TestEvent("se a abierto un nuevo Domicilio"));
        event(new DomicilioLibreEvent('se a abierto un nuevo Domicilio'));


    }

    public function render()
    {

        if(Auth::user()->roles->implode('name', ',') == 'DOMICILIARIO'){
            $this->domicilios = Domicilio::where('domiciliario_id',Auth::user()->id)
                ->orWhere('estado', 'Libre')
                ->orderBy('id', 'DESC')->get();
        }else{
            $this->domicilios = Domicilio::orderBy('id', 'DESC')->get();
        }

        return view('livewire.domicilios',[
            'domiciliarios' => User::role('DOMICILIARIO')->where('estado','Activo')->get()
        ]);
    }
}
