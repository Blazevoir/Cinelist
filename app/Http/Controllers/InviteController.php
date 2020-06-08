<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spam;

class InviteController extends Controller
{
    function invite(Request $data)
    {
        $invited = \DB::table('spam')->where('email', $data['email'])->first();
        if($invited != null && $invited->email == $data['email'])
        {
            $data->session()->put('alert','danger');
            $data->session()->put('message','Your friend already have a invitation.');
            return back();
        } 
        
        try{
            $spam = new Spam();
            $spam->email = $data['email'];
            $spam->save();
        } catch(\Exception $e){
            
        }
        
        $correo = new \App\Mail\inviteMail($data['email']);
        \Mail::to($data['email'])->send($correo);
        
        $data->session()->put('alert','success');
        $data->session()->put('message','Your friend have been invited. Thanks for sharing our webpage.');
        return back();
    }
    
    public function registerview(){
        return view('registerview');
    }
}
