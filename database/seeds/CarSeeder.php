<?php

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::create([
            'name' => 'Carro Teste 1',
            'color' => 'azul',
            'num_doors' => 4
        ]);
    }
}