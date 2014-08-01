@extends('_master')

@section('login')
	active
@stop

@section('title')
	Login to Task Manager
@stop

@section('body')
    <p>Enter your email address and password.</p>
    <p>
    {{ Form::open(array('url' => '/login')) }}

        Email<br>
        {{ Form::text('email', '') }}<br><br>
    
        Password:<br>
        {{ Form::password('password') }}<br><br>
    
        {{ Form::submit('Log In') }}

    {{ Form::close() }}
    </p>
    
    <p>Not Registered? <a href="/signup">Sign up</a> for a new account.</p>

@stop

