<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dog;
use App\Models\Detection;
use App\Models\Obedience;
use App\Models\Order;
use App\Models\Sustance;
use App\Models\Training;
use App\Models\Workers;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Componente para crear, listar, actualizar y eliminar entrenamientos de búsqueda.
 * Contiene validación de formularios y paginación.
 */
class SeccionEntBusqueda extends Component
{
    use WithPagination;

    public $date, $time, $series, $zone, $sustance, $searchTime, $focusTime, $positives, $negatives,
    $failures, $nivel, $guide, $dog_id, $training_id, $comprobarSeries;

    public $action = "guardar";

    public $titulo = "Registrar";

    protected $rules =[
        'date' => 'required|date',
        'time' => 'required',
        'series' => 'required|gt:0',
        'sustance' => 'required|gt:0',
        'positives' => 'required|gte:0',
        'negatives' => 'required|gte:0',
        'searchTime' => 'required|gt:0',
        'focusTime' => 'required|gt:0',
        'guide' =>  'required|gt:0',       
        'dog_id' => 'required|gt:0',
        'comprobarSeries' => 'boolean'
    ];

    protected $messages = [
        'sustance.gt' => 'La sustancia no puede ser la sustancia por defecto',
        'guide.gt' => 'El guía no puede ser el guía por defecto',
        'dog_id.gt' => 'El perro no puede ser el perro por defecto',
        'comprobarSeries.boolean' => 'La suma de positivos y negativos tiene que ser igual al número de series'
    ];

    protected $validationAttributes = [
        'date' => 'fecha',
        'time' => 'hora',
        'zone' => 'zona',
        'sustance' => 'sustancia',
        'positives' => 'positivos',
        'negatives' => 'negativos',
        'failures' => 'fallos',
        'searchTime' => 'tiempo de búsqueda',
        'focusTime' => 'tiempo de focalización',
        'guide' =>  'guía',       
        'dog_id' => 'perro',
    ];

    /**
     * Listar entrenamientos de búsqueda
     */
    public function render()
    {
        $entrenamientos = Training::latest('id')
        ->where('user_id', '=', Auth::id())
        ->where('technique_id', '=', 3)
        ->paginate('5');
        $trabajadores = Workers::latest('id')->where('user_id', '=', Auth::id())->get();
        $perros = Dog::latest('id')->where('user_id', '=', Auth::id())->get();
        $sustancias = Sustance::all();

        $existenEntrenamientos = false;
        
        if(sizeOf($entrenamientos) > 0) $existenEntrenamientos = true;
        return view('livewire.seccion-ent-busqueda', compact('entrenamientos', 'trabajadores', 'perros',
        'sustancias', 'existenEntrenamientos'));
    }

    /**
     * Insertar entrenamientos de búsqueda
     */
    public function guardar(){

        $this->comprobarSeries = $this->comprobarSeries();
        $this->validate();
        DB::transaction(function () {
            
            $entreno = Training::create([
                'date' => $this->date,
                'time' => $this->time,
                'series' => $this->series,
                'zone' => $this->zone,
                'user_id' => Auth::id(),
                'worker_id' => $this->guide,
                'dog_id' => $this->dog_id,
                'technique_id' => 3
            ]);
            $training_id = $entreno->id;
            Detection::create([
                'positives' => $this->positives,
                'negatives' => $this->negatives,
                'failures' => $this->failures,
                'search_time' => $this->searchTime,
                'focus_time' => $this->focusTime,
                'nivel' => $this->nivel,
                'training_id' => $training_id,
                'sustance_id' => $this->sustance
            ]);

        });

        
        $this->reset(['date', 'time', 'series', 'zone', 'sustance', 'searchTime', 'focusTime', 'nivel',
        'positives', 'negatives', 'failures', 'guide', 'dog_id','training_id', 'action', 'comprobarSeries']);
    }

    /**
     * Editar entrenamientos obediencia
     */
    public function editar(Training $entreno){
        $this->resetErrorBag();

        $this->action = "actualizar";
        $this->titulo = "Editar";
        $this->date = $entreno->date->format('Y-m-d');
        $this->time = $entreno->time;
        $this->series = $entreno->series;      
        $this->zone = $entreno->zone;
        $this->guide = $entreno->worker_id;
        $this->dog_id = $entreno->dog_id;
        $this->searchTime = $entreno->detection->search_time;
        $this->focusTime = $entreno->detection->focus_time;
        $this->nivel = $entreno->detection->nivel;
        $this->sustance = $entreno->detection->sustance_id;
        $this->positives = $entreno->detection->positives;
        $this->negatives = $entreno->detection->negatives;
        $this->failures = $entreno->detection->failures;
        $this->training_id = $entreno->id;
        $this->comprobarSeries = $this->comprobarSeries();
    }

    /**
     * Actualizar entrenamientos obediencia
     */
    public function actualizar(){

        $this->comprobarSeries = $this->comprobarSeries();
        $this->validate();
        DB::transaction(function () {
        
            $entreno = Training::find($this->training_id);
            $entreno->update([
                'date' => $this->date,
                'time' => $this->time,
                'series' => $this->series,
                'zone' => $this->zone,
                'worker_id' => $this->guide,
                'dog_id' => $this->dog_id
            ]);
            $entreno->detection->update([
                'sustance_id' => $this->sustance,
                'search_time' => $this->searchTime,
                'focus_time' => $this->focusTime,
                'nivel' => $this->nivel,
                'positives' => $this->positives,
                'negatives' => $this->negatives,
                'failures' => $this->failures
            ]);
        });
         

        $this->reset(['date', 'time', 'series', 'zone', 'sustance', 'searchTime', 'focusTime', 'nivel',
        'positives', 'negatives', 'failures', 'guide', 'dog_id','training_id', 'action', 'titulo',
        'comprobarSeries']);
    }

    /**
     * Eliminar entrenamientos obediencia
     */
    public function eliminar(Training $entreno){
        $this->resetErrorBag();
        $entreno->delete();
    }

    /**
     * Resetear valores variables.
     */
    public function resetear(){
        $this->reset(['date', 'time', 'series', 'zone', 'sustance', 'searchTime', 'focusTime', 'nivel',
        'positives', 'negatives', 'failures', 'guide', 'dog_id', 'training_id', 'action', 'titulo',
        'comprobarSeries']);
    }

    /**
     * Función para validar que los positivos y negativos no superan el
     * total de series realizadas
     */
    private function comprobarSeries(){
        
        $suma = $this->positives + $this->negatives;

        $this->comprobarSeries = true;

        if($this->series != $suma) $this->comprobarSeries = -1;

        return $this->comprobarSeries;

    }
}
