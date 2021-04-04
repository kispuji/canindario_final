<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Daily;
use App\Models\Dog;
use App\Models\Training;
use App\Models\Type;
use App\Models\Workers;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Componente para crear, listar, actualizar y eliminar entrenamientos diarios.
 * Contiene validación de formularios y paginación.
 */
class SeccionEntDiarios extends Component
{
    use WithPagination;

    public $date, $time, $series, $zone, $type, $duration, $meters, $guide, $dog_id, $criterion,
    $training_id;

    public $action = "guardar";

    public $titulo = "Registrar";

    protected $rules =[
        'date' => 'required|date',
        'time' => 'required',
        'series' => 'required|gt:0',
        'type' => 'required|gt:0',
        'duration' => 'required|gt:0',
        'meters' => 'required|gt:0',
        'guide' =>  'required|gt:0',       
        'dog_id' => 'required|gt:0',
    ];

    protected $messages = [
        'type.gt' => 'El tipo no puede ser el tipo por defecto',
        'guide.gt' => 'El guía no puede ser el guía por defecto',
        'dog_id.gt' => 'El perro no puede ser el perro por defecto'
    ];

    protected $validationAttributes = [
        'date' => 'fecha',
        'time' => 'hora',
        'zone' => 'zona',
        'type' => 'tipo',
        'duration' => 'duración',
        'meters' => 'metros',
        'guide' =>  'guía',       
        'dog_id' => 'perro',
        'criterion' => 'criterio',
    ];

    /**
     * Listar entrenamientos diarios
     */
    public function render()
    {
        $entrenamientos = Training::latest('id')
        ->where('user_id', '=', Auth::id())
        ->where('technique_id', '=', 1)
        ->paginate('5');
        $trabajadores = Workers::latest('id')->where('user_id', '=', Auth::id())->get();
        $perros = Dog::latest('id')->where('user_id', '=', Auth::id())->get();
        $tipos = Type::all();

        $existenEntrenamientos = false;
        
        if(sizeOf($entrenamientos) > 0) $existenEntrenamientos = true;

        return view('livewire.seccion-ent-diarios', compact('entrenamientos', 'trabajadores',
        'perros', 'tipos', 'existenEntrenamientos'));
    }

    /**
     * Insertar entenamientos diarios.
     */
    public function guardar(){

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
                'technique_id' => 1
            ]);
            $training_id = $entreno->id;
            Daily::create([
                'type_id' => $this->type,
                'duration' => $this->duration,
                'meters' => $this->meters,
                'training_id' => $training_id
            ]);

        });

        
        $this->reset(['date', 'time', 'series', 'zone', 'type', 'duration', 'meters', 'guide',
        'dog_id', 'criterion', 'training_id', 'action']);
    }

    /**
     * Editar entrenamientos diarios
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
        $this->type = $entreno->daily->type_id;
        $this->duration = $entreno->daily->duration;
        $this->meters = $entreno->daily->meters;
        $this->training_id = $entreno->id;
    }

    /**
     * Actualizar entrenamientos diarios
     */
    public function actualizar(){

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
            $entreno->daily->update([
                'type_id' => $this->type,
                'duration' => $this->duration,
                'meters' => $this->meters
            ]);
        });
         

        $this->reset(['date', 'time', 'series', 'zone', 'type', 'duration', 'meters', 'guide',
        'dog_id', 'criterion', 'training_id', 'action', 'titulo']);
    }

    /**
     * Eliminar entrenamientos diarios
     */
    public function eliminar(Training $entreno){
        $this->resetErrorBag();
        $entreno->delete();
    }

    /**
     * Resetear valores variables.
     */
    public function resetear(){
        $this->reset(['date', 'time', 'series', 'zone', 'type', 'duration', 'meters', 'guide',
        'dog_id', 'criterion', 'training_id', 'action', 'titulo']);
    }
}
