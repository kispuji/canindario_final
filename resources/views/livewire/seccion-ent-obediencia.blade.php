<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Entrenamientos de obediencia') }}
    </h2>
</x-slot>
<div>
    <div class="px-4 py-4">
        <a href="{{url('entrenamientos')}}" class="a_volver">< Volver</a>
    </div>
    <div>
        <div class="fondo_formulario">
            <div class="px-2 py-2 w-100">
                <h3 class="h3">{{$titulo}} un entrenamiento de obediencia</h3>
            </div>
            {{-- Formulario --}}          
            <div class="flex flex-wrap justify-center">
                <!-- Fecha -->
                <div class="px-2 py-2 w-80">
                    <label for="fecha" class="label">Fecha</label>
                    <input wire:model="date" id="fecha" type="date" class=" input my-2 block w-full"/>
                    @error('date')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                <!-- Hora -->
                <div class="px-2 py-2 w-80">
                    <label for="hora" class="label">Hora</label>
                    <input wire:model="time" id="hora" type="time" class=" input my-2 block w-full"/>
                    @error('time')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                <!-- Series -->
                <div class="px-2 py-2 w-80">
                    <label for="series" class="label">Series</label>
                    <input wire:model="series" id="series" type="number" class=" input my-2 block w-full"/>
                    @error('series')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                <!-- Zona -->
                <div class="px-2 py-2 w-80">
                    <label for="zona" class="label">Zona</label>
                    <input wire:model="zone" id="zona" type="text" class=" input my-2 block w-full"/>
                    @error('zone')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                <!-- Orden -->
                <div class="px-2 py-2 w-80">
                    <label for="tipo" class="label">Ordenes</label>
                    <select wire:model="order" id="orden" type="text" class=" input my-2 block w-full">
                        <option value="0">Elije un tipo</option>
                        @foreach ($ordenes as $orden)
                            <option value="{{$orden->id}}">{{$orden->name}}</option>                            
                        @endforeach
                    </select>
                    @error('order')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                {{-- Duración --}}
                <div class="px-2 py-2 w-80">
                    <label for="duracion" class="label">Duración (minutos)</label>
                    <input wire:model="duration" id="duracion" type="number" min="0" class=" input my-2 block w-full"/>
                    @error('duration')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                {{-- Positivos --}}
                <div class="px-2 py-2 w-80">
                    <label for="positivos" class="label">Positivos</label>
                    <input wire:model="positives" id="positivos" type="number" class=" input my-2 block w-full"/>
                    @error('positives')
                        <p class="error">{{$message}}</p>
                    @enderror
                    @error('comprobarSeries')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                {{-- Negativos --}}
                <div class="px-2 py-2 w-80">
                    <label for="negativos" class="label">Negativos</label>
                    <input wire:model="negatives" id="negativos" type="number" class=" input my-2 block w-full"/>
                    @error('negatives')
                        <p class="error">{{$message}}</p>
                    @enderror
                    @error('comprobarSeries')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                {{-- Fallos --}}
                <div class="px-2 py-2 w-80">
                    <label for="fallos" class="label">Fallos</label>
                    <input wire:model="failures" id="fallos" type="number" class=" input my-2 block w-full"/>
                    @error('failures')
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
                {{-- Perro --}}
                <div class="px-2 py-2 w-80">
                    <label for="perro" class="label">Perro</label>
                    <select wire:model="dog_id" name="dog" id="perro" class="option my-2 block w-full">
                        <option value="0">Elige un perro</option>
                        @foreach ($perros as $perro)
                            <option value="{{$perro->id}}">{{$perro->name}}</option>
                        @endforeach
                    </select>
                    @error('dog_id')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                {{-- Criterio --}}
                <div class="px-2 py-2 w-80">
                    <label for="criterio" class="label">Criterio</label>
                    <textarea wire:model="criterion" class="input my-2 block w-full" name="criterion" id="criterio" cols="30"></textarea>
                </div>
                @error('criterion')
                    <p class="error">{{$message}}</p>
                @enderror
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
            @if ($existenEntrenamientos)
                <div class="w-full rounded-lg shadow overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-600 border-gray-600">
                            <tr class="titulo_tabla">
                                <th class="px-8 py-3">Fecha</th>
                                <th class="px-3 py-3">Hora</th>
                                <th class="px-3 py-3">Series</th>
                                <th class="px-3 py-3">Zona</th>
                                <th class="px-3 py-3">Orden</th>
                                <th class="px-3 py-3">Duración</th>
                                <th class="px-3 py-3">Positivos</th>
                                <th class="px-3 py-3">Negativos</th>
                                <th class="px-3 py-3">Fallos</th>
                                <th class="px-5 py-3">Guía</th>
                                <th class="px-3 py-3">Perro</th>
                                <th class="px-8 py-3">Criterio</th>
                                <th class="px-3 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($entrenamientos as $entreno)
                            <tr class="fila_registro">
                                <td class="px-3 py-4">{{$entreno->date->format('d-m-Y')}}</td>
                                <td class="px-3 py-4">{{$entreno->time}}</td>
                                <td class="px-3 py-4">{{$entreno->series}}</td>
                                <td class="px-3 py-4">{{$entreno->zone != null ? $entreno->zone : 'No info'}}</td>
                                <td class="px-3 py-4">{{$entreno->obedience->order->name}}</td>
                                <td class="px-3 py-4">{{$entreno->obedience->duration != null ? $entreno->obedience->duration : 'No info'}}</td>
                                <td class="px-3 py-4">{{$entreno->obedience->positives}}</td>
                                <td class="px-3 py-4">{{$entreno->obedience->negatives}}</td>
                                <td class="px-3 py-4">{{$entreno->obedience->failures >= 0 && $entreno->obedience->failures != null ? $entreno->obedience->failures : 'No info'}}</td>
                                <td class="px-5 py-4">{{$entreno->worker != null ? $entreno->worker->name . " " . $entreno->worker->surname : 'No info'}}</td>
                                <td class="px-3 py-4">{{$entreno->dog->name}}</td>
                                <td class="px-8 py-4">{{$entreno->criterion != null ? $entreno->criterion : 'No info'}}</td>
                                <td class="px-3 py-4">
                                    <button wire:click="editar({{$entreno}})"  class="button-edit">Editar</button>
                                    <button wire:click="eliminar({{$entreno}})"  class="button-delete">Eliminar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="paginacion">
                        {{$entrenamientos->links()}}
                    </div>
            </div>
            @else
                <div class="flex flex-wrap justify-center">
                    <div class="my-8">
                        <h2 class="sin_registros">Actualmente no hay ningun entenamiento de obediencia dado de alta</h2>
                    </div>
                </div>
            @endif   
        </div>
    </div>
</div>
