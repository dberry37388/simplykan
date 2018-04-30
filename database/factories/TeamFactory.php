<?php

use Faker\Generator as Faker;

$factory->define(App\Team::class, function (Faker $faker) {
    return [
        'owner_id' => function() {
            return factory(\App\User::class)->create();
        },
        'name' => $faker->company,
    ];
});
