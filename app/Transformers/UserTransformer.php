<?php 

namespace Notifier\Transformers;

class UserTransformer extends Transformer
{

	public function __construct(NoteTransformer $noteTransformer, CommentTransformer $commentTransformer)
	{
		$this->noteTransformer = $noteTransformer;
		$this->commentTransforer = $commentTransformer;
	}
	
	public function transform($user)
	{

		/**
		 * fields to transform in json call
		 * @var [type]
		 */
		$return = [
			'id' => (integer) $user->id,
			'name' => (string) $user->name,
			'email' => (string) $user->email,
			'created' => (string) $user->created_at,
			'updated' => (string) $user->updated_at
		];

		/**
		 * if the notes relation is loaded in query
		 */
		if($user->relationLoaded('notes'))
		{
			$return['notes'] = $this->noteTransformer->transformCollection($user->notes);
		}

		/**
		 * if comments relation is loaded in query
		 */
		if($user->relationLoaded('comments'))
		{
			$return['comments'] = $this->commentTransformer->transformCollection($user->comments);
		}

		// return transformation
		return $return;
	}
}