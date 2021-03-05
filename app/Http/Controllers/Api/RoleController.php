<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Pasa la informacion a UserPolicy.php
        //$this->authorize('view', User::class);

        //Pasa la informacion a UserPolicy.php
        //$this->authorize('view', $usuario);
        //Gate::authorize('haveaccess', 'access.roles');
        
        $roles =  Role::orderBy('name', 'Desc')->paginate(10);

        foreach($roles as $rol){
            $rol->role_id = $rol->permissions;
        }

        return response()->json($roles, 200);
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
        $role = Role::where('name', $request->input('name'))->first();

        if($role){
            return 'Este rol ya existe!!';
        }

        $rol = Role::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'orden' => $request->input('orden'),
            'full_access' => $request->input('full_access'),
        ]);

        $permis = $request->input('permisos');

        $rol->permissions()->sync( $permis );
        
        return 'Datos guardados correctamente!!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $r = Role::findId($role->id);
        return response()->json($r);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $role->update($request->all());
        $role->permissions()->sync( $request->get('permisos') );
      
        return 'Datos editados correctamente!!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

       if(!isset($role)){
            return response()->json( 'No encuentro el rol', 401);
       } 

       if($role->name == 'Super'){
            return response()->json( 'No tienes permiso para borrarme!!', 401);
       }
       $role->delete();
       return 'Rol Eliminado!!';

    }

    public function searchTexto(Request $request){

        $resp = Role::where('name', 'LIKE', '%' . $request->consulta . '%')
        ->orWhere('slug', 'LIKE', '%' . $request->consulta . '%')->paginate(5);

        $ultimoRegistro = $resp[count($resp)-1]->orden;
        foreach($resp as $rol){
            $rol->permisos = $rol->permissions;
            $rol->ultimo = $ultimoRegistro;
        }
        
        return response()->json( $resp, 200);
    }
}
