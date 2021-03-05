<?php

namespace App\Http\Controllers\Web;

use App\Models\Pie;
use App\Models\Product;
use App\Models\Tarjeta;
use App\Models\Menusuperior;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducto($nombre)
    {
        $menu_sup = Menusuperior::menuSup('web');
        $productos = Product::menuLateral();
        $pie = Pie::where( 'id', '1')->first();
        $tarjetas = Tarjeta::where('pagina', '=', $nombre)->get();

        if(count($tarjetas) > 0 ){
            return view('pagina', compact('menu_sup', 'productos', 'pie', 'tarjetas'));
        }
        
        $post = Product::where('slug', '=', $nombre)->first();
        return view('producto', compact('menu_sup', 'productos', 'pie', 'post'));
    }

   
}
