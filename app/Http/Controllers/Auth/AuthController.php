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
      #get the user roles for dropdown
      $user_roles_for_dropdown = \p4\UserRole::getForDropdown();

      #forward to the registeration view
      return view('auth.register')->with('user_roles_for_dropdown', $user_roles_for_dropdown);
    }


    public function store(Request $request)
    {
      #validate the input
      $this->validate($request, ['name' => 'required|max:255',
                                'email' => 'required|email|max:255|unique:users',
                                'password' => 'required|min:6|confirmed',]);

      #get any existing user for this email id
      $existingUsers = \p4\User::all()->keyBy('email')->toArray();

      #create a new user object
      $user = new \p4\User();
      $user->email = $request->email;
      $user->name = $request->name;
      $user->password = bcrypt($request->password);
      $user->user_role_id = $request->user_role_id;

      #check if the user exists already
      if(!array_key_exists($user->email,$existingUsers))
      {
        $user->save();
        \Session::flash('flash_message', 'New user '.$user->name.' was added.');
      }
      else
      {
        \Session::flash('flash_message', 'user email '.$user->email.' already in use.');
      }

      #Finish
      return redirect('/');

    }

}
