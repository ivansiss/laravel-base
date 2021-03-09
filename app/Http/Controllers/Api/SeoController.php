<?php

namespace App\Http\Controllers\Api;

use App\Models\Seo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seo = Seo::orderBy('orden', 'Asc')->paginate(10);
   
        return response()->json($seo, 200);
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
 
        $S = Seo::create([
            'pagina' => $request->pagina,
            'titulo' => $request->titulo,
            'title' => $request->title,
            'description' => $request->description,
            'autor' => $request->autor,
            'h1' => $request->h1,
            'h2' => $request->h2,
            'extra' => $request->extra,
            'orden' => $request->orden +1
        ]);
        
        return 'Datos guardados correctamente!!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seo = Seo::where('id', '=', $id)->orderBy('orden', 'Asc')->paginate(10);
        return response()->json($seo, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seo $seo)
    {
        $seo->pagina = $request->input('pagina');
        $seo->titulo = $request->input('titulo');
        $seo->title = $request->input('title');
        $seo->description = $request->input('description');
        $seo->autor = $request->input('autor');
        $seo->h1 = $request->input('h1');
        $seo->h2 = $request->input('h2');
        $seo->extra = $request->input('extra');
        $seo->orden = $request->input('orden');
        $seo->save();

        return 'seo actualizado!!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seo $seo)
    {
        $seo->delete();
        return('Registro eliminado correctamente!!');
    }

    public function searchTexto(Request $request){

        $resp = Seo::where('pagina', 'LIKE', '%' . $request->consulta . '%')
        ->orWhere('titulo', 'LIKE', '%' . $request->consulta . '%')->orderBy('orden', 'Asc')->paginate(20);

        if(count($resp) > 0){

            $ultimoRegistro = $resp[count($resp)-1]->orden;
            foreach($resp as $user){
                $user->rol = $user->roles;
                $user->ultimo = $ultimoRegistro;
            }
        }
        
        return response()->json( $resp, 200);
    }
}
