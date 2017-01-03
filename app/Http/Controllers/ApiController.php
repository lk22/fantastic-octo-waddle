<?php

namespace Notifier\Http\Controllers;

use Illuminate\Http\Request;

use Notifier\User;
use Notifier\Note;
use Notifier\Comment;
use Notifier\Message;

use Auth;

class ApiController extends Controller
{
    /**
    * constructor
    */
   public function __construct(User $user, Note $note, Comment $comment, Message $message)
   {
   		$this->user = $user;
   		$this->note = $note;
   		$this->comment = $comment;
      $this->message = $message;
   		$this->status = 200;
   		$this->error = "No records was found";
   }

   /**
    * home endpoint
    */
   public function home()
   {
   		return response()->json([ 'message' => 'OK' ]);
   }

   /**
    * csrf endpoint 
    */
   public function csrf()
   {
   		return response()->json([ 'token' => csrf_token() ]);
   }

   /**
    * users endpoint 
    */
   public function users()
   {
   		$users = $this->user->all();

   		if(!count($users))
   		{
     			return response()->json([ 'error' => $this->error ]);
   		}

      return $users;
   }

   /**
    * single user 
    */
   public function user($slug)
   {
      $user = User::findBySlugOrFail($slug);

      if(!count($user))
      {
          return response()->json([ 'error' => $this->error ]);
      }

      return $user;
   }

   /** 
    * users notes endpoint
    */
   public function userNotes()
   {
   		$users = $this->user->with('notes')->get();

   		if(!count($users))
   		{
     			return response()->json([ 'error' => $this->error ]);
   		}

      return $users;
   }

   /**
    * users comments endpoint
    */
   public function userComments()
   {
      $comments = $this->user->with('comments')->get();

      if(!count($comments))
      {
          return response()->json([ 'error' => $this->error ]);
      }

      return $comments;
   }

   /** 
    * users notes and comments endpoint
    */
   public function userNotesAndComments()
   {
      $userNotesAndComments = $this->user->with('notes', 'comments')->get();

      if(!count($userNotesAndComments))
      {
          return response()->json([ 'error' => $this->error ]);
      }

      return $userNotesAndComments;
   }

   /** 
    * notes endpoint
    */
   public function notes()
   {
   		$notes = $this->note->all();

   		if(!count($notes))
   		{
     			return response()->json([ 'error' => $this->error ]);
   		}

   		return $notes;
   }

   /**
    * single note endpoint
    */
   public function note($id)
   {
      $note = $this->note->where('id', $id)->get();

      if(!count($note))
      {
          return response()->json([ 'error' => $this->error ]);
      }

      return $note;
   }

   /**
    * note comments endpoint
    */
   public function noteComments()
   {
      $noteComments = $this->note->with('comments')->get();

      if(!count($noteComments))
      {
          return response()->json([ 'error'  => $this->error ]);
      }

      return $noteComments;
   }

   /**
    * comments
    */
   public function comments()
   {
      $comments = $this->comment->all();

      if(!count($comments))
      {
          return response()->json([ 'error' => $this->error ]);
      }

      return $comments;
   }

   /**
    * comment
    */
   public function comment($id)
   {
      $comment = $this->comment->where('id', $id)->get();

      if(!count($comment))
      {
          $this->error = " comment of following id of " . $id . " is not found";
          return response()->json([ 'error' => $this->error ]);
      }

      return $comment;
   }

   /**
    * messages
    */
   public function messages()
   {
      $messages = $this->message->all();

      if(!count($messages))
      {
          return response()->json([ 'error' => $this->error ]);
      }

      return $messages;
   }

}
