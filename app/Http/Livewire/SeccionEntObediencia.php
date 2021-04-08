<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dog;
use App\Models\Obedience;
use App\Models\Order;
use App\Models\Training;
use App\Models\Workers;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Componente para crear, listar, actualizar y eliminar entrenamientos obediencia.
 * Contiene validación de formularios y paginación.
 */
class SeccionEntObediencia extends Component
{
    use WithPagination;

    public $date, $time, $series, $zone, $order, $duration, $positives, $negatives, $failures, $guide,
    $dog_id, $criterion, $training_id, $comprobarSeries;

    public $action = "guardar";

    public $titulo = "Registrar";

    protected $rules =[
        'date' => 'required|date',
        'time' => 'required',
        'series' => 'required|gt:0',
        'order' => 'required|gt:0',
        'duration' => 'required|gt:0',
        'positives' => 'required|gte:0',
        'negatives' => 'required|gte:0',
        'guide' =>  'required|gt:0',       
        'dog_id' => 'required|gt:0',
        'comprobarSeries' => 'boolean'
    ];

    protected $messages = [
        'order.gt' => 'La orden no puede ser la orden por defecto',
        'guide.gt' => 'El guía no puede ser el guía por defecto',
        'dog_id.gt' => 'El perro no puede ser el perro por defecto',
        'comprobarSeries.boolean' => 'La suma de positivos y negativos tiene que ser igual al número de series'
    ];

    protected $validationAttributes = [
        'date' => 'fecha',
        'time' => 'hora',
        'zone' => 'zona',
        'order' => 'orden',
        'duration' => 'duración',
        'positives' => 'positivos',
        'negatives' => 'negativos',
        'failures' => 'fallos',
        'guide' =>  'guía',       
        'dog_id' => 'perro',
        'criterion' => 'criterio',
    ];

    /**
     * Listar entrenamientos de obedicencia
     */
    public function render()
    {
        $entrenamientos = Training::latest('id')
        ->where('user_id', '=', Auth::id())
        ->where('technique_id', '=', 2)
        ->paginate('5');
        $trabajadores = Workers::latest('id')->where('user_id', '=', Auth::id())->get();
        $perros = Dog::latest('id')->where('user_id', '=', Auth::id())->get();
        $ordenes = Order::all();

        $existenEntrenamientos = false;
        
        if(sizeOf($entrenamientos) > 0) $existenEntrenamientos = true;

        return view('livewire.seccion-ent-obediencia', compact('entrenamientos', 'trabajadores', 'perros',
        'ordenes', 'existenEntrenamientos'));
    }

    /**
     * Insertar entrenamientos de obediencia
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
                'criterion' => $this->criterion,
                'user_id' => Auth::id(),
                'worker_id' => $this->guide,
                'dog_id' => $this->dog_id,
                'technique_id' => 2
            ]);
            $training_id = $entreno->id;
            Obedience::create([
                'positives' => $this->positives,
                'negatives' => $this->negatives,
                'failures' => $this->failures,
                'duration' => $this->duration,
                'training_id' => $training_id,
                'order_id' => $this->order
            ]);

        });

        
        $this->reset(['date', 'time', 'series', 'zone', 'order', 'duration', 'positives', 'negatives',
        'failures', 'guide', 'dog_id', 'criterion', 'training_id', 'action', 'comprobarSeries']);
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
        $this->criterion = $entreno->criterion;
        $this->guide = $entreno->worker_id;
        $this->dog_id = $entreno->dog_id;
        $this->duration = $entreno->obedience->duration;
        $this->order = $entreno->obedience->order_id;
        $this->positives = $entreno->obedience->positives;
        $this->negatives = $entreno->obedience->negatives;
        $this->failures = $entreno->obedience->failures;
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
                'criterion' => $this->criterion,
                'worker_id' => $this->guide,
                'dog_id' => $this->dog_id
            ]);
            $entreno->obedience->update([
                'order_id' => $this->order,
                'duration' => $this->duration,
                'positives' => $this->positives,
                'negatives' => $this->negatives,
                'failures' => $this->failures
            ]);
        });
         

        $this->reset(['date', 'time', 'series', 'zone', 'order', 'duration', 'positives', 'negatives',
        'failures', 'guide', 'dog_id', 'criterion', 'training_id', 'action', 'titulo', 'comprobarSeries']);
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
        $this->resetErrorBag();
        $this->reset(['date', 'time', 'series', 'zone', 'order', 'duration', 'positives', 'negatives',
        'failures', 'guide', 'dog_id', 'criterion', 'training_id', 'action', 'titulo', 'comprobarSeries']);
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
