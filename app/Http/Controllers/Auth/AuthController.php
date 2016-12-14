<?php

namespace p4\Http\Controllers\Auth;

use p4\User;
use Validator;
use p4\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;

use App;
use DB;
use Illuminate\Database\Seeder;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_role_id' => $data['user_role_id'],
        ]);
    }

    protected function register()
    {
      $user_roles_for_dropdown = \p4\UserRole::getForDropdown();
      return view('auth.register')->with('user_roles_for_dropdown', $user_roles_for_dropdown);
    }


    public function store(Request $request)
    {
      $user = new \p4\User();
      $user->email = $request->email;
      $user->name = $request->name;
      $user->password = $request->password;
      $user->user_role_id = $request->user_role_id;
      $user->save();

      $existingUsers = \p4\User::all()->keyBy('email')->toArray();

      if(!array_key_exists($user[0],$existingUsers))
      {
          $user = \p4\User::create([
            'email' => $user[0],
            'name' => $user[1],
            'password' => bcrypt($user[2]),
            'user_role_id' => $user[3],
          ]);
      }
      return redirect('/');

    }

}
