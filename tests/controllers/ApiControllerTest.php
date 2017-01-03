<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Notifier\User;
use Notifier\Note;
use Notifier\Comment;
use Notifier\Message;

class ApiControllerTest extends TestCase
{

	// use DatabaseMigrations;

    public static function setUpBeforeClass()
    {
    	echo "\n\nTesting ApiController hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    }

    /**
     * @test
     */
    public function show_error_response_if_no_records_exists()
    {
    	// act
        $user = factory(User::class)->create();// 
    	$users = $user->all();

    	$compositeExpectation = new Mockery\CompositeExpectation;
    	$response = Response::shouldReceive('json')->andReturn(['error' => 'No records was found']);

    	// assert
    	$this->get(route('api.users'))->assertResponseStatus(200);
    	$this->assertTrue(count($users) > 0);
    	// $this->assertEquals(['error' => 'No records was found'], $response->json());
    }

    /**
     * @test
     */
    public function get_all_users_from_api()
    {
    	// act / assert
    	$this->get(route('api.users'))->assertResponseStatus(200);	

    	// act
    	$user = factory(User::class)->make();
    	$users = $user->all();

    	// assert
    	$this->assertTrue(count($users) > 0);
    }

    /**
     * @test
     */
    public function get_single_user_from_api()
    {
    	// act / assert
        $user = factory(User::class)->create();// 
    	$this->get(route('api.users.user', [$user->slug]))->assertResponseStatus(200);

    	// act
    	
    	$singleUser = User::findBySlugOrFail($user->slug);

    	// assert
    	$this->assertTrue(count($singleUser) === 1);
    }

    /**
     * @test
     */
    public function get_all_notes_from_api()
    {
    	// act / assert
    	$this->get(route('api.notes'))->assertResponseStatus(200);

    	// act
    	$note = factory(Note::class)->make();
    	$notes = $note->all();

    	// assert
    	$this->assertTrue(count($notes) > 0);
    }

    /** 
     * @test
     */
    public function get_single_note_from_api()
    {
        // act / assert
        $note = factory(Note::class)->create();
        $this->get(route('api.note', [$note->slug]))->assertResponseStatus(200);

        // act 
        
        $singleNote = Note::findBySlugOrFail($note->slug);

        // assert
        $this->assertTrue(count($singleNote) === 1);
    }

    /** 
     * @test
     */
    public function get_note_comments_from_api()
    {
        // act / assert
        $this->get(route('api.notes.comments'))->assertResponseStatus(200);

        // act
        $note = factory(Note::class)->make();
        $noteComments = $note->with('comments')->get();

        // assert 
        $this->assertTrue(count($noteComments) > 0);        
    }

    /**
     * @test
     */
    public function get_all_comments_from_api() 
    {
    	// act / assert
    	$this->get(route('api.comments'))->assertResponseStatus(200);

    	// act
    	$comment = factory(Comment::class)->make();
    	$comments = $comment->all();

    	// assert
    	$this->assertTrue(count($comments) > 0);
    }

    /** 
     * @test
     */
    public function get_all_messages_from_api()
    {
        // act / assert
        $this->get(route('api.messages'))->assertResponseStatus(200);

        // act 
        $message = factory(Message::class)->make();
        $messages = $message->all();

        // assert
        $this->assertTrue(count($messages) > 0);
    }

    /**
     * @test
     */
    public function get_all_users_notes_from_api()
    {
    	// act / assert 
    	$this->get(route('api.users.notes'))->assertResponseStatus(200);

    	// act
    	$note = factory(Note::class)->make();
    	$user = factory(User::class)->make();
    	$userNotes = $user->with('notes')->get();

    	// assert
    	$this->assertTrue(count($userNotes) > 0);
    }

    /**
     * @test
     */
    public function get_users_notes_and_comments_from_api()
    {
        // act / assert 
        $this->get(route('api.users.notes.comments'))->assertResponseStatus(200);

        // act
        $user = factory(User::class)->make();
        $userNotesAndComments = $user->with('notes', 'comments')->get();
         
        // assert 
        $this->assertTrue(count($userNotesAndComments) > 0);
    }

   

    

    
}
