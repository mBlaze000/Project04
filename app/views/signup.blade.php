@extends('_master')

@section('login')
	active
@stop

@section('title')
	Sign up for Task Manager
@stop

@section('body')
    <p>Please enter your information in the following fields.</p>
    <p>All fields are required.</p>
    <p>
        {{ Form::open(array('url' => '/signup')) }}
        
            Email<br>
            {{ Form::text('email') }}<br><br>
        
            First Name<br>
            {{ Form::text('name') }}<br><br>
        
            Password (at least 6 characters):<br>
            {{ Form::password('password') }}<br><br>
        
        
            {{ Form::submit('Sign Up') }}
        
        {{ Form::close() }}
    </p>
    <p>
    
        @foreach($errors->all() as $message) 
            <div class='error'>{{ $message }}</div>
        @endforeach
           
    </p>

@stop

