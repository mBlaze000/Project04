@extends('_master')

@section('home')
	active
@stop

@section('title')
	Welcome to Task Manager
@stop

@section('body')
    <p class="toppadding">
    This is your place to track any tasks you may have. If you have been here before, you can continue to follow your progress. 
</p>
    <p>
    If this is your first visit, start by 
    @if(Auth::check())
         creating a <a href="add">new task</a>.
    @else 
        <a href='/login'>Logging in</a>.
    @endif
    </p>

@stop

