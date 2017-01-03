<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Notifier\Comment;

class CommentControllerTest extends TestCase
{
    public static function setUpBeforeClass()
    {
    	echo "\n\nTesting Comment controller hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    	$this->comment = factory(Comment::class)->make();
    }

    /**
     * @test
     */
    public function store_new_comment()
    {
        $user_id = 1;
        $note_id = 1;
        $data = array(
            'body' => 'gipewpogkewkgewpokgopewkgpewp',
            'user_id' => $user_id,
            'note_id' => $note_id
        );

        $this->comment->create($data);

        $comment = $this->comment->latest()->first();

        $this->assertEquals($data['body'], $comment->body);
        $this->assertEquals($data['user_id'], $comment->user_id);
        $this->assertEquals($data['note_id'], $comment->note_id);
    }

    /**
     * @test
     */
    public function updaate_existing_comment()
    {
        $user_id = 1;
        $note_id = 1;

        $comment = $this->comment;

        $data = array(
            'body' => 'gipewpogkewkgewpokgopewkgpewpgoeiwjogejw',
            'user_id' => $user_id,
            'note_id' => $note_id
        );

        if($data)
        {
            $comment->body = $data['body'];
            $comment->user_id = $data['user_id'];
            $comment->note_id = $data['note_id'];
            $comment->save();
        }

        $this->assertEquals($data['body'], $comment->body);
        $this->assertEquals($data['user_id'], $comment->user_id);
        $this->assertEquals($data['note_id'], $comment->note_id);
    }
}
