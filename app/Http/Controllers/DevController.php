<?php
namespace App\Http\Controllers;

// require 'vendor/abraham/twitteroauth/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Abraham\TwitterOAuth\TwitterOAuth;


class DevController extends Controller
{
    function index(){
        return view('dev.index');
    }
    
    function search(){
        return view('dev.search');
    }
    
    
    
    function getmovies(Request $request){
        
        $query = $request->input('query');
        
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', "https://api.themoviedb.org/3/search/multi?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=es&query=$query&include_adult=false");
        $arrayb = json_decode($res->getBody(), true);

        return response()->json([
            'respuesta'=>$arrayb,
        ]);
    }
    
    function tuit(){
        $access_token = 'ip5fywhAehCzhIJ8ot5fuBCZe';
        $access_secret = 'oSYHXdNDvc2PaSMQEOwzK1hySMxpxL78fbTkJx4ClafYLAd7eq';
        $consumer = '555316884-Wl7v2LgMP6b3DeUUbNvln3KUj4hKKjHJKBP2cFnr';
        $consumer_secret = 'VsZX21k1njlNudUxhsqKvikXKDfGUT2Em7aEPtJbUIqL1';
        
        $connection = new TwitterOAuth($access_token, $access_secret, $consumer, $consumer_secret);
        $new_status = $connection->post("statuses/update", ["status" => "Entrad a Cinelist, darme de comer amigos. = D"]);
        $new_status2 = $connection->get("account/verify_credentials");
        
        if ($connection->getLastHttpCode() == 200) {
            echo 'posteado';
        } else {
            echo 'error ' . $connection->getLastHttpCode();
        }
        
    }
}
