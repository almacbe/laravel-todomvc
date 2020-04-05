<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'description' => $faker->text,
        'done' => $faker->boolean,
    ];
});

$factory->state(Task::class, 'done', ['done' => true]);

$factory->state(Task::class, 'undone', ['done' => false]);
