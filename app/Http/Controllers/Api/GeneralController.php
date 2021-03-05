<<<<<<< HEAD
<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\Post;
use App\Models\Role;
use App\Models\Image;
use App\Models\Video;
use App\Models\Product;
use App\Models\Tarjeta;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    public function ultimoOrden(Request $request){

        $guardado = 0;
        $resp = [];
        if($request['name'] == 'usuarios'){
            $resp =  User::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'roles'){
            $resp =  Role::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'permisos'){
            $resp =  Permission::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'imagenes'){
            $resp =  Image::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'posts'){
            $resp =  Post::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'productos'){
            $resp =  Product::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'paginas'){
            $resp =  Tarjeta::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'videos'){
            $resp =  Video::orderBy('orden', 'Asc')->get();
        }

        foreach ($resp as $item) {
            if($item->orden > $guardado){
                    $guardado = $item->orden;
            }
        }
        
        return response()->json($guardado, 200);
    }
}
=======
<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\Post;
use App\Models\Role;
use App\Models\Image;
use App\Models\Video;
use App\Models\Product;
use App\Models\Tarjeta;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    public function ultimoOrden(Request $request){

        $guardado = 0;
        $resp = [];
        if($request['name'] == 'usuarios'){
            $resp =  User::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'roles'){
            $resp =  Role::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'permisos'){
            $resp =  Permission::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'imagenes'){
            $resp =  Image::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'posts'){
            $resp =  Post::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'productos'){
            $resp =  Product::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'paginas'){
            $resp =  Tarjeta::orderBy('orden', 'Asc')->get();
        }
        if($request['name'] == 'videos'){
            $resp =  Video::orderBy('orden', 'Asc')->get();
        }

        foreach ($resp as $item) {
            if($item->orden > $guardado){
                    $guardado = $item->orden;
            }
        }
        
        return response()->json($guardado, 200);
    }
}
>>>>>>> e82a5fbc1bfb0f06169fa8025500f4026917e1b9
