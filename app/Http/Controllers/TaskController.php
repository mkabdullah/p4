<?php

namespace p4\Http\Controllers;

use Illuminate\Http\Request;

use p4\Http\Requests;

use App;
use DB;

class TaskController extends Controller
{

  public function debug()
  {
    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tasks =[];

      #check if this is a logged in user
      if(! \Auth::guest())
      {
        #get the task list for this user
        $tasks = \p4\Task::where('user_id', '=', \Auth::user()->id)->get();
      }

      #forward to the list view
      return view('task.list')->with('tasks', $tasks);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      # get the users for dropdown
      $users_for_dropdown = \p4\User::getForDropdown();

      # get the statuses for dropdown
      $task_statuses_for_dropdown = \p4\TaskStatus::getForDropdown();

      #forward to the create task view
      return view('task.create')->with([
        'users_for_dropdown' => $users_for_dropdown,
        'task_statuses_for_dropdown' => $task_statuses_for_dropdown
      ]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      #validate the input
      $this->validate($request, ['name' => 'required|max:255',
                                'details' => 'required|max:255',]);

      #create a new task object
      $task = new \p4\Task();
      $task->name = $request->name;
      $task->details = $request->details;
      $task->user_id = $request->user_id;
      $task->task_status_id = $request->task_status_id;

      #save the task in DB
      $task->save();

      #Finish
      \Session::flash('flash_message', 'Your task '.$task->name.' was added.');
      return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $task = \p4\Task::find($id);

      if(is_null($task)) {
          \Session::flash('flash_message', 'Task not found');
          return redirect('/');
      }

     $task_statuses_for_dropdown = \p4\TaskStatus::getForDropdown();

      return view('task.edit')->with([
        'task' => $task,
        'task_statuses_for_dropdown' => $task_statuses_for_dropdown
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      #check if the task exists
      $task = \p4\Task::find($request->id);

      if(is_null($task)) {
          \Session::flash('flash_message', 'Task not found');
          return redirect('/');
      }

      #validate the input
      $this->validate($request, ['name' => 'required|max:255',
                                'details' => 'required|max:255',]);

      #set new task values
      $task->name = $request->name;
      $task->details = $request->details;
      $task->task_status_id = $request->task_status_id;
      $task->save();

      # Finish
      \Session::flash('flash_message', 'Your changes to '.$task->name.' were saved.');
      return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      #find the task to be deleted
      $task = \p4\Task::find($id);

      #check if it exists?
      if(is_null($task)) {
          \Session::flash('message','Task not found.');
          return redirect('/');
      }

      # delete the task
      $task->delete();

      # Finish
      \Session::flash('flash_message', $task->name.' was deleted.');
      return redirect('/');

    }


    public function complete()
    {
      #get the status id for COMPLETE
      $task_status = \p4\TaskStatus::where('name', '=', 'COMPLETE')->first();

      #get the completed tasks
      $tasks = \p4\Task::where('user_id', '=', \Auth::user()->id)->where('task_status_id', '=', $task_status->id)->get();

      #return the list view
      return view('task.list')->with('tasks', $tasks);

    }

    public function incomplete()
    {
      #get the status id for INCOMPLETE
      $task_status = \p4\TaskStatus::where('name', '=', 'INCOMPLETE')->first();

      #get the incomplete tasks
      $tasks = \p4\Task::where('user_id', '=', \Auth::user()->id)->where('task_status_id', '=', $task_status->id)->get();

      #return the list view
      return view('task.list')->with('tasks', $tasks);

    }

}
