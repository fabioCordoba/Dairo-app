<div>
    {{--<table class="w-full divide-y divide-gray-200">
        <thead>
          <tr>
              <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Foto
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Categoria/Subcategoria
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Informacion
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Precio
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Estado
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="abrirModal({{Auth::user()->id}},'Create')" aria-label="Close">Nuevo</button>  
              </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @if($products->count())
                @foreach($products as $i => $product) 
                    <tr>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                          <div class="d-flex justify-content-center">
                              <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="{{asset($product->foto)}}" alt="">
                              </div>
                            </div>
                          
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                          <div class="text-sm text-gray-500">{{$product->subCategoryProduct->Category->name}}/{{$product->subCategoryProduct->name}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-sm text-gray-500">{{$product->nombre}}</div>
                            <div class="text-sm text-gray-500">{{$product->Descripcion}}</div>
                            
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-sm text-gray-900">$ {{$product->precio}} x UND</div>
                          
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            @if ($product->estado == 'Eliminado')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{$product->estado}}
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{$product->estado}}
                                </span>
                                
                            @endif
                        </td>
                        <td style="width: 170px;">
                          @if (Auth::user()->roles->implode('name', ',') == 'ROOT')
                          <div class="flex item-center justify-center">
                              <button type="button" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="abrirModal({{$product->id}},'Show')" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                  </svg>
                              </button>
          
                              <button type="button" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="abrirModal({{$product->id}},'Edit')" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                  </svg>
                              </button>
          
                              <button type="button" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="delProduct({{$product->id}})" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                  </svg>
                              </button>
                          </div>
                          @endif
                            
                        </td>
                      </tr>
                @endforeach
                 
            @else
                <tr>
                    <td colspan="6">
                        <div class="alert alert-warning">
                            No se encontraron products
                        </div>
                    </td>
                </tr>
            @endif 
          
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5" class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> {{ $products->links() }}</td>
          </tr>
        </tfoot>
      
    </table>--}}
    @include('livewire.product.modal-verprod')

    <div x-data="{ cartOpen: false , isOpen: false }" class="bg-white">
        <header>
            <div class="row">
                <div class="col-md-11">
                    <div class="relative mt-6 max-w-lg mx-auto">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
        
                        <input wire:keydown.enter="search" wire:model="textBusqueda" class="w-full border rounded-md pl-10 pr-4 py-2 focus:border-blue-500 focus:outline-none focus:shadow-outline" type="text" placeholder="Search">
                    </div>

                </div>

                <div class="col-md-1">
                    <div class="relative mt-6 max-w-lg mx-auto justify-end w-full">
                        <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none mx-4 sm:mx-0" >
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </button>
    
                        <div class="flex sm:hidden">
                            <button @click="isOpen = !isOpen" type="button" class="text-gray-600 hover:text-gray-500 focus:outline-none focus:text-gray-500" aria-label="toggle menu">
                                <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                                    <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!--carrito-->

        <div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'" class="fixed right-0 top-0 max-w-xs w-full h-full px-6 py-4 transition duration-300 transform overflow-y-auto bg-white border-l-2 border-gray-300">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-medium text-gray-700">Your cart</h3>
                <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <hr class="my-3">

            @if ($carrito)
                @foreach ($carrito as $car)
                    
                    <div class="flex justify-between mt-6">
                        <div class="flex">
                            <img class="h-20 w-20 object-cover rounded" src="{{asset($car['foto'])}}" alt="">
                            <div class="mx-3">
                                <h3 class="text-sm text-gray-600">{{$car['nombre']}}</h3>
                                <div class="flex items-center mt-2">
                                    <button class="text-gray-500 focus:outline-none focus:text-gray-600" wire:click="plusCar({{$car['id']}},'mas')">
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                    <span class="text-gray-700 mx-2">{{$car['cant']}}</span>
                                    <button class="text-gray-500 focus:outline-none focus:text-gray-600" wire:click="plusCar({{$car['id']}},'menos')">
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <span class="text-gray-600">${{$car['precio']}}</span>
                    </div>
                    
                @endforeach
            @endif


            {{--<div class="flex justify-between mt-6">
                <div class="flex">
                    <img class="h-20 w-20 object-cover rounded" src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" alt="">
                    <div class="mx-3">
                        <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                        <div class="flex items-center mt-2">
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                            <span class="text-gray-700 mx-2">2</span>
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <span class="text-gray-600">20$</span>
            </div>
            <div class="flex justify-between mt-6">
                <div class="flex">
                    <img class="h-20 w-20 object-cover rounded" src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1189&q=80" alt="">
                    <div class="mx-3">
                        <h3 class="text-sm text-gray-600">Mac Book Pro</h3>
                        <div class="flex items-center mt-2">
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                            <span class="text-gray-700 mx-2">2</span>
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                <span class="text-gray-600">20$</span>
            </div>--}}

            @if ($carrito)

            <div class="mt-8">
                <form class="flex items-center justify-center">
                    @php
                        $total = 0;
                    @endphp 

                    @foreach ($carrito as $car)
                        @php
                            $total = $total + ($car['precio'] * $car['cant']);
                        @endphp 
                    @endforeach
                    
                    <input class="form-input w-48" disabled value="$ {{$total}}" type="text" placeholder="Add promocode">
                    <button class="ml-3 flex items-center px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded  focus:outline-none focus:bg-blue-500">
                        <span>Total</span>
                    </button>
                </form>
            </div>

            @if ($total > 30000)
                
            <a wire:click="orderCar(0,'OrdenCar')" type="button" class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                <span>Chechout</span>
                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>

            @else
            <span class="text-red-500 ">El total debe ser minimo o superior a $30000 pesos</span>

            @endif

            @else
                <a class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                    <span>Carrito Vacio</span>
                </a>
            @endif

        </div>

        <main class="my-8">
            
            <div class="container mx-auto px-6">
                <h3 class="text-gray-700 text-2xl font-medium">{{$textBusqueda}}</h3>
                <span class="mt-3 text-sm text-gray-500">{{$products->count()}} Productos</span>

                @if ($products->count() > 0)
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

                        @foreach ($products as $product)

                            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden" >
                                <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('{{asset($product->foto)}}')">
                                    <button class="p-2 rounded-full bg-blue-600 text-white mx-6 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500" wire:click="addCar({{$product->id}},'')">
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </button>
                                </div>
                                <div class="px-3 py-3">
                                    
                                    <h3 type="button" class="text-gray-700 uppercase" wire:click="verprod({{$product->id}},'verprod')" >{{$product->nombre}}</h3>
                                    <span class="text-gray-500 mt-2">${{$product->precio}}</span>
                                </div>
                            </div>
                            
                        @endforeach
                    </div>

                    <div class="flex justify-center">
                        @if ( $type == 'all' )
                            <div class="flex rounded-md mt-8">
                                {{ $products->links() }}
                            </div>
                        @endif
                    </div>
                    
                @else

                    <div class="alert alert-warning" role="alert">
                        Lo siento, Aun no hay productos Disponibles...
                    </div>
                    
                @endif

            </div>
        </main>

    </div>
</div>
