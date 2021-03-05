<<<<<<< HEAD
<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use App\Models\TipoImagen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess', 'access.permisos');
        $images =  Image::orderBy('orden', 'Asc')->get();
        return response()->json($images, 200);
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
    
         //$filename = time() . $request->image->extension();

        $file =$request->file('miImagen');
        if(isset( $file ) && isset( $request->miImagen )){
            $name = $request->file('miImagen')->getClientOriginalName();
        }else{
            return response()->json('Es necesario una imagen!!', 406);
        }
        
        $lista = Storage::allFiles('public/imagenes');
        if($lista){
            $lista = str_replace("public/imagenes/", "", $lista);

            foreach ($lista as $value) {
                if($value == $name){
                    return response()->json( 'Esta imagen es repetida!!', 406);
                }
            }
        }else{
            return response()->json( 'Ocurrio un error en buscar imagenes en el servidor', 406);
        }
        
        $img = new Image;

        if($request->image){
            $img->image = $request->image;
        }else{
            return response()->json( 'El nombre de la imagen es requerido', 406);
        }

        if($request->description){
            $img->description = $request->description;
        }else{
            $img->description = " ";
        }

        if($request->link){
            $img->link = $request->link;
        }else{
            $img->link = " ";
        }

        if($request->alt){
            $img->alt = $request->alt;
        }else{
            $img->alt = " ";
        }

        if($request->file('miImagen')->getSize() >= 1024){
            $redondeo = round($request->file('miImagen')->getSize()/1024, 1);
            $img->size = $redondeo .' kb';
        }else{
            $redondeo = $request->file('miImagen')->getSize();
            $img->size = $redondeo .' bytes';
        }

        $img->visible = $request->visible;
        $img->tipo_id = $request->tipo_id;
        $img->orden = $request->orden;
        $img->save();

        $request->miImagen->move(public_path('storage/imagenes/'), $name);
  
        return response()->json( "Imagen guardada", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Image $img)
    {
        return response()->json($img);
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

        $img =  Image::where( 'id', $id)->first();

        $file =$request->file('miImagen');
        if(isset( $file ) && isset( $request->miImagen )){
            $name = $request->file('miImagen')->getClientOriginalName();
        }

        $img =  Image::where( 'id', $request->id)->first();

        $img->image = $request->image;

        if($request->description){
            $img->description = $request->description;
        }else{
            $img->description = " ";
        }

        if($request->link){
            $img->link = $request->link;
        }else{
            $img->link = " ";
        }

        if($request->alt){
            $img->alt = $request->alt;
        }else{
            $img->alt = " ";
        }
        
        $img->visible = $request->visible;
        $img->tipo_id = $request->tipo_id;

        if($request->hasFile('miImagen')) {
            
            if($request->file('miImagen')->getSize() >= 1024){
                $redondeo = round($request->file('miImagen')->getSize()/1024, 1);
                $img->size = $redondeo .' kb';
            }else{
                $redondeo = $request->file('miImagen')->getSize();
                $img->size = $redondeo .' bytes';
            }
        }
        
        $img->save();

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
       $imagen = Image::findOrfail($id);
       Storage::delete('public/imagenes/' . $imagen->image);
       $imagen->delete();
       return('Registro eliminado correctamente!!');
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

    public function searchTextoMini(Request $request){

        $bandera = true;
        $tipo = "Tipo imagen";

        if($request->result == 'visible'){

            $resp = Image::where('visible', '=', 1)->orderBy('orden', 'Asc')->get();
            $bandera = false;
            $tipo = "Visible";
        }

        if($request->result == 'no visible' && $bandera == true){
            $resp = Image::where('visible', '=', 0)->orderBy('orden', 'Asc')->get();
            $bandera = false;
            $tipo = "No Visible";
        }

        if($request->result == 'size' && $bandera == true){
            $resp = Image::where('size', '>=', 1000)->orderBy('orden', 'Asc')->get();
            $bandera = false;
            $tipo = "Size";
        }
        
        if($request->result != ''){

            $tipo_imagen = TipoImagen::where('title', '=', $request['result'])->first();
            if($tipo_imagen != ''){
                $resp = Image::where('tipo_id', '=', $tipo_imagen->id)->orderBy('orden', 'Asc')->get();
                $bandera = false;
                $tipo = "tipo imagen";
            }
        }
        
        if($bandera == true){
            $resp = Image::where('image', 'LIKE', '%' . $request['result'] . '%')
                         ->orWhere('description', 'LIKE', '%' . $request['result'] . '%')
                         ->orWhere('alt', 'LIKE', '%' . $request['result'] . '%')->orderBy('orden', 'Asc')->get();
        
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

    public function catalogarAuto(){

        $lista = Storage::allFiles('public/imagenes');
        $imagenes = str_replace("public/imagenes/", "", $lista);
        $fichaImagenes =  Image::orderBy('orden', 'Asc')->get();

        $contador = 0;
        foreach ($imagenes as $imagen) {
        $pareja = false;
           
            if(count($fichaImagenes) > 0){
                foreach ($fichaImagenes as $ficha) {

                    if($imagen === $ficha->image){
                        $pareja = true;
                    }
                }
            }   

            if($pareja == false){

                $img = new Image;

                $preparandoTipo = substr($imagen, 0, 4);
                
                switch ($preparandoTipo) 
                {
                case 'ico_':
                    $img->tipo_id = 5;
                    break;
                case 'sell':
                    $img->tipo_id = 7;
                    break;
                case 'web_':
                    $img->tipo_id = 4;
                    break;
                case 'tari':
                    $img->tipo_id = 3;
                    break;
                case 'colo':
                    $img->tipo_id = 6;
                    break;
                default:
                    $img->tipo_id = 1;
                }

                $preparandoAlt = substr($imagen, 0, -4);

                $img->image = $imagen;
                $img->description = " ";
                $img->link = " ";
                $img->alt = "sutoldo, imagen de " . $preparandoAlt;
                $img->visible = 1;
                $img->orden = $contador++;
                
                if(Storage::size('/public/imagenes/'. $imagen) >= 1024){
                    $img->size = round(Storage::size('/public/imagenes/'. $imagen) /1024, 1);
                }else{
                    $img->size = Storage::size('/public/imagenes/'. $imagen);
                }
                
                $img->save();
            }
        }

        return 'Imagenes catalogadas!!';
    }

    public function imagenTipo()
    {
       return TipoImagen::orderBy('id', 'Asc')->get();
    }

    public function order(Request $request){

        for ($i=0; $i < count($request->all()); $i++) { 
            $image =  Image::where( 'id', $request[$i]['id'])->first();
            $image->orden =$request[$i]['orden'];
            $image->save();
        }

        return 'ok';
    }

    public function ordenAutomatico()
    {
        //Gate::authorize('haveaccess', 'access.permisos');
        $images =  Image::orderBy('orden', 'Asc')->get();
        $contador = 0;

        foreach ($images as $item) {
            
            $image =  Image::where('id', '=', $item->id)->first();
            $image->orden = $contador;
            $image->save();
            $contador++;
        }

        return response()->json('orden guardado!', 200);
    }

    public function editarPortada(Request $request)
    {  

        $file_w =$request->file('miImagen_w');

            if(!empty($file_w)){

                $img_w =  Image::where( 'image', 'portada1hg.jpg')->first();
                $name_w = "";
                if(isset( $file_w ) && isset( $request->miImagen_w )){
                    //$name_w = $request->file('miImagen_w')->getClientOriginalName();
                    $name_w = 'portada1hg.jpg';
                }

                if($request->hasFile('miImagen_w')) {
                
                    if($request->file('miImagen_w')->getSize() >= 1024){
                        $img_w->size = round($request->file('miImagen_w')->getSize()/1024, 1) .' kb';
                    }else{
                        $redondeo = $request->file('miImagen_w')->getSize();
                        $img_w->size = $redondeo .' bytes';
                    }
                }

                $request->miImagen_w->move(public_path('storage/imagenes/'), $name_w);
                $img_w->save();
            }

        $file_m =$request->file('miImagen_m');
 
            if(!empty($file_m)){

                $img_m =  Image::where( 'image', 'portada1m.jpg')->first();
                $name_m = "";
                if(isset( $file_m ) && isset( $request->miImagen_m )){
                    //$name_m = $request->file('miImagen_m')->getClientOriginalName();
                    $name_m = 'portada1m.jpg';
                }

                if($request->hasFile('miImagen_m')) {
                
                    if($request->file('miImagen_m')->getSize() >= 1024){
                        $img_m->size = round($request->file('miImagen_m')->getSize()/1024, 1) .' kb';
                    }else{
                        $redondeo = $request->file('miImagen_m')->getSize();
                        $img_m->size = $redondeo .' bytes';
                    }
                }

                $request->miImagen_m->move(public_path('storage/imagenes/'), $name_m);
                $img_m->save();
            }

        return 'Datos editados correctamente!!';
        
    }
}
=======
<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use App\Models\TipoImagen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess', 'access.permisos');
        $images =  Image::orderBy('orden', 'Asc')->get();
        return response()->json($images, 200);
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
    
         //$filename = time() . $request->image->extension();

        $file =$request->file('miImagen');
        if(isset( $file ) && isset( $request->miImagen )){
            $name = $request->file('miImagen')->getClientOriginalName();
        }else{
            return response()->json('Es necesario una imagen!!', 406);
        }
        
        $lista = Storage::allFiles('public/imagenes');
        if($lista){
            $lista = str_replace("public/imagenes/", "", $lista);

            foreach ($lista as $value) {
                if($value == $name){
                    return response()->json( 'Esta imagen es repetida!!', 406);
                }
            }
        }else{
            return response()->json( 'Ocurrio un error en buscar imagenes en el servidor', 406);
        }
        
        $img = new Image;

        if($request->image){
            $img->image = $request->image;
        }else{
            return response()->json( 'El nombre de la imagen es requerido', 406);
        }

        if($request->description){
            $img->description = $request->description;
        }else{
            $img->description = " ";
        }

        if($request->link){
            $img->link = $request->link;
        }else{
            $img->link = " ";
        }

        if($request->alt){
            $img->alt = $request->alt;
        }else{
            $img->alt = " ";
        }

        if($request->file('miImagen')->getSize() >= 1024){
            $redondeo = round($request->file('miImagen')->getSize()/1024, 1);
            $img->size = $redondeo .' kb';
        }else{
            $redondeo = $request->file('miImagen')->getSize();
            $img->size = $redondeo .' bytes';
        }

        $img->visible = $request->visible;
        $img->tipo_id = $request->tipo_id;
        $img->orden = $request->orden;
        $img->save();

        $request->miImagen->move(public_path('storage/imagenes/'), $name);
  
        return response()->json( "Imagen guardada", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Image $img)
    {
        return response()->json($img);
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

        $img =  Image::where( 'id', $id)->first();

        $file =$request->file('miImagen');
        if(isset( $file ) && isset( $request->miImagen )){
            $name = $request->file('miImagen')->getClientOriginalName();
        }

        $img =  Image::where( 'id', $request->id)->first();

        $img->image = $request->image;

        if($request->description){
            $img->description = $request->description;
        }else{
            $img->description = " ";
        }

        if($request->link){
            $img->link = $request->link;
        }else{
            $img->link = " ";
        }

        if($request->alt){
            $img->alt = $request->alt;
        }else{
            $img->alt = " ";
        }
        
        $img->visible = $request->visible;
        $img->tipo_id = $request->tipo_id;

        if($request->hasFile('miImagen')) {
            
            if($request->file('miImagen')->getSize() >= 1024){
                $redondeo = round($request->file('miImagen')->getSize()/1024, 1);
                $img->size = $redondeo .' kb';
            }else{
                $redondeo = $request->file('miImagen')->getSize();
                $img->size = $redondeo .' bytes';
            }
        }
        
        $img->save();

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
       $imagen = Image::findOrfail($id);
       Storage::delete('public/imagenes/' . $imagen->image);
       $imagen->delete();
       return('Registro eliminado correctamente!!');
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

    public function searchTextoMini(Request $request){

        $bandera = true;
        $tipo = "Tipo imagen";

        if($request->result == 'visible'){

            $resp = Image::where('visible', '=', 1)->orderBy('orden', 'Asc')->get();
            $bandera = false;
            $tipo = "Visible";
        }

        if($request->result == 'no visible' && $bandera == true){
            $resp = Image::where('visible', '=', 0)->orderBy('orden', 'Asc')->get();
            $bandera = false;
            $tipo = "No Visible";
        }

        if($request->result == 'size' && $bandera == true){
            $resp = Image::where('size', '>=', 1000)->orderBy('orden', 'Asc')->get();
            $bandera = false;
            $tipo = "Size";
        }
        
        if($request->result != ''){

            $tipo_imagen = TipoImagen::where('title', '=', $request['result'])->first();
            if($tipo_imagen != ''){
                $resp = Image::where('tipo_id', '=', $tipo_imagen->id)->orderBy('orden', 'Asc')->get();
                $bandera = false;
                $tipo = "tipo imagen";
            }
        }
        
        if($bandera == true){
            $resp = Image::where('image', 'LIKE', '%' . $request['result'] . '%')
                         ->orWhere('description', 'LIKE', '%' . $request['result'] . '%')
                         ->orWhere('alt', 'LIKE', '%' . $request['result'] . '%')->orderBy('orden', 'Asc')->get();
        
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

    public function catalogarAuto(){

        $lista = Storage::allFiles('public/imagenes');
        $imagenes = str_replace("public/imagenes/", "", $lista);
        $fichaImagenes =  Image::orderBy('orden', 'Asc')->get();

        $contador = 0;
        foreach ($imagenes as $imagen) {
        $pareja = false;
           
            if(count($fichaImagenes) > 0){
                foreach ($fichaImagenes as $ficha) {

                    if($imagen === $ficha->image){
                        $pareja = true;
                    }
                }
            }   

            if($pareja == false){

                $img = new Image;

                $preparandoTipo = substr($imagen, 0, 4);
                
                switch ($preparandoTipo) 
                {
                case 'ico_':
                    $img->tipo_id = 5;
                    break;
                case 'sell':
                    $img->tipo_id = 7;
                    break;
                case 'web_':
                    $img->tipo_id = 4;
                    break;
                case 'tari':
                    $img->tipo_id = 3;
                    break;
                case 'colo':
                    $img->tipo_id = 6;
                    break;
                default:
                    $img->tipo_id = 1;
                }

                $preparandoAlt = substr($imagen, 0, -4);

                $img->image = $imagen;
                $img->description = " ";
                $img->link = " ";
                $img->alt = "sutoldo, imagen de " . $preparandoAlt;
                $img->visible = 1;
                $img->orden = $contador++;
                
                if(Storage::size('/public/imagenes/'. $imagen) >= 1024){
                    $img->size = round(Storage::size('/public/imagenes/'. $imagen) /1024, 1);
                }else{
                    $img->size = Storage::size('/public/imagenes/'. $imagen);
                }
                
                $img->save();
            }
        }

        return 'Imagenes catalogadas!!';
    }

    public function imagenTipo()
    {
       return TipoImagen::orderBy('id', 'Asc')->get();
    }

    public function order(Request $request){

        for ($i=0; $i < count($request->all()); $i++) { 
            $image =  Image::where( 'id', $request[$i]['id'])->first();
            $image->orden =$request[$i]['orden'];
            $image->save();
        }

        return 'ok';
    }

    public function ordenAutomatico()
    {
        //Gate::authorize('haveaccess', 'access.permisos');
        $images =  Image::orderBy('orden', 'Asc')->get();
        $contador = 0;

        foreach ($images as $item) {
            
            $image =  Image::where('id', '=', $item->id)->first();
            $image->orden = $contador;
            $image->save();
            $contador++;
        }

        return response()->json('orden guardado!', 200);
    }

    public function editarPortada(Request $request)
    {  

        $file_w =$request->file('miImagen_w');

            if(!empty($file_w)){

                $img_w =  Image::where( 'image', 'portada1hg.jpg')->first();
                $name_w = "";
                if(isset( $file_w ) && isset( $request->miImagen_w )){
                    //$name_w = $request->file('miImagen_w')->getClientOriginalName();
                    $name_w = 'portada1hg.jpg';
                }

                if($request->hasFile('miImagen_w')) {
                
                    if($request->file('miImagen_w')->getSize() >= 1024){
                        $img_w->size = round($request->file('miImagen_w')->getSize()/1024, 1) .' kb';
                    }else{
                        $redondeo = $request->file('miImagen_w')->getSize();
                        $img_w->size = $redondeo .' bytes';
                    }
                }

                $request->miImagen_w->move(public_path('storage/imagenes/'), $name_w);
                $img_w->save();
            }

        $file_m =$request->file('miImagen_m');
 
            if(!empty($file_m)){

                $img_m =  Image::where( 'image', 'portada1m.jpg')->first();
                $name_m = "";
                if(isset( $file_m ) && isset( $request->miImagen_m )){
                    //$name_m = $request->file('miImagen_m')->getClientOriginalName();
                    $name_m = 'portada1m.jpg';
                }

                if($request->hasFile('miImagen_m')) {
                
                    if($request->file('miImagen_m')->getSize() >= 1024){
                        $img_m->size = round($request->file('miImagen_m')->getSize()/1024, 1) .' kb';
                    }else{
                        $redondeo = $request->file('miImagen_m')->getSize();
                        $img_m->size = $redondeo .' bytes';
                    }
                }

                $request->miImagen_m->move(public_path('storage/imagenes/'), $name_m);
                $img_m->save();
            }

        return 'Datos editados correctamente!!';
        
    }
}
>>>>>>> e82a5fbc1bfb0f06169fa8025500f4026917e1b9
