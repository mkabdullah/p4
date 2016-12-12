<?php

namespace p4;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
  public function users()
  {
      # Role can be applied to many users
      # Define a one-to-many relationship.
      return $this->hasMany('p4\User');
  }

  public static function getForDropdown()
  {
      $user_roles = UserRole::orderBy('name', 'ASC')->get();
      $user_roles_for_dropdown = [];
      foreach($user_roles as $user_role)
      {
          $user_roles_for_dropdown[$user_role->id] = $user_role->name;
      }
      return $user_roles_for_dropdown;
  }
}
