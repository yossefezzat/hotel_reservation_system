<?php

use App\RoomType;
use Faker\Generator;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(Room::class, function (Faker $faker) {
	$roomTypes = DB::table('room_types')->pluck('id')->all();

    return [
        'number' => $faker->unique()->randomNumber(),
        'room_type_id' => $faker->randomElement($roomTypes),
    ];
});



$factory->define(RoomType::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->sentence(),
        'deleted_at' => $faker->optional()->dateTime(),
    ];
});
