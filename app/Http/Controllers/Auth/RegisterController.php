<?php

namespace ORC\Http\Controllers\Auth;

use ORC\User;
use ORC\Group;
use ORC\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use ORC\Role;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'surname' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:255', 'unique:users'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'birth_date' => ['required'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \ORC\User
     */
    protected function create(array $data) {
        $user = User::create([
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'birth_date' => $data['birth_date'],
                    'password' => Hash::make($data['password']),
        ]);

        $role = Role::select('id')->where('name', 'user')->first();
        $user->roles()->attach($role);
        
        // automatic insert into the public group
        $public = Group::where('name','public')->first();
        $user->groups()->attach($public['id']);
            
        return $user;
    }

}
