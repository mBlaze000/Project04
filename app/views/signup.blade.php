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
    <p class="formspace">
        {{ Form::open(array('url' => '/signup')) }}
        
            {{ Form::label('email', 'Email:', array('class' => 'signuplabel')) }}
            {{ Form::text('email', '', array('class' => 'textinput')) }}<br><br>
        
            {{ Form::label('name', 'First Name:', array('class' => 'signuplabel')) }}
            {{ Form::text('name', '', array('class' => 'textinput')) }}<br><br>
        
            {{ Form::label('password', 'Password:', array('class' => 'signuplabel')) }}
            {{ Form::password('password', array('class' => 'textinput')) }}<br>
            (Password must be at least 6 characters)<br><br>
        
        
            {{ Form::submit('Sign Up') }}
        
        {{ Form::close() }}
    </p>
    <p>
    
        @foreach($errors->all() as $message) 
            <div class='error'>{{ $message }}</div>
        @endforeach
           
    </p>

@stop

