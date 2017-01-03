<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Notifier\Traits\Assertable;

use Notifier\Message;

class MessageTest extends TestCase
{

    // use Assertable;
    // use DatabaseMigrations;

    public static function setUpBeforeClass()
    {
    	echo "\n\nTesting Message model hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    	$this->message = factory(Message::class)->make();
    }

    /**
     * @test
     */
    public function message_model_has_correct_attributes()
    {
        $this->assertObjectHasAttribute('table', $this->message);
        $this->assertObjectHasAttribute('fillable', $this->message);
    }

    /**
     * @test
     */
    public function message_model_attributes_has_correct_fields()
    {
        $this->message->table = 'contact_messages';
        $this->assertAttributeContains('firstname', 'fillable', $this->message);
        $this->assertAttributeContains('lastname', 'fillable', $this->message);
        $this->assertAttributeContains('email', 'fillable', $this->message);
        $this->assertAttributeContains('body', 'fillable', $this->message);
        $this->assertEquals('contact_messages', $this->message->table);
    }
}
