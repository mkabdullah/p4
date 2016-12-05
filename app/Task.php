<?php

namespace p4;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  public function taskStatus()
  {
    # Task can have one status
    # Define an inverse one-to-many relationship.
    return $this->belongsTo('p4\TaskStatus');
  }
}
