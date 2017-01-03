<?php

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
$factory->define(Notifier\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'active' => $faker->randomElement([false, true]),
        'avatar' => $faker->randomElement([
        	'/images/avatar2.png',
        	'/images/Opi52c7dccf270e0.png',
        	'/images/stefan-1-350.png'
        ]),
        'slug' => $faker->slug,
        'is_admin' => $faker->randomElement([false, true]),
        'has_active_email' => $faker->randomElement([false, true])
    ];
});

$factory->define(Notifier\Note::class, function(Faker\Generator $faker) {
	return [
		'title' => $faker->title,
		'body' => $faker->text(),
		'user_id' => rand(1, 10),
		'created_at' => Carbon\Carbon::now(),
		'updated_at' => Carbon\Carbon::now(),
		'slug' => $faker->slug
	];
});

$factory->define(Notifier\Comment::class, function(Faker\Generator $faker) {
	return [
		'body' => $faker->text(),
		'user_id' => rand(1,10),
		'note_id' => rand(1, 10),
		'created_at' => Carbon\Carbon::now(),
		'updated_at' => Carbon\Carbon::now(), 
	];
});

$factory->define(Notifier\Message::class, function(Faker\Generator $faker) {
	return [
		'firstname' => $faker->firstname,
		'lastname' => $faker->lastname,
		'email' => $faker->unique()->safeEmail,
		'body' => $faker->text()
	];
});

$factory->define(Notifier\Category::class, function(Faker\Generator $faker) {
	return [
		'name' => $faker->randomElement(['Homework', 'Work']),
		'note_id' => rand(1, 10),
		'comment_id' => rand(1, 10),
		'created_at' => Carbon\Carbon::now(),
		'updated_at' => Carbon\Carbon::now()
	];
});