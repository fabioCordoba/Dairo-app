<div>
    @include('livewire.domicilio.modal-create')
    @include('livewire.domicilio.modal-show')

    <table class="w-full divide-y divide-gray-200">
        <thead>
          <tr >
              <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                  Codigo
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                  Admin
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                    Domiciliario
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                    Fecha
                </th>
              <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                  Estado
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider" style="width: 16%;">
                @role('ROOT|ADMINISTRADOR')
                @if ($swSiguiente == true)
                    
                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="storeAuto" aria-label="Close">Auto</button>  
                @endif
                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="abrirModal({{Auth::user()->id}},'Create')" aria-label="Close">Abrir</button>  
                <button type="button" class="mt-1 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="storeLibre" aria-label="Close">Abrir 2</button>  
                @endrole
              </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @if($domicilios->count())
                @foreach($domicilios as $i => $domicilio) 
                    <tr>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{$domicilio->codigo}}</div>
                          
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                          <div class="text-sm text-gray-900">{{$domicilio->admin->name}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if ($domicilio->domiciliario)
                                
                            <div class="text-sm text-gray-900">{{$domicilio->domiciliario->name}}</div>
                            @endif
                            
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-sm text-gray-900">{{ date('F j, Y, g:i a', strtotime($domicilio->created_at)); }}</div>
                            <div class="text-sm text-gray-900">{{ date('F j, Y, g:i a', strtotime($domicilio->updated_at)); }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            @if ($domicilio->estado == 'Eliminado')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{$domicilio->estado}}
                                </span>
                            @elseif ($domicilio->estado == 'Entregado')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{$domicilio->estado}}
                                </span>
                            @elseif ($domicilio->estado == 'En Camino')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-200 text-purple-600">
                                    {{$domicilio->estado}}
                                </span>
                            @elseif ($domicilio->estado == 'Rechazado')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-200 text-yellow-600">
                                    {{$domicilio->estado}}
                                </span>
                            @elseif ($domicilio->estado == 'Asignado')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-200 text-blue-600">
                                    {{$domicilio->estado}}
                                </span>
                            @elseif ($domicilio->estado == 'Libre')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-200 text-blue-600">
                                    {{$domicilio->estado}}
                                </span>
                            @elseif ($domicilio->estado == 'Pagado')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{$domicilio->estado}}
                                </span>
                            @endif
                        </td>
                        <td style="width: 170px;">
                          @if (Auth::user()->roles->implode('name', ',') == 'ADMINISTRADOR' && $domicilio->estado != 'Pagado' )
                          <div class="flex item-center justify-center">
                              <button type="button" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="abrirModal({{$domicilio->id}},'Show')" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                  </svg>
                              </button>
          
                              @if ($domicilio->estado == 'Rechazado' || $domicilio->estado == 'Entregado' )
                              
                              @else
                              <button type="button" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="abrirModal({{$domicilio->id}},'Edit')" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                  </svg>
                              </button>
          
                              <button type="button" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="deldomicilio({{$domicilio->id}})" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                  </svg>
                              </button>

                              @if ($domicilio->estado != 'Libre')
                                  
                              <button type="button" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="entregar({{$domicilio->id}})" data-bs-toggle="tooltip" data-bs-placement="top" title="Entregar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                              @endif
                                  
                              @endif
                          </div>
                          @elseif (Auth::user()->roles->implode('name', ',') == 'DOMICILIARIO' )

                          <div class="flex item-center justify-center">
                            
                            @if ($domicilio->estado == 'Rechazado' || $domicilio->estado == 'Entregado' || $domicilio->estado == 'Pagado')
                            
                            @else
                            <button type="button" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="abrirModal({{$domicilio->id}},'Edit')" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                                
                            @endif
                        </div>

                          @endif

                          
                          
                            
                        </td>
                      </tr>
                @endforeach
                 
            @else
                <tr>
                    <td colspan="6">
                        <div class="alert alert-warning">
                            No se encontraron domicilios
                        </div>
                    </td>
                </tr>
            @endif 
          
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5" class="bg-gray-200 text-gray-600 text-left text-xs font-medium  uppercase tracking-wider"> {{-- $domicilios->links() --}}</td>
          </tr>
        </tfoot>
      
    </table>
</div>
