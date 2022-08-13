<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use App\Models\Subcategoria;

class Carrito extends Component
{
    public $shipping, $orden, $subtotal, $envio, $metodoEnvio, $total, $description, $referenceCode, $signature, $merchantId, $accountId, $responseUrl, $shippingAddress, $shippingCity, $limit, $btnDom, $btnShop;
    
    public function closeModal($modal){
        $this->dispatchBrowserEvent('closeModal', ['modal' => $modal]);
    }
    
    public function addDir($modal)
    {
        $this->dispatchBrowserEvent('openModal', ['modal' => $modal]);
    }

    public function pusDir()
    {
        $validatedData = $this->validate([
            'metodoEnvio' => 'required',
        ]);

        if($this->metodoEnvio == 0){

            $this->envio = $this->metodoEnvio;
            $this->orden->update([
                'metodoEnvio' => $this->metodoEnvio
            ]);
            
        }else{
            
            $validatedData = $this->validate([
                'shippingAddress' => 'required',
            ]);
            
            $this->orden->update([
                'shippingCity' => $this->shippingCity,
                'shippingAddress' => $this->shippingAddress,
                'metodoEnvio' => $this->metodoEnvio
            ]);
        }

        $this->metodoEnvio == null;

        $this->pay();
        $this->dispatchBrowserEvent('closeModal', ['modal' => 'direccion']);
    }

    public function pay(){
        $this->merchantId = 508029;
        $this->accountId = 512321;
        $this->subtotal = 0;
        $this->description = '';
        $this->referenceCode = $this->orden->codigo;
        $this->shippingCity = 'Monteria';
        $this->limit = 30000;

        foreach ($this->orden->Products as $product) {
            if($this->description == ''){
                $this->description = $product->Product->nombre.' X '.$product->cant;
            }else{

                $this->description = $this->description.', '.$product->Product->nombre.' X '.$product->cant;
            }
            $this->subtotal = $this->subtotal + ($product->Product->precio * $product->cant);
        }

        if($this->orden->metodoEnvio != 0){
            $this->description = $this->description.', + Domicilio';
        }

        $this->total = $this->orden->metodoEnvio + $this->subtotal;

        $this->signature = hash('md5', '4Vj8eK4rloUd272L48hsrarnUA~'.$this->merchantId.'~'.$this->referenceCode.'~'.$this->total.'~COP');

    }

    public function render()
    {
        $this->shipping = false;
        $this->pay();
        //dd($this->metodoEnvio);
        
        return view('livewire.carrito');
    }
}
