<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * test new registered user email
 */
Route::get('/test-registered-mail', function()
{
	$user = \Auth::loginUsingId(1);
	\Mail::to($user->email)->send(new \Notifier\Mail\WelcomeToNotifier($user));
});

// landing page
Route::get('/', ['as' => 'welcome', 'uses' => 'HomeController@welcome']);

// activate user
Route::get('/activate-user/{token}', ['as' => 'user.activate', 'uses' => 'UserController@activateUser']);

// sending message through landingpage
Route::post('/send-message', ['as' => 'welcome.send.message', 'uses' => 'HomeController@storeMessage']);

// app routes group
Route::group(['prefix' => 'app/home'], function() {
	Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

	Route::group(['prefix' => 'profile'], function() 
	{
		Route::get('/{user_slug}', ['as' => 'auth.profile', 'uses' => 'HomeController@profile']);
	});

	// Route::get('/get-started', ['as' => ''])

	// notes
	Route::group(['prefix' => 'notes'], function() {
		// store new note
		

		// update note


		// delete note
		Route::post('remove-note/{note_id}', ['as' => 'remove.note', 'uses' => 'NoteController@removeNote']);
	}); // end notes app routes
}); // end app routes 


/**
 * Backend route group
 */
Route::group(['prefix' => '/manage'], function() 
{

	// route to backend
	Route::get('/', ['as' => 'manage', 'uses' => 'ManageController@dashboard']);

	// users dashboard group
	Route::group(['prefix' => '/users'], function() {

		// users dashboard endpoint
		Route::get('/', ['as' => 'manage.users', 'uses' => 'ManageController@users']);

		// see single user
		Route::get('/{id}', ['as' => 'manage.user', 'uses' => 'ManageController@user']);

	}); // end manage users

	// notes dashboard group
	Route::group(['prefix' => '/notes'], function() 
	{

		// notes dashboard endpoint
		Route::get('/', ['as' => 'manage.notes', 'uses' => 'ManageController@notes']);

		// single note endpoint
		Route::get('/{id}', ['as' => 'manage.note', 'uses' => 'ManageController@note']);

	});	// end manage notes

	// comments dashboard group
	Route::group(['prefix' => '/comments'], function() 
	{

		// manage comments endpoint
		Route::get('/', ['as' => 'manage.comments', 'uses' => 'ManageController@comments']);

		// single comment endpoint
		Route::get('/{id}', ['as' => 'manage.comment', 'uses' => 'ManageController@comment']);

	}); // end manage comments

	Route::group(['prefix' => '/messages'], function() 
	{

		Route::get('/', ['as' => 'manage.messages', 'uses' => 'ManageController@messages']);

	});

}); // end manage

/**
 * authentication related routes
 */
Auth::routes();

Route::get('/logout-success', ['as' => 'logout.success', 'uses' => 'HomeController@logout']);

Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
