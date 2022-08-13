<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Orden;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Pedidos extends Component
{
    public $pedidos, $users;

    public function __construct()
    {
        $this->users = User::all();
        if(Auth::user()->roles->implode('name', ',') == 'CLIENTE'){
            $this->pedidos = Orden::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        }else{
            $this->pedidos = Orden::orderBy('id', 'DESC')->get();
        }
    }

    public function render()
    {
        return view('livewire.pedidos');
    }
}
