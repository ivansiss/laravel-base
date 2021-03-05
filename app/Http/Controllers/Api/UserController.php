<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserController extends Controller
{

    use RegistersUsers;


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Gate::authorize('haveaccess', 'access.user');
        $users =  User::orderBy('created_at', 'Desc')->paginate(100);

        foreach($users as $user){
            $user->rol = $user->roles;
        }
   
        return response()->json( $users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $user = User::where('email', $request->input('email'))->first();

        if($user){
            return 'Este email esta en uso!!';
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'email_verified_at' => "2020-10-26 23:01:11",
            'remember_token' => NULL,
            'estado' => $request->input('estado'),
            'password' => Hash::make($request->input('password')),
            'orden' => $request->input('orden'),
        ]);

        $user->roles()->sync([ $request->input('role_id') ]);
        
        return 'Datos guardados correctamente!!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
  
        $user = User::findId($user->id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
 
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {

        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->email_verified_at = '2020-10-26 23:01:11';
        $usuario->remember_token = NULL;
        $usuario->estado = $request->input('estado');
        $usuario->password = Hash::make('12345678');
        $usuario->roles()->attach( $request->input('role_id')); //this executes the insert-query
        $usuario->save();

        return 'Usuario actualizado!!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
       if(!isset($usuario)){
            return response()->json( 'No encuentro el usuario', 401);
       } 

       if($usuario->roles[0]->name == 'Super'){
            return response()->json( 'No tienes permiso para borrarme!!', 401);
       }
       $usuario->delete();
       return 'Usuario Eliminado!!';
    }

    public function searchTexto(Request $request){

        $resp = User::where('name', 'LIKE', '%' . $request->consulta . '%')
        ->orWhere('email', 'LIKE', '%' . $request->consulta . '%')->orderBy('orden', 'Asc')->paginate(20);

        $ultimoRegistro = $resp[count($resp)-1]->orden;
        foreach($resp as $user){
            $user->rol = $user->roles;
            $user->ultimo = $ultimoRegistro;
        }
        
        return response()->json( $resp, 200);
    }

    public function getListarPermisosByUsuario(Request $request){

        //busca usuario
        $id = $request->input('id');
        $user = User::findOrFail($id);
        
        //busca el rol del usuario
        $userRolId = $user->roles[0]->pivot->role_id;

        $rol = Role::findOrFail($userRolId);
        $permisos = $rol->permissions;
        
        $perm = [];
        foreach ($permisos as $item) {
            array_push($perm, $item->slug);
        }

        //return json_encode($perm);
        return response()->json( $perm, 200);

    }

    public function order(Request $request){

        for ($i=0; $i < count($request->all()); $i++) { 
 
            $user = User::where( 'id', '=', $request[$i]['id'])->first();
            $user->orden =$request[$i]['orden'];
            $user->save();
        }

        // for ($i=0; $i < count($request->all()); $i++) { 
        //     User::where('id', $request[$i]['id'])
        //         ->update(['orden' => $request[0]['orden']]);
        // }

        return response()->json( 'ok' , 200);
    }

    public function ordenAutomatico(Request $request)
    {
        $contador = 0;
        for ($i=0; $i < count($request->all()); $i++) { 
 
            $user = User::where( 'id', '=', $request[$i]['id'])->first();
            $user->orden = $contador;
            $user->save();
            $contador++;
        }

        return response()->json('ok', 200);
    }
}
