<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pagos;

class RegistroVentas extends Component
{
    public function render()
    {
        return view('livewire.registro-ventas',[
            'ventas' => Pagos::orderBy('id', 'DESC')->paginate(10)
        ]);
    }
}
