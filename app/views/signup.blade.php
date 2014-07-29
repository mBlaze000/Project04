@extends('_master')

@section('login')
	active
@stop

@section('title')
	Sign up for Task Manager
@stop

@section('body')
    
    <p>
        {{ Form::open(array('url' => '/signup')) }}
        
            Email<br>
            {{ Form::text('email') }}<br><br>
        
            First Name<br>
            {{ Form::text('name') }}<br><br>
        
            Password:<br>
            {{ Form::password('password') }}<br><br>
        
        
            {{ Form::submit('Sign Up') }}
        
        {{ Form::close() }}
    </p>

@stop

