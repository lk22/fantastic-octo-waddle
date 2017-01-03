<?php

use Illuminate\Database\Seeder;

use Notifier\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'name' => 'Leo Knudsen',
    		'email' => 'leo@notifier.com',
    		'password' => bcrypt(1),
    		'remember_token' => str_random(10),
    		'active' => 1,
    		'slug' => 'leo-knudsen',
    		'is_admin' => 1
    	]);

        factory(Notifier\User::class, rand(1, 10))->create();
    }
}
