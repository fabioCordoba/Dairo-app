<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\pagos;

class Bonificados extends Component
{
    
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
                'codigo' => $codigo,
                'cant' => $domiciliario->domiciliosDomic->where('estado', 'Entregado')->count(),
                'domiciliario_id' => $domiciliario->id
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

        $this->dispatchBrowserEvent('msj',['msj' => 'Domiciliario Liquidado con exito.', 'tipo' => 'alert-success']);
        
    }

    public function render()
    {
        return view('livewire.bonificados',[
            'domiciliarios' => User::role('DOMICILIARIO')->get()
        ]);
    }
}
