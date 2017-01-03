<?php

namespace Notifier\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Notifier\Mail\WelcomeToNotifier;

use Notifier\User;

class UserController extends Controller
{

	public function __construct(User $user)
	{
		$this->user = $user;
	}

    public function profile($id)
    {
    	// show user with specific id
    	// show the users latests notes
    	// return view with the profile data
    }

    /**
     * save new ressource
     * @param  CreateUserRequest $request [description]
     * @return [type]                     [description]
     */
    public function storeUser(Request $request)
    {
        $data = $request->all();

        if(!count($data))
        {
           return view('errors.404');
        }

        $this->user->create($data);

        $users = $this->user->all();

        return $users;
    }

    /**
     * updating user
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function updateUser(Request $request, $slug)
    {

       $data = $request->all();

       $user = User::findBySlugOrFail($slug);

       if($user && $request->has(['name', 'email', 'password']))
       {
          $username = $request->get('name');
          $email = $request->get('email');
          $password = bcrypt($request->get('password'));

          $user->save();
       }

        // return redirect()->back();
    }

    /**
     * deleting ressource
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteUser($id)
    {
        $user = $this->user->where('id', $id)->firstOrFail();

        if(!$user)
        {
            return view('errors.404');
        }

        $user->delete();

        return redirect()->back();
    }
      

    /**
     * make user email active for newsletter and other email recieval
     * @return [type] [description]
     */
    public function activateUser(Request $request, $token)
    {
        $user = $this->user->where('id', auth()->user()->id)->firstOrFail();

        if($user)
        {

            $this->user->activate($user);

            Mail::to($user->email)->send(new WelcomeToNotifier($user));

            $activate_email = $request->session()->flash('activate_successfull', 'Thanks for activation check your inbox for more information to get started');

            return redirect('/login')->with($activate_email);

        }

        $message = 'something went wrong activating your account please try again later';

        return view('errors.500', compact('message'));
    }
}
