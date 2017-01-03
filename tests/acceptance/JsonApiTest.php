<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Notifier\User;
use Notifier\Note;
use Notifier\Comment;

class JsonApiTest extends TestCase
{

	// use DatabaseMigrations;

    public static function setUpBeforeClass()
    {
    	echo "\n\nTesting Json API hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    	$this->user = factory(User::class)->make();
    	$this->note = factory(Note::class)->make();
    	$this->comment = factory(Comment::class)->make();
    }

    /**
     * GET /api
     * 
     * @test
     */
    public function see_json_from_home_api()
    {
    	$this->get(route('api.home'))->followRedirects()->assertResponseStatus(200);

    	$this->json('GET', route('api.home'))->seeJson();

    	$this->json('GET', route('api.home'))->seeJsonEquals([
    		'message' => 'OK'
    	]);

    }

    /**
     * GET /api/csrf
     * 
     * @test
     */
    public function see_json_from_csrf_api()
    {
    	$this->get(route('api.csrf'))->followRedirects()->assertResponseStatus(200);

    	$this->json('GET', route('api.csrf'))->seeJson();

    	$this->json('GET', route('api.csrf'))->seeJsonEquals([
    		'token' => csrf_token()
    	]);

    }

    /**
     * GET /api/users
     * 
     * @test
     */
    public function see_json_from_users_api()
    {
        $user = $this->user;
    	$this->actingAs($user)->get(route('api.users'))->followRedirects()->assertResponseStatus(200);

    	$this->actingAs($user)->json('GET', route('api.users'))->seeJson();

    	$this->actingAs($user)->json('GET', route('api.users'))->seeJsonStructure([
    		'*' => [
    			'id', 
    			'name', 
    			'email', 
    			'created_at',
    			'updated_at',
                'active',
                'avatar',
                'slug'
      		]
    	]);
    }

    /**
     * GET /api/users/notes
     * 
     * @test
     */
    public function see_json_from_users_notes_api()
    {
        $user = $this->user;
    	$this->actingAs($user)->get(route('api.users.notes'))->followRedirects()->assertResponseStatus(200);

    	$this->actingAs($user)->json('GET', route('api.users.notes'))->seeJson();

    	$this->actingAs($user)->json('GET', route('api.users.notes'))->seeJsonStructure([
    		'*' => [
    			'id', 
    			'name', 
    			'email', 
    			'created_at',
    			'updated_at',
    			'notes' => [
    				'*' => [
    					'id',
    				]
    			]
      		]
    	]);
    }

    /**
     * GET /api/users/comments
     * 
     * @test
     */
    public function see_json_from_users_comments_api()
    {
        $user = $this->user;
    	$this->actingAs($user)->get(route('api.users.comments'))->followRedirects()->assertResponseStatus(200);

    	$this->actingAs($user)->json('GET', route('api.users.comments'))->seeJson();

    	$this->actingAs($user)->json('GET', route('api.users.comments'))->seeJsonStructure([
          	'*' => [
          		'id',
          		'name',
          		'email',
          		'created_at',
          		'updated_at',
          		'comments' => [
          			'*' => [
          				'id'
          			]
          		]
          	]
    	]);
    }

    /** 
     * GET /api/notes
     * 
     * @test
     */
    public function see_json_from_notes_api()
    {
        $user = $this->user;

    	$this->actingAs($user)->get(route('api.notes'))->followRedirects()->assertResponseStatus(200);

    	$this->actingAs($user)->json('GET', route('api.notes'))->seeJson();

    	$this->actingAs($user)->json('GET', route('api.notes'))->seeJsonStructure([
             '*' => [
             	'id',
             	'title',
             	'body',
             	'created_at',
             	'updated_at'
             ]
        ]);
    }

    /**
     * GET /api/comments
     * 
     * @test
     */
    public function see_json_from_comments_api()
    {
        $user = $this->user;

    	$this->actingAs($user)->get(route('api.comments'))->followRedirects()->assertResponseStatus(200);

    	$this->actingAs($user)->json('GET', route('api.comments'))->seeJson();

    	$this->actingAs($user)->json('GET', route('api.comments'))->seeJsonStructure([
        	'*' => [
        		'id',
        		'body',
        		'created_at',
        		'updated_at'
        	]
        ]);
    }

    /** 
     * POST /api/users/add-user
     *
     * @test
     */
    public function add_new_user()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user)->post(route('api.users.store'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => bcrypt('test'),
            'slug' => 'leo-knudsen'
        ])->followRedirects()->assertResponseStatus(200);
    }

    /** 
     * PUT /api/users/update-user{id}
     *
     * @test
     */
    public function update_existing_user_credentials()
    {

        $user = factory(User::class)->create();
        $this->actingAs($user)->put(route('api.users.update', [$user->slug]), [
            'name' => 'Tom Binder',
            'email' => 'binder_tom@hotmail.com',
            'password' => bcrypt('test')
        ])->followRedirects()->assertResponseStatus(200);
    }

    /** 
     * DELETE /apu/users/delete-user/{id}
     *
     * @test
     */
    public function delete_existing_user_with_id()
    {
        $user = $this->user->first();

        $this->actingAs($this->user)->delete(route('api.users.delete', [$user->id]))->followRedirects()->assertResponseStatus(200);
    }

    /**
     * POST /api/users/notes/add-note
     *
     * @test
     */
    public function add_new_note()
    {
        $user = $this->user->first();

        $this->actingAs($this->user)->post(route('api.users.notes.store'), [
            'title' => 'Lorem Ipsum',
            'body' => 'PIGEJPGKEPOKGPEWKPGKEPOKPOGkokwopgkwgkepwkgpoekwpg',
            'user_id' => $user->id
        ])->followRedirects()->assertResponseStatus(200);
    }

    /** 
     * PUT /api/users/notes/update-note/{id}
     *
     * @test
     */
    public function update_existing_note()
    {
        $note = $this->note->first();
        $user = $this->user->first();

        $this->actingAs($this->user)->put(route('api.users.notes.update', [$note->slug]), [
            'title' => 'lorem ipsum',
            'body' => 'goiejwogjeowjgioewjoigjewoig',
            'slug' => 'lorem-ipsum',
            'user_id' => $user->id
        ])->followRedirects()->assertResponseStatus(200);
    }

    /** 
     * POST /api/users/notes/comments/add-comment
     *
     * @test
     */
    public function add_new_comment()
    {
        $note = $this->note->first();
        $user = $this->user->first();
        $this->actingAs($user)->post(route('api.users.notes.comments.store', [$note->slug]), [
            'body' => 'jgiopejwpogjekpowgkpewgekwpgewgopekwpg',
            'user_id' => $user->id,
            'note_id' => $note->id
        ])->followRedirects()->assertResponseStatus(200);
    }

    /**
     * PUT /api/users/notes/comments/update-comment/{user_id}/{note_id}/{comment_id}
     *
     * @test
     */
    public function update_existing_comment()
    {
        $user = $this->user->first();
        $note = $this->note->first();
        $comment = $this->comment->first();
        $this->actingAs($user)->put(route('api.users.notes.comments.update', [$note->slug, $comment->id]), [
            'body' => 'jgiejgowjgioewjogjewoijgoiewjogjeowjgoiewjogew',
            'user_id' => $user->id, 
            'note_id' => $note->id
        ])->followRedirects()->assertResponseStatus(200);
    }

    /**
     * DELETE /api/users/notes/comments/delete-comment/{id}
     *
     * @test
     */
    public function deleting_existing_comment()
    {
        $comment = $this->comment->first();

        $this->actingAs($this->user)->delete(route('api.users.notes.comments.delete', [$comment->id]))->followRedirects()->assertResponseStatus(200);
    }
}
