<div>
    <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Codigo pedido</th>
                                <th class="py-3 px-6 text-left">Cliente</th>
                                <th class="py-3 px-6 text-center">Productos</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @if ($pedidos->count() > 0)
                                @foreach ($pedidos as $pedido)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="mr-2">
                                                </div>
                                                <span class="font-medium">{{$pedido->codigo}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                <span>{{$users->find($pedido->user_id)->name}}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <span>{{$users->find($pedido->user_id)->email}}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <span>{{$users->find($pedido->user_id)->telefono}}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <span>{{$pedido->shippingCity}} - {{$pedido->shippingAddress}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center">
                                                <ul>
                                                    @foreach ($pedido->Products as $product)
                                                        <li>
                                                            <span>{{$product->Product->nombre}} x {{$product->cant}}</span>
                                                        </li> 
                                                    @endforeach
                                                    <li>
                                                        @php
                                                            $total = 0;
                                                        @endphp 

                                                        @foreach ($pedido->Products as $product)
                                                            @php
                                                                $total = $total + ($product->Product->precio * $product->cant);
                                                            @endphp 
                                                        @endforeach
                                                        TOTAL: ${{$total}}
                                                        
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            @if ($pedido->estado == 'En Proceso')
                                                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{$pedido->estado}}</span>
                                            @elseif ($pedido->estado == 'APPROVED')
                                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{$pedido->estado}}</span>
                                            @elseif ($pedido->estado == 'DECLINED')
                                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">{{$pedido->estado}}</span>
                                            @else
                                                <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">{{$pedido->estado}}</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                @if (Auth::user()->roles->implode('name', ',') == 'CLIENTE' && $pedido->estado == 'DECLINED')
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </div>
                                                    
                                                @endif
                                                
                                                @if (Auth::user()->roles->implode('name', ',') == 'CLIENTE' && $pedido->estado == 'En Proceso')
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <a href="{{url('/carrito/'.$pedido->id)}}">
                                                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                            </svg>
                                                        </a>
                                                    </div> 
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                                <td colspan="5" class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium">Aun no tienes Pedidos</span>
                                    </div>
                                </td>
                            </tr>

                            @endif

                        </tbody>
                    </table>
                </div>
</div>
