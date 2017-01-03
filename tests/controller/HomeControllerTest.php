<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Notifier\User;

class HomeControllerTest extends TestCase
{

    use DatabaseMigrations, DatabaseTransactions;

    public static function setUpBeforeClass()
    {
    	echo "\n\n Testing Home Controller hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    	$this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function show_home_view_with_authenticated_user_notes()
    {
        // login user
        $this->actingAs($this->user);

        // show notes from the authenticated user
        $notes = $this->user->with('notes')->where('id', $this->user->id)->get();
        
        $this->assertTrue(count($notes) > 0);
    }

    /**
     * @test
     */
    public function show_authed_profile()
    {
        $this->actingAs($this->user);

        $profile = $this->user->whereSlug($this->user->slug)->get();

        $this->assertTrue(count($profile) > 0);
    }
}
