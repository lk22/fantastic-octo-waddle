<?php

use Illuminate\Database\Seeder;

use Notifier\Note;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Note::create([
    		'title' => 'lorem',
    		'body' => 'lorem ipsum reginatis',
    		'user_id' => 1,
    		'created_at' => Carbon\Carbon::now(),
    		'updated_at' => Carbon\Carbon::now(),
    		'slug' => 'lorem'
    	]);

        factory(Notifier\Note::class, rand(1, 10))->create();
    }
}
