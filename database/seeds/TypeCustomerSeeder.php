<?php

use Illuminate\Database\Seeder;

class TypeCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TypeCustomer::class, 2)->create();
    }
}
