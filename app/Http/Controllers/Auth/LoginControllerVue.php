<?php

namespace App\Http\Controllers\Auth;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class LoginControllerVue extends Controller
{
    
    
    public function login(Request $request){

        $cEmail      =   $request->input('cEmail');
        $cContrasena =   $request->input('cContrasena');

        $verifica = ['email' => $cEmail, 'password' => $cContrasena];

        $rpta = Auth::attempt($verifica);
     

        if($rpta){
            return response()->json([
                'authUser'   =>   Auth::user(),
                'code'       =>   200
            ]);
        }else{
            return response()->json([
                'code'       =>   401
            ]);
        }
    }

    public function logout(Request $request){
        
        Auth::logout();

        return response()->json([
            'code'       =>   204
        ]);
    }

    public function UsuarioRolPermisos(){


    }

    
}