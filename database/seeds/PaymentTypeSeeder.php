<?php

use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PaymentType::firstOrCreate([
            'name'  => 'Efectivo'
        ]);

        App\PaymentType::firstOrCreate([
            'name'  => 'Tarjeta'
        ]);
    }
}
