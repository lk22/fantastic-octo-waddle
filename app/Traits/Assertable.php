<?php 

namespace Notifier\Traits;

trait Assertable
{

	/**
	 * assert true count conditiion
	 * @param  [type] $query    [description]
	 * @param  [type] $operator [description]
	 * @param  [type] $count    [description]
	 * @return [type]           [description]
	 */
	public function count($query, $operator = null, $count)
	{
		if(is_null($operator))
			$this->assertTrue(count($query) > $count);
	}

	/**
	 * assert data is integer
	 * @param  [type] $query [description]
	 * @return [type]        [description]
	 */
	public function isInteger($data)
	{
		$this->assertTrue(is_integer($data));
	}

	/**
	 * assert data is float
	 * @param  [type]  $data [description]
	 * @return boolean       [description]
	 */
	public function isFloat($data)
	{
		$this->assertTrue(is_float($data));
	}

	/**
	 * assert data is string value
	 * @param  [type]  $data [description]
	 * @return boolean       [description]
	 */
	public function isString($data)
	{
		$this->assertTrue(is_string($data));
	}

	/**
	 * assert the object has attributes
	 * @param  array  $attributes [description]
	 * @param  [type] $object     [description]
	 * @return [type]             [description]
	 */
	public function objectHasAttributes(array $attributes, $object)
	{
		foreach($attributes as $attribute)
		{
			$this->assertObjectHasAttribute($attribute, $object);
		}
	}

	/**
	 * assert the attributes from the object has correct fields
	 * @param  array  $fields    [description]
	 * @param  [type] $attribute [description]
	 * @param  [type] $object    [description]
	 * @return [type]            [description]
	 */
	public function attributeContainFields(array $fields, $attribute, $object)
	{
		foreach($fields as $field)
		{
			$this->assertAttributeContains($field, $attribute, $object);
		}
	}

}