<?php 

namespace Notifier\Transformers;


class CommentTransformer extends Transformers
{

	public function __construct(UserTransformer $userTransformer, NoteTransformer $noteTransformer)
	{
		$this->authorTransformer = $userTransformer;
		$this->noteTransformer = $noteTransformer;
	}

	public function transform($comment)
	{
		$return = [
			'id' => (integer) $comment->id,
			'body' => (string) $comment->body,
			'created_at' => (string) $comment->created_at,
			'updated_at' => (string) $comment->updated_at
		];

		if($comment->relationLoaded('note'))
		{
			$return['note'] = $this->authorTransformer->transformCollection($comment->note);	
		}

		if($comment->relationLoaded('author'))
		{
			$return['author'] = $this->noteTransformer->transformCollection($comment->author);
		}

		return $return;
	}
}