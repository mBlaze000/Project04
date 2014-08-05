@extends('_master')

@section('all')active @stop

@section('title')Add Your Task Here @stop

@section('body')
        {{ Form::open(array('url' => '/add', 'class' => 'formspace' )) }}
        
            {{ Form::label('name', 'Task Name:', array('class' => 'editlabel')) }}
            {{ Form::text('name', '', array('class' => 'textinput', 'id' => 'name', 'onblur' => 'funcSetHidden('.$userid.')')) }}<br><br> 
            
            {{ Form::hidden('task_name','', array('id' => 'task_name')) }}
        
            {{ Form::submit('Add task') }}
        
        {{ Form::close() }}
    
    <p id="testOutput">
        @foreach($errors->all() as $message) 
            <div class='error'>{{ $message }}</div>
        @endforeach
    </p>
           
@stop

@section('footer')
	<!--
    -->
    <script type="text/javascript" src="{{ URL::asset('scripts/add.js') }}"></script>
@stop	
