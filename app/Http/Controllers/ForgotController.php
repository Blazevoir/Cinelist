<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ForgotController extends Controller
{
    public function forgot(Request $request){
        
        try{
            $email = $request['email_forgot'];
            $user = \DB::table('users')->where('email', $email)->first();
            $token = Str::random(32);
            if($user->remember_token == null)
            {
                \DB::table('users')->where('email', $email)->update(['remember_token' => $token]);
                $user->remember_token = $token;
            }
            
            $correo = new \App\Mail\forgotMail($user);
            \Mail::to($email)->send($correo);
            
            $request->session()->put('alert','success');
            $request->session()->put('message','We have send you an email with instructions for change your password.');
            
        } catch(\Exception $e){
            
            $request->session()->put('alert','danger');
            $request->session()->put('message','We couldnt have send you the reset password email.');
            return back();
        }

        return redirect('/');
    }
    
    public function password(){
        return view('newpassword');
    }
    
    public function setPassword(Request $request){
        
        $token = $request['token'];
        $new_password = $request['new_password'];
        $repeat_password = $request['repeat_password'];
        if($new_password == $repeat_password)
        {
            
            \DB::table('users')->where('remember_token', $token)->update(['password' => Hash::make($new_password)]);
            \DB::table('users')->where('remember_token', $token)->update(['remember_token' => null]);
            $request->session()->put('alert','success');
            $request->session()->put('message','Your password have been changed. Log in now.');
            return redirect('/');
        }
        
        $request->session()->put('alert','danger');
        $request->session()->put('message','Both passwords doesnt match.');
        return back();
    }
}
