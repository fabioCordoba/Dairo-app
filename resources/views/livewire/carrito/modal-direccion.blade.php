<!-- Modal Edit-->
<div wire:ignore.self  class="modal fade" id="modal-direccion" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="margin-top: 20px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px;">
                <h5 class="modal-title">Agrega direccion de envio</h5>
                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="closeModal('direccion')" aria-label="Close">Close</button>
            </div>
            <div class="modal-body" style="padding: 10px;">
                @if ($errors->any())
                <div class="alert alert-warning" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    </span>
                </div>
                <br>
                @endif
                
                    <form  >
                    <div class="row">
                        <div class="cc col-md-6">
                            <h4 class="text-sm text-gray-500 font-medium">Método de entrega</h4>
                            <div class="mt-6">
                                <button type="button" class="flex items-center justify-between w-full bg-white rounded-md border-2 border-blue-500 p-4 focus:outline-none">
                                    <label class="flex items-center">
                                        <input type="radio" class="form-radio h-5 w-5 text-blue-600" value="10000" id="metodoEnvio" name="metodoEnvio" wire:model="metodoEnvio"><span class="ml-2 text-sm text-gray-700">Entrega a Domicilio</span>
                                    </label>

                                    <span class="text-gray-600 text-sm">$10000</span>
                                </button>
                                <button type="button" class="mt-6 flex items-center justify-between w-full bg-white rounded-md border p-4 focus:outline-none">
                                    <label class="flex items-center">
                                        <input type="radio" class="form-radio h-5 w-5 text-blue-600" value="0" id="metodoEnvio" name="metodoEnvio" wire:model="metodoEnvio"><span class="ml-2 text-sm text-gray-700">Recoger En Tienda</span>
                                    </label>

                                    <span class="text-gray-600 text-sm">$0</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @if ($metodoEnvio == 10000)    
                                    <div class="mt-2">
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
                        </div>
                    </div>

                    {{--<div class="row">
                        <div class="cc col-md-6">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Ciudad</label>
                                <select class="form-control" id="shippingCity" name="shippingCity" wire:model="shippingCity">  
                                    <option value="{{$shippingCity}}">{{$shippingCity}}</option>                              
                                </select>
                              </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="cc col-md-12">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-italic" id="inputGroup-sizing-sm" style="color: black;">Direccion residencia</span>
                                </div>
                        <!----> <input type="text" class="form-control" id="shippingAddress" name="shippingAddress" wire:model="shippingAddress" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                
                            </div>
                        </div>

                    </div>--}}
    
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <button type="button" class="btn btn-sm btn-outline-info" wire:click="pusDir">continuar</button>
                        </div>
                        
                    </div>
    
                    </form>
                    
                
                
            </div>
        
        </div>
    </div>
</div>