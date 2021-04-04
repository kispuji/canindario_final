<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="h-auto">

        <div class="bg-white mx-4 overflow-hidden shadow-xl sm:rounded-lg">
            <x-card></x-card>
        </div>

    </div>
</x-app-layout>
