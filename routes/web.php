<?php

//Nunca hay necesidad de especificar cuando un archivo es .php ya que se intuye que absolutamente todos
//los archivos en la carpeta son PHP

//Direccion del paquete Route, libreria para rutas

use App\Http\Controllers\categoriescontroller;
use App\Http\Controllers\todoscontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Cuando sea una solicitud GET a mi directorio RAIZ, se ejecuta la siguiente función.
Route::get('/', function () {
    //Aqui se regresa una vista
    return view('welcome');
});

//Estas rutas parecidas a las de Express permiten al usuario hacer
//uso de multiples rutas dentro de su propia aplicacion.
/*Route::get('/tareas', function () {
    //Aqui se regresa una vista

    /*La notacion del punto dentro de las vistas indica que estamos haciendo referencia a una
    carpeta, misma que ha sido creada dentro de la carpeta views.
    
    Despues del punto está la pagina que queremos ver, index. No hace falta especificar
    el .blade.php ya que su uso es obligatorio.

    
    return view('tareas.index');
})->name('todos');*/

Route::post('/tareas', [todoscontroller::class, 'store'])->name('todos');
Route::get('/tareas', [todoscontroller::class, 'index'])->name('todos');
Route::get('/tareas/{id}', [todoscontroller::class, 'show'])->name('todos-edit');

Route::patch('/tareas/{id}', [todoscontroller::class, 'update'])->name('todos-update');
Route::delete('/tareas/{id}', [todoscontroller::class, 'destroy'])->name('todos-destroy');

Route::resource('categories', categoriescontroller::class);

//Tambien vamos a poder retornar solo texto.
/*Route::get('/hola', function () {
    //Aqui se regresa un texto
    return 'Hola a todos desde esta ruta';
});

*/