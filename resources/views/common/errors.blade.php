<!-- Hacemos un if para comprobar si hay errores-->
@if (count($errors) > 0)
    <!-- Formulario para la lista de errores-->
    <!-- Usamos bootstrap para que quede bien ponpoxo y lendo -->
    <div class="alert alert-danger">
        <!-- Le metemos un mensaje de error personalizado -->
        <strong>Vaya, parece que no sabes agregar tasks de manera simple, quieres que te ayude clipo o que??</strong>
        <br><br>

        <!-- Hacemos una lista para ir sacando todos los errores que ha habido hasta ahora -->
        <!-- En caso de que no haya ningún tipo de error pues no va a mostrar nada -->
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif