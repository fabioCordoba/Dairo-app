<!-- Modal Show-->
<div wire:ignore.self  class="modal fade" id="modal-Show" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md font-sans h-screen w-full flex flex-row justify-center items-center"  style="margin-top: 20px;">
    @if ($product)
    <div class="modal-content card w-96 mx-auto bg-white shadow-xl hover:shadow">
        <img class="w-32 mx-auto rounded-full -mt-20 border-8 border-white" src="{{asset($product->foto)}}" alt="">
        
        <div class="text-center mt-2 text-3xl font-medium">{{$product->nombre}}</div>
        <div class="text-center mt-2 font-normal text-sm">{{$product->subCategoryProduct->Category->name}}/{{$product->subCategoryProduct->name}}</div>
        <div class="text-center mt-2 font-normal text-sm">{{$product->email}}</div>
        <div class="text-center font-normal text-lg">$ {{ $product->precio }} UND</div>
        <div class="text-center font-normal text-lg">{{ $product->estado }}</div>
        <div class="px-6 text-center mt-2 font-light text-sm">
        <p>
            {{$product->Descripcion}}
        </p>
        <div class="text-center mt-2 font-normal text-sm">Cant Min: {{$product->cantidadMin}} - Dias Antisipacion: {{$product->anticipacionDias}} - Cant Stock: {{$product->stock}} </div>
        </div>
        
        <div class="modal-header">
        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="closeModal('Show')" aria-label="Close">close</button>
        </div>
    </div>
                
                
    @else
        
    @endif
    </div>
</div>