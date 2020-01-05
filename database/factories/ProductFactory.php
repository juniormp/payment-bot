<?php

/** @var Factory $factory */

use App\Domain\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->firstNameMale,
        'quantity' => rand(1, 10),
        'amount' => rand(100, 1000) / 10,
        'url'  => $faker->imageUrl('250', '250', 'cats')
    ];
});
