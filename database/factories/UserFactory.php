<?php

use ORC\User;
use ORC\Group;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use ORC\Role;

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

$factory->define(User::class, function (Faker $faker) {
    $name = $faker->firstName;
    $surname = $faker->lastName;
    $username = $name . '.' . $surname;
    $password = bcrypt($name);
    $email = $faker->unique()->safeEmail;
    $birth_date = $faker->date;

    return [
        'name' => $name,
        'surname' => $surname,
        'username' => $username,
        'password' => $password, // password
        'email' => $email,
        'birth_date' => $birth_date,
        'remember_token' => Str::random(10),
    ];

   
});

$factory->afterCreating(User::class, function($user, $faker) {
    // i give them a role 
    $userRole = Role::where('name','user')->first();
    $user->roles()->attach($userRole);
    
    //give them a group by default    
    $public = Group::where('name','public')->first();
    $user->groups()->attach($public['id']);
});
