<?php

namespace p4;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
  public function users() {
      # Role can be applied to many users
      # Define a one-to-many relationship.
      return $this->hasMany('p4\User');
  }
}
