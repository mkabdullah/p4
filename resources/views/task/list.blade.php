@extends('welcome')

@section('task-list')
  <?php
    #$tasks = \p4\Task::where('user_id', '=', Auth::user()->id)->where('task_status_id', '=', $task_status_id)->get();
    #if(!$tasks->isEmpty()) {
    if(! empty($tasks)) {
  ?>
    <table class="table">
      <thead>
        <tr>
          <th>Task Name</th>
          <th>Task Details</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($tasks as $task)
      {
        $edit_url = '/tasks/'.$task->id.'/edit';
        $delete_url = '/tasks/'.$task->id;
      ?>
        <tr>
          @if ($task->taskStatus->name == 'INCOMPLETE')
            <th>{{ $task->name }}</th>
            <th>{{ $task->details }}</th>
            <th>{{ $task->taskStatus->name }}</th>
          @else
            <td>{{ $task->name }}</td>
            <td>{{ $task->details }}</td>
            <td>{{ $task->taskStatus->name }}</td>
          @endif
          <td><a href="{{ url($edit_url) }}"><i class="fa fa-btn fa-pencil"></i></a>&nbsp;
              <form method='POST' action='{{ url($delete_url) }}'>
                <input name='_method' type='hidden' value='DELETE'>
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <input name='id' type='hidden' value='1'>
                <a href='javascript:void(0)' onClick='parentNode.submit();return false;'><i class="fa fa-btn fa-trash"></i></a></form></td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  <?php } ?>
@stop
