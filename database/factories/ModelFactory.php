<?php
use App\Station;
use App\Role;
use App\District;
use App\Province;
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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
    	'station_id'=>function(){
            return Station::all()->random();
        },
        'district_id'=>function()
        {
            return District::all()->random();
        },
        'province_id'=>function()
        {
            return Province::all()->random();
        },
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' =>$faker->phoneNumber,
        'title'=>'corporal',
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
