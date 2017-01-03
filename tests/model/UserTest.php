<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Notifier\User;

class UserTest extends TestCase
{

    // use DatabaseMigrations;

	/**
	 * setup before class is triggered
	 */
    public static function setUpBeforeClass()
    {
    	echo "\n\nTesting User model hold on...\n";
    }

    /**
     * setup for each test to trigger in class
     */
    public function setUp()
    {
    	parent::setUp();
    	$this->user = factory(User::class)->make();
    }

    /**
     * @test
     */
    public function user_model_has_correct_attributes()
    {
    	$user = new User;
    	$this->assertObjectHasAttribute('fillable', $user);
        $this->assertObjectHasAttribute('hidden', $user);
    }
    
    /**2
     * @test
     */
    public function user_model_attributes_has_correct_keys_and_values()
    {
    	$user = new User;
    	$this->assertAttributeContains('name', 'fillable', $user);
    	$this->assertAttributeContains('email', 'fillable', $user);
    	$this->assertAttributeContains('password', 'fillable', $user);
        $this->assertAttributeContains('avatar', 'fillable', $user);
        $this->assertAttributeContains('active', 'fillable', $user);
        $this->assertAttributeContains('slug', 'fillable', $user);
        $this->assertAttributeContains('is_admin', 'fillable', $user);
        $this->assertAttributeContains('has_active_email', 'fillable', $user);
    	$this->assertAttributeContains('password', 'hidden', $user);
    	$this->assertAttributeContains('remember_token', 'hidden', $user);
    }

    /**
     * @test
     */
    public function user_model_has_many_notes()
    {
    	$user = new User;
    	$this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\HasMany::class, $user->notes());
    	$this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\HasMany::class, $user->comments());
        $this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\HasMany::class, $user->loginLinks());
    }

    /**
     * @test
     * @return [type] [description]
     */
    public function user_is_not_admin()
    {
        $user = new User;

        $userIsAdmin = $user->isAdmin();

        $this->assertTrue(is_null($userIsAdmin));
    }

    /**
     * @test
     */
    public function user_is_admin()
    {
        $user = factory(User::class)->create(['is_admin' => true]);

        $userIsAdmin = $user->isAdmin();

        $this->assertTrue($userIsAdmin);
    }

    /**
     * @test
     */
    public function user_model_can_get_authenticated_user_if_user_is_logged_in()
    {
        $user = new User;
        $this->actingAs($user);

        $auth = $user->auth();

        $this->assertTrue($auth);
    }

    /**
     * @test
     */
    public function user_is_active_and_has_verified_email()
    {
        $user = factory(User::class)->create(['active' => true, 'has_active_email' => true]);

        $this->assertTrue($user->active);
        $this->assertTrue($user->has_active_email);
    }

    /**
     * @test
     * @return [type] [description]
     */
    public function verify_user()
    {
        $user = factory(User::class)->create(['active' => true, 'has_active_email' => true]);

        $this->actingAs($user);

        $activateUser = $user->activate($user);

        // dd($activateUser);

        $this->assertTrue($user->active);
        $this->assertTrue($user->has_active_email);
    }

    public static function tearDownAfterClass()
    {
        exec('php artisan db:seed --database=mysql-test');
    }
}
