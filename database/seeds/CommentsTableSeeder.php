<?php

use Illuminate\Database\Seeder;
use Notifier\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Comment::create([
    		'body' => 'lorem ipsum bla bla bla',
    		'user_id' => 3,
    		'note_id' => 1,
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now()
    	]);

        factory(Notifier\Comment::class, rand(1, 10))->create();
    }
}
