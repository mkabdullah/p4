<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $jill_user_id = \p4\User::where('email','=','jill@harvard.edu')->pluck('id')->first();
      $jamal_user_id = \p4\User::where('email','=','jamal@harvard.edu')->pluck('id')->first();
      $complete_status_id = \p4\TaskStatus::where('name','=','COMPLETE')->pluck('id')->first();
      $incomplete_status_id = \p4\TaskStatus::where('name','=','INCOMPLETE')->pluck('id')->first();

      $tasks = [
        ['Jill_Task1','First task for Jill',$jill_user_id, $complete_status_id],
        ['Jill_Task2','Second task for Jill',$jill_user_id, $incomplete_status_id],
        ['Jill_Task3','Third task for Jill',$jill_user_id, $incomplete_status_id],
        ['Jamal_Task1','First task for Jamal',$jamal_user_id, $complete_status_id],
        ['Jamal_Task2','Second task for Jamal',$jamal_user_id, $incomplete_status_id],
        ['Jamal_Task3','Third task for Jamal',$jamal_user_id, $incomplete_status_id]
      ];

      foreach($tasks as $task)
      {
          $task = \p4\Task::create([
            'name' => $task[0],
            'details' => $task[1],
            'user_id' => $task[2],
            'task_status_id' => $task[3],
          ]);
      }
    }
}
