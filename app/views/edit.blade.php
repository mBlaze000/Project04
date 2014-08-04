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
    <p class="formspace">
        {{ Form::open(array('url' => '/edit/'.$task['id'].'/'.$status )) }}
        
        
            {{ Form::label('name', 'Task Name:', array('class' => 'editlabel')) }}
            {{ Form::text('name', $task['name'], array('class' => 'textinput', 'id' => 'name', 'onblur' => 'funcSetHidden('.$userid.')')) }}<br><br> 
            {{ Form::label('complete', 'Complete?', array('class' => 'editlabel')) }}
            {{ Form::checkbox('complete', 1, $task['complete'], array('onclick' => 'funcToggleDate()')) }}<br><br>
            
            <div id="datecomplete">
            {{ Form::label('completed_at', 'Date Complete:', array('class' => 'editlabel')) }}
            {{ Form::text('completed_at', $complete_date, array('class' => 'textinput')) }}<br>
            (Enter date as mm/dd/yyyy)<br><br>
			</div>
            
            <!--
            -->
        
        
            {{ Form::submit('Update task') }}
        
        {{ Form::close() }}
    </p>
    
    <p id="testOutput">
        @foreach($errors->all() as $message) 
            <div class='error'>{{ $message }}</div>
        @endforeach
    </p>

@stop

@section('footer')
    <script type="text/javascript" src="{{ URL::asset('scripts/edit.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('scripts/add.js') }}"></script>
    
	<!--
    -->
@stop	
    