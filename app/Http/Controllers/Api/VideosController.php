<<<<<<< HEAD
<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use App\Models\Video;
use App\Models\TipoImagen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoVideo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess', 'access.permisos');
        $videos =  Video::orderBy('orden', 'Asc')->paginate(10);
        return response()->json($videos, 200);
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarVideo(Request $request)
    {
            $validatedData = $this->validate($request, [
                'titulo' => 'required',
                'miVideo' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4'
            ]);

            $file =$request->file('miVideo');
            if($file){
                $name = $request->file('miVideo')->getClientOriginalName();
            }else{
                return response()->json('Es necesario un video!!', 406);
            }
        
            $lista = Storage::allFiles('public/videos');
            if($lista){
                $lista = str_replace("public/videos/", "", $lista);

                foreach ($lista as $value) {
                    if($value == $name){
                        return response()->json( 'Este video esta repetido!!', 406);
                    }
                }
            }

            $vid = new Video;

            if($request->file('miVideo')->getSize() >= 1024){
                $redondeo = round($request->file('miVideo')->getSize()/1024, 1);
                $vid->size = $redondeo .' kb';
            }else{
                $redondeo = $request->file('miVideo')->getSize();
                $vid->size = $redondeo .' bytes';
            }

            $vid->titulo = $request->titulo;
            $vid->descripcion = $request->descripcion;
            $vid->link = $name;
            $vid->visible = $request->visible;
            $vid->tipo_id = $request->tipo_id;
            $vid->orden = $request->orden;
            $vid->miniatura = $request->miniatura;
            $vid->save();

        $request->miVideo->move(public_path('storage/videos/'), $name);
      
        return response()->json( "Video guardado", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tiposVideos()
    {
        $resp = TipoVideo::orderBy('id', 'Asc')->get();
        return response()->json( $resp, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $img)
    {
        return response()->json($img);
    }

    /**
     * Update the specified resource in storage.
     *
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  

        $validatedData = $this->validate($request, [
            'titulo' => 'required',
        ]);

        $vid =  Video::where( 'id', $id)->first();

        $vid->titulo = $request->titulo;
        $vid->descripcion = $request->descripcion;
        $vid->visible = $request->visible;
        $vid->tipo_id = $request->tipo_id;
        $vid->miniatura = $request->miniatura;

        $vid->save();

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
       $vid = Video::findOrfail($id);
       Storage::delete('public/videos/' . $vid->link);
       $vid->delete();
       return('Registro eliminado correctamente!!');
    }

    public function search(Request $request){

        $bandera = true;
        $dondeEntra = "";

        if($request['consulta'] === 'visible'){

            $resp = Video::where('visible', '=', 1)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $dondeEntra = 'visible1';
        }

        if($request['consulta'] === 'no visible' && $bandera == true){
            $resp = Video::where('visible', '=', 0)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $dondeEntra = 'no visible';
        }

        $tipo = TipoVideo::orderBy('id', 'Asc')->get();
        foreach ($tipo as $item) {
            if($request['consulta'] === $item->title && $bandera == true){
                $resp = Video::where('tipo_id', '=', $item->id)->orderBy('orden', 'Asc')->paginate(20);
                $bandera = false;
                $dondeEntra = 'tipo video';
            }
        }

        if($bandera == true){
            $resp = Video::where('titulo', 'LIKE', '%' . $request['consulta'] . '%')
                        ->orWhere('descripcion', 'LIKE', '%' . $request['consulta'] . '%')->orderBy('orden', 'Asc')->paginate(20);
                        $dondeEntra = 'like';
        }

        if(count($resp)){ 

            return response()->json( $resp, 200);
        }

        return response()->json( $request['consulta'], 200);
        
    }

    public function searchTexto(Request $request){

        $bandera = true;
        $tipo = "Tipo imagen";

        if($request->consulta == 'visible'){

            $resp = Image::where('visible', '=', 1)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $tipo = "Visible";
        }

        if($request->consulta == 'no visible' && $bandera == true){
            $resp = Image::where('visible', '=', 0)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $tipo = "No Visible";
        }

        if($request->consulta == 'size' && $bandera == true){
            $resp = Image::where('size', '>=', 1000)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $tipo = "Size";
        }
        
        if($request->consulta != ''){

            $tipo_imagen = TipoImagen::where('title', '=', $request['consulta'])->first();
            if($tipo_imagen != ''){
                $resp = Image::where('tipo_id', '=', $tipo_imagen->id)->orderBy('orden', 'Asc')->paginate(20);
                $bandera = false;
                $tipo = "tipo imagen";
            }
        }
        
        if($bandera == true){
            $resp = Image::where('image', 'LIKE', '%' . $request->consulta . '%')
                         ->orWhere('description', 'LIKE', '%' . $request['consulta'] . '%')
                         ->orWhere('alt', 'LIKE', '%' . $request['consulta'] . '%')->orderBy('orden', 'Asc')->paginate(20);
        
        $tipo = "Like";   
        }

        if(count($resp)){
            $ultimoRegistro = $resp[count($resp)-1]->orden;
            foreach($resp as $img){
                $img->rol = $img->roles;
                $img->ultimo = $ultimoRegistro;
                $img->tipo = $tipo;

            }

            return response()->json( $resp, 200);
        }

        return response()->json( 'No encontrado', 200);
        
    }

    public function imagenTipo()
    {
       return TipoImagen::orderBy('id', 'Asc')->get();
    }

    public function order(Request $request){

        for ($i=0; $i < count($request->all()); $i++) { 
            $vid =  Video::where( 'id', $request[$i]['id'])->first();
            $vid->orden =$request[$i]['orden'];
            $vid->save();
        }

        return 'ok';
    }

    public function ordenAutomatico()
    {
        //Gate::authorize('haveaccess', 'access.permisos');
        $vid =  Video::orderBy('orden', 'Asc')->get();
        $contador = 0;

        foreach ($vid as $item) {
            
            $vid =  Video::where('id', '=', $item->id)->first();
            $vid->orden = $contador;
            $vid->save();
            $contador++;
        }

        return response()->json('orden guardado!', 200);
    }
}
=======
<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use App\Models\Video;
use App\Models\TipoImagen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoVideo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess', 'access.permisos');
        $videos =  Video::orderBy('orden', 'Asc')->paginate(10);
        return response()->json($videos, 200);
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarVideo(Request $request)
    {
            $validatedData = $this->validate($request, [
                'titulo' => 'required',
                'miVideo' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4'
            ]);

            $file =$request->file('miVideo');
            if($file){
                $name = $request->file('miVideo')->getClientOriginalName();
            }else{
                return response()->json('Es necesario un video!!', 406);
            }
        
            $lista = Storage::allFiles('public/videos');
            if($lista){
                $lista = str_replace("public/videos/", "", $lista);

                foreach ($lista as $value) {
                    if($value == $name){
                        return response()->json( 'Este video esta repetido!!', 406);
                    }
                }
            }

            $vid = new Video;

            if($request->file('miVideo')->getSize() >= 1024){
                $redondeo = round($request->file('miVideo')->getSize()/1024, 1);
                $vid->size = $redondeo .' kb';
            }else{
                $redondeo = $request->file('miVideo')->getSize();
                $vid->size = $redondeo .' bytes';
            }

            $vid->titulo = $request->titulo;
            $vid->descripcion = $request->descripcion;
            $vid->link = $name;
            $vid->visible = $request->visible;
            $vid->tipo_id = $request->tipo_id;
            $vid->orden = $request->orden;
            $vid->miniatura = $request->miniatura;
            $vid->save();

        $request->miVideo->move(public_path('storage/videos/'), $name);
      
        return response()->json( "Video guardado", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tiposVideos()
    {
        $resp = TipoVideo::orderBy('id', 'Asc')->get();
        return response()->json( $resp, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $img)
    {
        return response()->json($img);
    }

    /**
     * Update the specified resource in storage.
     *
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  

        $validatedData = $this->validate($request, [
            'titulo' => 'required',
        ]);

        $vid =  Video::where( 'id', $id)->first();

        $vid->titulo = $request->titulo;
        $vid->descripcion = $request->descripcion;
        $vid->visible = $request->visible;
        $vid->tipo_id = $request->tipo_id;
        $vid->miniatura = $request->miniatura;

        $vid->save();

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
       $vid = Video::findOrfail($id);
       Storage::delete('public/videos/' . $vid->link);
       $vid->delete();
       return('Registro eliminado correctamente!!');
    }

    public function search(Request $request){

        $bandera = true;
        $dondeEntra = "";

        if($request['consulta'] === 'visible'){

            $resp = Video::where('visible', '=', 1)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $dondeEntra = 'visible1';
        }

        if($request['consulta'] === 'no visible' && $bandera == true){
            $resp = Video::where('visible', '=', 0)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $dondeEntra = 'no visible';
        }

        $tipo = TipoVideo::orderBy('id', 'Asc')->get();
        foreach ($tipo as $item) {
            if($request['consulta'] === $item->title && $bandera == true){
                $resp = Video::where('tipo_id', '=', $item->id)->orderBy('orden', 'Asc')->paginate(20);
                $bandera = false;
                $dondeEntra = 'tipo video';
            }
        }

        if($bandera == true){
            $resp = Video::where('titulo', 'LIKE', '%' . $request['consulta'] . '%')
                        ->orWhere('descripcion', 'LIKE', '%' . $request['consulta'] . '%')->orderBy('orden', 'Asc')->paginate(20);
                        $dondeEntra = 'like';
        }

        if(count($resp)){ 

            return response()->json( $resp, 200);
        }

        return response()->json( $request['consulta'], 200);
        
    }

    public function searchTexto(Request $request){

        $bandera = true;
        $tipo = "Tipo imagen";

        if($request->consulta == 'visible'){

            $resp = Image::where('visible', '=', 1)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $tipo = "Visible";
        }

        if($request->consulta == 'no visible' && $bandera == true){
            $resp = Image::where('visible', '=', 0)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $tipo = "No Visible";
        }

        if($request->consulta == 'size' && $bandera == true){
            $resp = Image::where('size', '>=', 1000)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
            $tipo = "Size";
        }
        
        if($request->consulta != ''){

            $tipo_imagen = TipoImagen::where('title', '=', $request['consulta'])->first();
            if($tipo_imagen != ''){
                $resp = Image::where('tipo_id', '=', $tipo_imagen->id)->orderBy('orden', 'Asc')->paginate(20);
                $bandera = false;
                $tipo = "tipo imagen";
            }
        }
        
        if($bandera == true){
            $resp = Image::where('image', 'LIKE', '%' . $request->consulta . '%')
                         ->orWhere('description', 'LIKE', '%' . $request['consulta'] . '%')
                         ->orWhere('alt', 'LIKE', '%' . $request['consulta'] . '%')->orderBy('orden', 'Asc')->paginate(20);
        
        $tipo = "Like";   
        }

        if(count($resp)){
            $ultimoRegistro = $resp[count($resp)-1]->orden;
            foreach($resp as $img){
                $img->rol = $img->roles;
                $img->ultimo = $ultimoRegistro;
                $img->tipo = $tipo;

            }

            return response()->json( $resp, 200);
        }

        return response()->json( 'No encontrado', 200);
        
    }

    public function imagenTipo()
    {
       return TipoImagen::orderBy('id', 'Asc')->get();
    }

    public function order(Request $request){

        for ($i=0; $i < count($request->all()); $i++) { 
            $vid =  Video::where( 'id', $request[$i]['id'])->first();
            $vid->orden =$request[$i]['orden'];
            $vid->save();
        }

        return 'ok';
    }

    public function ordenAutomatico()
    {
        //Gate::authorize('haveaccess', 'access.permisos');
        $vid =  Video::orderBy('orden', 'Asc')->get();
        $contador = 0;

        foreach ($vid as $item) {
            
            $vid =  Video::where('id', '=', $item->id)->first();
            $vid->orden = $contador;
            $vid->save();
            $contador++;
        }

        return response()->json('orden guardado!', 200);
    }
}
>>>>>>> e82a5fbc1bfb0f06169fa8025500f4026917e1b9
