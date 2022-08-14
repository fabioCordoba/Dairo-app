<!-- Modal Show-->
<div wire:ignore.self  class="modal fade" id="modal-Show" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md font-sans h-screen w-full flex flex-row justify-center items-center"  style="margin-top: 20px;">
    @if ($domicilio)
    <div class="modal-content card w-96 mx-auto bg-white shadow-xl hover:shadow">
        
        <div class="text-center mt-2 text-3xl font-medium">Codigo: {{$domicilio->codigo}}</div>
        <div class="text-center mt-2 font-normal text-sm">Sede: {{$domicilio->admin->name}}</div>
        <div class="text-center mt-2 font-normal text-sm">Asignado a: {{$domicilio->domiciliario->name}}</div>
        <div class="text-center font-normal text-lg">Estado: {{ $domicilio->estado }}</div>
        <div class="px-6 text-center mt-2 font-light text-sm">
        
            <div class="text-center mt-2 font-normal text-sm">Fecha creado: {{$domicilio->created_at}}</div>
            <div class="text-center mt-2 font-normal text-sm">Fecha Actualizado: {{$domicilio->updated_at}}</div>
        </div>
        
        <div class="modal-header">
        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="closeModal('Show')" aria-label="Close">close</button>
        </div>
    </div>
                
                
    @else
        
    @endif
    </div>
</div>