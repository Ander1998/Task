<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

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
    /*no sé porque pero me muestra cada una de las líneas que tengo en
    la base de datos 2 veces y sin embargo solo me deja eliminarlas 1 sola vez*/
    $tasks = Task::orderby('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

Route::post('/task', function(UserController $request) {
    /*<!--validamos que el nombre introducido para la task esté rellenado
    y además le establecemos un tamaño máximo para el campo de 255 caracteres
    lo he sacado de este video: https://www.youtube.com/watch?v=-u-xcYC7TKg
    la segunda parte del video https://www.youtube.com/watch?v=pprodMnNmB0-->*/
    
    /*No funciona ni queriendo, yo quiero llamar al Usercontroler que es el que
    va a manejar el tema de la validación, en el controlador hay un
    use Illuminate\Http\Request; para llamar a la clase Request que se supone
    que hace la validación, pero al intentar hacer el $request->all() me da
     error ya que dice que la clase UserController no tiene un ->all()
    pero se supone que tendría que estar llamando al ->all() del Request, yo que sé*/
    $request->validate($request->all(), [
            'username' => 'required|max:255',
        ]);
    
    //en el caso de que la validación falle vamos a redireccionar al usuario a la página principal
    //además de guardar los datos que había introducido anteriormente y los fallos
    //que ha dado el programa (el tema del required y el tamaño máximo)
    //al pasarle los datos que ha introducido podremos mantenerlos en los campos correspondientes
    //aunque haya errores
    if($request->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($request);
    }

    //creamos una nueva task
    $task = new Task;
    //le establecemos el nombre a la task metiendole lo que viene en la request
    $task->name = $request->name;
    //guardamos la nueva task creadacon el método save
    $task->save();

    //redireccionamos al usuario a la página de inicio de nuevo
    return redirect('/');
});

Route::delete('/task/{task}', function(Task $task) {

    //llamamos a la función delete propia de la clase task
    $task->delete();

    //redireccionamos al usuario a la página de inicio
    return redirect('/');
});
