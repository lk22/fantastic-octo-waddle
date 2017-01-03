<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Notifier\User;

class FrontendRoutesTest extends TestCase
{

    use DatabaseMigrations, DatabaseTransactions;

    public static function setUpBeforeClass()
    {
    	echo "\nTesting Frontend routes hold on...\n\n";
    }

    public function setUp()
    {
    	parent::setUp();
    }

    /**
     * @test
     */
    public function test_landing_page_route()
    {
        $this->get(route('welcome'))->assertResponseStatus(200);
    }

    /** 
     * @test
     */
    public function test_login_route()
    {
        $this->get('login')->assertResponseStatus(200);
    }

    /**
     * @test
     */
    public function test_register_route()
    {
        $this->get('register')->assertResponseStatus(200);
    }

    /**
     * @test
     */
    public function test_logout_route()
    {
        $this->get(route('logout'))->followRedirects()->assertResponseStatus(200);
    }

    /**
     * @test
     */
    public function test_logout_success_route()
    {
        $this->get(route('logout.success'))->followRedirects()->assertResponseStatus(200);
    }

    /**
     * @test
     */
    public function test_app_home_route()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get(route('home'))->assertResponseStatus(200);
    }


}
