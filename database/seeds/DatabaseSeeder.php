<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VoyagerDatabaseSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DeliveryTypeSeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(TypeCustomerSeeder::class);
        $this->call(CustomerSeeder::class);
    }
}
