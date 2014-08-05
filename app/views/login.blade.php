@extends('_master')

@section('login')
	active
@stop

@section('title')Login to Task Manager @stop

@section('body')
    <p>If you already have an account on Task Manager. Enter your email address and password.</p>
    <p>If you don't alreeady have an account, sign up for a <a href="/signup">free account</a> using the link below</p>
    
    {{ Form::open(array('url' => '/login', 'class' => 'formspace' )) }}

        {{ Form::label('email', 'Email:', array('class' => 'loginlabel')) }}
        {{ Form::text('email', '', array('class' => 'textinput')) }}<br><br>
    
        {{ Form::label('password', 'Password:', array('class' => 'loginlabel')) }}
        {{ Form::password('password', array('class' => 'textinput')) }}<br><br>
    
        {{ Form::submit('Log In') }}

    {{ Form::close() }}
    
    <p class="formspace">Not Registered?</p>
    <p><a href="/signup">Sign up</a> for a free account.</p>

@stop

