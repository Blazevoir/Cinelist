<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WatchedEpisode;
use App\Episode;
use App\Favorite;
use App\FavoriteTv;
use App\Planned;
use App\PlannedTv;
use App\WatchedMovie;
use App\WatchedTv;
use App\WatchingMovie;
use App\WatchingTv;


class CheckController extends Controller
{
    public function checkEpisode(Request $request){
        $iduser = $request['iduserr'];
        $idtv = $request['idtvr'];
        
        try{
            $episodes = WatchedEpisode::select('idepisode')->where('iduser', $iduser)->where('idtv' ,$idtv)->get();
            
            foreach($episodes as $episode)
            {
                $array[] = (string) $episode['idepisode'];    
            }
            if(isset($array) && $array != null){
                return response()->json([
                    'episodes' => $array,
                    'viewed' => 'yes',
                ]);
            } else {
                return response()->json([
                    'viewed' => 'no',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'viewederror' => $e,
            ]);
        }
        
    }
    
    public function checkSeason(Request $request){
        $iduser = (int)$request['iduserr'];
        $idseason = (int)$request['idseasonr'];
        try{
            $episodes = Episode::select('id')->where('idseason', $idseason)->get();
            $episodesSeason = WatchedEpisode::select('idepisode as id')->where('idseason',$idseason)->where('iduser',$iduser)->get();
            
            if( count($episodes) === count($episodesSeason) && count($episodes)>0 ){
                return response()->json([
                    'viewed' => 'yes',
                ]);
            } else {
                return response()->json([
                    'viewed' => 'no',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'viewederror' => $e,
            ]);
        }
        
    }    
    
    public function checkFavorite(Request $request){
        $idmedia = $request['idmedia'];
        $iduser = $request['iduser'];
        $mediatype = $request['mediatype'];
        
        if($mediatype == 'movie'){
            if(Favorite::where('iduser', $iduser)->where('idmovie', $idmedia)->first() != null){
                return response()->json([
                    'Favorite' => 'yes',
                ]);
            } else {
                return response()->json([
                    'Favorite' => 'no',
                ]);
            }
        } else if($mediatype == 'tv'){
            if(FavoriteTv::where('iduser', $iduser)->where('idtv', $idmedia)->first() != null){
                return response()->json([
                    'Favorite' => 'yes',
                ]);
            } else {
                return response()->json([
                    'Favorite' => 'no',
                ]);
            }
        }
    }
    
    
    public function checkSelect(Request $request){
        $idmedia = $request['idmedia'];
        $iduser = $request['iduser'];
        $mediatype = $request['mediatype'];
        
        if($mediatype == 'movie'){
            
            if(Planned::where('iduser', $iduser)->where('idmovie', $idmedia)->first() != null){
                return response()->json([
                    'select' => 'planned',
                ]);
            } 
            
            if(WatchedMovie::where('iduser', $iduser)->where('idmovie', $idmedia)->first() != null){
                return response()->json([
                    'select' => 'watched',
                ]);
            }
            
            if(WatchingMovie::where('iduser', $iduser)->where('idmovie', $idmedia)->first() != null){
                return response()->json([
                    'select' => 'watching',
                ]);
            } 
            
            return response()->json([
                'select' => 'notlisted',
            ]);
            
            
        }else if($mediatype == 'tv'){
            
            if(PlannedTv::where('iduser', $iduser)->where('idtv', $idmedia)->first() != null){
                return response()->json([
                    'select' => 'planned',
                ]);
            } 
            
            if(WatchedTv::where('iduser', $iduser)->where('idtv', $idmedia)->first() != null){
                return response()->json([
                    'select' => 'watched',
                ]);
            }
            
            if(WatchingTv::where('iduser', $iduser)->where('idtv', $idmedia)->first() != null){
                return response()->json([
                    'select' => 'watching',
                ]);
            } 
            
            return response()->json([
                'select' => 'notlisted',
            ]);
            
        }

    }
    
    public function checkTrendingFavorites(Request $request){
        $iduser = $request['iduser'];

        $tvfav = FavoriteTv::where('iduser', $iduser)->get();
        $moviefav = Favorite::where('iduser', $iduser)->get();

        $favs = [];
        foreach($tvfav as $item){
            array_push($favs,$item['idtv']);

        }
        foreach($moviefav as $item){
            array_push($favs,$item['idmovie']);
        }
        
        
        return response()->json([
            'favs' => $favs,
        ]);
    }
}
