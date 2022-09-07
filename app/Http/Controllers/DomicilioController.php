<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domicilio;
use App\Models\User;
use App\Models\pagos;
use Illuminate\Support\Facades\Validator;

class DomicilioController extends Controller
{
    public function misDomicilios(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required',
            'email' => 'required|string',
        ])->validate();
        
        $user = User::find($request->id);

        if($user->roles->implode('name', ',') == 'DOMICILIARIO'){

            return response([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'rol' => $user->roles->implode('name', ','),
                'domicilios' => $user->domiciliosDomic()->get(),
            ], 200);

        }else{

            return response([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'rol' => $user->roles->implode('name', ','),
            ], 200);
        }


    }

    public function domiciliosLibres()
    {
        $domicilios = Domicilio::where('estado', 'Libre')->orderBy('id', 'DESC')->get();

        return response([
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
                        'id' => $user->id,
                        'domicilio' => $domicilio,
                    ], 200);
                }else{
                    return response([
                        'Error' => 'No disponible'
                    ], 401);
                }
            }else{
                return response([
                    'Error' => 'No disponible'
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

    public function bonificados(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required',
        ])->validate();

        $user = User::find($request->id);

        if($user->roles->implode('name', ',') == 'DOMICILIARIO'){
            
            $pagos = $user->pagos()->get();

            return response([
                'id_user' => $user->id,
                'pagos' => $pagos,
            ], 200);

        }else{

            return response([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'rol' => $user->roles->implode('name', ','),
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

            $domicilios = pagos::find($request->id_pago)->domicilios()->get();

            return response([
                'id_user' => $user->id,
                'domicilios' => $domicilios,
            ], 200);

        }else{

            return response([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'rol' => $user->roles->implode('name', ','),
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
                        'id' => $user->id,
                        'domicilio' => $domicilio,
                    ], 200);
                }else{
                    return response([
                        'Error' => 'No disponible'
                    ], 401);
                }
                
            }else{
                return response([
                    'Error' => 'No disponible'
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
