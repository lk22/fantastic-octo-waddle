<?php

namespace Notifier\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Notifier\Mail\WelcomeToNotifier;
use Notifier\Transformers\UserTransformer;

use Notifier\User;

class UserController extends Controller
{

	public function __construct(User $user, UserTransformer $userTransformer)
	{
		$this->user = $user;
        $this->userTransformer = $userTransformer;
	}

    /**
     * showing the authenticated user profiler
     * @param  [type] $user_slug [description]
     * @return [type]            [description]
     */
    public function profile($user_slug)
    {
        // grab the first user with the user slug and notes and comments
        $profile = $this->user->with('notes.comments')->whereSlug($user_slug)->get();

        // if profile not exists 
        if(!$profile)
        {   
            // return 404
            return view('errors.404');
        }

        // return $profile;
        
        // make the profile accessable with JavaScript
        $js_variables = [
            'profile' => $profile
        ];

        // return view with data
        return view('auth.profile', compact('profile', 'js_variables'));
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
