<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Menusuperior;
use App\Models\Product;
use App\Models\Post;
use App\Models\Pie;

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
        
        $posts = Post::orderBy('orden', 'Asc')->get();

        return view('inicio', compact('menu_sup', 'productos', 'pie', 'posts'));
    }

    public function seo(){
        // $seo = DB::table('seo as s')->where([
        //     ['pagina', 'inicio']
        // ])
        // ->first();

        //return $seo;
    }

}
