<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Notifications\tokenMail;
use Illuminate\Support\Str;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => '12345'
        ]);
    }
    
    function register(Request $data)
    {
        try{
            if($data['password'] == $data['repeat-password'])
            {
                
                $user = User::create([
                    'username' => $data['username'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'token' => Str::random(32),
                ]);
                
            } else {
                $data->session()->put('alert','danger');
                $data->session()->put('message','Password doesnt match, do it again please.');
                return back();
            }
            
        }
        catch(\Exception $e){
            $data->session()->put('alert','danger');
            $data->session()->put('message','Error in register method. Please try it again.');
            return back();
        }


        $data->session()->put('alert','success');
        $data->session()->put('message','Register successfull Check your email for validation purposes');
        
        $correo = new \App\Mail\tokenMail($user);
        \Mail::to($data['email'])->send($correo);
        
        return redirect('/');
    }
    
    


        
}
