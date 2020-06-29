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


Route::get('welcome', function (){
    return "Hola mundo";
});

Route::get('bye', function (){
    return "Adiós!!";
});

// Match --> valdría tanto get como post. Para no repetir peticiones.
Route::match(['get', 'post'],  'match', function (){
    return "Prueba de Match";
});

// Any --> cogería todas las peticiones, get, post, put, delete
Route::any('any', function (){
    return "Prueba de Any";
});

// Ver URL e imprimirla por pantalla
Route::any('url', function (){
    $url = url('welcome');
    return "Estás en la ruta " . $url;
});

// --------------------------------
// PARÁMETROS
Route::get('parametro/{id}', function ($id){
    return "El id es el " . $id;
});

// Parámetro opcional
Route::get('parametro/{id?}', function ($id = null){
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
Route::get('parametroExpRegular/{idNumerico}', function ($idNumerico){
    return "El id es el " . $idNumerico;
});

// --------------------------------
// Renombrado de rutas
oute::get('user/profile', ['as' => 'profile', function () {

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
    'Uses' => 'PostController@store'
]);