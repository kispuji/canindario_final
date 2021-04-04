<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    private $ordenes = ['Sit', 'Platz', 'Fuus', 'Quieto', 'Laser', 'Izquierda', 'Derecha', 'Sigue', 'Foco'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->ordenes as $orden){
            Order::create([
                'name' => $orden
            ]);
        }
    }
}
