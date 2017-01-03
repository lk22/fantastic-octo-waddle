<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Notifier\Note;

class NoteControllerTest extends TestCase
{

    use DatabaseTransactions;

    public static function setUpBeforeClass()
    {
    	echo "\n\nTesting Note controller hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    	$this->note = factory(Note::class)->make();
    }

    /** 
     * @test
     */
    public function store_new_note_on_user()
    {
        // arrange
        $user_id = 1;
        $data = array(
            'title' => "lorem ipsum",
            'body' => "gjiewjigjeoiwjgioejwogejwoig",
            'user_id' => $user_id
        );

        // act
        Note::create($data);

        $note = Note::latest()->with('author')->firstOrFail();

        // assert
        // $this->assertEquals($data['title'], $note->title);
        // $this->assertEquals($data['body'], $note->body);
        $this->assertEquals($user_id, $data['user_id']);
        $this->assertEquals($data['user_id'], $note->user_id);
    }

    /**
     * @test
     */
    public function updating_existing_note()
    {
        $user_id = 1;
        $note = $this->note;

        $data = array(
            'title' => 'lorem ipsum2',
            'body' => 'gjiewjigjeoiwjgioejwogejwoig jigoejwoigewjogew',
            'user_id' => $user_id
        );

        if($data)
        {
            $note->title = $data['title'];
            $note->body = $data['body'];
            $note->user_id = $data['user_id'];

            $note->save();
        }

        $this->assertEquals($data['title'], $note->title);
        $this->assertEquals($data['body'], $note->body);
        $this->assertEquals($data['user_id'], $note->user_id);
    }

    /**
     * @test
     */
    public function removing_existing_note()
    {
        $user_id = 1;
        $note = $this->note->where('user_id', $user_id)->firstOrFail();

        if($note)
        {
            $note->delete();
        }

        $this->assertTrue(count($note) > 0);
    }
}
