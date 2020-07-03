<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('welcome', function () {
    return "Hola mundo";
});

Route::get('bye', function () {
    return "Adiós!!";
});

// Match --> valdría tanto get como post. Para no repetir peticiones.
Route::match(['get', 'post'], 'match', function () {
    return "Prueba de Match";
});

// Any --> cogería todas las peticiones, get, post, put, delete
Route::any('any', function () {
    return "Prueba de Any";
});

// Ver URL e imprimirla por pantalla
Route::any('url', function () {
    $url = url('welcome');
    return "Estás en la ruta " . $url;
});

// --------------------------------
// PARÁMETROS
Route::get('parametro/{id}', function ($id) {
    return "El id es el " . $id;
});

// Parámetro opcional
Route::get('parametro/{id?}', function ($id = null) {
    if ($id == null) {
        return "ID no especificado";
    } else {
        return "El id es el " . $id;
    }
});

// --------------------------------
// Expresiones regulares en ruta
// solamente se va a encontrar la ruta cuando se le pasa un parametro numerico
Route::pattern('idNumerico', '\d+');
Route::get('parametroExpRegular/{idNumerico}', function ($idNumerico) {
    return "El id es el " . $idNumerico;
});

// --------------------------------
// Renombrado de rutas
Route::get('user/profile', ['as' => 'profile', function () {

    $url = route('profile');
    return "This url is: " . $url;

}]);

Route::get('user/{id}/profile', ['as' => 'profile', function ($id) {

    $url = route('profile', ['id' => $id]);
    return 'This url is: ' . $url;

}]);

// --------------------------------
// Grupos de rutas
Route::get('user/profile', ['as' => 'profile', function () {
    $url = route('profile');
    return "This url is: " . $url;
}]);

Route::get('user/{id}/profile', ['as' => 'profile', function ($id) {
    $url = route('profile', ['id' => $id]);
    return 'This url is: ' . $url;
}]);

// --------------------------------
// Proteccion CSRF
Route::post('home/articles/store', [
    'Middleware' => 'auth',
    'Before' => 'csrf',
    'Uses' => 'PostController@store',
]);

// ----------------------------------------------
// Acceder a un método del controlador
Route::get('post/{id}', [
    'uses' => 'PostController@show',
]);

// ----------------------------------------------
// middleware --> proporcionan un mecanismo para filtrar peticiones a la aplicación.
Route::post('middleware', [
    'Middleware' => 'auth',
    'Uses' => 'PostController@middleware',
]);

// ACCESO A DATOS
Route::get('mostrardatos', 'PostController@mostrarTodosLosDatos');

Route::get('mostrardato/{id}', 'PostController@mostrarUnSoloDato');

Route::get('sinoSeEncuentraMuestraError/{id}', 'PostController@sinoSeEncuentraMuestraError');

Route::post('post/update/{id}', [
    'middleware' => 'auth',
    'before' => 'csrf',
    'uses' => 'PostController@update',
]);

Route::get('eliminarDato/{id}', 'PostController@eliminarDato');

Route::get('insertar', 'PostController@create');

Route::post('post/store', [
    'middleware' => 'auth',
    'uses' => 'PostController@store',
]);

// VISTAS
Route::get('inicio', 'Controller@inicio');
