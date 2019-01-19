<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Player::class, function (Faker $faker) {
    return [
        'team_id' => 1, //Usually overwritten
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName
    ];
});
