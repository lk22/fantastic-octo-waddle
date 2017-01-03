<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Notifier\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(Category::class, 2)->create();
    }
}
