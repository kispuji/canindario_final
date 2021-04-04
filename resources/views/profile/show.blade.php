<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configuración de la cuenta') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif
            
            {{-- <div class="mt-10 sm:mt-0">
                @livewire('profile-form')
                <x-personal-information-form>
                    <x-slot name="title">
                        {{ __('Datos Personales') }}
                    </x-slot>
                
                    <x-slot name="description">
                        {{ __('Introduzca o actualice información sobre su edad, dirección o profesión.') }}
                    </x-slot>
                
                    <x-slot name="form">
                       
                        <!-- Age -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="age" value="{{ __('Edad') }}" />
                            <x-jet-input id="age" type="number" class="mt-1 block w-full"/>
                        </div>
                
                        <!-- Profession -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="profession" value="{{ __('Profesión') }}" />
                            <x-jet-input id="profession" type="text" class="mt-1 block w-full"/>
                        </div>
                
                        <!-- Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="street" value="{{ __('Calle') }}" />
                            <x-jet-input id="street" type="text" class="mt-1 block w-full"/>
                            <x-jet-label for="number" value="{{ __('Número') }}" />
                            <x-jet-input id="number" type="number" class="mt-1 block w-full"/>
                            <x-jet-label for="town" value="{{ __('Población') }}" />
                            <x-jet-input id="town" type="text" class="mt-1 block w-full"/>
                            <x-jet-label for="town" value="{{ __('Ciudad') }}" />
                            <x-jet-input id="cp" type="text" class="mt-1 block w-full"/>
                            <x-jet-label for="cp" value="{{ __('Código Postal') }}" />
                            <x-jet-input id="street" type="number" class="mt-1 block w-full"/>
                            <x-jet-label for="country" value="{{ __('País') }}" />
                            <x-jet-input id="country" type="text" class="mt-1 block w-full"/>
                        </div>
                    </x-slot>
                
                    <x-slot name="actions">                
                        <x-jet-button>
                            {{ __('Actualizar') }}
                        </x-jet-button>
                    </x-slot>
                </x-personal-information-form>
            </div> --}}
            {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif --}}

           {{--  <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>
 --}}
            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
