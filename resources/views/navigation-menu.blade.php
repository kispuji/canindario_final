@php
    $nav_links = [
        [

            'name' => "Home",
            'route' => route('dashboard'),
            'active' => request()->routeIs('dashboard')
        ],
        [
            'name' => "Trabajadores",
            'route' => route('trabajadores'),
            'active' => request()->routeIs('trabajadores')
        ],
        [
            'name' => "Perros",
            'route' => route('perros'),
            'active' => request()->routeIs('perros')
        ],
        [
            'name' => "Entrenamientos",
            'route' => route('entrenamientos'),
            'active' => request()->routeIs('entrenamientos', 'diarios', 'obediencia', 'busqueda')
        ],
        [
            'name' => "Informes",
            'route' => route('informes'),
            'active' => request()->routeIs('informes')
        ]
    ]
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    
    
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex pr-4 justify-between h-18">
            <div class="flex">
                <!-- Logo -->
                <div class="w-20 my-2">
                    @auth
                        <a href="{{ route('dashboard') }}">
                            <x-jet-application-mark class="block h-9 w-auto" />
                        </a>
                    @else
                        <a href="{{ route('home') }}">
                            <x-jet-application-mark class="block h-9 w-auto" />
                        </a>
                    @endauth

                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth                       
                        @foreach ($nav_links as $nav_link)
                            <x-jet-nav-link href="{{ $nav_link['route'] }}" :active="$nav_link['active']">
                                {{ $nav_link['name'] }}
                            </x-jet-nav-link>
                        @endforeach
                    @endauth
                </div>
            </div>

            <!-- Menu de la derecha -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    @auth
                <!-- Menu hamburguesa -->
                        <x-jet-dropdown align="right" width="48">
                            <!-- Foto -->
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>
                            <!-- Links -->
                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Administrar Cuenta') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Cuenta') }}
                                </x-jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Salir') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    @endauth
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

            {{-- Link de navegación --}}
            @auth
                @foreach ($nav_links as $nav_link)

                    <x-jet-responsive-nav-link href="{{ $nav_link['route'] }}" :active="$nav_link['active']">
                        {{ $nav_link['name'] }}
                    </x-jet-responsive-nav-link>

                @endforeach
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
                   
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="flex-shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                
                <!-- Account Management -->
                <div class="mt-3 space-y-1">

                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Cuenta') }}
                    </x-jet-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Salir') }}
                        </x-jet-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
