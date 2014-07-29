@extends('_master')

@section('all')
	@if ($status == 'all')
    	active
    @endif
@stop

@section('complete')
	@if ($status == 'completed')
    	active
    @endif
@stop

@section('open')
	@if ($status == 'open')
    	active
    @endif
@stop

@section('title')
	{{ Auth::user()->name; }}, Edit Your Task
@stop

@section('body')
    <p>
        {{ Form::open(array('url' => '/edit/'.$task['id'].'/'.$status )) }}
        
            Task Name<br>
            {{ Form::text('name', $task['name']) }}<br><br>
            
            Completed?<br>
                @if ($task['complete'] == '0')
                    {{ Form::checkbox('complete', '1') }}<br><br>
                @else
                    {{ Form::checkbox('complete', 1, true) }}<br><br>
                @endif

        
        
            {{ Form::submit('Update task') }}
        
        {{ Form::close() }}
    </p>
    

@stop

