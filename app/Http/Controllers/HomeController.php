<?php

namespace Notifier\Http\Controllers;

use Illuminate\Http\Request;
use Notifier\Http\Requests\CreateMessageRequest;

use Notifier\Mail\NewMessageSendMail;

use Notifier\Note;
use Notifier\Message;
use Notifier\Transformers\NoteTransformer;

use Mail;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Note $note, Message $message, Mail $mailer, NoteTransformer $noteTransformer)
    {
        $this->middleware('auth', ['only' => 'index']);
        $this->note = $note;
        $this->mailer = $mailer;
        $this->message = $message;
        $this->noteTransformer = $noteTransformer;
    }

    /**
     * show the welcome landingpage
     * @return [type] [description]
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * show logout success view with the authenticated users information
     * @return [type] [description]
     */
    public function logout()
    {
        if(!auth()->check())
            return redirect('/');

        return view('auth.logout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        
        $notes = $this->note->where('user_id', $user->id)->get();

        $js_variables = [
            'notes' => $this->noteTransformer->transformCollection($notes)
        ];

        // return $js_variables['notes'];

        // return $notes;

        return view('home', compact('notes', 'js_variables'));
    }

    /**
     * storing new message ressource and sending email to the client
     * @param  CreateMessageRequest $request [description]
     * @return [type]                        [description]
     */
    public function storeMessage(CreateMessageRequest $request)
    {
        $sender = $request->all();
        // dd($sender);

        if($sender)
        {
            $this->message->create([
                'firstname' => $sender['firstname'],
                'lastname' => $sender['lastname'],
                'email' => $sender['email'],
                'body' => $sender['message']
            ]);

            Mail::to($request->get('email'))->send(new NewMessageSendMail($request->all()));

            Session::flash(
                'send_successfull',
                'Dear ' . $request->get('firstname') . ' ' . $request->get('lastname') . ' Thanks for contacting us we will respond to you as quick as possible'
            );
        }

        Session::flash(
            'send_failed',
            'Dear ' . $request->get('firstname') . ' ' . $request->get('lastname') . ' something went wrong sending your message please try again later, Cheers'
        );

        return redirect()->back();
    }
}
