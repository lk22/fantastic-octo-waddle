<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NoteTest extends TestCase
{
    public static function setUpBeforeClass()
    {
    	echo "\n\n Testing Note model hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    	$this->note = new Notifier\Note;
    }

    /**
     * @test
     */
    public function note_model_has_correct_attributes()
    {
    	$this->assertObjectHasAttribute('table', $this->note);
    	$this->assertObjectHasAttribute('fillable', $this->note);
    	$this->assertObjectHasAttribute('hidden', $this->note);
    	$this->assertObjectHasAttribute('guarded', $this->note);
    	$this->assertObjectHasAttribute('dates', $this->note);

    }

    /**
     * @test
     */
    public function note_model_attributes_has_correct_keys()
    {
    	$this->assertAttributeContains('title', 'fillable', $this->note);
    	$this->assertAttributeContains('body', 'fillable', $this->note);
    	$this->assertAttributeContains('user_id', 'fillable', $this->note);
        $this->assertAttributeContains('slug', 'fillable', $this->note);
  
    	$this->assertAttributeContains('user_id', 'hidden', $this->note);
      	$this->assertAttributeContains('user_id', 'guarded', $this->note);
  
    	$this->assertAttributeContains('created_at', 'dates', $this->note);
    	$this->assertAttributeContains('updated_at', 'dates', $this->note);
        $this->assertAttributeContains('deleted_at', 'dates', $this->note);
    }

    /**
     * @test
     */
    public function note_model_has_correct_relationships()
    {
    	$this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->note->author());

    	$this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\HasMany::class, $this->note->comments());
    }
}
