<?php

namespace Notifier\Http\Controllers;

use Illuminate\Http\Request;

use Notifier\Comment;
use Notifier\Note;

use Auth;

class CommentController extends Controller
{
    public function __construct(Comment $comment, Note $note)
    {
    	$this->comment = $comment;
    	$this->note = $note;
    }

    /**
     * saving new comment
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function storeComment(Request $request, $note_slug)
    {
        $data = $request->all();
        
        $user = Auth::user();

        $note = $this->note->findBySlugOrFail($note_slug);

        $data['user_id'] = $user->id;
        $data['note_id'] = $note->id;

        if(!$data)
        {
            return view('errors.500');
        }

        $this->comment->create([
            'body' => $request->get('body'),
            'user_id' => $request->get('user_id'),
            'note_id' => $request->get('note_id')
        ]);

    }

    /**
     * updating comment ressource
     * @param  Request $request    [description]
     * @param  [type]  $user_id    [description]
     * @param  [type]  $note_id    [description]
     * @param  [type]  $comment_id [description]
     * @return [type]              [description]
     */
    public function updateComment(Request $request, $note_slug, $comment_id)
    {
        $data = $request->all();

        $user = Auth::user();
        $note = $this->note->findBySlugOrFail($note_slug);
        $comment = $this->comment->where('id', $comment_id)->firstOrFail();

        if($data)
        {
           $comment->body = $data['body'];
           $comment->user_id = $user->id;
           $comment->note_id = $note->id;

           $comment->save();
        }

        return redirect()->back();
    }

    /**
     * deleting comment ressource
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteComment($id)
    {
        $comment = $this->comment->where('id', $id)->firstOrFail();

        if(!$comment)
        {
            return response()->json([ 'error' => 'something went wrong deleting a comment' ]);
        }

        $comment->delete();

        return redirect()->back();
    }
}
