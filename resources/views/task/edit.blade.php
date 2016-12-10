@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Task</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/tasks/{{ $task->id }}">
                      {{ method_field('PUT') }}
                      {{ csrf_field() }}

                      <input name='id' value='{{$task->id}}' type='hidden'>

                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Task Name</label>
                        <div class="col-md-6">
                          <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $task->name) }}">
                          @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Task Details</label>
                        <div class="col-md-6">
                          <input id="details" type="text" class="form-control" name="details" value="{{ old('details', $task->details) }}">
                          @if ($errors->has('details'))
                            <span class="help-block">
                                <strong>{{ $errors->first('details') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>

                      <div class='form-group'>
                        <label for="task_status_id" class="col-md-4 control-label">Task Status</label>
                        <div class="col-md-6">
                          <select name='task_status_id'>
                            @foreach($task_statuses_for_dropdown as $task_status_id => $task_status)
                              <option
                              {{ ($task_status_id == $task->taskStatus->id) ? 'SELECTED' : '' }}
                              value='{{ $task_status_id }}'
                              >{{ $task_status }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Update
                              </button>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
