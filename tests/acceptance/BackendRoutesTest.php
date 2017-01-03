<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Notifier\User;
use Notifier\Note;
use Notifier\Comment;

class BackendRoutesTest extends TestCase
{

	// use DatabaseMigrations;

    public static function setUpBeforeClass()
    {
    	echo "\n\nTesting Notifier backend routes hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    }

    /** 
     * /manage/dashboard
     * 
     * @test
     */
   	public function hit_manage_dashboard_endpoint()
   	{
      $user = factory(User::class)->create();
   		$this->actingAs($user)->get(route('manage'))->assertResponseStatus(200);
   	}

   	/**
   	 * /manage/users
   	 *
   	 * @test
   	 */
   	public function hit_users_dashboard_endpoint()
   	{
      $user = factory(User::class)->create();
   		$this->actingAs($user)->get(route('manage.users'))->assertResponseStatus(200);
   	}

   	/**
   	 *	/manage/users/{id}
   	 * 
   	 * @test
   	 */
   	public function hit_user_profile_dashboard_endpoint()
   	{
   		$user = factory(User::class)->create();
   		$this->actingAs($user)->get(route('manage.user', [$user->id]))->assertResponseStatus(200);
   	}

   	/**
   	 * /manage/notes
   	 * 
   	 * @test
   	 */
   	public function hit_notes_dashboard_endpoint()
   	{
      $user = factory(User::class)->create();
   		$this->actingAs($user)->get(route('manage.notes'))->assertResponseStatus(200);
   	}

   	/**
   	 * /manage/notes/{id}
   	 *
   	 * @test
   	 */
   	public function hit_single_note_dashboard_ednpoint()
   	{
      $user = factory(User::class)->create();
   		$note = factory(Note::class)->create();
   		$this->actingAs($user)->get(route('manage.note', [$note->id]))->assertResponseStatus(200);
   	}

   	/**
   	 * /manage/comments
   	 * 
   	 * @test
   	 */
   	public function hit_comments_dashboard_endpoint()
   	{
      $user = factory(User::class)->create();
   		$this->actingAs($user)->get(route('manage.comments'))->assertResponseStatus(200); 
   	}

   	/**
   	 * /manage/comments/{id}
   	 * @test
   	 */
   	public function hit_single_comment_dashboard_endpoint()
   	{
      $user = factory(User::class)->create();
   		$comment = factory(Comment::class)->make();
   		$this->actingAs($user)->get(route('manage.comment', [$comment->id]))->assertResponseStatus(200);
   	}

    /**
     * /manage/messages
     * @test
     */
    public function hit_messages_dashboard_enpoint()
    {
      $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('manage.messages'))->assertResponseStatus(200);
    }
}
