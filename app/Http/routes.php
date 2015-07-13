<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return Redirect::to('books');
});

Route::get('/home', function () {
    return Redirect::to('books');
});

Route::resource('users', 'UserController');
Route::resource('books', 'BookController');

// Route for list of book which having some user with id TODO POST
Route::get('users/{uid}/books', 'BookController@usersBooks');

// Route for returning the book
Route::delete('users/{uid}/books/{bid}', 'BookController@returnBook');

// Route to list for adding books to user with id
Route::get('books/users/{id}', 'BookController@listAddingBook');

// Route to store books to user with id
Route::get('users/{uid}/books/{bid}', 'BookController@addBook');


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Registration with facebook routes...
Route::get('auth/fb', 'Auth\AuthController@redirectToFb');
Route::get('auth/fb_callback', 'Auth\AuthController@handleFbCallback');
