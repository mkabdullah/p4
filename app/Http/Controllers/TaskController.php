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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
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
      #return view('lorem-ipsum.generate')->with('paragraphs', $paragraphs);

      $task = \p4\Task::find($id);

      if(is_null($task)) {
          Session::flash('flash_message', 'Task not found');
          return redirect('/');
      }

      $task_statuses = \p4\TaskStatus::orderBy('name', 'ASC')->get();

      $task_statuses_for_dropdown = [];
      foreach($task_statuses as $task_status)
      {
        $task_statuses_for_dropdown[$task_status->id] = $task_status->name;
      }

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
      # Validate
      /*
        $this->validate($request, [
            'title' => 'required|min:3',
            'published' => 'required|min:4|numeric',
            'cover' => 'required|url',
            'purchase_link' => 'required|url',
        ]);
        */
        # Find and update book
        $task = \p4\Task::find($request->id);
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
        //
    }
}
