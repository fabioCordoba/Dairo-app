<div>
    <ul>
        <li class="nav-item dropdown">
            <!--Punto rojo-->
            <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">              
                <i class="icon-bell"></i>
                 @if ($user->notifications->where('estado','nonread')->count()>0|| $allnotificacion->where('estado','nonread')->count() > 0)
                    <span class="count">{{$user->notifications->where('estado','nonread')->count()}}</span>
                @endif             
            </a>

            <div class="dropdown-menu  navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <!--tienes x notificaciones sin revisar-->
                <a class="dropdown-item py-2 border-bottom" href="#">
                    @if ($user->notifications->where('estado','nonread')->count() + $allnotificacion->where('estado','nonread')->count() != 1)
                        <p class="block  text-sm leading-5 text-gray-700 mb-0 font-weight-medium ">Tienes {{ $user->notifications->where('estado','nonread')->count() }} notifications Sin revisar</p>
                    @else
                        <p class="block  text-sm leading-5 text-gray-700 mb-0 font-weight-medium ">Tienes {{ $user->notifications->where('estado','nonread')->count() }} notificacion Sin revisar</p>
                    @endif
                    
                    {{--<span class="badge badge-pill badge-primary float-right">Ver Todas</span>--}}
                </a>

                <!--listar notificaciones por usuarios-->
                @foreach ($user->notifications->sortByDesc('id') as $notificacion)
                    @if ($notificacion->estado == 'nonread')
                        @if ($notificacion->tipo == 'Url')
                            <a class="dropdown-item preview-item py-3" wire:click="readN({{$notificacion->id}})" onclick="abrirSala('{{$notificacion->url}}')">
                                <div class="row">
                                    <div class="preview-thumbnail py-3 mr-2">
                                        @if (Auth::user()->roles->implode('name', ',') == 'CLIENTE')
                                            <i class="mdi mdi-alert m-auto text-primary"></i>
                                        @elseif(Auth::user()->roles->implode('name', ',') == 'ROOT')
                                            <i class="mdi mdi-comment-check m-auto text-primary"></i>
                                        @endif
                                    
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject fw-normal text-dark mb-1">{{ $notificacion->notificacion }}</h6>
                                        <p class="fw-light small-text mb-0"> {{ $notificacion->fechaHora }} </p>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endif
                @endforeach

                <!--listar notificaciones para admins y soportes-->
                @foreach ($allnotificacion->sortByDesc('id') as $notificacion)
                    @if ($notificacion->estado == 'nonread')
                        @if ($notificacion->tipo == 'all')
                            <a class="dropdown-item preview-item py-3" wire:click="readN({{$notificacion->id}})" onclick="abrirSala('{{$notificacion->url}}')">
                            <div class="preview-thumbnail">
                                @if(Auth::user()->roles->implode('name', ',') != 'GUEST')
                                <i class="mdi mdi-comment-check m-auto text-primary"></i>
                                @endif
                                
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal text-dark mb-1">{{ $notificacion->notificacion }}</h6>
                                <p class="fw-light small-text mb-0"> {{ $notificacion->fechaHora }} </p>
                            </div>
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </li>
    </ul>
</div>
