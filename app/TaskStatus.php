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
}
