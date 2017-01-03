<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'ApiController@home']);


/**
 * csrf token endpoint
 */
Route::get('/csrf', ['as' => 'csrf', 'uses' => 'ApiController@csrf']);

// auth user
Route::get('/auth', ['as' => 'auth', function (Request $request) {
	return $request->user();
}])->middleware('auth:api');

/**
 * user endpoint group
 */
Route::group(['prefix' => '/users'], function() 
{

	// all users endpoint 
	Route::get('/', ['as' => 'users', 'uses' => 'ApiController@users']);

	// single user endpoint
	Route::get('/{slug}', ['as' => 'users.user', 'uses' => 'ApiController@user']);

	Route::post('/add-user', ['as' => 'users.store', 'uses' => 'UserController@storeUser']);

	// updating user
	Route::put('/update-user/{slug}', ['as' => 'users.update', 'uses' => 'UserController@updateUser']);

	// deleting user
	Route::delete('/delete-user{id}', ['as' => 'users.delete', 'uses' => 'UserController@deleteUser']);

	// user notes endpoint group
	Route::group(['prefix' => '/notes'], function() 
	{

		// user notes endpoint
		Route::get('/all', ['as' => 'users.notes', 'uses' => 'ApiController@userNotes']);

		// storing users note
		Route::post('/add-note', ['as' => 'users.notes.store', 'uses' => 'NoteController@storeNote']);

		// updating users note
		Route::put('/update-note/{note_slug}', ['as' => 'users.notes.update', 'uses' => 'NoteController@updateNote']);

		// users notes and comments endpoint group
		Route::group(['prefix' => '/comments'], function() 
		{

			// users notes and comments endpoint
			Route::get('/all', ['as' => 'users.notes.comments', 'uses' => 'ApiController@userNotesAndComments']);

			Route::post('/add-comment/{note_slug}', ['as' => 'users.notes.comments.store', 'uses' => 'CommentController@storeComment']);

			Route::put('/update-comment/{note_slug}/{comment_id}', ['as' => 'users.notes.comments.update', 'uses' => 'CommentController@updateComment']);

			Route::delete('/delete-comment/{id}', ['as' => 'users.notes.comments.delete', 'uses' => 'CommentController@deleteComment']);

		}); // end user notes, comments group

	}); // end user notes group

	// users comments endpoint group
	Route::group(['prefix' => '/comments'], function() 
	{

		// user comments endpoiunt group
		Route::get('/all', ['as' => 'users.comments', 'uses' => 'ApiController@userComments']);

	}); // end user comments group

}); // end users group

/**
 * Notes endpoint group
 */
Route::group(['prefix' => '/notes'], function() 
{

	// notes endpoint 
	Route::get('/', ['as' => 'notes', 'uses' => 'ApiController@notes']);

	// single note endpoint
	Route::get('/{id}', ['as' => 'note', 'uses' => 'ApiController@note']);

	Route::group(['prefix' => '/comments'], function() {

		Route::get('/all', ['as' => 'notes.comments', 'uses' => 'ApiController@noteComments']);

	}); // end note comments group

}); // end notes group

/**
 * comments ednpoint group
 */
Route::group(['prefix' => '/comments'], function() 
{

	Route::get('/', ['as' => 'comments', 'uses' => 'ApiController@comments']);

	Route::get('/{id}', ['as' => 'comment', 'uses' => 'ApiController@comment']);

	Route::post('/add-comment', ['as' => 'comments.store', 'uses' => 'ApiController@storeComment']);

}); // end comments group

/**
 * messages endpoint group
 */
Route::group(['prefix' => '/messages'], function() 
{
	Route::get('/', ['as' => 'messages', 'uses' => 'ApiController@messages']);
});

