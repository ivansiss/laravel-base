<?php

namespace App\Http\Controllers\Web;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{
    public function index(){
        Gate::authorize('haveaccess', 'access.imagenes');
        return view('app');
    }


    public function search(Request $request){

        if($request->input('tabla') == "imagenes"){

            if($request->input('accion') == "radios" && $request->input('consulta') == "mb"){
                return Image::where('size', '>=', '1024')->get();
            }

            if($request->input('accion') == "input" && $request->input('consulta') == ""){
               return Image::orderBy('created_at', 'Desc')->get();
            }

            if($request->input('accion') == "input" && $request->input('consulta') != ""){
               return Image::where('image', 'LIKE', '%' . $request->input('consulta') . '%')->get();
            }

            if($request->input('accion') == "radios"){
  
                return Image::where($request->input('consulta'), ' ')->get();
            }
            
            //
        }
        
        return $request->input('consulta');
    }
}
