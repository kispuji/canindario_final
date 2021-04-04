<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Perros') }}
    </h2>
</x-slot>
<div>
    <div class="px-4 py-4">
        <a href="{{url('dashboard')}}" class="a_volver">< Volver</a>
    </div>
    <div class="fondo_formulario">
        <div class="px-2 py-2 w-80">
            <h3 class="h3">{{$titulo}} un perro</h3>
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
            <!-- Edad -->
            <div class="px-2 py-2 w-80">
                <label for="edad" class="label">Edad</label>
                <input wire:model="age" id="edad" type="text" class=" input my-2 block w-full"/>
                @error('age')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            <!-- Especialidad -->
            <div class="px-2 py-2 w-80">
                <label for="especialidad" class="label">Especialidad</label>
                <input wire:model="specialty" id="especialidad" type="text" class=" input my-2 block w-full"/>
                @error('specialty')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            <!-- Raza -->
            <div class="px-2 py-2 w-80">
                <label for="raza" class="label">Raza</label>
                <input wire:model="race" id="raza" type="text" class=" input my-2 block w-full"/>
                @error('race')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            <!-- Tipo de marcaje -->
            <div class="px-2 py-2 w-80">
                <label for="marcaje" class="label">Tipo de marcaje</label>
                <input wire:model="marking" id="marcaje" type="text" class=" input my-2 block w-full"/>
                @error('marking')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            {{-- Microchip --}}
            <div class="px-2 py-2 w-80">
                <label for="microchip" class="label">Microchip</label>
                <input wire:model="microchip" id="microchip" type="text" class=" input my-2 block w-full"/>
                @error('microchip')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            {{-- Cantidad de comida --}}
            <div class="px-2 py-2 w-80">
                <label for="cantidad_comida" class="label">Cantidad de comida</label>
                <input wire:model="a_food" id="cantidad_comida" type="text" class=" input my-2 block w-full"/>
                @error('a_food')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            {{-- Guía --}}
            <div class="px-2 py-2 w-80">
                <label for="guia" class="label">Guía</label>
                <select wire:model="guide" name="guide" id="guide" class="option my-2 block w-full">
                    <option value="0">Elige un trabajador</option>
                    @foreach ($trabajadores as $trabajador)
                        <option value="{{$trabajador->id}}">{{$trabajador->name . " " . $trabajador->surname}}</option>
                    @endforeach
                </select>
                @error('guide')
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
        @if ($existenPerros)
            <div class="tabla">
                <table class="w-full">
                    <thead class="bg-gray-600 border-gray-600">
                        <tr class="titulo_tabla">
                            <th class="px-6 py-3">Nombre</th>
                            <th class="px-6 py-3">Edad</th>
                            <th class="px-6 py-3">Especialidad</th>
                            <th class="px-6 py-3">Raza</th>
                            <th class="px-6 py-3">Tipo de Marcaje</th>
                            <th class="px-6 py-3">Microchip</th>
                            <th class="px-6 py-3">Guía</th>
                            <th class="px-6 py-3">Cantidad de comida</th>
                            <th class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($perros as $perro)
                        <tr class="fila_registro">
                            <td class="px-8 py-4">{{$perro->name}}</td>
                            <td class="px-8 py-4">{{$perro->age}}</td>
                            <td class="px-8 py-4">{{$perro->specialty != null ? $perro->specialty : 'No Info'}}</td>
                            <td class="px-8 py-4">{{$perro->race != null ? $perro->race : 'No Info'}}</td>
                            <td class="px-8 py-4">{{$perro->marking != null ? $perro->marking : 'No Info'}}</td>
                            <td class="px-8 py-4">{{$perro->microchip != null ? $perro->microchip : 'No Info'}}</td>
                            <td class="px-8 py-4">{{$perro->worker_id != null ? $perro->worker->name . " " . $perro->worker->surname: 'No Info'}}</td>
                            <td class="px-8 py-4">{{$perro->amount_food != null ? $perro->amount_food : 'No Info'}}</td>
                            <td class="px-8 py-4">
                                <button wire:click="editar({{$perro}})"  class="button-edit">Editar</button>
                                <button wire:click="eliminar({{$perro}})"  class="button-delete">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="paginacion">
                    {{$perros->links()}}
                </div>
        </div>
        @else
            <div class="flex flex-wrap justify-center">
                <div class="my-8">
                    <h2 class="sin_registros">Actualmente no hay ningun perro dado de alta</h2>
                </div>
            </div>
        @endif   
    </div>
</div>

