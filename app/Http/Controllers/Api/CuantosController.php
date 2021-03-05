<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\Post;
use App\Models\Role;
use App\Models\Image;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class CuantosController extends Controller
{
    public function cuantos(){

        $nClientes =  User::count();
        $nRoles =  Role::count();
        $nPermisos =  Permission::count();
        $nImage =  Image::count();
        $nPost =  Post::count();
        $nProductos =  Product::count();

        $nDatos = [
            "clientes" => $nClientes,
            "roles" => $nRoles,
            "permisos" => $nPermisos,
            "imagenes" => $nImage,
            "posts" => $nPost,
            "productos" => $nProductos
        ];

        return response()->json($nDatos, 200);
    }
}
