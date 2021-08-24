<?php

use Illuminate\Database\Seeder;
use App\Models\UserCars;

class UserCarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserCars::create([
            'user_id' => 1,
            'car_id' => 1
        ]);
    }
}