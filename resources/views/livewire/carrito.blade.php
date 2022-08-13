<div>
    @include('livewire.carrito.modal-direccion')

    @if ($orden->Products->count() > 1)
        {{--<div class="container mx-auto px-6">
            <div class="md:flex md:items-center">
                <div class="w-full max-w-lg mx-auto mt-2 md:ml-8 md:mt-0 md:w-1/2">
                    <div class="mt-2">
                        <div class="bg-white shadow-md rounded my-6">
                            <table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                <thead>
                                    <tr>
                                        <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Producto</th>
                                        <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Cantidad</th>
                                        <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orden->Products as $product)
                                        <tr>
                                            <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word" >
                                                <div class="d-flex justify-content-left">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                      <img class="h-10 w-10 rounded-full" src="{{asset($product->Product->foto)}}" alt="">
                                                    </div>
                                                    <div class="px-2 py-2 ">
                                                        {{$product->Product->nombre}}
                                                      </div>
                                                </div>
                                            </td>
                                            <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                {{$product->cant}}
                                            </td>
                                            <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                <span><span>$</span>{{$product->Product->precio * $product->cant}}</span>
                                            </td>	
                                        </tr>
            
                                    @endforeach
                                </tbody>
                                
                                <tfoot>
                                    <tr>
                                        <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px">Subtotal:</th>
                                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px"><span><span>$</span>{{$subtotal}}</span></td>
                                    </tr> 
                                    <tr>
                                        <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Envío:</th>
                                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                            <span><span>$</span>{{$orden->metodoEnvio}}</span>&nbsp;<small>vía Envio Nacional</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Total:</th>
                                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><span>$</span>{{$total}}</span></td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div> 
                    
                    
                </div>
            </div>--}}
            <!-- otro -->
        <main class="my-8">
            <div class="container mx-auto px-6">
                <h3 class="text-gray-700 text-2xl font-medium">Checkout</h3>
                <div class="flex flex-col lg:flex-row mt-8">
                    <div class="w-full lg:w-1/2 order-2">
                        <div class="flex items-center">
                            <button class="flex text-sm text-blue-500 focus:outline-none"><span class="flex items-center justify-center text-white bg-blue-500 rounded-full h-5 w-5 mr-2">1</span> Contacts</button>
                            <button class="flex text-sm text-gray-700 ml-8 focus:outline-none"><span class="flex items-center justify-center border-2 border-blue-500 rounded-full h-5 w-5 mr-2">2</span> Shipping</button>
                            <button class="flex text-sm text-gray-500 ml-8 focus:outline-none" disabled><span class="flex items-center justify-center border-2 border-gray-500 rounded-full h-5 w-5 mr-2">3</span> Payments</button>
                        </div>
                        <div class="mt-8 lg:w-3/4">
                            @if ($orden->metodoEnvio == null)
                                <div>
                                    <h4 class="text-sm text-gray-500 font-medium">Método de entrega</h4>
                                    <div class="mt-6">
                                        @if ($metodoEnvio == 10000)
                                            <button type="button" class="flex items-center justify-between w-full bg-white rounded-md border-2  p-4 focus:outline-none border-blue-500" >
                                                <label class="flex items-center">
                                                    <input type="radio" class="form-radio h-5 w-5 text-blue-600" value="10000" id="metodoEnvio" name="metodoEnvio" wire:model="metodoEnvio"><span class="ml-2 text-sm text-gray-700">Entrega a Domicilio</span>
                                                </label>
            
                                                <span class="text-gray-600 text-sm">$10000</span>
                                            </button>
                                            
                                            <button type="button" class="mt-6 flex items-center justify-between w-full bg-white rounded-md border-2 p-4 focus:outline-none">
                                                <label class="flex items-center">
                                                    <input type="radio" class="form-radio h-5 w-5 text-blue-600" value="0" id="metodoEnvio" name="metodoEnvio" wire:model="metodoEnvio"><span class="ml-2 text-sm text-gray-700">Recoger En Tienda</span>
                                                </label>
            
                                                <span class="text-gray-600 text-sm">$0</span>
                                            </button>
                                        @elseif($metodoEnvio == null && $orden->metodoEnvio == null)
                                            <button type="button" class="flex items-center justify-between w-full bg-white rounded-md border-2  p-4 focus:outline-none " >
                                                <label class="flex items-center">
                                                    <input type="radio" class="form-radio h-5 w-5 text-blue-600" value="10000" id="metodoEnvio" name="metodoEnvio" wire:model="metodoEnvio"><span class="ml-2 text-sm text-gray-700">Entrega a Domicilio</span>
                                                </label>
            
                                                <span class="text-gray-600 text-sm">$10000</span>
                                            </button>
                                            
                                            <button type="button" class="mt-6 flex items-center justify-between w-full bg-white rounded-md border-2 p-4 focus:outline-none ">
                                                <label class="flex items-center">
                                                    <input type="radio" class="form-radio h-5 w-5 text-blue-600" value="0" id="metodoEnvio" name="metodoEnvio" wire:model="metodoEnvio"><span class="ml-2 text-sm text-gray-700">Recoger En Tienda</span>
                                                </label>
            
                                                <span class="text-gray-600 text-sm">$0</span>
                                            </button>
                                        @else
                                            <button type="button" class="flex items-center justify-between w-full bg-white rounded-md border-2  p-4 focus:outline-none" >
                                                <label class="flex items-center">
                                                    <input type="radio" class="form-radio h-5 w-5 text-blue-600" value="10000" id="metodoEnvio" name="metodoEnvio" wire:model="metodoEnvio"><span class="ml-2 text-sm text-gray-700">Entrega a Domicilio</span>
                                                </label>
            
                                                <span class="text-gray-600 text-sm">$10000</span>
                                            </button>
                                            
                                            <button type="button" class="mt-6 flex items-center justify-between w-full bg-white rounded-md border-2 p-4 focus:outline-none border-blue-500">
                                                <label class="flex items-center">
                                                    <input type="radio" class="form-radio h-5 w-5 text-blue-600" value="0" id="metodoEnvio" name="metodoEnvio" wire:model="metodoEnvio"><span class="ml-2 text-sm text-gray-700">Recoger En Tienda</span>
                                                </label>
            
                                                <span class="text-gray-600 text-sm">$0</span>
                                            </button>
                                            
                                        @endif
                                    </div>
                                </div>
                                
                            @else
                                <div>
                                    <h4 class="text-sm text-gray-500 font-medium">Método de entrega</h4>
                                    <div class="mt-6">
                                        @if ($orden->metodoEnvio == '10000')
                                            <button type="button" class="flex items-center justify-between w-full bg-white rounded-md border-2  p-4 focus:outline-none border-blue-500" >
                                                <label class="flex items-center">
                                                    <input type="radio" checked class="form-radio h-5 w-5 text-blue-600" ><span class="ml-2 text-sm text-gray-700">Entrega a Domicilio</span>
                                                </label>
            
                                                <span class="text-gray-600 text-sm">$10000</span>
                                            </button>
                                            
                                            <button type="button" class="mt-6 flex items-center justify-between w-full bg-white rounded-md border-2 p-4 focus:outline-none">
                                                <label class="flex items-center">
                                                    <input type="radio" disabled class="form-radio h-5 w-5 text-blue-600" ><span class="ml-2 text-sm text-gray-700">Recoger En Tienda</span>
                                                </label>
            
                                                <span class="text-gray-600 text-sm">$0</span>
                                            </button>
                                        @else
                                            <button type="button" class="flex items-center justify-between w-full bg-white rounded-md border-2  p-4 focus:outline-none" >
                                                <label class="flex items-center">
                                                    <input type="radio" disabled class="form-radio h-5 w-5 text-blue-600" ><span class="ml-2 text-sm text-gray-700">Entrega a Domicilio</span>
                                                </label>
            
                                                <span class="text-gray-600 text-sm">$10000</span>
                                            </button>
                                            
                                            <button type="button" class="mt-6 flex items-center justify-between w-full bg-white rounded-md border-2 p-4 focus:outline-none border-blue-500">
                                                <label class="flex items-center">
                                                    <input type="radio" checked class="form-radio h-5 w-5 text-blue-600" ><span class="ml-2 text-sm text-gray-700">Recoger En Tienda</span>
                                                </label>
            
                                                <span class="text-gray-600 text-sm">$0</span>
                                            </button>
                                            
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if ($errors->any())
                            <br>
                                <div class="alert alert-warning" role="alert">
                                    <strong class="font-bold">Error!</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                    </span>
                                </div>
                            @endif

                            @if ($metodoEnvio == 10000)    
                            <div class="mt-8">
                                <h4 class="text-sm text-gray-500 font-medium">Dirección de entrega</h4>
                                <div class="mt-6 flex">
                                    <label class="block w-3/12">
                                        <select class="form-control mt-1" id="shippingCity" name="shippingCity" wire:model="shippingCity">  
                                            <option value="{{$shippingCity}}">{{$shippingCity}}</option>                              
                                        </select>
                                        
                                    </label>
                                    <label class="block flex-1 ml-3">
                                        <input type="text" class="form-controlmt-1 block w-full text-gray-700" placeholder="Direccion" id="shippingAddress" name="shippingAddress" wire:model="shippingAddress" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    </label>
                                </div>
                            </div>
                            @endif
                            
                            <div class="mt-8">
                                <h4 class="text-sm text-gray-500 font-medium">Date</h4>
                                <div class="mt-6 flex">
                                    <label class="block flex-1">
                                        <input type="date" class="form-input mt-1 block w-full text-gray-700" placeholder="Date">
                                    </label>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-8">
                                <button class="flex items-center text-gray-700 text-sm font-medium rounded hover:underline focus:outline-none">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                                    <span class="mx-2">Back step</span>
                                </button>
                                @if ($orden->metodoEnvio == null)
                                    <button type="button" wire:click="pusDir" class="flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                        <span>Payment</span>
                                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </button>
                                @else
                                    @include('livewire.product.button-payU')
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="w-full mb-8 flex-shrink-0 order-1 lg:w-1/2 lg:mb-0 lg:order-2">
                        <div class="flex justify-center lg:justify-end">
                            <div class="border rounded-md max-w-md w-full px-4 py-3">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-gray-700 font-medium">Order total ({{$orden->Products->count()}})</h3>
                                    <span class="text-gray-600 text-sm">Edit</span>
                                </div>
                                <!-- foreach -->
                                @foreach ($orden->Products as $product)
                                    <div class="flex justify-between mt-6">
                                        <div class="flex">
                                            <img class="h-20 w-20 object-cover rounded" src="{{asset($product->Product->foto)}}" alt="">
                                            <div class="mx-3">
                                                <h3 class="text-sm text-gray-600">{{$product->Product->nombre}}</h3>
                                                <div class="flex items-center mt-2">
                                                    <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    </button>
                                                    <span class="text-gray-700 mx-2">{{$product->cant}}</span>
                                                    <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-gray-600">${{$product->Product->precio * $product->cant}}</span>
                                    </div>
                                @endforeach
                                <div class="mt-2">
                                    <div class="bg-white shadow-md rounded my-6">
                                        <table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                            
                                            <tfoot>
                                                <tr>
                                                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px">Subtotal:</th>
                                                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px"><span><span>$</span>{{$subtotal}}</span></td>
                                                </tr> 
                                                <tr>
                                                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Envío:</th>
                                                    @if ($orden->metodoEnvio == 0)
                                                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                        <span><span>$</span>{{$orden->metodoEnvio}}</span>&nbsp;<small>Recoger En Tienda</small>
                                                    </td>
                                                    @else
                                                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                        <span><span>$</span>{{$orden->metodoEnvio}}</span>&nbsp;<small>vía Envio Nacional</small>
                                                    </td>
                                                        
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Total:</th>
                                                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><span>$</span>{{$total}}</span></td>
                                                </tr>
                                            </tfoot>
                                        </table>
            
                                    </div>
                                </div> 
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
        <!-- fin otro --> 
        </div>                   
    @else
        @if ($orden)
            <div class="container mx-auto px-6">
                <div class="md:flex md:items-center">
                    <div class="w-full h-64 md:w-1/2 lg:h-96">
                        <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{asset($orden->Products->first()->Product->foto)}}" alt="{{$orden->Products->first()->Product->nombre}}">
                    </div>
                    <div class="w-full max-w-lg mx-auto mt-2 md:ml-8 md:mt-0 md:w-1/2">
                        <h3 class="text-indigo-700 uppercase text-lg">{{$orden->Products->first()->Product->nombre}}</h3>
                        <h4 class="text-gray-600  text-sm">{{$orden->Products->first()->Product->subCategoryProduct->Category->name}}/{{$orden->Products->first()->Product->subCategoryProduct->name}}</h4>
                            <p class="text-gray-500  mx-1">
                                {{$orden->Products->first()->Product->Descripcion}}
                            </p>
    
                        <hr class="my-3">
                        <div class="mt-2">
                            <div class="bg-white shadow-md rounded my-6">
                                <table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Producto</th>
                                            <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Cantidad</th>
                                            <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word">
    
                                                    {{$orden->Products->first()->Product->nombre}}
                                                    @if ($orden->metodoEnvio != 0)
                                                    <ul style="font-size:small;margin:1em 0 0;padding:0;list-style:none">
                                                        <li style="margin:0.5em 0 0;padding:0">
                                                            Domicilio ($10.000)
                                                        </li>
                                                    </ul>		
                                                        
                                                    @endif
                                                </td>
                                                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                    {{$orden->Products->first()->cant}}
                                                </td>
                                                <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                    <span><span>$</span>{{$orden->Products->first()->Product->precio * $orden->Products->first()->cant}}</span>		
                                                </td>
                                            </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px">Subtotal:</th>
                                            <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px"><span><span>$</span>{{$subtotal}}</span></td>
                                        </tr> 
                                        <tr>
                                            <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Envío:</th>
                                            @if ($orden->metodoEnvio == 0)
                                            <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                <span><span>$</span>{{$orden->metodoEnvio}}</span>&nbsp;<small>Recoger En Tienda</small>
                                            </td>
                                            @else
                                            <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                <span><span>$</span>{{$orden->metodoEnvio}}</span>&nbsp;<small>vía Envio Nacional</small>
                                            </td>
                                                        
                                            @endif
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Total:</th>
                                            <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><span>$</span>{{$total}}</span></td>
                                        </tr>
                                    </tfoot>
                                </table>

                                
                                
                            </div>
                        </div>


                        @if ($total < $limit)
                            <button class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500"> Lo sentimos, hacemos pedidos con valor total superior a $30.000</button>
                        @else
                            
                            @if ($orden->metodoEnvio == null)
                                <button wire:click="addDir('direccion')" class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500"> agregar direccion de envio</button>
                            @else
                                @include('livewire.product.button-payU')
                            @endif
                        @endif
                    </div>
                </div>         
            </div>
        @endif
        
    @endif
    
</div>
