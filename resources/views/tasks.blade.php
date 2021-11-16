<!--el extends layouts.app significa que vamos a usar como-->
<!--base para crear los demás layouts-->
@extends('layouts.app')

<!--lo que tenemos entre el section y el end section será inyectado-->
<!--dentro de la directiva @yield('content') dentro del layout app.blade.php-->
@section('content')

    <!-- La vista hija que ereda de app.blade.php -->

    <div class="panel-body">
        <!-- con este include añadimos los errores que pueda tener la página -->
        <!--esta directiva cargará la plantilla que se encuentra en la ruta-->
        <!--resources/views/common/errors.blade.php-->
        @include('common.errors')

        <!-- Un nuevo task -->
        <form action="{{ url('task') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Nombre de la task -->
            <div class="form-group">
                <!-- Un icono muy lindos de task list agregado mediante bootstrap-->
                <label for="task" class="col-sm-3 control-label"><i class="bi bi-list-task"></i>Tarea</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            <!-- Botón para añadir la task -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                    <i class="bi bi-patch-plus-fill"></i> Añadir nueva tarea<i class="bi bi-patch-plus-fill"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Task actual en la que estamos -->
    <!-- Le he ido metiendo cosas de bootstrap como un panel con heading y body -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="bi bi-list"></i>Tarea Actual
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Heading -->
                    <thead>
                        <!-- Un icono muy lindos de task list agregado mediante bootstrap-->
                        <th><i class="bi bi-list-task"></i>Tarea</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        <!-- Recorremos las tareas que tenemos para ir sacandolas en una tabla -->
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <!-- le establecemos en nombre de la tarea que queremos mostrar -->
                                <!-- este es el nombre de la tarea que vamos a mostrar, sería como el título por así decir -->
                                <td class="table-text">
                                    <div><i class="bi bi-bookmarks-fill"></i>{{ $task->name }}</div>
                                </td>

                                <td>
                                    <tr>
                                        <!-- Task Name -->
                                        <!-- Le establecemos el nombre de la tarea que queremos motrar -->
                                        <!-- Esto sería la tarea como tal, esto es lo que va a permitir eliminar la tarea ya que es lo que va a  tener el delete -->
                                        <td class="table-text">
                                            <div><i class="bi bi-bookmark-check-fill"></i>{{ $task->name }}</div>
                                        </td>

                                        <!-- Delete Button -->
                                        <!-- Le agregamo el botón para eliminar las tareas-->
                                        <td>
                                            <!-- Al pulsar el botón se enviará una petición al método delete de la task con el id correspondiente -->
                                            <form action="{{ url('task/'.$task->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                
                                                <!-- Un boton tipo submit con un poco de alegría gracias a bootstrap -->
                                                <button type="submit" class="btn btn-danger">
                                                    <!-- Iconos que he ido sacando de la página https://icons.getbootstrap.com/ -->
                                                    <!-- ya que se trata de un botón de eliminación he añadido un icono de basura -->
                                                    <i class="bi bi-trash-fill"></i> Borra esto por favor
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection