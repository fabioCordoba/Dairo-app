<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domicilio;
use App\Models\User;
use App\Models\pagos;
use Illuminate\Support\Facades\Validator;

class DomicilioController extends Controller
{
    public function misDomicilios($id)
    {
        $user = User::find($id);
        $usuario = User::find($user->id);

        if($user->roles->implode('name', ',') == 'DOMICILIARIO'){

            return response([
                'user' => $usuario,
                'domicilios' => $user->domiciliosDomic()->with('admin:id,name')->orderBy('id', 'DESC')->get(),
            ], 200);

        }else{

            return response([
                'user' => $user,
                'rol' => $user->roles->implode('name', ','),
                'message' => 'Informacion no Disponible'
            ], 200);
        }


    }

    public function domiciliosLibres()
    {
        $domicilios = Domicilio::where('estado', 'Libre')->with('admin:id,name')->orderBy('id', 'DESC')->get();

        return response([
            'ok' => true,
            'domicilios' => $domicilios,
        ], 200);
    }

    public function autoAsignar(Request $request)
    {
        Validator::make($request->all(), [
            'id_user' => 'required',
            'id_domicilio' => 'required',
        ])->validate();

        $user = User::find($request->id_user);
        
        if($user->roles->implode('name', ',') == 'DOMICILIARIO'){
            
            $domicilio = Domicilio::find($request->id_domicilio);

            if($domicilio){
                
                if($domicilio->estado == 'Libre'){
    
                    $domicilio->update([
                        'domiciliario_id' => $user->id,
                        'estado' => 'Asignado'
                    ]);
    
                    return response([
                        'message' => 'Domicilio Asignado correctamente'
                    ], 200);
                }else{
                    return response([
                        'message' => 'No disponible'
                    ], 401);
                }
            }else{
                return response([
                    'message' => 'No disponible'
                ], 401);
            }

        }else{

            return response([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'rol' => $user->roles->implode('name', ','),
                'message' => 'Informacion no Disponible'
            ], 200);
        }

    }

    public function bonificados($id)
    {
        $user = User::find($id);

        if($user->roles->implode('name', ',') == 'DOMICILIARIO'){
            
            $pagos = $user->pagos()->get();

            return response([
                'ok' => true,
                'pagos' => $pagos,
            ], 200);

        }else{

            return response([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'rol' => $user->roles->implode('name', ','),
                'message' => 'Informacion no Disponible'
            ], 200);
        }

    }

    public function domiciliosPagados(Request $request)
    {
        Validator::make($request->all(), [
            'id_user' => 'required',
            'id_pago' => 'required',
        ])->validate();

        $user = User::find($request->id_user);

        if($user->roles->implode('name', ',') == 'DOMICILIARIO'){

            $domicilios = pagos::find($request->id_pago)->domicilios()->with('admin:id,name')->get();
        
            return response([
                'ok' => true,
                'domicilios' => $domicilios,
            ], 200);

        }else{

            return response([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'rol' => $user->roles->implode('name', ','),
                'message' => 'Informacion no Disponible'
            ], 200);
        }


    }

    public function encamino(Request $request)
    {
        Validator::make($request->all(), [
            'id_user' => 'required',
            'id_domicilio' => 'required',
        ])->validate();

        $user = User::find($request->id_user);
        
        if($user->roles->implode('name', ',') == 'DOMICILIARIO'){
            
            $domicilio = Domicilio::find($request->id_domicilio);

            if($domicilio){

                if($domicilio->estado == 'Asignado'){
    
                    $domicilio->update([
                        'domiciliario_id' => $user->id,
                        'estado' => 'En Camino'
                    ]);
    
                    return response([
                        'message' => 'Domicilio marcado correctamente'
                    ], 200);
                }else{
                    return response([
                        'message' => 'No disponible'
                    ], 401);
                }
                
            }else{
                return response([
                    'message' => 'No disponible'
                ], 401);
            }

        }else{

            return response([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'rol' => $user->roles->implode('name', ','),
            ], 200);
        }
    }

}
