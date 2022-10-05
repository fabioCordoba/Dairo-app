<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\pagos;
use GuzzleHttp\Client;
use App\Models\DeviceToken;
use Illuminate\Support\Facades\Auth;

class Bonificados extends Component
{

    private $client;
    
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://fcm.googleapis.com'
        ]);

    }

    public function pagarBonificados($id){
        $domiciliario = User::find($id);
        $pg = pagos::all();
        $bono = 0;
        if($domiciliario->domiciliosDomic->where('estado', 'Entregado')->count() > 0){

            if($pg->count() > 0){
                $codigo = ($pg->last()->id + 1);
            }else{
                $codigo = 1;
            }
            
            $codigo = sprintf("%05d", $codigo);

            $pago = pagos::create([
                'codigo' => 'PG'.$codigo,
                'cant' => $domiciliario->domiciliosDomic->where('estado', 'Entregado')->count(),
                'domiciliario_id' => $domiciliario->id,
                'admin_id' => Auth::user()->id
            ]);

            foreach ($domiciliario->domiciliosDomic->where('estado', 'Entregado') as $key => $value) {
                
                $value->update([
                    'estado' => 'Pagado',
                    'pago_id' => $pago->id
                ]);
                $bono = $bono + 500;
            }

            $pago->update([
                'valor' => $bono
            ]);
        }

        //notificacion

        $titulo = "Pago Bonificados - " . Auth::user()->name;
        $mensaje = Auth::user()->name . ' te genero el pago , CODIGO: ' . $pago->codigo . " x " . $pago->cant . " Domicilios";

        if($domiciliario->devicesToken()->count() !=  0){
            foreach ($domiciliario->devicesToken()->get() as $key => $value) {
                $device = $value->device_token;
                $this->notificacion($titulo, $mensaje, $device);
            }
        }
        //notificacion

        $this->dispatchBrowserEvent('msj',['msj' => 'Domiciliario Liquidado con exito.', 'tipo' => 'alert-success']);
        
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
    }

    public function render()
    {
        return view('livewire.bonificados',[
            'domiciliarios' => User::role('DOMICILIARIO')->get()
        ]);
    }
}
