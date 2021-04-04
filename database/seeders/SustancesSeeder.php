<?php

namespace Database\Seeders;

use App\Models\Sustance;
use Illuminate\Database\Seeder;

class SustancesSeeder extends Seeder
{
    private $sustancias = ['Goma2', 'Pg2', 'Pg3', 'Pentrita', 'Tritila', 'Clorato', 'Nitrato', 'Amonal',
    'Kom', 'Olor Personal'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->sustancias as $sustancia){
            Sustance::create([
                'name' => $sustancia
            ]);
        }
    }
}
