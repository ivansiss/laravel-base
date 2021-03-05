<?php

namespace App\Http\Controllers\Api;

use App\Models\Tarjeta;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaginasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarjetas =  Tarjeta::orderBy('orden', 'Asc')->paginate(10);
   
        return response()->json($tarjetas, 200);
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
        $tarjetas =  Tarjeta::orderBy('orden', 'Asc')->get();
        
        $actual_orden = 0;
        foreach ($tarjetas as $item) {
           if($item->orden > $actual_orden){
            $actual_orden = $item->orden;
           }
        }

        $tarjeta = Tarjeta::create([
            'category_id' => $request->category_id,
            'orden' => $actual_orden + 1,
            'pagina' => $request->pagina,
            'title' => $request->title,
            'subtitulo' => $request->subtitulo,
            'url_clean' => $request->url_clean,
            'content' => $request->content,
            'posted' => $request->posted
        ]);

        $ids = [];
        foreach ($request->imagenes as $value) {
            array_push($ids, $value['id']);
        }

        $tarjeta->images()->sync( $ids );
        
        return 'Datos guardados correctamente!!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $tarjeta =  Tarjeta::where('id', '=', $id)->first();
   
        return response()->json($tarjeta, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarjeta $pag)
    {
        return response()->json($pag);
        //return response()->json($pag);
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
        $tarjeta = Tarjeta::find($request->id);

        $tarjeta->category_id = $request->category_id;
        $tarjeta->orden = $request->orden;
        $tarjeta->pagina = $request->pagina;
        $tarjeta->title = $request->title;
        $tarjeta->subtitulo = $request->subtitulo;
        $tarjeta->url_clean = $request->url_clean;
        $tarjeta->content = $request->content;
        $tarjeta->posted = $request->posted;
        
        $ids = [];
        foreach ($request->imagenes as $value) {
            array_push($ids, $value['id']);
        }

        $tarjeta->save();
        $tarjeta->images()->sync( $ids );
        
        return 'Datos editados correctamente!!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarjeta = Tarjeta::find($id);
        $tarjeta->delete();

       return($tarjeta);
    }

    public function order(Request $request){

        $contador = 0;
        for ($i=0; $i < count($request->all()); $i++) { 

            $tarjeta = Tarjeta::where( 'id', $request[$i]['id'])->first();
            $tarjeta->orden = $contador;
            $contador++;
            $tarjeta->save();
        }

        return response()->json($request, 200);
    }

    public function search(Request $request){

        $bandera = true;
        $dondeEntra = "";

        if($request['consulta'] === 'visible'){

            $resp = Tarjeta::where('posted', '=', 'yes')->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $dondeEntra = 'visible1';
        }

        if($request['consulta'] === 'no visible' && $bandera == true){
            $resp = Tarjeta::where('posted', '=', 'not')->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $dondeEntra = 'no visible';
        }

        $cat = Category::orderBy('id', 'Asc')->get();
        foreach ($cat as $item) {
            if($request['consulta'] === $item->title && $bandera == true){
                $resp = Tarjeta::where('category_id', '=', $item->id)->orderBy('orden', 'Asc')->paginate(20);
                $bandera = false;
                $dondeEntra = 'tipo imagen';
            }
        }

        if($bandera == true){
            $resp = Tarjeta::where('title', 'LIKE', '%' . $request['consulta'] . '%')
                        ->orWhere('subtitulo', 'LIKE', '%' . $request['consulta'] . '%')
                        ->orWhere('posted', 'LIKE', '%' . $request['consulta'] . '%')
                        ->orWhere('pagina', 'LIKE', '%' . $request['consulta'] . '%')
                        ->orWhere('content', 'LIKE', '%' . $request['consulta'] . '%')->orderBy('orden', 'Asc')->paginate(20);
            
                        $dondeEntra = 'like';
        }

        if(count($resp)){ 

            $ultimoRegistro = $resp[count($resp)-1]->orden;
            foreach($resp as $tarjeta){
                $tarjeta->rol = $tarjeta->roles;
                $tarjeta->ultimo = $ultimoRegistro;
            }

            return response()->json( $resp, 200);
        }

        return response()->json( $request['consulta'], 200);
        
    }

    public function paginaFiltro(){
        
        $tarjetas =  Tarjeta::orderBy('orden', 'Asc')->get();

        $route = [];
        foreach ($tarjetas as $item) {
            array_push($route, $item->pagina);
        }

        $result = array_unique($route);
        rsort($result);
   
        return response()->json($result, 200);
    }



}


