<?php

namespace App\Http\Controllers\Web;

use App\Models\Pie;
use App\Models\Video;
use App\Models\Product;
use App\Models\Tarjeta;
use App\Models\Menusuperior;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PaginasController extends Controller
{
    public function getPagina($nombre){

        $menu_sup = Menusuperior::menuSup('web');
        $productos = Product::menuLateral();
        $pie = Pie::where( 'id', '1')->first();
        $tarjetas = Tarjeta::where('pagina', '=', $nombre)->get();
        $select_items =  Video::orderBy('orden', 'Asc')->get();
        $items[0] = $select_items[0];

        return view('pagina', compact('menu_sup', 'productos', 'pie', 'tarjetas', 'items', 'select_items'));
    }

    public function search(Request $request){

        $search = $request['search'];
        $menu_sup = Menusuperior::menuSup('web');
        $productos = Product::menuLateral();
        $pie = Pie::where( 'id', '1')->first();
        $tarjetas = Tarjeta::where('pagina', '=', 'formacion')->get();

        $select_items =  Video::orderBy('orden', 'Asc')->get();
        $items = Video::where('miniatura', '=',  $search )->orderBy('orden', 'Asc')->paginate(5);
        //$items = Video::where('miniatura', 'LIKE', '%'. $search . '%')->orderBy('orden', 'Asc')->paginate(5);

        return view('pagina', compact('menu_sup', 'productos', 'pie', 'tarjetas', 'items', 'select_items'));
    }
}
