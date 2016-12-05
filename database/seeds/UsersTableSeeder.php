<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $admin_role_id = \p4\UserRole::where('name','=','ADMIN')->pluck('id')->first();
      $member_role_id = \p4\UserRole::where('name','=','MEMBER')->pluck('id')->first();

      $users = [
        ['jill@harvard.edu','jill','helloworld', $admin_role_id], # <-- Required for P4
        ['jamal@harvard.edu','jamal','helloworld', $member_role_id], # <-- Required for P4
        ['mabdullah@g.harvard.edu','muhammad','helloworld', $member_role_id] # <-- Update with your own info, or remove
      ];

      # Get existing users to prevent duplicates
      $existingUsers = \p4\User::all()->keyBy('email')->toArray();

      foreach($users as $user)
      {
        # If the user does not already exist, add them
        if(!array_key_exists($user[0],$existingUsers))
        {
            $user = \p4\User::create([
              'email' => $user[0],
              'name' => $user[1],
              'password' => Hash::make($user[2]),
              'user_role_id' => $user[3],
            ]);
        }
      }
    }
}
