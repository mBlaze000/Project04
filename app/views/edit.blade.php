@extends('_master')

@section('title'){{ Auth::user()->name; }}, Edit Your Task @stop

@section('body')
        {{ Form::open(array('url' => '/edit/'.$task['id'].'/'.$status, 'class' => 'formspace' )) }}
        
        
            {{ Form::label('name', 'Task Name:', array('class' => 'editlabel')) }}
            {{ Form::text('name', $task['name'], array('class' => 'textinput', 'id' => 'name', 'onblur' => 'funcSetTask('.$userid.')')) }}<br><br> 
            
            {{ Form::hidden('orig_name','', array('id' => 'orig_name', 'onload' => 'funcSetOrig('.$userid.')')) }}
            {{ Form::hidden('task_name','', array('id' => 'task_name')) }}
        
            {{ Form::label('complete', 'Complete?', array('class' => 'editlabel')) }}
            {{ Form::checkbox('complete', 1, $task['complete'], array('id'=>'checkedoff','onclick' => 'funcToggleDate()')) }}<br><br>
            
            <div id="datecomplete">
            {{ Form::label('completed_at', 'Date Complete:', array('class' => 'editlabel')) }}
            {{ Form::text('completed_at', $complete_date, array('class' => 'textinput')) }}<br>
            (Enter date as mm/dd/yyyy)<br><br>
			</div>
            
            <!--
            -->
            {{ Form::submit('Update task') }}
        
        {{ Form::close() }}
    
    <p id="testOutput">
        @foreach($errors->all() as $message) 
            <div class='error'>{{ $message }}</div>
        @endforeach
    </p>

@stop

@section('footer')
    <script type="text/javascript" src="{{ URL::asset('scripts/edit.js') }}"></script>
    <script>
		funcSetOrig({{ $userid }});
	</script>
	<!--
    -->
@stop	
    