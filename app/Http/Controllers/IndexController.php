<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use config\Functions;

class IndexController extends Controller
{
    /**
     * 
     * 
     *
     * 
     */ 
    function index(Request $request){
        
        $client = new \GuzzleHttp\Client();
        $trending = Functions::getTrending();
        $trending = Functions::getRows($trending, 4);
        //buscamos las últimas medias que han salido
        $today = Carbon::now()->toDateString();
        $votes = 100;
        
        $res = $client->request('GET', "https://api.themoviedb.org/3/discover/movie?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-En&sort_by=primary_release_date.desc&include_adult=false&include_video=false&page=1&primary_release_date.lte=$today&vote_count.gte=$votes");
        $latestMovies = json_decode($res->getBody(), true);
        $latestMovies = Functions::getRows($latestMovies['results'], 10);
        $latestMovies = Functions::setMediaType($latestMovies, 'movie');
        
        $res = $client->request('GET', "https://api.themoviedb.org/3/discover/tv?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-En&sort_by=first_air_date.desc&include_adult=false&include_video=false&page=1&first_air_date.lte=$today&vote_count.gte=$votes&include_null_first_air_dates=false");
        $latestTv = json_decode($res->getBody(), true);
        $latestTv = Functions::getRows($latestTv['results'], 10);
        $latestTv = Functions::setMediaType($latestTv, 'tv');

        $latestMedia = array_merge($latestMovies, $latestTv);

        $latestMedia = Functions::setTrailer($latestMedia, $client);
        shuffle($latestMedia);

        //conseguimos los votos de la ultima media
        $latestMedia = Functions::getNotaMediaArray($latestMedia);
        $latestMedia  =Functions::getVotesArray($latestMedia);
        //National Actors
        $lastMediaId = $latestMedia[0]['id'];
        $lastMediaMediaType = $latestMedia[0]['media_type'];
        $res = $client->request('GET', "https://api.themoviedb.org/3/$lastMediaMediaType/$lastMediaId/credits?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1");
        $castLastMedia = json_decode($res->getBody(), true);
        shuffle($castLastMedia['cast']);
        // dd($castLastMedia, $latestMedia[0]);
        $castLastMedia = Functions::getActorsAndSetBiography($castLastMedia['cast'], $client);
        $castLastMedia = Functions::shortLength($castLastMedia, 'biography');
        $castLastMedia = Functions::getRows($castLastMedia,3);



        $res = $client->request('GET', "https://api.themoviedb.org/3/discover/movie?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US&region=ES&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&primary_release_date.gte=$today");
        $upcomingMovies = json_decode($res->getBody(), true);
        $upcomingMovies = Functions::getRows($upcomingMovies['results'], 5);
        $upcomingMovies = Functions::setMediaType($upcomingMovies,'movie');
        $upcomingMovies = Functions::setTrailer($upcomingMovies, $client);
        $upcomingMovies = Functions::filterTrailer($upcomingMovies);
        $upcomingMovies = array_values($upcomingMovies);
        
        return view('index')->with([
                    'trending' => $trending,
                    'latestMedia' => $latestMedia,
                    'castLastMedia' => $castLastMedia,
                    'coming_soon' => $upcomingMovies,
                                                    ]);
    }
    
    //Guarda consultas
    function search(Request $request){
        
        $query = $request->input('search-keyword');
        $client = new \GuzzleHttp\Client();
        
        //solicitamos una peticion
        $res = $client->request('GET', "https://api.themoviedb.org/3/search/multi?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=es&query=$query&include_adult=false&page=1");
        
        //pasa la peticion a array
        $arrayb = json_decode($res->getBody(), true);
        
        //filtra las peliculas para mostrar5
        $tmdb = Functions::getRows($arrayb['results'], 5);

        Functions::saveMedia($tmdb);
        
        return back();
        
        return response()->json([
            'respuesta'=>$tmdb,
        ]);
    }
    
    //verifica el corredo
    function verify(Request $request){

        $url = $request->url();

        $trozos = explode('/',$url);
        $token = $trozos[sizeof($trozos)-1];

        $email_verified_at = \Carbon\Carbon::now();
        $email_verified_at->toDateTimeString();


        if( \DB::table('users')->where('token', $token)->update(['email_verified_at' => $email_verified_at])){
            \DB::table('users')->where('token', $token)->update(['token' => null]);
        }
        return redirect('/');

    }
    
    
    
}
