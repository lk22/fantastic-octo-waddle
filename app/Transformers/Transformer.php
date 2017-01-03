<?php 

namespace Notifier\Transformers;

abstract class Transformer {

	public function transformCollection($items) {

		$return = [];

		foreach($items as $item)
			$return[] = $this->transform($item);

		return $return;
		
		return array_map([$this, $this->transform], $items);
	}

	public abstract function transform($item);

}