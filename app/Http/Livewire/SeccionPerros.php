<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Dog;
use App\Models\Workers;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

/**
 * Componente para crear, listar, actualizar y eliminar perros.
 * Contiene validación de formularios y paginación.
 */
class SeccionPerros extends Component
{
    use WithPagination;

    public $name, $age, $specialty, $race, $marking, $microchip, $guide, $a_food, $dog_id;

    public $action = "guardar";

    public $titulo = "Registrar";

    protected $rules =[
        'name' => 'required|max:15',
        'age' => 'required|numeric|gte:0|lte:20',
        'specialty' => 'max:20',
        'race' => 'max:20',
        'marking' => 'max:20',
        'microchip' => 'max:15',
        'a_food' =>  'max:5',       
        'guide' => 'required|gt:0',
    ];

    protected $validationAttributes = [
        'name' => 'nombre',
        'age' => 'edad',
        'specialty' => 'especialidad',
        'race' => 'raza',
        'marking' => 'marcaje',
        'guide' => 'guía',
        'a_food' => 'cantidad de comida',
    ];

    protected $messages = [
        'guide.gt' => 'El guía no puede ser el guía por defecto',
    ];
    
    /**
     * Listar perros
     */
    public function render()
    {
        $perros = Dog::latest('id')->where('user_id', '=', Auth::id())->paginate('5');
        $trabajadores = Workers::latest('id')->where('user_id', '=', Auth::id())->get();

        $existenPerros = false;

        if(sizeof($perros) > 0) $existenPerros = true;

        return view('livewire.seccion-perros', compact('perros', 'existenPerros', 'trabajadores'));
    }

    /**
     * Insertar perros.
     */
    public function guardar(){

        $this->validate();
            
        $perro = Dog::create([
            'name' => $this->name,
            'age' => $this->age,
            'specialty' => $this->specialty,
            'race' => $this->race,
            'marking' => $this->marking,
            'microchip' => $this->microchip,
            'amount_food' => $this->a_food,
            'user_id' => Auth::id(),
            'worker_id' => $this->guide
        ]);
        
        $this->reset(['name', 'age', 'specialty', 'race', 'marking', 
        'microchip', 'a_food', 'guide','dog_id', 'action']);
    }

    /**
     * Editar perros
     */
    public function editar(Dog $perro){
        $this->resetErrorBag();
        $this->dog_id = $perro->id;
        $this->action = "actualizar";
        $this->titulo = "Editar";
        $this->name = $perro->name;
        $this->age = $perro->age;
        $this->specialty = $perro->specialty;      
        $this->race = $perro->race;
        $this->marking = $perro->marking;
        $this->microchip = $perro->microchip;
        $this->a_food = $perro->amount_food;
        $this->guide = $perro->worker_id;

    }

    /**
     * Actualizar perros
     */
    public function actualizar(){

        $this->validate();

        $perro = Dog::find($this->dog_id);
        $perro->update([
            'name' => $this->name,
            'age' => $this->age,
            'specialty' => $this->specialty,
            'race' => $this->race,
            'marking' => $this->marking,
            'microchip' => $this->microchip,
            'amount_food' => $this->a_food,
            'user_id' => Auth::id(),
            'worker_id' => $this->guide
        ]);   

        $this->reset(['name', 'age', 'specialty', 'race', 'marking', 'microchip', 'a_food',
         'guide','dog_id', 'action', 'titulo']);
    }

    /**
     * Eliminar perros
     */
    public function eliminar(Dog $perro){
        $this->resetErrorBag();
        $perro->delete();
    }

    /**
     * Resetear valores variables.
     */
    public function resetear(){
        $this->resetErrorBag();
        $this->reset(['name', 'age', 'specialty', 'race', 'marking', 'microchip', 'a_food',
         'guide','dog_id', 'action', 'titulo']);
    }
}
