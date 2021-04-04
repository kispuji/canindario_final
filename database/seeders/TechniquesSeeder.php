<?php

namespace Database\Seeders;

use App\Models\technique;
use Illuminate\Database\Seeder;

class TechniquesSeeder extends Seeder
{
    private $tecnicas = ['Diario', 'Obediencia', 'Búsqueda'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->tecnicas as $tecnica){
            technique::create([
                'name' => $tecnica
            ]);
        }
    }
}
