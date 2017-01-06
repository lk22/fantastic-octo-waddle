<?php

namespace Notifier\Http\Controllers;

use Illuminate\Http\Request;
use Notifier\Http\Requests\CreateMessageRequest;

use Notifier\Mail\NewMessageSendMail;

use Notifier\Note;
use Notifier\Message;
use Notifier\User;
use Notifier\Comment;
use Notifier\Transformers\NoteTransformer;
use Notifier\Transformers\UserTransformer;

use Mail;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Note $note, Message $message, Comment $comment, Mail $mailer, NoteTransformer $noteTransformer, UserTransformer $userTransformer)
    {
        $this->middleware('auth', ['only' => 'index']);
        $this->user = $user;
        $this->note = $note;
        $this->comment = $comment;
        $this->mailer = $mailer;
        $this->message = $message;
        $this->noteTransformer = $noteTransformer;
        $this->userTransformer = $userTransformer;
    }

    /**
     * show the welcome landingpage
     * @return [type] [description]
     */
    public function welcome()
    {
        // welcome view
        return view('welcome');
    }

    /**
     * show logout success view with the authenticated users information
     * @return [type] [description]
     */
    public function logout()
    {
        // if user is not logged in return back to home view
        if(!auth()->check())
            return redirect('/');

        // show logout view
        return view('auth.logout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get authenticated user
        $user = auth()->user();
        
        // fetch all suers notes
        $notes = $this->note->where('user_id', $user->id)->get();

        // make data accessable through JavaScript
        $js_variables = [
            'notes' => $this->noteTransformer->transformCollection($notes)
        ];

        // return home view with data
        return view('home', compact('notes', 'js_variables'));
    }

    /**
     * storing new message ressource and sending email to the client
     * @param  CreateMessageRequest $request [description]
     * @return [type]                        [description]
     */
    public function storeMessage(CreateMessageRequest $request)
    {
        // get the sender 
        $sender = $request->all();
        
        // if the sender exists
        if($sender)
        {
            // create a new message with the given form data
            $this->message->create([
                'firstname' => $sender['firstname'],
                'lastname' => $sender['lastname'],
                'email' => $sender['email'],
                'body' => $sender['message']
            ]);

            // send an mail to the message sender 
            Mail::to($request->get('email'))->send(new NewMessageSendMail($request->all()));

            // flash some data to the session
            Session::flash(
                'send_successfull',
                'Dear ' . $request->get('firstname') . ' ' . $request->get('lastname') . ' Thanks for contacting us we will respond to you as quick as possible'
            );

            // redirect back with the session
            return redirect()->back();
        }
        // else
        else
        {
            // return 500
            return view('errors.500');
        }
    }
}
