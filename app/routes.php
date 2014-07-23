<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

// Display test info
Route::get('/test', function()
{
	echo "TEST COMPLETE!";
});

// Find out what environment we're in.
Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

// Trigger an error to check whether detailed error or generic error is displayed.
Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});