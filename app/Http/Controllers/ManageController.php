<?php

namespace Notifier\Http\Controllers;

use Illuminate\Http\Request;

use Notifier\User;
use Notifier\Note;
use Notifier\Comment;
use Notifier\Message;

class ManageController extends Controller
{
	/**
	 * Constructor
	 * @param User    $user    [description]
	 * @param Note    $note    [description]
	 * @param Comment $comment [description]
	 */
    public function __construct(User $user, Note $note, Comment $comment, Message $message)
    {
    	   $this->user = $user;
    	   $this->note = $note;
    	   $this->comment = $comment;
         $this->message = $message;
    }

    /**
     * return backend dashboard view
     * @return [type] [description]
     */
    public function dashboard()
    {
    	// return the count of users, notes, comments
    	   $users = $this->user->all();
    	   $notes = $this->note->all();
    	   $comments = $this->comment->all();
         $messages = $this->message->orderBy('id', 'DESC')->take(5)->get();
         
      // return count($messages);

    	// check there is any records if not make it fail
    	if( !count($users) || !count($notes) || !count($comments) || !count($messages))
    	{
    		return response()->json([
    			'error' => 'data not found'
      		]);
    	}

    	// return view with data
    	return view('manage.dashboard', compact('users', 'notes', 'comments', 'messages'));
    }

    /**
     * see users dashboard
     * @return [type] [description]
     */
    public function users()
    {
    	// return all users
    	$users = $this->user->all();

    	// make a check for any records exists
    	if(!count($users))
    	{
    		return response()->json([
          	'error' => 'no users found'
      	]);
    	}

    	// return view with users data
    	return view('manage.users.all', compact('users'));
    }

    /**
     * see single user profile dashboard
     * @return [type] [description]
     */
    public function user($id)
    {
    	// return single user from slug or id with notes and comments
    	$users = $this->user->with('notes', 'comments')->where('id', $id)->get();

    	// make a check for any records exists
    	if(!count($users))
    	{
    		return response()->json([
              	'error' => 'no user found'
          	]);
    	}

    	// return view with data
    	return view('manage.users.user', compact('users'));
    }

    /**
     * see dashboard for all notes
     * @return [type] [description]
     */
    public function notes()
    {
    	// return all the notes and belonging authors
    	$notes = $this->note->all();

    	// make existing records check
    	if(!count($notes))
    	{
    		return response()->json([
              	'error' => 'no notes found'
          	]);
    	}

    	// return view with data
    	return view('manage.notes.all', compact('notes'));
    }

    /**
     * see dashboad for single note
     * @return [type] [description]
     */
    public function note($id)
    {
   		// return note where id and the author, comments it belongs to
   		$note = $this->note->with('author', 'comments')->where('id', $id)->get();
   		
   		// make record check
   		if(!count($note))
    	{
    		return response()->json([
              	'error' => 'no note found'
          	]);
    	}

   		// return view with data
   		return view('manage.notes.note', compact('note'));
    }

    /**
     * see comments dashboard
     * @return [type] [description]
     */
    public function comments()
    {
    	// return all created comments and its authors
    	$comments = $this->comment->with('author', 'note')->get();

        // dd($comments);
    	// make a records existing check
    	 if(!count($comments))
    	 {
    	 	return response()->json([
            	'error' => 'no comments found'
            ]);
    	 }
    	
    	// return view with data
    	return view('manage.comments.all', compact('comments'));
    }

    /**
     * see dashboard for single comment
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function comment($id)
    {
    	// return comment and the author, note the comment belongs to
    	$comment = $this->comment->with('author')->where('id', $id)->get();
    	// make record check
    	if(!count($comment))
    	 {
    	 	return response()->json([
                'error' => 'no comments found'
            ]);
    	 }

    	// return view with data
    	return view('manage.comments.comment', compact('comment'));
    }

    public function messages()
    {
        // return messages with all data
        $messages = $this->message->all();

        // make check if the records exists
        if(!count($messages))
        {
            return response()->json([
                'error' => 'No messages found'
            ], 404);
        }

        // return view with data
        return view('manage.messages.all', compact('messages'));
    }
}
