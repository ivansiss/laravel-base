<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess', 'access.post');
        $posts =  Post::orderBy('orden', 'Asc')->paginate(10);
   
        return response()->json($posts, 200);
        //return $posts->categories;
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

        $posts =  Post::orderBy('orden', 'Asc')->get();
        
        $actual_orden = 0;
        foreach ($posts as $item) {
           if($item->orden > $actual_orden){
            $actual_orden = $item->orden;
           }
        }

        $post = Post::create([
            'category_id' => $request->category_id,
            'orden' => $actual_orden + 1,
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

        $post->images()->sync( $ids );
        
        return 'Datos guardados correctamente!!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $post = Post::find($request->id);

        $post->category_id = $request->category_id;
        $post->orden = $request->orden;
        $post->title = $request->title;
        $post->subtitulo = $request->subtitulo;
        $post->url_clean = $request->url_clean;
        $post->content = $request->content;
        $post->posted = $request->posted;
        
        $ids = [];
        foreach ($request->imagenes as $value) {
            array_push($ids, $value['id']);
        }

        $post->save();
        $post->images()->sync( $ids );
        
        return 'Datos editados correctamente!!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
       $post->delete();
       return('Registro eliminado correctamente!!');
    }

    public function order(Request $request){

        $contador = 0;
        for ($i=0; $i < count($request->all()); $i++) { 
            $post = Post::where( 'id', $request[$i]['id'])->first();
            $post->orden = $contador;
            $contador++;
            $post->save();
        }

        return response()->json($request, 200);
    }

    public function search(Request $request){

        $bandera = true;
        $dondeEntra = "";

        if($request['consulta'] === 'visible'){

            $resp = Post::where('posted', '=', 'yes')->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $dondeEntra = 'visible1';
        }

        if($request['consulta'] === 'no visible' && $bandera == true){
            $resp = Post::where('posted', '=', 'not')->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $dondeEntra = 'no visible';
        }

        $cat = Category::orderBy('id', 'Asc')->get();
        foreach ($cat as $item) {
            if($request['consulta'] === $item->title && $bandera == true){
                $resp = Post::where('category_id', '=', $item->id)->orderBy('orden', 'Asc')->paginate(20);
                $bandera = false;
                $dondeEntra = 'tipo imagen';
            }
        }

        if($bandera == true){
            $resp = Post::where('title', 'LIKE', '%' . $request['consulta'] . '%')
                        ->orWhere('subtitulo', 'LIKE', '%' . $request['consulta'] . '%')
                        ->orWhere('posted', 'LIKE', '%' . $request['consulta'] . '%')
                        ->orWhere('content', 'LIKE', '%' . $request['consulta'] . '%')->orderBy('orden', 'Asc')->paginate(20);
            
                        $dondeEntra = 'like';
        }

        if(count($resp)){ 

            $ultimoRegistro = $resp[count($resp)-1]->orden;
            foreach($resp as $post){
                $post->rol = $post->roles;
                $post->ultimo = $ultimoRegistro;
            }

            return response()->json( $resp, 200);
        }

        return response()->json( $request['consulta'], 200);
        
    }



}

