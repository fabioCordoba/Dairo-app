 <!-- Modal verprod-->
 <div wire:ignore.self  class="modal fade" id="modal-verprod" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="margin-top: 20px;"> 
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <h5 class="text-gray-700 text-lg">Informacion detallada de Producto</h5>
                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="closeModal('verprod')" aria-label="Close">Close</button>
            </div>
            <div class="modal-body" style="padding: 10px;">
                <div x-data="{ cartOpen: false , isOpen: false }" class="bg-white">
                    <main class="my-1">
                        <div class="container mx-auto px-6">
                            @if ($productemp)
                                <div class="md:flex md:items-center">
                                    <div class="w-full h-64 md:w-1/2 lg:h-96">
                                        <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{asset($productemp->foto)}}" alt="{{$productemp->nombre}}">
                                    </div>
                                    <div class="w-full max-w-lg mx-auto mt-1 md:ml-8 md:mt-0 md:w-1/2">
                                        <h3 class="text-indigo-700 uppercase text-lg">{{$productemp->nombre}}</h3>
                                        <h4 class="text-gray-600  text-sm">{{$productemp->subCategoryProduct->Category->name}}/{{$productemp->subCategoryProduct->name}}</h4>
                                        <p class="text-gray-500  mx-1">
                                            {{$productemp->Descripcion}}
                                        </p>
                                        <span class="text-indigo-700 mt-3">${{$productemp->precio}} UND</span>
                                        <hr class="my-3">
                                        <div class="mt-2">
                                            <label class="text-gray-700 text-sm" for="count">Count:</label>
                                            <div class="flex items-center mt-1">
                                                <button class="text-gray-500 focus:outline-none focus:text-gray-600" wire:click="plusVerP({{$productemp->id}},'mas')">
                                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </button>
                                                <span class="text-gray-700 text-lg mx-2">{{$contVerP}}</span>
                                                <button class="text-gray-500 focus:outline-none focus:text-gray-600"  wire:click="plusVerP({{$productemp->id}},'menos')">
                                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="text-gray-700 text-sm" for="count">Producto disponible en:</label>
                                            <div class="flex items-center mt-1">
                                                <span class="text-indigo-500 text-sm mx-1">Monteria</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="text-gray-700 text-sm" for="count">Pedidos:</label>
                                            <div class="flex items-center mt-1">
                                                <span class="text-red-500 text-sm mx-1">Anticipacion de {{$productemp->anticipacionDias}} Dias</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center mt-6">
                                            <button class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500" wire:click="orderCar({{$productemp->id}},'OrderNow')">Order Now</button>
                                            <button class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none" wire:click="addCar({{$productemp->id}}, 'verprod')">
                                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </main>
                </div>
            </div>
        
        </div>
    </div>
</div>