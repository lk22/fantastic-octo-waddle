<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Notifier\User;

class UserControllerTest extends TestCase
{
    public static function setUpBeforeClass()
    {
    	echo "\n\ntesting User controller hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    	$this->user = factory(User::class)->create();
    }

     /** 
     * @test
     */
    public function storing_an_new_user()
    {
        // arrange
        $password = bcrypt('test');
        $newPass = $password;

        $data = array(
            'name' => 'Tom Binder',
            'email' => $this->user->email,
            'password' => $password
        );

        // act / assert
        if(!$data)
        {
            $this->assertFalse(count($data) > 0);
        }

        if($password)
        {
            $this->user->fill(['password' => $newPass]);
        }

        $this->user->create($data);

        // assert
        $this->assertEquals($newPass, $password);
    }

    /**
     * @test
     */
    public function update_existing_user()
    {
        // arrange
        $id = 3;

        $data = array(
            'name' => 'Tom Binder',
            'email' => $this->user->email,
            'password' => bcrypt('test')
        ); 

        $user = $this->user;

        if($data)
        {
           $user->name = $data['name'];
           $user->email = $data['email'];
           $user->password = $data['password'];

           $user->save();
        }

        $this->assertEquals('Tom Binder', $user->name);
        $this->assertEquals($this->user->email, $user->email);
        $this->assertEquals($data['password'], $user->password);
    }

    /**
     * @test
     */
    public function deleting_existing_user()
    {
        // arrange
        $id = 3;

        $user = new User;
        $user->where('id', $id)->first();

        $user->delete();
    }

    /**
     * @test
     */
    public function activate_user_and_users_email()
    {
        $user = factory(User::class)->create([
            'active' => false,
            'has_active_email' => false
        ]);

        $userIsActive = $user->active;
        $userHasActiveEmail = $user->has_active_email;

        // dd($userIsActive);

        $this->assertFalse($userIsActive);

        $this->actingAs($user);
        $this->get(route('user.activate'))->followRedirects()->assertResponseStatus(200);

        if($this->actingAs($user))
        {
            $user->active = true;
            $user->has_active_email = true;
            $user->save();
        }

        $this->assertTrue($user->active);
        $this->assertTrue($user->has_active_email);
    }
}
