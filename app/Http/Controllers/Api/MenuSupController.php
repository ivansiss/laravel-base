<?php

namespace App\Http\Controllers\Api;

use App\Models\Menusuperior;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuSupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_sup =  Menusuperior::where('padre', '=', '0')->orderBy('orden', 'Asc')->get();
        return response()->json($menu_sup, 200);
    }

    public function menuSupHijo($id)
    {
        $menu_sup =  Menusuperior::where('padre', '=', $id)->orderBy('orden', 'Asc')->get();
        return response()->json($menu_sup, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $menu =  Menusuperior::where('padre', '=', $request->padre)->orderBy('orden', 'Asc')->get();
        
        $actual_orden = 0;
        foreach ($menu as $item) {
           if($item->orden > $actual_orden){
            $actual_orden = $item->orden;
           }
        }

        $m = Menusuperior::create([
            'btn' => $request->btn,
            'route' => $request->route,
            'padre' => $request->padre,
            'icono' => $request->icono,
            'orden' => $actual_orden + 1,
            'activado' => $request->activado,
            'tipo' => $request->tipo
        ]);
    
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu_sup =  Menusuperior::where('id', '=', $id)->orderBy('orden', 'Asc')->first();
        return response()->json($menu_sup, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menusuperior::find($id);

            $menu->btn = $request->btn;
            $menu->route = $request->route;
            $menu->padre = $request->padre;
            $menu->icono = $request->icono;
            $menu->orden = $request->orden;
            $menu->activado = $request->activado;
            $menu->tipo = $request->tipo;

            $menu->save();
        
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
       $menu = Menusuperior::find($id);
       $menu->delete();

       $menu_hijos =  Menusuperior::where('padre', '=', $id)->delete();

       return('Registro eliminado correctamente!!');
    }
}
