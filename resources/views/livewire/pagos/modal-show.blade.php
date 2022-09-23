<!-- Modal Show-->
<div wire:ignore.self  class="modal fade" id="modal-Show" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg font-sans h-screen w-full flex flex-row justify-center items-center"  style="margin-top: 20px;">
    @if ($domicilios)
    <div class="modal-content card  bg-white shadow-xl hover:shadow">
        <div class="modal-body">
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
                                    <div class="text-sm text-gray-900">{{$domicilio->domiciliario->name}}</div>
                                    
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900">{{ date('F j, Y, g:i a', strtotime($domicilio->created_at)); }}</div>
                                    <div class="text-sm text-gray-900">{{ date('F j, Y, g:i a', strtotime($domicilio->updated_at)); }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        {{$domicilio->estado}}
                                    </span>
                                    
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
        
        <div class="modal-header">
        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="closeModal('Show')" aria-label="Close">close</button>
        </div>
    </div>
                
                
    @else
        
    @endif
    </div>
</div>