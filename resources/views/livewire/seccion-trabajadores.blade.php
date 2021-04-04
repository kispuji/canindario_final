<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Trabajadores') }}
    </h2>
</x-slot>
<div>
    <div class="px-4 py-4">
        <a href="{{url('dashboard')}}" class="a_volver">< Volver</a>
    </div>
    <div class="fondo_formulario">
        <div class="px-2 py-2 w-80">
            <h3 class="h3">{{$titulo}} un trabajador</h3>
        </div>
        {{-- Formulario --}}          
        <div class="flex flex-wrap justify-center">
            <!-- Nombre -->
            <div class="px-2 py-2 w-80">
                <label for="nombre" class="label">Nombre</label>
                <input wire:model="name" id="nombre" type="text" class=" input my-2 block w-full"/>
                @error('name')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            <!-- Apellido -->
            <div class="px-2 py-2 w-80">
                <label for="apellidos" class="label">Apellidos</label>
                <input wire:model="surname" id="apellidos" type="text" class=" input my-2 block w-full"/>
                @error('surname')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            <!-- Age -->
            <div class="px-2 py-2 w-80">
                <label for="edad" class="label">Edad</label>
                <input wire:model="age" id="edad" type="number" class=" input my-2 block w-full"/>
                @error('age')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            <!-- Profession -->
            <div class="px-2 py-2 w-80">
                <label for="profesion" class="label">Profesión</label>
                <input wire:model="profession" id="profesion" type="text" class=" input my-2 block w-full"/>
                @error('profession')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            <!-- Address -->
            <div class="px-2 py-2 w-80">
                <label for="calle" class="label">Calle</label>
                <input wire:model="street" id="calle" type="text" class=" input my-2 block w-full"/>
                @error('street')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            {{-- Number --}}
            <div class="px-2 py-2 w-80">
                <label for="numero" class="label">Número</label>
                <input wire:model="number" id="numero" type="number" class=" input my-2 block w-full"/>
                @error('number')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            {{-- Town --}}
            <div class="px-2 py-2 w-80">
                <label for="poblacion" class="label">Población</label>
                <input wire:model="town" id="poblacion" type="text" class=" input my-2 block w-full"/>
                @error('town')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            {{-- City --}}
            <div class="px-2 py-2 w-80">
                <label for="ciudad" class="label">Ciudad</label>
                <input wire:model="city" id="ciudad" type="text" class=" input my-2 block w-full"/>
                @error('city')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            {{-- Cp --}}
            <div class="px-2 py-2 w-80">
                <label for="cp" class="label">Código Postal</label>
                <input wire:model="cp" id="cp" type="number" class=" input my-2 block w-full"/>
                @error('cp')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            {{-- Country --}}
            <div class="px-2 py-2 w-80">
                <label for="pais" class="label">País</label>
                <input wire:model="country" id="pais" type="text" class=" input my-2 block w-full"/>
                @error('country')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
        </div>
            
        {{-- Botones --}}
        <div class="boton_formulario sm:px-6">
            @if ($action == 'guardar')
                <button wire:click="{{$action}}" class="button-actualizar">Registrar</button>
            @else
                <button wire:click="{{$action}}" class="button-actualizar mr-2">Actualizar</button>
                <button wire:click="resetear" class="button-actualizar">Cancelar</button>
            @endif
        </div>    
    </div>

    <div class="fondo_tablas">
        @if ($existenTrabajadores)
            <div class="tabla">
                <table class="w-full">
                    <thead class="bg-gray-600 border-gray-600">
                        <tr class="titulo_tabla">
                            <th class="px-6 py-3">Nombre</th>
                            <th class="px-6 py-3">Apellidos</th>
                            <th class="px-6 py-3">Edad</th>
                            <th class="px-6 py-3">Profesion</th>
                            <th class="px-6 py-3">Calle</th>
                            <th class="px-6 py-3">Número</th>
                            <th class="px-6 py-3">Población</th>
                            <th class="px-6 py-3">Ciudad</th>
                            <th class="px-6 py-3">Código Postal</th>
                            <th class="px-6 py-3">País</th>
                            <th class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($trabajadores as $trabajador)
                        <tr class="fila_registro">
                            <td class="px-4 py-4">{{$trabajador->name}}</td>
                            <td class="px-4 py-4">{{$trabajador->surname}}</td>
                            <td class="px-4 py-4">{{$trabajador->age != null ? $trabajador->age : 'No Info'}}</td>
                            <td class="px-4 py-4">{{$trabajador->profession != null ? $trabajador->profession : 'No Info'}}</td>
                            @if ($trabajador->address != null)
                                <td class="px-4 py-4">{{$trabajador->address->street != null ? $trabajador->address->street : 'No Info'}}</td>
                                <td class="px-4 py-4">{{$trabajador->address->number != null ? $trabajador->address->number : 'No Info'}}</td>
                                <td class="px-4 py-4">{{$trabajador->address->town != null ? $trabajador->address->town : 'No Info'}}</td>
                                <td class="px-4 py-4">{{$trabajador->address->city != null ? $trabajador->address->city : 'No Info'}}</td>
                                <td class="px-4 py-4">{{$trabajador->address->cp != null ? $trabajador->address->cp : 'No Info'}}</td>
                                <td class="px-4 py-4">{{$trabajador->address->country != null ? $trabajador->address->country : 'No Info'}}</td>
                            @else
                                <td class="px-4 py-4">No Info</td>
                                <td class="px-4 py-4">No Info</td>
                                <td class="px-4 py-4">No Info</td>
                                <td class="px-4 py-4">No Info</td>
                                <td class="px-4 py-4">No Info</td>
                                <td class="px-4 py-4">No Info</td>
                            @endif
                            <td class="px-4 py-4">
                                <button wire:click="editar({{$trabajador}})"  class="button-edit">Editar</button>
                                <button wire:click="eliminar({{$trabajador}})"  class="button-delete">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="paginacion">
                    {{$trabajadores->links()}}
                </div>
        </div>
        @else
            <div class="flex flex-wrap justify-center">
                <div class="my-8">
                    <h2 class="sin_registros">Actualmente no hay ningun trabajador dado de alta</h2>
                </div>
            </div>
        @endif   
    </div>
</div>

