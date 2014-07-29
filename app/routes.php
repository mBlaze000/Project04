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

/*-------------------------------------------------------------------------
Home page
-------------------------------------------------------------------------*/
Route::get('/', function()
{
	return View::make('index');
});



/*-------------------------------------------------------------------------
// !get signup user
-------------------------------------------------------------------------*/
Route::get('/signup',
    array(
        'before' => 'guest',
        function() {
            return View::make('signup');
        }
    )
);

/*-------------------------------------------------------------------------
// !post signup user
-------------------------------------------------------------------------*/
Route::post('/signup', array('before' => 'csrf', function() {

	$user = new User;
	$user->email = Input::get('email');
	$user->name = Input::get('name');
	$user->password = Hash::make(Input::get('password'));

	try {
		$user->save();
	}
	catch (Exception $e) {
		return Redirect::to('/signup')
			->with('flash_message', 'Sign up failed; please try again.')
			->withInput();
	}

	# Log in
	Auth::login($user);

	return Redirect::to('/list')->with('flash_message', 'Welcome to Task Manager!');

}));



/*-------------------------------------------------------------------------
// !get login user
-------------------------------------------------------------------------*/
Route::get('/login',
    array(
        'before' => 'guest',
        function() {
            return View::make('login');
        }
    )
);

/*-------------------------------------------------------------------------
// !post login user
-------------------------------------------------------------------------*/
Route::post('/login', array('before' => 'csrf', function() {

	$credentials = Input::only('email', 'password');

	if (Auth::attempt($credentials, $remember = true)) {
		return Redirect::intended('list')->with('flash_message', 'Welcome Back!');
	}
	else {
		return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
	}

	return Redirect::to('login');

}));


/*-------------------------------------------------------------------------
// !get logout user
-------------------------------------------------------------------------*/
Route::get('/logout', function() {

	# Log out
	Auth::logout();

	# Send them to the login page
	return Redirect::to('login');

});


/*-------------------------------------------------------------------------------------------------
// !get list tasks
-------------------------------------------------------------------------------------------------*/
Route::get('/list/{status?}', array('before' => 'auth', function($status = 'all') {
	
	$userid = Auth::user()->id;
	
	if($status == 'completed') {
		$tasks = Task::where('complete', '>', '0')
				->where('user_id', '=', $userid)
				->get();
	}
	elseif($status == 'open') {
		$tasks = Task::where('complete', '=', '0')
				->where('user_id', '=', $userid)
				->get();
	}
	else {
		$tasks = Task::where('user_id', '=', $userid)
				->get();
	}
	return View::make('list')
		->with('tasks', $tasks)
		->with('status', strtolower($status));
}));




/*-------------------------------------------------------------------------------------------------
// !get add tasks
-------------------------------------------------------------------------------------------------*/
Route::get('/add', array('before' => 'auth', function() {
	return View::make('add');
}));

/*-------------------------------------------------------------------------------------------------
// !post add tasks
-------------------------------------------------------------------------------------------------*/
Route::post('/add', array('before' => 'csrf', function() {
	
	$user = Auth::user();
	
	$task = new Task();
				
	$task->name = Input::get('name');
	$task->user()->associate($user);

	$task->save();

	return Redirect::to('/list')->with('flash_message', 'Task added successfully');


}));



/*-------------------------------------------------------------------------------------------------
// !get edit tasks
-------------------------------------------------------------------------------------------------*/
Route::get('/edit/{item}/{status}', array('before' => 'auth', function($item, $status) {
	
	$task = Task::find($item);
	
	return View::make('edit')
		->with('task', $task)
		->with('status', $status);
	
}));

/*-------------------------------------------------------------------------------------------------
// !post edit tasks NEEDS WORK
-------------------------------------------------------------------------------------------------*/
Route::post('/edit/{item}/{status}', array('before' => 'csrf', function($item, $status) {

	$task = Task::find($item);

	$task->name = Input::get('name');
	$task->complete = Input::get('complete');

	$task->save();
	
	if($task->complete > 0) {
		$task->completed_at = $task->updated_at;
	}
	else {
		$task->completed_at = NULL;
	}

	$task->save();
	

	return Redirect::to('/list/'.$status)->with('flash_message', 'Task updated successfully');

}));




/*-------------------------------------------------------------------------
// debugging routes
-------------------------------------------------------------------------*/

// Find out what environment we're in.
Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

// Trigger an error to check whether detailed error or generic error is displayed.
Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});

// Output debugging info about your app's environment and database connection.
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:orange; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});