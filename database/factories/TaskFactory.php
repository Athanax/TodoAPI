<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Task;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Task::class, function (Faker $faker) {
//     static $password;
    return [
        'name'=>$faker->text(10),
        'desciption'=>$faker->paragraph,
        'user_id'=>function(){
                return App\User::all()->random();
        },
        'complete'=>$faker->boolean,
    ];
});
