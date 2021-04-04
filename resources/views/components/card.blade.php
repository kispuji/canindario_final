<div>
    <h2 class="saludo">Bienvenido {{auth()->user()->name}}</h2>
</div>
<div class="flex flex-wrap justify-center my-2 mx-2">
    <a href="{{route('trabajadores')}}">    
        <div class="card">
            <img src="{{asset('img/trabajador2.jpg')}}" alt="Trabajadores" class="mx-auto py-2 rounded-full">
            <h4 class=" text-center font-bold uppercase">Trabajadores</h4>
            <p class="px-2 py-4 text-justify">
                <ul>
                    <li class="px-6">Registrar trabjador</li>
                    <li class="px-6">Listar trabajadores</li>
                    <li class="px-6">Editar trabajador</li>
                    <li class="px-6">Eliminar trabajador</li>
                </ul>
            </p>
        </div>
    </a>
    <a href="{{route('perros')}}"> 
        <div class="card">
            <img src="{{asset('img/perro2.jpg')}}" alt="Perros" class="mx-auto py-2 rounded-full">
            <h4 class=" text-center font-bold uppercase">Perros</h4>
            <p class="px-2 py-4 text-justify">
                <ul>
                    <li class="px-6">Registrar perro</li>
                    <li class="px-6">Listar perros</li>
                    <li class="px-6">Editar perros</li>
                    <li class="px-6">Eliminar perro</li>
                </ul>
            </p>
        </div>
    </a>
    <a href="{{route('entrenamientos')}}"> 
        <div class="card">
            <img src="{{asset('img/entrenamiento2.jpg')}}" alt="Entenamientos" class="mx-auto py-2 rounded-full">
            <h4 class=" text-center font-bold uppercase">Entrenamientos</h4>
            <p class="px-2 py-4 text-justify">
                <ul>
                    <li class="px-6">Registrar entrenamiento</li>
                    <li class="px-6">Listar entrenamiento</li>
                    <li class="px-6">Editar entrenamiento</li>
                    <li class="px-6">Eliminar entrenamiento</li>
                </ul>
            </p>
        </div>
    </a>
    <a href="{{route('informes')}}"> 
        <div class="card">
            <img src="{{asset('img/informe2.jpg')}}" alt="Informes" class="mx-auto py-2 rounded-full">
            <h4 class=" text-center font-bold uppercase">Informes</h4>
            <p class="px-2 py-4 text-justify">
                <ul>
                    <li class="px-6">Crear informe</li>
                </ul>
            </p>
        </div>
    </a>
</div>