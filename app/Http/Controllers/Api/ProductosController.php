<?php

namespace App\Http\Controllers\Api;


use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess', 'access.product');
        $productos =  Product::orderBy('orden', 'Asc')->get();
        return response()->json($productos, 200);
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
        $file = $request->file('miPdf');
        $producto = Product::find($request->id);
        
        if(empty($request->pdf)){
            $name = "";
        }else{
            $name = $request->pdf;
        }
        
        if(isset( $file ) && isset( $request->miPdf )){

            $name = $request->file('miPdf')->getClientOriginalName();

            if($producto->pdf != $name){
                Storage::delete('public/pdfs/' . $producto->pdf);
            }

            $lista = Storage::allFiles('public/pdfs');

            if($lista){

                $lista = str_replace("public/pdfs/", "", $lista);

                foreach ($lista as $value) {
                    if($value == $name){
                        return response()->json( 'Este pdf es repetido!!', 406);
                    }
                }  
            }

            $request->miPdf->move(public_path('storage/pdfs/'), $name);
        }
        
        $producto = Product::create([
            'titulo' => $request->titulo,
            'resena' => $request->resena,
            'subtitulo' => $request->subtitulo,
            'contenido' => $request->contenido,
            'slug' => $request->slug,
            'pdf' => $name,
            'orden' => $request->orden,
            'estado' => $request->estado
        ]);

        $ids = explode(' ', $request->imagenes);

        
        foreach ($ids as $item) {
            $imagen =  Image::where('id', $item)->first();
            $imagen->link = $request->slug;
            $imagen->save();
        }

        $producto->images()->sync( $ids );
        
        return 'Datos guardados correctamente!! ';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $producto)
    {
        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return null;
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
        $file = $request->file('miPdf');
        $producto = Product::find($request->id);
        
        if(empty($request->pdf)){
            $name = "";
        }else{
            $name = $request->pdf;
        }
        
        if(isset( $file ) && isset( $request->miPdf )){

            $name = $request->file('miPdf')->getClientOriginalName();

            if($producto->pdf != $name){
                Storage::delete('public/pdfs/' . $producto->pdf);
            }

            $lista = Storage::allFiles('public/pdfs');

            if($lista){

                $lista = str_replace("public/pdfs/", "", $lista);

                foreach ($lista as $value) {
                    if($value == $name){
                        return response()->json( 'Este pdf es repetido!!', 406);
                    }
                }  
            }

            $request->miPdf->move(public_path('storage/pdfs/'), $name);
        }

        if($producto){

            $producto->titulo = $request->titulo;
            $producto->resena = $request->resena;
            $producto->subtitulo = $request->subtitulo;
            $producto->contenido = $request->contenido;
            $producto->slug = $request->slug;
            $producto->pdf = $name;
            $producto->estado = $request->estado;
            $producto->save();

            $ids = explode(' ', $request->imagenes);

            foreach ($ids as $item) {

                $imagen =  Image::where('id', $item)->first();

                if($imagen->tipo_id == 1){
                    $imagen->link = $request->slug;
                    $imagen->save();
                }
            }

            $producto->images()->sync( $ids );
        }

        return response()->json( 'Producto actualizado!!', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $producto)
    {
       $producto->delete();
       return('Registro eliminado correctamente!!');
    }

    public function search(Request $request){

        $bandera = true;

        if($request->consulta == 'visible'){

            $resp = Product::where('estado', '=', 1)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
        }

        if($request->consulta == 'no visible' && $bandera == true){
            $resp = Product::where('estado', '=', 0)->orderBy('orden', 'Asc')->paginate(20);
            $bandera = false;
        }

        if($bandera == true){
            $resp = Product::where('titulo', 'LIKE', '%' . $request->consulta . '%')
                           ->orWhere('resena', 'LIKE', '%' . $request['consulta'] . '%')
                           ->orWhere('contenido', 'LIKE', '%' . $request['consulta'] . '%')->orderBy('orden', 'Asc')->paginate(20);
        }

        if(count($resp)){

            $todos = Product::orderBy('orden', 'Asc')->get();
            $ultimoRegistro = $todos[count($todos)-1]->orden;
            foreach($resp as $prod){
                $prod->ultimo = $ultimoRegistro;
            }

            return response()->json( $resp, 200);
        }

        return response()->json( [], 200);
    }

    public function searchTexto(Request $request){

        if($request->input('del') == "select"){

            return Product::where($request->input('campo'), $request->input('result'))->orderBy('orden', 'Asc')->paginate(5);  
        }

        if($request->input('del') == "input"){

            if($request->input('result') == ""){
                return Product::orderBy('orden', 'Asc')->paginate(5);
            }

            return Product::where('titulo', 'LIKE', '%' . $request->input('result') . '%')->orderBy('orden', 'Asc')->paginate(5);
        }

        return Product::orderBy('orden', 'Asc')->paginate(5);
        
    }

    public function eliminarPdf(Request $request){

        $producto = Product::findOrfail($request->id);
        $producto->pdf = "";
        $producto->save();
        Storage::delete('public/pdfs/' . $request->nombre);
        return('Pdf eliminado correctamente!!');
    }

    public function order(Request $request){

        for ($i=0; $i < count($request->all()); $i++) { 
            $product =  Product::where( 'id', $request[$i]['id'])->first();
            $product->orden =$request[$i]['orden'];
            $product->save();
        }

        return 'Productos ordenados correctamente!!';
    }

    public function ordenAutomatico()
    {
        //Gate::authorize('haveaccess', 'access.permisos');
        $productos =  Product::orderBy('orden', 'Asc')->get();
        $contador = 0;

        foreach ($productos as $item) {
            
            $produto =  Product::where('id', '=', $item->id)->first();
            $produto->orden = $contador;
            $produto->save();
            $contador++;
        }

        return response()->json('orden guardado!', 200);
    }

    public function generarPdf(){

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];

        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView("ejemplo", [
            "nombre" => "Luis Cabrera Benito",
        ]);

        return $dompdf->stream();
        $dompdf->download('prueba.pdf');
    }

}
