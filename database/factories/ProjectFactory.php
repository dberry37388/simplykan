<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'owner_id' => create(\App\User::class)->id,
        'title' => $faker->company,
        'description' => $faker->paragraph,
        'prefix' => str_random(3)
    ];
});
