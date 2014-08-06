<?php

/*-------------------------------------------------------------------------
// ! Home page
-------------------------------------------------------------------------*/
Route::get('/', function()
{
	return View::make('index');
});


/*-------------------------------------------------------------------------
// ! GET signup user - go to the signup form.
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
// ! POST signup user - process the signup form.
-------------------------------------------------------------------------*/
Route::post('/signup', array('before' => 'csrf', function() {
	
	# Validate user signup info.
	$rules = array(
		'email' => 'required|email|unique:users,email',
		'name' => 'required',
		'password' => 'required|min:6'
	);
	
	$validator = Validator::make(Input::all(), $rules);
	
	if($validator->fails()) {
		return Redirect::to('/signup')
			->with('flash_message', 'Sign up failed; please fix the errors listed below.')
			->withInput()
			->withErrors($validator);
	}

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
// ! GET login user - go to login form.
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
// ! POST login user - process login form.
-------------------------------------------------------------------------*/
Route::post('/login', array('before' => 'csrf', function() {

	$credentials = Input::only('email', 'password');

	# Continue to intended page onced logged in.
	if (Auth::attempt($credentials, $remember = true)) {
		return Redirect::intended('list')->with('flash_message', 'Welcome Back!');
	}
	# Or go back to login page.
	else {
		return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
	}

}));


/*-------------------------------------------------------------------------
// ! GET logout user - log out user and return to login page.
-------------------------------------------------------------------------*/
Route::get('/logout', function() {

	# Log out
	Auth::logout();

	# Send them to the login page
	return Redirect::to('login');

});


/*-------------------------------------------------------------------------------------------------
// ! GET list tasks - present list pages for all, complete and open.
-------------------------------------------------------------------------------------------------*/
Route::get('/list/{status?}', array('before' => 'auth', function($status = 'all') {
	
	$userid = Auth::user()->id;
	
	# Collect the tasks related to the user.
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
// ! GET add tasks - go to add tasks form.
-------------------------------------------------------------------------------------------------*/
Route::get('/add', array('before' => 'auth', function() {
	
	$userid = Auth::user()->id;
	
	return View::make('add')->with('userid', $userid);
}));

/*-------------------------------------------------------------------------------------------------
// ! POST add tasks - process add tasks form.
-------------------------------------------------------------------------------------------------*/
Route::post('/add', array('before' => 'csrf', function() {
	
	#Validation of newly added tasks.
	$rules = array(
		'name' => 'required',
		'task_name' => 'unique:tasks,task_name'
	);
	
	$validator = Validator::make(Input::all(), $rules);
	
	if($validator->fails()) {
		return Redirect::to('/add')
			->with('flash_message', 'Task entry failed; please fix the errors listed below.')
			->withInput()
			->withErrors($validator);
	}

	$user = Auth::user();
	
	$task = new Task();
				
	$task->name = Input::get('name');
	$task->task_name = Input::get('task_name');
	$task->user()->associate($user);

	try {
		$task->save();
	}
	catch (Exception $e) {
		return Redirect::to('/add')
			->with('flash_message', 'Sign up failed; please try again.')
			->withInput();
	}

	# Go to list once the add task has completed.
	return Redirect::to('/list')->with('flash_message', 'Task added successfully');


}));


/*-------------------------------------------------------------------------------------------------
// ! GET edit task - go to edit task page.
-------------------------------------------------------------------------------------------------*/
Route::get('/edit/{item?}/{status?}', array('before' => 'auth', function($item=0, $status='all') {
	
	# make sure the task item exists
	try {
		$task = Task::findOrFail($item);
	}
	catch(Exception $e) {
		return Redirect::to('/list')->with('flash_message', 'Task not found');
	}
	
	$userid = Auth::user()->id;
	
	# assign variable that populates the complete date value in form
	if($task->completed_at != NULL) {
		$complete_date = strtotime($task->completed_at);
		$complete_date = date('m/d/Y',$complete_date);
	}
	else {
		$complete_date = date('m/d/Y');
	}
	
	return View::make('edit')
		->with('task', $task)
		->with('status', $status)
		->with('userid', $userid)
		->with('complete_date', $complete_date);
	
}));

/*-------------------------------------------------------------------------------------------------
// ! POST edit task - process edit task page.
-------------------------------------------------------------------------------------------------*/
Route::post('/edit/{item}/{status}', array('before' => 'csrf', function($item, $status) {

	# Validation of edited task.
	$rules = array(
		'name' => 'required',
		'task_name' => 'unique:tasks,task_name',
		'completed_at'=>'required|date|date_format:m/d/Y'
	);
	
	$validator = Validator::make(Input::all(), $rules);
	
	if($validator->fails()) {
		return Redirect::to('/edit/'.$item.'/'.$status)
			->with('flash_message', 'Task edit failed; please fix the errors listed below.')
			->withInput()
			->withErrors($validator);
	}

	$task = Task::find($item);

	$task->name = Input::get('name');
	$task->complete = Input::get('complete');
	
	# Fills the placeholder field with a value
	# This field is a unique task name for the user.
	if(Input::get('task_name') != '') {
		$task->task_name = Input::get('task_name');
	}
	
	# This populates the completion date field if the complete box is checked.
	if($task->complete > 0) {
		$complete_date = strtotime(Input::get('completed_at'));
		$complete_date = date('Y-m-d h:i:s', $complete_date);
		
		$task->completed_at = $complete_date;
	}
	else {
		$task->completed_at = NULL;
	}
	# 2014-07-31 20:42:34 - the format the timestamp fields are expecting.

	$task->save();
	
	# Once edited, return to list.
	return Redirect::to('/list/'.$status)->with('flash_message', 'Task updated successfully');

}));


/*-------------------------------------------------------------------------------------------------
// ! GET delete task - delete the current task.
-------------------------------------------------------------------------------------------------*/
Route::get('/delete/{item?}/{status?}', array('before' => 'auth', function($item=0, $status='all') {
	
	# make sure the task item exists
	try {
		$task = Task::findOrFail($item);
	}
	catch(Exception $e) {
		return Redirect::to('/list')->with('flash_message', 'Task not found');
	}
	
	# Delete the task. The confirmation is done through javascript.
	$task->delete();
	
	# Return to listonce deleted.
	return Redirect::to('/list/'.$status)
		->with('flash_message', 'Task deleted successfully');
}));

