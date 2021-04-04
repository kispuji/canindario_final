<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Canindario') }}
        </h2>
    </x-slot>
    <div class="flex flex-col w-3/4 my-2 mx-auto h-screen bg-white rounded-lg shadow-2xl">
        <div class="mx-auto w-72 my-6 pt-10">
            <img class="rounded-full h-52" src="{{asset('img/logo.jpg')}}" alt="logo">
        </div>
        <div class="mx-auto mb-8">
            <h2 class="text-center text-4xl font-extrabold tracking-wider uppercase">Canindario</h2>
        </div>
        <div class="mx-auto w-3/5">
            <p class="text-lg font-semibold text-gray-800 mb-4">
                Registrate en Canindario y lleva un registro de las actividades que realizas, dentro de la
                aplicación tendrás opción de:
            </p>
            <ul class="pl-12 my-4">
                <li class="text-md text-gray-500">Gestionar los trabajadores</li>
                <li class="text-md text-gray-500">Gestionar los perros</li>
                <li class="text-md text-gray-500">Almacenar tus entrenamientos</li>
                <li class="text-md text-gray-500">Crear informes</li>
            </ul>
        </div>
        <div class="mx-auto mt-4">
            <a href="{{ route('login') }}" class="button-actualizar mx-2">Logueate</a>
            <a href="{{ route('register') }}" class="button-actualizar mx-2">Registrate</a>
        </div>
    </div>
</x-app-layout>
