<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }
    
    
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        
        
            $this->username = $this->findUsername($request);

            $user = \DB::table('users')->where($this->username, $request['email'])->first();
            
            if($user==null) 
            {
                $request->session()->put('alert','danger');
                $request->session()->put('message','Error login in: username does not exist');
                return back();
            }
            
            $request['email'] = $user->email;
            
            if($user->email_verified_at == null)
            {
                $request->session()->put('alert','danger');
                $request->session()->put('message','Error login in: Email hasnt been verified');
                return back();
            }
            
            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if (method_exists($this, 'hasTooManyLoginAttempts') &&
                $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
    
                return $this->sendLockoutResponse($request);
            }
            
    
            if ($this->attemptLogin($request)) {
                $request->session()->put('alert','success');
                $request->session()->put('message','Login successfull');
                return $this->sendLoginResponse($request);
            } else {
                $request->session()->put('alert','danger');
                $request->session()->put('message','Invalid Credentials, try again.');
            }
    
            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);
    
            return $this->sendFailedLoginResponse($request);
    }
    
    
     /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $messages = [
            'username.required' => 'Username cannot be empty',
            'email.exists' => 'Username already registered',
            'username.exists' => 'Username is already registered',
            'password.required' => 'Password cannot be empty',
        ];

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'email' => 'string|exists:users',
            'username' => 'string',
        ], $messages);
    }
    
    
    

 
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername(Request $request)
    {
        $login = $request['email'];
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
        $request[$fieldType] = $login;
 
        return $fieldType;
    }
 
    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }
    
    public function showLoginForm(){
        return redirect('/');
    }
}
