<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Workers;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * Componente para crear, listar, actualizar y eliminar trabajadores.
 * Contiene validación de formularios y paginación.
 */
class SeccionTrabajadores extends Component
{
    use WithPagination;

    public $name, $surname, $age, $profession, $street, $number, $town, $city, $cp, $country, $worker_id;

    public $action = "guardar";

    public $titulo = "Registrar";

    protected $rules =[
        'name' => 'required|max:15',
        'surname' => 'required|max:40',
        'age' => 'required|numeric|gte:18|lte:100',
        'profession' => 'max:25',
        'street' => 'max:40',
        'number' => 'max:500',
        'town' => 'max:25',
        'city' => 'max:25',
        'cp' =>  'max:5',       
        'country' => 'max:25',
    ];

    protected $validationAttributes = [
        'name' => 'nombre',
        'surname' => 'apellidos',
        'age' => 'edad',
        'profession' => 'profesión',
        'street' => 'calle',
        'number' => 'número',
        'town' => 'población',
        'city' => 'ciudad',
        'cp' =>  'código postal',       
        'country' => 'país',
    ];
    
    /**
     * Listar trabajadores
     */
    public function render()
    {
        $trabajadores = Workers::latest('id')->where('user_id', '=', Auth::id())->paginate('5');

        $existenTrabajadores = false;

        if(sizeof($trabajadores) > 0) $existenTrabajadores = true;

        return view('livewire.seccion-trabajadores', compact('trabajadores', 'existenTrabajadores'));
    }

    /**
     * Insertar trabajadores
     */
    public function guardar(){

        $this->validate();
        DB::transaction(function () {
            
            $trabajador = Workers::create([
                'name' => $this->name,
                'surname' => $this->surname,
                'age' => $this->age,
                'profession' => $this->profession,
                'user_id' => Auth::id()
            ]);
            $trabajador->address()->create([
                'street' => $this->street,
                'number' => $this->number,
                'town' => $this->town,
                'city' => $this->city,
                'cp' => $this->cp,
                'country' => $this->country
            ]);
        });
        
        $this->reset(['name', 'surname', 'age', 'profession', 'street', 'number', 'town', 'city', 'cp', 'country','worker_id', 'action']);
    }

    /**
     * Editar trabajadores
     */
    public function editar(Workers $trabajador){
        $this->resetErrorBag();
        $this->worker_id = $trabajador->id;
        $this->action = "actualizar";
        $this->titulo = "Editar";
        $this->name = $trabajador->name;
        $this->surname = $trabajador->surname;
        $this->age = $trabajador->age;
        $this->profession = $trabajador->profession;
        if(isset($trabajador->address)){
            $this->street = $trabajador->address->street;
            $this->number = $trabajador->address->number;
            $this->town = $trabajador->address->town;
            $this->city = $trabajador->address->city;
            $this->cp = $trabajador->address->cp;
            $this->country = $trabajador->address->country;
        }
    }

    /**
     * Actualizar trabajadores
     */
    public function actualizar(){

        $this->validate();

        DB::transaction(function () {
            $trabajador = Workers::find($this->worker_id);
            $trabajador->update([
                'name' => $this->name,
                'surname' => $this->surname,
                'age' => $this->age,
                'profession' => $this->profession,
                'user_id' => Auth::id()
            ]);
            $trabajador->address()->update([
                'street' => $this->street,
                'number' => $this->number,
                'town' => $this->town,
                'city' => $this->city,
                'cp' => $this->cp,
                'country' => $this->country
            ]);        
        });
        $this->reset(['name', 'surname', 'age', 'profession', 'street', 'number', 'town', 'city', 'cp', 'country','worker_id', 'action', 'titulo']);
    }

    /**
     * Eliminar trabajadores
     */
    public function eliminar(Workers $trabajador){
        $this->resetErrorBag();
        $trabajador->delete();
    }

    /**
     * Resetear valores variables.
     */
    public function resetear(){
        $this->reset(['name', 'surname', 'age', 'profession', 'street', 'number', 'town', 'city', 'cp', 'country','worker_id', 'action', 'titulo']);
    }

}
