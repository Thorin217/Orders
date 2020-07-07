<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\TypeCustomer::class, function (Faker $faker) {
    return [
        'name'      => $faker->word(8)
    ];
});
