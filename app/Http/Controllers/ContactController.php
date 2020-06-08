<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use config;

class ContactController extends Controller
{
    private $email = 'cinelisten@gmail.com';

    public function contact(){
        return view('contact');
    }
    
    
    public function contactForm(Request $request){
        try{
            $data = [
                'name' => $request['name'],
                'email' => $request['email'],
                'subject' => $request['subject'],
                'message' => $request['message'],
            ];
            
            $correo = new \App\Mail\contactMail($data);
            \Mail::to($this->email)->send($correo);
            
            $request->session()->put('alert','success');
            $request->session()->put('message','Message sent correctly.');
            

        } catch(\Exception $e){
            $request->session()->put('alert','danger');
            $request->session()->put('message','We couldnt send your message, please try it again later.');
            
        }
    
            return back();

    }
}
