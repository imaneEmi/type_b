<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\ChercheurService;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
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
    protected $redirectTo = "/email/verify";


    private $chercheurService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ChercheurService $chercheurService )
    {
        $this->middleware('guest');
        $this->chercheurService =$chercheurService;
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
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email','email_uca_rech', 'max:255', 'unique:users' ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'prenom' => $data['prenom'],
            'profession' => $data['profession'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


        try {

            $userRole = Role::findByName('user');
            $user->assignRole($userRole);
            return $user;

        } catch (Exception $e) {

            $userRole = Role::create(['name' => 'user']);
            $user->assignRole($userRole);
            return $user;
        }
    }
}
