<?php

use Faker\Generator as Faker;

$factory->define(App\Expresion::class, function (Faker $faker) {
    return [
        'level_id' => 		$faker->numberBetween($min = 1, $max = 5),
		'sesion_id' => 		$faker->numberBetween($min = 1, $max = 20),
        'observation' =>  	$faker->word,
        'fecha' =>           	   $faker->dateTimeBetween($startDate = '-1 month', $endDate = '+2 month', $timezone = null), 

    ];
});
