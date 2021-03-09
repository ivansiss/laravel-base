<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ImagesController;
use App\Http\Controllers\Api\CuantosController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PermisosController;
use App\Http\Controllers\Api\ProductosController;
use App\Http\Controllers\Api\TemaController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\PieController;
use App\Http\Controllers\Api\PaginasController;
use App\Http\Controllers\Api\MenuSupController;
use App\Http\Controllers\Api\VideosController;
use App\Http\Controllers\Api\SeoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/cuantos', [CuantosController::class, 'cuantos']);


Route::resource('/role', RoleController::class);
Route::resource('/categorias', CategoryController::class);

Route::resource('/usuarios', UserController::class);
Route::post('/usuarios/search', [UserController::class, 'searchTexto']);
Route::post('/usuarios/getListarPermisosByUsuario', [UserController::class, 'getListarPermisosByUsuario']);
Route::post('/usuarios/ordenar', [UserController::class, 'ordenAutomatico']);
Route::post('/usuarios/order', [UserController::class, 'order']);


Route::post('/rol/search', [RoleController::class, 'searchTexto']);

Route::resource('/permisos', PermisosController::class);
Route::post('/permisos/search', [PermisosController::class, 'searchTexto']);
Route::post('/permisos/order', [PermisosController::class, 'order']);
Route::post('/permisos/ordenar', [PermisosController::class, 'ordenAutomatico']);


Route::resource('/post', PostController::class);
Route::post('/post/order', [PostController::class, 'order']);
Route::post('/post/search/text', [PostController::class, 'searchTexto']);
Route::post('/post/search', [PostController::class, 'search']);

Route::resource('/paginas', PaginasController::class);
Route::post('/pagina/order', [PaginasController::class, 'order']);
Route::post('/pagina/search/text', [PaginasController::class, 'searchTexto']);
Route::post('/pagina/search', [PaginasController::class, 'search']);
Route::post('/pagina/filtro', [PaginasController::class, 'paginaFiltro']);

Route::resource('/images', ImagesController::class);
Route::post('/images/ordenar', [ImagesController::class, 'ordenAutomatico']);
Route::post('/images/search', [ImagesController::class, 'searchTexto']);
Route::post('/images/search/mini', [ImagesController::class, 'searchTextoMini']);
Route::post('/images/catalogarAuto', [ImagesController::class, 'catalogarAuto']);
Route::post('/images/tipo', [ImagesController::class, 'imagenTipo']);
Route::post('/image/order', [ImagesController::class, 'order']);

Route::post('image/portada', [ImagesController::class, 'editarPortada']);


Route::resource('/videos', VideosController::class);
Route::post('/videos/guardar', [VideosController::class, 'guardarVideo']);
Route::post('/videos/tipos', [VideosController::class, 'tiposVideos']);
Route::post('/videos/search', [VideosController::class, 'search']);
Route::post('/videos/order', [VideosController::class, 'order']);


Route::resource('/productos', ProductosController::class);
Route::post('/productos/order', [ProductosController::class, 'order']);
Route::post('/productos/order-auto', [ProductosController::class, 'ordenAutomatico']);
Route::post('/productos/search/text', [ProductosController::class, 'searchTexto']);
Route::post('/productos/search', [ProductosController::class, 'search']);
Route::post('/productos/eliminar/pdf', [ProductosController::class, 'eliminarPdf']);


Route::resource('/menu-sup', MenuSupController::class);
Route::get('/menu-sup-hijo/{id}', [MenuSupController::class, 'menuSupHijo']);

Route::resource('/pie', PieController::class);


Route::post('/config/tema', [TemaController::class, 'index']);
Route::post('/general', [GeneralController::class, 'ultimoOrden']);

Route::resource('/seo', SeoController::class);
Route::post('/seo/search', [SeoController::class, 'searchTexto']);





