<?php

namespace App\Http\Livewire;

use Livewire\Component;

class App extends Component
{
    protected $listeners = ['echo:notify,NotifyEvent' => 'lanzador']; //notify -> chanell

    public function lanzador(){
        $this->emitTo('bell', 'refreshComponent'); //bell -> componente Bell
    }

    public function render()
    {
        return view('livewire.app');
    }

}
