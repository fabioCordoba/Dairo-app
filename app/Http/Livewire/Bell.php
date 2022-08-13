<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\notification;
use Illuminate\Support\Collection;
use App\Events\NotifyEvent;

class Bell extends Component
{
    public $user, $notificacion;
    protected $listeners = ['refreshComponent' => 'render'];

    public function mount($user)
    {
        $this->user = $user;
    }

    public function readN($id){
        $this->notificacion = notification::find($id)->update([
            'estado' => 'read'
        ]);

        $this->emit('refreshComponent');
        // event(new BellEvent);
    }

    public function render()
    {
        if($this->user->roles->implode('name', ',') != 'GUEST'){
            $this->allnotificacion = Notification::where('user_id', null)->get();
        }else{
            $this->allnotificacion = collect([]);
        }

        return view('livewire.bell');
    }
}
