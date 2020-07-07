<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'type_customer_id'          => $faker->numberBetween(1,2),
        'business_name'             => $faker->company,
        'contact_first_name'        => $faker->firstName,
        'contact_last_name'         => $faker->lastName,
        'telephone'                 => $faker->tollFreePhoneNumber,
        'cellphone'                 => $faker->tollFreePhoneNumber,
        'address'                   => $faker->address,
        'ncr'                       => $faker->ein,
        'nit'                       => $faker->ein,
        'dui'                       => $faker->ein,
        'attached'                  => $faker->ean13,
    ];
});
