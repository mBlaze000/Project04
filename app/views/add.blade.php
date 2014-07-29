@extends('_master')

@section('all')
	active
@stop

@section('title')
	Add Your Task Here
@stop

@section('body')
    <p>
        {{ Form::open(array('url' => '/add')) }}
        
            Task Name<br>
            {{ Form::text('name') }}<br><br>
        
        
            {{ Form::submit('Add task') }}
        
        {{ Form::close() }}
    </p>

@stop

