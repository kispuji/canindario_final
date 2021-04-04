<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    private $tipos = ['Paseo', 'Carrera'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->tipos as $tipo){
            Type::create([
                'name' => $tipo
            ]);
        }
    }
}
