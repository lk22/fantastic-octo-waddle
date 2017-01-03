<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    public static function setUpBeforeClass()
    {
    	echo "\n\nTesting Cateory model hold on...\n";
    }

    public function setUp()
    {
    	parent::setUp();
    	$this->category = new Notifier\Category;
    }

    /**
     * @test
     */
    public function category_model_has_correct_attributes()
    {
    	$this->assertObjectHasAttribute('table', $this->category);
    	$this->assertObjectHasAttribute('fillable', $this->category);
    }

    /** 
     * @test
     */
    public function category_model_attributes_has_correct_values()
    {
    	$this->assertAttributeContains('name', 'fillable', $this->category);
    }

    /** 
     * @test
     */
    public function category_has_correct_relations()
    {
    	$this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->category->notes());
    	$this->assertInstanceOf(Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->category->comments());
    }
}
