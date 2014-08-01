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
	Here Are Your
	@if ($status != 'all')
        {{ ucfirst($status) }}
    @endif
    Tasks
@stop

@section('body')
    @if(count($tasks) == 0)
        @if($status == 'all')
        	<h2>{{ Auth::user()->name; }}, you haven't entered any tasks yet.</h2>
            <p>Start your task list by <a href="/add/">entering tasks</a>.
        @elseif($status == 'completed')
        	<h2>{{ Auth::user()->name; }}, all of your tasks are currently open.</h2>
        @else
        	<h2>Congratulations {{ Auth::user()->name; }}, all of your tasks have been completed!</h2>
        @endif
    @else
    	<p>
         @if($status == 'all')
        	The tasks in <span class="open">bold</span> are those that have not yet been completed. 
        @endif
        </p>
        <p>
            <div class="table-responsive toppadding">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="icon">&nbsp;</th>
                            <th class="date">CREATED</th>
                            @if($status != 'open')
                                <th class="date">COMPLETED</th>
                            @endif
                            <th>TASK</th>
                            <th class="icon">&nbsp;</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            @if($status != 'open')
                                <td></td>
                            @endif
                            <td colspan="2"><a href="/add/">Add new task</a></td>
                        </tr>
                    </tfoot>
                    <tbody>
                    
                    @foreach($tasks as $task)
                        @if($status == 'all')
                            @if($task['complete'] == 0)
                                <tr class="open">
                            @else
                                <tr class="complete">
                            @endif
                        @else
                            <tr>
                        @endif
                             <td><a href="/edit/{{ $task['id'] }}/{{ $status }}"><img src="/images/edit.png" alt="Edit task" title="Edit task" /></a></td>
                           <td>{{ date_format($task['created_at'], 'M d, Y') }}</td>
                            @if($status != 'open')
                                <td>
                                @if($task['completed_at'] != NULL)
                                    {{ date('M d, Y', strtotime($task['completed_at'])) }}
                                @endif
                                </td>
                            @endif
                            <td>{{ $task['name'] }}</td>
                            <td> <!-- <a href="/delete/{{ $task['id'] }}/{{ $status }}"><img src="/images/delete.png" alt="Delete task" title="Delete task" /></a> --></td>
                            
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
        </p>
    @endif
    

@stop

