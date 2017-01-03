<?php

namespace Notifier\Transformers;

class NoteTransformer extends Transformer
{

	/**
	 * constructor
	 * @param UserTransformer    $userTransformer    [description]
	 * @param CommentTransformer $commentTransformer [description]
	 */
	// public function __construct(UserTransformer $userTransformer, CommentTransformer $commentTransformer)
	// {
	// 	$this->authorTransformer = $userTransformer;
	// 	$this->commentTransformer = $commentTransformer;
	// }

	/**
	 * transform item
	 * @param  [type] $note [description]
	 * @return [type]       [description]
	 */
	public function transform($note)
	{
		/**
		 * fields to transform
		 * @var [type]
		 */
		$return = [
			'id' => (integer) $note->id,
			'title' => (string) $note->title,
			'body' => (string) $note->body,
			'created_at' => (string) $note->created_at,
			'updated_at' => (string) $note->updated_at
		];

		/**
		 * if comments relation is loaded
		 */
		if($note->relationLoaded('comments'))
		{
			$return['comments'] = $this->commentTransformer->transformCollection($note->comments);
		}

		/**
		 * if author relation is loaded
		 */
		if($note->relationLoaded('author'))
		{
			$return['author'] = $this->authorTransformer->transformCollection($note->author);
		}

		return $return;
	}	
}