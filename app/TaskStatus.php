<?php

namespace p4;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
  public function tasks() {
      # Task status can be applied to many tasks
      # Define a one-to-many relationship.
      return $this->hasMany('p4\Task');
  }

  public static function getForDropdown()
  {

    $task_statuses = TaskStatus::orderBy('name', 'ASC')->get();

    $task_statuses_for_dropdown = [];
    foreach($task_statuses as $task_status)
    {
      $task_statuses_for_dropdown[$task_status->id] = $task_status->name;
    }

    return $task_statuses_for_dropdown;
  }
}
