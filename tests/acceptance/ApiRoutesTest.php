<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Notifier\User;
use Notifier\Note;
use Notifier\Comment;

class ApiRoutesTest extends TestCase
{

	// use DatabaseMigrations; 

	   public static function setUpBeforeClass()
	   {
	   		exec('php artisan db:seed --database=mysql-test');
	   		echo "\n\nTesting Api routes hold on...\n";
	   }

	   public function setUp()
	   {
	   		parent::setUp();
	   		$this->note = factory(Note::class)->make();
	   		$this->comment = factory(Comment::class)->make();
	   }

	   /**
	    * @test
	    */
	   public function hit_api_home_endpoint()
	   {
	   		$this->get(route('api.home'))->assertResponseStatus(200);
	   }

	   /**
	    * @test
	    */
	   public function hit_csrf_api_endpoint()
	   {
	   		$this->get(route('api.csrf'))->assertResponseStatus(200);
	   }

	   /**
	    * @test
	    */
	   public function hit_auth_api_endpoint()
	   {
	   		// $user = factory(User::class)->create();
	   		// $this->actingAs($user)->get(route('api.auth'))->assertResponseStatus(200);
	   }

	   /**
	    * @test
	    */
	   public function hit_users_api_endpoint()
	   {
	   		$this->get(route('api.users'))->assertResponseStatus(200);
	   }

	   /**
	    * @test
	    */
	   public function hit_notes_api_endpoint()
	   {
	   		$this->get(route('api.notes'))->assertResponseStatus(200);
	   }

	   /**
	    * @test
	    */
	   public function hit_note_api_endpoint()
	   {
	   		$note = new Notifier\Note;
	   		$this->get(route('api.note', [$note->id]))->assertResponseStatus(200);
	   }

	   /** 
	    * @test
	    */
	   public function hit_notes_comments_api_endpoint()
	   {
	   		$this->get(route('api.notes.comments'))->assertResponseStatus(200);
	   }

	   /**
	    * @test
	    */
	   public function hit_users_notes_api_endpoint()
	   {
	   		$this->get(route('api.users.notes'))->assertResponseStatus(200);
	   }

	   /**
	    * @test
	    */
	  	public function hit_users_comments_api_endpoint()
	  	{
	  		$this->get(route('api.users.comments'))->assertResponseStatus(200);
	  	}

	   /**
	    * @test
	    */
	   public function hit_comments_api_endpoint()
	   {
	   		$this->get(route('api.comments'))->assertResponseStatus(200);
	   }

	   /**
	    * @test
	    */
	   public function hit_single_comment_api_endpoint()
	   {
	   		$comment = new Notifier\Comment;
	   		$this->get(route('api.comment', [$comment->id]))->assertResponseStatus(200);
	   }

	   /**
	    * @test
	    */
	   public function hit_messages_api_endpoint()
	   {
	   		$this->get(route('api.messages'))->assertResponseStatus(200);
	   }
}
