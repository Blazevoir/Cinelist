<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ScoreMovie;
use App\ScoreTv;
use App\WatchedMovie;
use App\WatchedTv;
use App\User;
use config\Functions;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            $client = new \GuzzleHttp\Client();
            
            $latestWatchedMovies = WatchedMovie::where('iduser',Auth::user()->id)->orderBy('created_at','desc')->take(10)->get();
            $latestWatchedTv = WatchedTv::where('iduser',Auth::user()->id)->orderBy('created_at','desc')->take(10)->get();
            
            $countLatestMovies = ScoreMovie::where('iduser', Auth::user()->id)->count();
            $countLatestTv = ScoreTv::where('iduser', Auth::user()->id)->count();
            // Si el usuario ha visto alguna película o serie, las mostramos y sacamos las relacionadas.
            
            $latestWatchedMovies = Functions::doListQuery('movie',$latestWatchedMovies);
            $latestWatchedTv = Functions::doListQuery('tv',$latestWatchedTv);
            $latestWatchedMovies = Functions::setTrailer($latestWatchedMovies,$client);
            // $latestWatchedTv = Functions::setTrailer($latestWatchedTv,$client);
            $relatedmovies = null;
            
            //si hay películas, saca relacionadas
            if(isset($latestWatchedMovies[0])){
                $relatedmovies = Functions::getSeveralRelated($latestWatchedMovies,'movie',$client);
    
                $relatedmovies = Functions::setTrailerHome($relatedmovies,$client,'movie');
                $relatedmovies = Functions::getRows($relatedmovies,4);
                $aux;
                foreach($relatedmovies as $movie){
                    $movie['votes'] = Functions::getVotes('movie',$movie['id']);
                    $movie['notamedia'] = Functions::getNotaMedia('movie',$movie['id']);
                    $aux[]=$movie;
                }
                $relatedmovies = $aux;
                shuffle($relatedmovies);
                $relatedmovies = array_slice($relatedmovies,0,2);
            }
            
            //Enviamos datos sobre el encabezado y la foto de perfil del usuario
            $hasProfilePic = false;
            if(file_exists('assets/profilepics/' . Auth::user()->id .'.png')){
                $hasProfilePic = true;
            }
            $hasBackgroundPic = false;
            if(file_exists('assets/backgrounds/' . Auth::user()->id .'background.png')){
                $hasBackgroundPic = true;
            }
            // dd($relatedmovies);
            return view('home')->with([
                    'latestWatchedMovies' => $latestWatchedMovies,
                    'latestWatchedTv' => $latestWatchedTv,
                    'countLatestMovies' => $countLatestMovies,
                    'countLatestTv' => $countLatestTv,
                    'relatedmovies' => $relatedmovies,
                    'hasProfilePic' => $hasProfilePic,
                    'hasBackgroundPic' => $hasBackgroundPic,
                  ]);
    }
    
}
