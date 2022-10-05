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
use GuzzleHttp\Client;
use App\Models\DeviceToken;


class Domicilios extends Component
{
    use WithFileUploads;

    public $domicilio, $admin, $domiciliario, $swstore, $domicilios, $estado, $swSiguiente, $opcionBusqueda, $parametroBusqueda, $admins;
    private $client;
    protected $listeners = ['say-delete' => 'delete'];

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://fcm.googleapis.com'
        ]);

    }

    public function mount()
    {
        if(Auth::user()->roles->implode('name', ',') == 'DOMICILIARIO'){
            $this->domicilios = Domicilio::where('domiciliario_id',Auth::user()->id)
                ->orWhere('estado', 'Libre')
                ->orderBy('id', 'DESC')->get();
        }else{
            $this->domicilios = Domicilio::orderBy('id', 'DESC')->get();
        }

        $this->admins = User::role('ADMINISTRADOR')->where('estado','Activo')->get();
    }

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

            //$user->notify(new RealTimeNotification('Se te asigno un nuevo Domicilio, cod: ' . $domi->codigo));

            //notificacion

            $titulo = "Solicitud - " . Auth::user()->name;
            $mensaje = Auth::user()->name . ' te asigno un nuevo Domicilio, CODIGO: ' . $domi->codigo;

            if($user->devicesToken()->count() >  0){
                foreach ($user->devicesToken()->get() as $key => $value) {
                    $device = $value->device_token;
                    $this->notificacion($titulo, $mensaje, $device);
                }
            }
            //notificacion

            $this->swSiguiente = true;

            $this->mount();
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

                //$user->notify(new RealTimeNotification('Se te asigno un nuevo Domicilio, cod: ' . $this->domicilio->codigo));
                //notificacion

                $titulo = "Solicitud - " . Auth::user()->name;
                $mensaje = Auth::user()->name . ' te asigno este Domicilio, o realizo un cambio, CODIGO: ' . $this->domicilio->codigo;

                if($user->devicesToken()->count() >  0){
                    foreach ($user->devicesToken()->get() as $key => $value) {
                        $device = $value->device_token;
                        $this->notificacion($titulo, $mensaje, $device);
                    }
                }
                //notificacion

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
            $this->mount();
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

        $this->mount();
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

                //$next->notify(new RealTimeNotification('Se te asigno un nuevo Domicilio, cod: ' . $domi->codigo));
                 //notificacion

                 $titulo = "Solicitud - " . Auth::user()->name;
                 $mensaje = Auth::user()->name . ' te asigno un nuevo Domicilio, CODIGO: ' . $domi->codigo;
 
                 if($next->devicesToken()->count() >  0){
                     foreach ($next->devicesToken()->get() as $key => $value) {
                         $device = $value->device_token;
                         $this->notificacion($titulo, $mensaje, $device);
                     }
                 }
                 //notificacion
    
                $this->mount();
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

                //$user->notify(new RealTimeNotification('Se te asigno un nuevo Domicilio, cod: ' . $domi->codigo));

                //notificacion

                $titulo = "Solicitud - " . Auth::user()->name;
                $mensaje = Auth::user()->name . ' te asigno un nuevo Domicilio, CODIGO: ' . $domi->codigo;

                if($user->devicesToken()->count() >  0){
                    foreach ($user->devicesToken()->get() as $key => $value) {
                        $device = $value->device_token;
                        $this->notificacion($titulo, $mensaje, $device);
                    }
                }
                //notificacion
    
                $this->mount();
                $this->closeModal('Create');
                $this->dispatchBrowserEvent('msj',['msj' => 'Registro creado con exito.', 'tipo' => 'alert-success']);
            }
        }
         
    }

    public function entregar($id){
        Domicilio::find($id)->update([
            'estado' => 'Entregado'
        ]);
        $this->mount();
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

        $domicilio = Domicilio::create([
            'codigo' => 'DM'.$codigo,
            'admin_id' => Auth::user()->id,
            'estado' => 'Libre'
        ]);

        $this->swSiguiente = false;
        $this->closeModal('Create');
        
        //event(new TestEvent("se a abierto un nuevo Domicilio"));
        //event(new DomicilioLibreEvent('se a abierto un nuevo Domicilio'));

        //notificacion

        $dispositivos = DeviceToken::all();


        foreach ($dispositivos as $key => $value) {

            $titulo = "Solicitud - " . Auth::user()->name;
            $mensaje = Auth::user()->name . " Abrio un Domicilio, CODIGO: ". $domicilio->codigo;
            $device = $value->device_token;


            $this->notificacion($titulo, $mensaje, $device);
            
        }

        //fin notificacion

        $this->mount();
        $this->dispatchBrowserEvent('msj',['msj' => 'Registro creado con exito.', 'tipo' => 'alert-success']);

    }

    public function notificacion(String $titulo, String $mensaje, String $device){
        $requestUrl = "/fcm/send";
        $headers = [
            'Authorization' => env('AUTHORIZATION_KEY'),
            'Content-Type' => 'application/json'
          ];

        $body = [
            "to" => $device,
            "notification" => [
                "title" => $titulo,
                "body"  => $mensaje
            ],
        ];

        $response = $this->client->request('POST', $requestUrl, [
            'headers' => $headers, 
            'body' => json_encode($body)
            ]
        );

        $data = json_decode($response->getBody());

        //dd($data);
    }

    public function search(){
        try{
            if($this->opcionBusqueda == 'all'){
                $this->domicilios = Domicilio::orderBy('id', 'DESC')->get();

            }else{
                $validatedData = $this->validate([
                    'opcionBusqueda' => 'required',
                    'parametroBusqueda' => 'required',
                ]);

                if ($this->opcionBusqueda == 'admin') {
                    $this->domicilios = Domicilio::where('admin_id', 'LIKE', "%{$this->parametroBusqueda}%")->get();
                }else if($this->opcionBusqueda == 'domiciliario'){
                    $this->domicilios = Domicilio::where('domiciliario_id', 'LIKE', "%{$this->parametroBusqueda}%")->get();
                }else{

                    $this->domicilios = Domicilio::where($this->opcionBusqueda, 'LIKE', "%{$this->parametroBusqueda}%")->get();
                }
    
                
            }
            
            $this->dispatchBrowserEvent('msj',['msj' => 'Resultados de la busqueda!', 'tipo' => 'alert-success']);
            $this->parametroBusqueda = null;
            $this->opcionBusqueda = null;
            
        }catch(\Exception $exception){
            $this->dispatchBrowserEvent('msj',['msj' => 'Error, Asegurate de seleccionar una opcion y usar un parametro para la busqueda', 'tipo' => 'alert-danger']);
        }
    }

    public function render()
    {

        return view('livewire.domicilios',[
            'domiciliarios' => User::role('DOMICILIARIO')->where('estado','Activo')->get(),
        ]);
    }
}
