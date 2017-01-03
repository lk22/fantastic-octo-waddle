<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{
    public static function setUpBeforeClass()
    {
    	echo "\n\nTesting Comment model hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    	$this->comment = new Notifier\Comment;
    }

    /**
     * @test
     */
    public function comment_model_has_correct_attributes()
    {
    	$this->assertObjectHasAttribute('table', $this->comment);
    	$this->assertObjectHasAttribute('fillable', $this->comment);
    	$this->assertObjectHasAttribute('hidden', $this->comment);
    	$this->assertObjectHasAttribute('guarded', $this->comment);
    	$this->assertObjectHasAttribute('dates', $this->comment);
    }

    /**
     * @test
     */
    public function comment_model_attributes_has_correct_fields()
    {
    	$this->assertAttributeContains('body', 'fillable', $this->comment);
    	$this->assertAttributeContains('user_id', 'fillable', $this->comment);
    	$this->assertAttributeContains('note_id', 'fillable', $this->comment);
        $this->assertAttributeContains('slug', 'fillable', $this->comment);

    	$this->assertAttributeContains('user_id', 'hidden', $this->comment);
    	$this->assertAttributeContains('note_id', 'hidden', $this->comment);

    	$this->assertAttributeContains('user_id', 'guarded', $this->comment);
    	$this->assertAttributeContains('note_id', 'guarded', $this->comment);

    	$this->assertAttributeContains('created_at', 'dates', $this->comment);
    	$this->assertAttributeContains('updated_at', 'dates', $this->comment);
        $this->assertAttributeContains('deleted_at', 'dates', $this->comment);
    }

    /**
     * @test
     */
    public function comment_model_has_correct_relationships()
    {
    	// $this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->comment->authors());
    	$this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->comment->author());

    	// $this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->comment->notes());

    	$this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->comment->note());
    }
}
