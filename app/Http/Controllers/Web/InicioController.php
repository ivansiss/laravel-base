<?php

namespace App\Http\Controllers\Web;

use App\Models\Pie;
use App\Models\Seo;
use App\Models\Post;
use App\Models\Product;
use App\Models\Menusuperior;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {
        $menu_sup = Menusuperior::menuSup('web');
        $productos = Product::menuLateral();
        $pie = Pie::where( 'id', '1')->first();
        $seo = Seo::where( 'pagina', '=', 'inicio')->first();
        $seo->description = $this->quitarParrafo($seo->description);
        
        $posts = Post::orderBy('orden', 'Asc')->get();

        return view('inicio', compact('menu_sup', 'productos', 'pie', 'posts', 'seo'));
    }

    private function quitarParrafo($cadena){

        $resultado = str_replace("<p>", " ", $cadena);
        $resultado = str_replace("</p>", " ", $resultado);
        return trim($resultado);
    }

    public function seo(){
        // $seo = DB::table('seo as s')->where([
        //     ['pagina', 'inicio']
        // ])
        // ->first();

        //return $seo;
    }

}

