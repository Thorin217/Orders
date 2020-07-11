<?php

use Illuminate\Database\Seeder;

class DeliveryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\DeliveryType::firstOrCreate([
            'name' => 'Domicilio'
        ]);

        App\DeliveryType::firstOrCreate([
            'name' => 'Local'
        ]);
    }
}
