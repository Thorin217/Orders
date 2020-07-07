<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Inventory::class, function (Faker $faker) {
    return [
        'description'           =>  $faker->text(200),
        'quantity_stock'        =>  $faker->numberBetween(100,1000),
        'unit_price'            =>  $faker->randomFloat(2,2,100),
        'percent_commission'    =>  $faker->randomFloat(2,1,30)
    ];
});
