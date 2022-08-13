    <!-- Modal Edit-->
    <div wire:ignore.self  class="modal fade" id="modal-Create" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="margin-top: 20px;"> >
            <div class="modal-content">
                <div class="modal-header" style="padding: 10px;">
                    <h5 class="modal-title">Crear un nuevo Producto</h5>
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
                            <div class="cc col-md-6">
    
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Categorias</label>
                                    <select class="form-control" id="catego" name="catego" wire:model="catego">
                                        <option value="0" selected>seleccione una opcion</option>   
                                       @if ($categorias)
                                            @foreach ($categorias as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>                              
                                            @endforeach
                                        
                                        @else
                                        
                                        @endif
                                    </select>
                                  </div>
                            </div>

                            @if ($catego)
                                <div class="cc col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Sub Categorias</label>
                                        <select class="form-control" id="subCat" name="subCat" wire:model="subCat">
                                            <option value="0" selected>seleccione una opcion</option>   
                                            @foreach ($subcategoria as $sub)
                                                @if ($sub->categoria_id == $catego)
                                                    <option value="{{$sub->id}}">{{$sub->name}}</option>                              
                                                @endif
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
    
                        <div class="row">
                            <div class="cc col-md-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-italic" id="inputGroup-sizing-sm" style="color: black;">Nombre</span>
                                    </div>
                            <!----> <input type="text" class="form-control" id="nombre" name="nombre" wire:model="nombre" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text font-italic" id="inputGroup-sizing-sm" style="color: black;">Descripcion</span>
                                    </div>
                            <!----> <input type="text" class="form-control" aria-label="Sizing example input" id="Descripcion" name="Descripcion" wire:model="Descripcion"  aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="cc col-md-6">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-italic" id="inputGroup-sizing-sm" style="color: black;">Precio</span>
                                    </div>
                            <!----> <input type="text" class="form-control" id="precio" name="precio" wire:model="precio" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    
                                </div>
                            </div>

                            <div class="cc col-md-6">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-italic" id="inputGroup-sizing-sm" style="color: black;">Stock</span>
                                    </div>
                            <!----> <input type="number" class="form-control" id="stock" name="stock" wire:model="stock" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    
                                </div>
                            </div>

                            <div class="cc col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Foto</label>
                                    <input type="file"  id="foto" name="foto" wire:model="foto"  aria-describedby="inputGroup-sizing-sm">
                                    
                                  </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="cc col-md-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-italic" id="inputGroup-sizing-sm" style="color: black;">Dias de anticipacion</span>
                                    </div>
                            <!----> <input type="number" class="form-control" id="anticipacionDias" name="anticipacionDias" wire:model="anticipacionDias" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text font-italic" id="inputGroup-sizing-sm" style="color: black;">Cantidad Minima</span>
                                    </div>
                            <!----> <input type="number" class="form-control" aria-label="Sizing example input" id="cantidadMin" name="cantidadMin" wire:model="cantidadMin"  aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
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