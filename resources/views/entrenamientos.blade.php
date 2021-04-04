<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Entrenamientos') }}
        </h2>
    </x-slot>

    <div class="h-auto">

        <div class="bg-white mx-4 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="px-4 pt-4">
                <a href="{{url('dashboard')}}" class="a_volver">< Volver</a>
            </div>
            <x-card_training></x-card_training>   
        </div>

    </div>
</x-app-layout>