<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\ImagesController;
use App\Http\Controllers\Web\InicioController;
use App\Http\Controllers\Web\PaginasController;
use App\Http\Controllers\Web\ProductoController;
use App\Http\Controllers\Auth\LoginControllerVue;
use App\Http\Controllers\Auth\ForgotPasswordController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes([
    'register' => false,
]);


//WEB --------------------------------------------------------------------------------------
Route::get('/', [InicioController::class, 'index'])->name('inicio');


//ADMINISTRACIÓN ---------------------------------------------------------------------------
Route::get('/administracion/{opcional?}', function () {
    return view('app');
})->name('basepath')->where('opcional', '.*');


Route::post('/administracion/authenticate/login', [LoginControllerVue::class, 'login'])->name('login-vue');
Route::post('/administracion/authenticate/logout', [LoginControllerVue::class, 'logout'])->name('logout-vue');
Route::get('/authenticate/getRefrescarUsuarioAutenticado', function (){
    return Auth::user();
});

//ADMINISTRACIÓN SUBIR IMÁGENES
Route::post('/administracion/imagenes/guardada', [ImagenController::class, 'subirImagen'])->name('guardarimagenes');
Route::put('/subirImagen', [ImagesController::class, 'subirImagen']);
Route::post('/search', [ImagesController::class, 'search']);

//EMAIL DE RECUPERACIÓN
Route::post('/password/email',[ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/estas/{nombre}/{search?}', [PaginasController::class, 'getPagina'])->name('paginas');
Route::post('/estas/formacion/{search?}', [PaginasController::class, 'search'])->name('paginas.search');

Route::get('/fabricante/{nombre}', [ProductoController::class, 'getProducto'])->name('paginas');

Route::get('/productos/pdf', [ProductoController::class, 'generarPdf'])->name('pdf');

//PRUEBAS

/*Route::get('/test', function () {
   // $user = User::find(1);
    //Gate::authorize('haveaccess', 'role.index');
    return Auth::user();

    /*return $user->havePermission('role.create');
});*/

//todas las rutas menos show
//Route::Resource('administracion/post', PostController::class, ['except' => 'show']);
//Route::resource('admin/post', [App\Http\Controllers\Administracion\PostController::class, 'index']);
/*Route::namespace("\App\Http\Controllers\Administracion")->group(function () {
    Route::get("/post", "PostController@index");
});*/
/*
Route::get('/home', [App\Http\Controllers\pruebaController::class, 'index'])->name('home');
Route::namespace("App\Http\Controllers")->group(function () {
    Route::get("/users", "UserController@index");
}); */

Route::get('/test', function(){

    /*return Image::create([
        'image' => 'boj.png',
        'description' => 'arbolito boj description',
        'link' => 'arbolito boj link',
        'alt' => 'arbolito boj alt',
        'visible' => 1,
        'tipo' => 'web',
    ]);*/

    //php artisan make:migration create_category_post_table --create=category_post

    $post = Post::find(2);
    $post->images()->sync([1]);
    return $post->images;

});

