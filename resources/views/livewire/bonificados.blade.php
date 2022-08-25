<div>
    <table class="w-full divide-y divide-gray-200">
        <thead>
          <tr>
              <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                  Domiciliario
              </th>
                <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                    # Domicilios
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                    Bonificacion Acumulada
                </th>
              <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                  Estado
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-200 text-gray-600 text-center text-xs font-medium  uppercase tracking-wider">
                {{--<button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="abrirModal({{Auth::user()->id}},'Create')" aria-label="Close">Abrir</button>  --}}
              </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @if($domiciliarios->count())
                @foreach($domiciliarios as $i => $domiciliario) 
                    <tr>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{$domiciliario->name}}</div>
                          
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                          <div class="text-sm text-gray-500">{{$domiciliario->domiciliosDomic->where('estado', 'Entregado')->count()}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-sm text-gray-500">$
                            @if ($domiciliario->domiciliosDomic->where('estado', 'Entregado')->count() > 0)
                            {{$total = $domiciliario->domiciliosDomic->where('estado', 'Entregado')->count() * 500}}
                            @else
                            {{$total = 0}}
                            @endif

                            </div>
                            
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            @if ($domiciliario->estado == 'Eliminado')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{$domiciliario->estado}}
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{$domiciliario->estado}}
                                </span>
                                
                            @endif
                        </td>
                        <td style="width: 170px;">
                          @if (Auth::user()->roles->implode('name', ',') == 'ROOT' && $domiciliario->domiciliosDomic->where('estado', 'Entregado')->count() > 0)
                          <div class="flex item-center justify-center">
                              
                              <button type="button" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="pagarBonificados({{$domiciliario->id}})" data-bs-toggle="tooltip" data-bs-placement="top" title="Pagar">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
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
                            No se encontraron domicilios
                        </div>
                    </td>
                </tr>
            @endif 
          
        </tbody>
        
      
    </table>
</div>
