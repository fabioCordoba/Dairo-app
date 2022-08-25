<div>
    @include('livewire.pagos.modal-show')

    <table class="w-full divide-y divide-gray-200">
        <thead>
          <tr>
              <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                codigo
              </th>
                <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                    # cant
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                    valor Bonificacion 
                </th>
              <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                  Domiciliario
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                Fecha
            </th>
              <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                {{--<button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="abrirModal({{Auth::user()->id}},'Create')" aria-label="Close">Abrir</button>  --}}
              </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @if($pagos->count())
                @foreach($pagos as $i => $pago) 
                    <tr>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{$pago->codigo}}</div>
                          
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                          <div class="text-sm text-gray-500">{{$pago->cant}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-sm text-gray-500">$
                                {{$pago->valor}}
                            </div>
                            
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{$pago->domiciliario->name}}
                            
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-sm text-gray-900">{{$pago->created_at}}</div>
                            <div class="text-sm text-gray-900">{{$pago->updated_at}}</div>
                        </td>
                        <td style="width: 170px;">
                            <div class="flex item-center justify-center">
                                
                                <button type="button" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="abrirModal({{$pago->id}},'Show')" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Domicilios">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
  
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
        
      
    </table>
</div>
