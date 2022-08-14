<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Bonificados extends Component
{
    public function render()
    {
        return view('livewire.bonificados',[
            'domiciliarios' => User::role('DOMICILIARIO')->get()
        ]);
    }
}
