    <!-- Modal Edit-->
    <div wire:ignore.self  class="modal fade" id="modal-Create" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="margin-top: 20px;"> >
            <div class="modal-content">
                <div class="modal-header" style="padding: 10px;">
                    <h5 class="modal-title">Solicitar Servicio a Domicilio</h5>
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" wire:click="closeModal('Create')" aria-label="Close">Close</button>
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
                    @if ($swstore)
                        <form  >
                        {{csrf_field()}}

                        <div class="row">
                            @if (Auth::user()->roles->implode('name', ',') != 'DOMICILIARIO')
                                
                            <div class="cc col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Domiciliarios</label>
                                    <select class="form-control" id="domiciliario" name="domiciliario" wire:model="domiciliario">
                                        <option value="0" selected>seleccione una opcion</option>   
                                       @if ($domiciliarios)
                                            @foreach ($domiciliarios as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>                              
                                            @endforeach
                                        
                                        @else
                                        
                                        @endif
                                    </select>
                                </div>
                            </div>
                            @endif

                            @if ($swstore == 'Edit')

                            <div class="cc col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Estado</label>
                                    <select class="form-control" id="estado" name="estado" wire:model="estado">
                                        <option value="0" selected>seleccione una opcion</option>   
                                        <option value="En Camino">En Camino</option> 
                                        @if (Auth::user()->roles->implode('name', ',') != 'DOMICILIARIO')
                                        <option value="Entregado">Entregado</option> 
                                        <option value="Rechazado">Rechazado</option>                              
                                            
                                        @endif
                                    </select>
                                </div>
                            </div>
                                
                            @endif

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-sm btn-outline-info" wire:click="Store">Crear</button>
                            </div>
                            
                        </div>
        
                        </form>
                        
                    @else
                        
                    @endif
                    
                </div>
            
            </div>
        </div>
    </div>