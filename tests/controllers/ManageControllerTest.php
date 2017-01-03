<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Notifier\Traits\Assertable;

use Notifier\User;
use Notifier\Note;
use Notifier\Comment;
use Notifier\Message;

class ManageControllerTest extends TestCase
{

    // use DatabaseMigrations;

    public static function setUpBeforeClass()
    {
    	echo "\n\nTesting ManageController hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    }

    /**
     * @test
     */
    public function it_shows_dashboard_view()
    {
        // act / assert
        $user = factory(User::class)->create();
        $note = factory(Note::class)->create();
        $comment = factory(Comment::class)->make();
        $message = factory(Message::class)->create();

        $this->actingAs($user);

        // act / assert

        $this->get(route('manage'))->assertResponseStatus(200);
        $users = $user->all();
        $notes = $note->all();
        $comments = $comment->all();
        $messages = $message->orderBy('id', 'DESC')->limit(5)->get();

        // assert
        $this->assertTrue(count($users) > 0);
        $this->assertTrue(count($notes) > 0);
        $this->assertTrue(count($comments) > 0);
        $this->assertTrue(count($messages) > 0);

    }

    /**
     * @test
     */
    public function it_shows_users_dashboard_view()
    {
        // act / assert
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('manage.users'))->assertResponseStatus(200);

        // act
        $users = $user->all();

        // assert
        $this->assertTrue(count($users) > 0);
    }

    /**
     * @test
     */
    public function it_shows_single_user_with_note_and_comments()
    {
        // act / assert
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('manage.user', [$user->id]))->assertResponseStatus(200);

        // act
        
        $userNoteAndComments = $user->with('notes', 'comments')->firstOrFail();
        // dd($userNoteAndComments);

        // assert
        $this->assertTrue(count($userNoteAndComments) > 0);
    }

    /**
     * @test
     */
    public function it_shows_notes_with_belonging_authors_dashboard()
    {
        // act / assert
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('manage.notes'))->assertResponseStatus(200);

        // act
        $note = factory(Note::class)->create();
        $notes = $note->with('author')->get();
        
        // assert
        $this->assertTrue(count($notes) > 0);
    }

    /**
     * @test
     */
    public function it_shows_single_note_with_author_and_comments_dashboard()
    {
        // act / assert
        $note = factory(Note::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('manage.note', [$note->id]))->assertResponseStatus(200);

        // act
        $note = $note->with('author', 'comments')->where('id', $note->id)->get();
        
        // assert
        $this->assertTrue(count($note) > 0);
    }

    /**
     * @test
     */
    public function it_shows_comments_with_belonging_authors_dashboard()
    {
        // act / assert
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('manage.comments'))->assertResponseStatus(200);

        // act
        $comment = factory(Comment::class)->make();
        $comments = $comment->with('author')->get();
        
        // assert
        $this->assertTrue(count($comments) > 0);
    }

    /**
     * @test
     */
    public function it_shows_single_comment_with_author_and_comments_dashboard()
    {
        // act / assert
        $comment = Comment::first();
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('manage.comment', [$comment->id]))->assertResponseStatus(200);

        // act
        $comments = $comment->with('author')->where('id', $comment->id)->firstOrFail();
        // dd($comment);
        
        // assert
        $this->assertTrue(count($comments) > 0);
    }

    /**
     * @test
     */
    public function it_shows_all_messages_dashboard()
    {
        // act / assert
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('manage.messages'))->assertResponseStatus(200);

        // act
        $message = factory(Message::class)->create();
        $messages = $message->all()->toArray();

        // assert
        $this->assertTrue(count($messages) > 0);
    }
}
