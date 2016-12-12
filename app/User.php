<?php

namespace p4;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userRole()
    {
      # User can have one role
      # Define an inverse one-to-many relationship.
      return $this->belongsTo('p4\UserRole');
    }

    public static function getForDropdown()
    {
        $users = User::orderBy('name', 'ASC')->get();
        $users_for_dropdown = [];
        foreach($users as $user)
        {
            $users_for_dropdown[$user->id] = $user->name;
        }
        return $users_for_dropdown;
    }
}
