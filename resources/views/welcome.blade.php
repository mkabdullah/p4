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
                @if (Auth::guest())
                  <div class="panel-heading">Welcome</div>
                @else
                  <div class="panel-heading">Task List</div>
                @endif

                <div class="panel-body">

                  @if (Auth::guest())
                    <a href="{{ url('/login') }}">Please Log in!</a>
                  @else
                    @yield('task-list')
                  @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
