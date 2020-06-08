<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ScoreTv;
use App\ScoreMovie;

class ScoreController extends Controller
{
    public function setScore(Request $request){
        
        $iduser = $request['iduser'];
        $idmedia = $request['idmedia'];
        $score = $request['score'];
        $mediatype = $request['mediatype'];
        

        if($mediatype == 'tv'){
            $votoanterior = ScoreTv::where('iduser', $iduser)->where('idtv', $idmedia)->first();
            if($votoanterior == null){
                try{
                    $nota = new ScoreTv();
                    $nota->iduser = $iduser;
                    $nota->idtv = $idmedia;
                    $nota->score = $score;
                    $nota->save();
                    
                }catch(\Exception $e){
                    return response()->json([
                        'score' => 'error tv',
                    ]);
                    
                }
            } else {
                try{
                    $votoanterior->score = $score;
                    $votoanterior->save();
                } catch(\Exception $e){
                    return response()->json([
                        'score' => 'error actualizando tv',
                    ]);
                }
            }
            

            
        } else if($mediatype == 'movie'){
            
           $votoanterior = ScoreMovie::where('iduser', $iduser)->where('idmovie', $idmedia)->first();
            if($votoanterior == null){
                try{
                    $nota = new ScoreMovie();
                    $nota->iduser = $iduser;
                    $nota->idmovie = $idmedia;
                    $nota->score = $score;
                    $nota->save();
                    
                }catch(\Exception $e){
                    return response()->json([
                        'score' => 'error movie',
                    ]);
                    
                }
            } else {
                try{
                    $votoanterior->score = $score;
                    $votoanterior->save();
                } catch(\Exception $e){
                    return response()->json([
                        'score' => 'error actualizando movie',
                    ]);
                }
            }
            
        }
        
        return response()->json([
            'score' => 'yes',
        ]);
        
    }
    
    public function checkScore(Request $request){
        
        $iduser = $request['iduser'];
        $idmedia = $request['idmedia'];
        $mediatype = $request['mediatype'];
        if($mediatype == 'tv'){
            $votoanterior = ScoreTv::where('iduser', $iduser)->where('idtv', $idmedia)->first();
        } else if($mediatype == 'movie'){
           $votoanterior = ScoreMovie::where('iduser', $iduser)->where('idmovie', $idmedia)->first();
        }
        if($votoanterior != null){
            $nota = $votoanterior->score;
        } else {
            $nota = -1;
        }
        
        return response()->json([
            'score' => $nota,
        ]);


    }
}
