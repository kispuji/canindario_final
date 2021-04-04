<div class="flex flex-wrap justify-center my-2 mx-2">
    <a href="{{route('diarios')}}">    
        <div class="card">
            <img src="{{asset('img/paseo.jpg')}}" alt="Trabajadores" class="mx-auto py-2 rounded-full">
            <h4 class=" text-center font-bold uppercase">Diarios</h4>
            <p class="px-2 py-4 text-justify">
                <ul>
                    <li class="px-6 font-bold">Entrenamientos diarios:</li>
                    <li class="px-14 pt-2">Paseo</li>
                    <li class="px-14">Carrera</li>
                </ul>
            </p>
        </div>
    </a>
    <a href="{{route('obediencia')}}"> 
        <div class="card">
            <img src="{{asset('img/Obediencia.jpg')}}" alt="Perros" class="mx-auto py-2 rounded-full">
            <h4 class=" text-center font-bold uppercase">Obediencia</h4>
            <p class="px-2 py-4 text-justify">
                <ul>
                    <li class="px-6 font-bold">Entrenamientos de obedicencia:</li>
                    <li class="px-14 pt-2">Conducta</li>
                    <li class="px-14">Direccionamiento</li>
                </ul>
            </p>
        </div>
    </a>
    <a href="{{route('busqueda')}}"> 
        <div class="card">
            <img src="{{asset('img/Busqueda.jpg')}}" alt="Busqueda" class="mx-auto py-2 rounded-full">
            <h4 class=" text-center font-bold uppercase">Búsqueda</h4>
            <p class="px-2 py-4 text-justify">
                <ul>
                    <li class="px-6 font-bold">Entrenamientos de búsqueda:</li>
                    <li class="px-14 pt-2">Explosivos</li>
                    <li class="px-14">Personas</li>
                </ul>
            </p>
        </div>
    </a>
</div>