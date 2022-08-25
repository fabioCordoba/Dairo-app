<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\pagos as pg;
use Illuminate\Support\Facades\Auth;

class Pagos extends Component
{
    public $pagos, $domicilios, $swstore;

    public function abrirModal($id, $modal){

        $this->domicilios = pg::find($id)->domicilios;
        //dd($id, $modal, $this->domicilios);
        $this->swstore = 'Show';
        $this->dispatchBrowserEvent('openModal', ['modal' => $modal]);

    }

    public function closeModal($modal){
        $this->dispatchBrowserEvent('closeModal', ['modal' => $modal]);
        $this->resetInputs();
    }

    public function resetInputs(){
        $this->domicilios = null;
        $this->swstore = null;
    }

    public function render()
    {
        if(Auth::user()->roles->implode('name', ',') == 'DOMICILIARIO'){
            $this->pagos = pg::where('domiciliario_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        }else{
            $this->pagos = pg::orderBy('id', 'DESC')->get();
        }

        return view('livewire.pagos');
    }
}
