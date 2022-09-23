<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Domicilios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-11 badge bg-blue-200 text-wrap" style="width: 6rem;">
                            <strong>Auto-asignar Domiciilios:</strong>  Crea un domicilio y lo asigna a domiciliarios por orden consecutivo
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-11 badge bg-blue-200  text-wrap" style="width: 6rem; ">
                            <strong>Asignar Domicilio:</strong>  Crea un Domiclio y se le asigna al domiciliario seleccionado
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-11 badge bg-blue-200  text-wrap" style="width: 6rem;">
                            <strong>Domicilio Libre:</strong>  Crea un Domiclio con estado Libre, con este le llegara una notificacion a cada domiciliario y solo uno podra tomarlo
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @role('ROOT|ADMINISTRADOR|DOMICILIARIO')
                    @livewire('domicilios')
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>