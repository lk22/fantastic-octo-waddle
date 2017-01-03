<?php

namespace Notifier\Http\Controllers;

use Illuminate\Http\Request;
use Notifier\Note;
use Notifier\User;
use Auth;

class NoteController extends Controller
{
    public function __construct(Note $note, User $user)
    {
    	$this->note = $note;
    	$this->user = $user;
    }

    /**
     * Save new note ressource
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function storeNote(Request $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        if(!$data)
        {
            return view('errors.500');
        }

        $this->note->create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => $request->get('user_id'),
        ]);

        return redirect()->back();
    }

    /**
     * updating note ressource
     * @param  Request $request [description]
     * @param  [type]  $user_id [description]
     * @param  [type]  $note_id [description]
     * @return [type]           [description]
     */
    public function updateNote(Request $request, $note_slug)
    {
        $data = $request->all();
        $user = Auth::user();
        $note = Note::findBySlugOrFail($note_slug);

        if($data && $user && $note)
        {
            $this->note->title = $data['title'];
            $this->note->body = $data['body'];
            $data['user_id'] = $user->id;

            $note->save();
        }

        $notes = $this->note->with('author')->get();

        return redirect()->back();
    }

    /**
     * removing note ressource
     * @param  [type] $note_id [description]
     * @return [type]          [description]
     */
    public function removeNote(Request $request, $note_id)
    {
        $user_id = auth()->user()->id;

        $note = $this->note->whereId($note_id)->firstOrFail();

        if($note)
        {
            $note->delete();
        }

        return redirect(route('home'));

    }
}
