<?php

namespace App\Http\Controllers\Api;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::authorize('haveaccess', 'access.permisos');
        $permisos =  Permission::orderBy('name', 'Desc')->paginate(100);
        return response()->json($permisos, 200);
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
        $permiso = Permission::where('slug', $request->input('slug'))->first();

        if($permiso){
            return 'Este permiso esta en uso!!';
        }

        $permiso = Permission::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'orden' => $request->input('orden')
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
        //
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
    public function update(Request $request,Permission $permiso)
    {
        $permiso->name = $request->input('name');
        $permiso->slug = $request->input('slug');
        $permiso->description = $request->input('description');

        $permiso->roles()->attach( $request->input('role_id')); //this executes the insert-query
        $permiso->save();

        return 'Usuario actualizado!!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permiso)
    {
        if(!isset($permiso)){
            return response()->json( 'No encuentro el permiso', 401);
       } 

       $permiso->delete();
       return 'Permiso Eliminado!!';

    }

    public function searchTexto(Request $request){

        $resp = Permission::where('name', 'LIKE', '%' . $request->consulta . '%')
        ->orWhere('slug', 'LIKE', '%' . $request->consulta . '%')->orderBy('orden', 'Asc')->paginate(20);

        $ultimoRegistro = $resp[count($resp)-1]->orden;
        foreach($resp as $perm){
            $perm->rol = $perm->roles;
            $perm->ultimo = $ultimoRegistro;
        }
        
        return response()->json( $resp, 200);
    }

    public function order(Request $request){

        for ($i=0; $i < count($request->all()); $i++) { 
 
            $permiso = Permission::where( 'id', '=', $request[$i]['id'])->first();
            $permiso->orden =$request[$i]['orden'];
            $permiso->save();
        }

        // for ($i=0; $i < count($request->all()); $i++) { 
        //     Permission::where('id', $request[$i]['id'])
        //         ->update(['orden' => $request[0]['orden']]);
        // }

        return response()->json( 'ok' , 200);
    }

    public function ordenAutomatico(Request $request)
    {
        $contador = 0;
        for ($i=0; $i < count($request->all()); $i++) { 
 
            $permiso = Permission::where( 'id', '=', $request[$i]['id'])->first();
            $permiso->orden = $contador;
            $permiso->save();
            $contador++;
        }

        return response()->json('ok', 200);
    }
}
