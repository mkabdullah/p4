@extends('layouts.app')

@section('content')
<?php
  #$tasks = \p4\Task::all();
  #$tasks = \p4\Task::where('user_id', '=', Auth::user()->id)->get();

  #Auth::user()->id
 ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>
                <div class="panel-body">

                  @if (Auth::guest())
                    <a href="{{ url('/login') }}">Please Log in!</a>
                  @else

                    <?php
                      $tasks = \p4\Task::where('user_id', '=', Auth::user()->id)->get();
                      if(!$tasks->isEmpty()) {
                    ?>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>ID</th>
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
                            <th scope="row">{{ $task->id }}</th>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->details }}</td>
                            <td>{{ $task->taskStatus->name }}</td>
                            <td><a href="{{ url($edit_url) }}"><i class="fa fa-btn fa-pencil"></i></a>&nbsp;
                                <form method='POST' action='{{ url($delete_url) }}'>
                                  <input name='_method' type='hidden' value='DELETE'>
                                  <input name='id' type='hidden' value='1'>
                                  <a href='javascript:void(0)' onClick='parentNode.submit();return false;'><i class="fa fa-btn fa-trash"></i></a></form></td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    <?php } ?>

                  @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
