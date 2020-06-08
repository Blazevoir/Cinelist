<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use config\Functions;
use App\WatchedEpisode;
use App\Episode;
use App\Planned;
use App\PlannedTv;
use App\WatchingMovie;
use App\WatchingTv;
use App\WatchedTv;
use App\WatchedMovie;
use App\Favorite;
use App\FavoriteTv;

class SaveController extends Controller
{
    public function addMediaToList(Request $request){
        $iduser = (int)$request['iduser'];
        $idmedia = (int)$request['idmedia'];
        $list = $request['list'];
        $mediatype = $request['mediatype'];

        try{
            //añadir media a planned to watch
            if($list == 'planned'){
                if($mediatype == 'movie'){
                    if(Planned::where('idmovie',$idmedia)->where('iduser',$iduser)->first() == null){
                        $media = new Planned();
                        $media->iduser = $iduser;
                        $media->idmovie = $idmedia;
                        $media->save();
                        
                        if(WatchedMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = WatchedMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first();
                            $removeMedia->delete();
                        }
                        if(WatchingMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = WatchingMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first();
                            $removeMedia->delete();
                        }                        
                    }
                }
                else{
                    if(PlannedTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() == null){
                        
                        $media = new PlannedTv();
                        $media->iduser = $iduser;
                        $media->idtv = $idmedia;
                        $media->save();
                        
                       if(WatchedTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = WatchedTv::where('idtv',$idmedia)->first();
                            $removeMedia->delete();
                        }
                       if(WatchingTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = WatchingTv::where('idtv',$idmedia)->first();
                            $removeMedia->delete();
                        }                        
                    }
                }
                
            return response()->json([
                'listing' => 'Media añadida a '.$list,
            ]);
            }
            
            
            else if($list == 'watching'){
                if($mediatype == 'movie'){
                    if(WatchingMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first() == null){
                        $media = new WatchingMovie();
                        $media->iduser = $iduser;
                        $media->idmovie = $idmedia;
                        $media->save();
                        
                        if(WatchedMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = WatchedMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first();
                            $removeMedia->delete();
                        }
                        if(Planned::where('idmovie',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = Planned::where('idmovie',$idmedia)->where('iduser',$iduser)->first();
                            $removeMedia->delete();
                        }                        
                    }
                }
                else{
                    if(WatchingTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() == null){
                        $media = new WatchingTv();
                        $media->iduser = $iduser;
                        $media->idtv = $idmedia;
                        $media->save();
                        
                       if(WatchedTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = WatchedTv::where('idtv',$idmedia)->first();
                            $removeMedia->delete();
                        }
                       if(PlannedTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = PlannedTv::where('idtv',$idmedia)->first();
                            $removeMedia->delete();
                        }                        
                    }
                }
            return response()->json([
                'listing' => 'Media añadida a '.$list,
            ]);
            }
            else if($list == 'watched'){
                if($mediatype == 'movie'){
                    if(WatchedMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first() == null){
                        $media = new WatchedMovie();
                        $media->iduser = $iduser;
                        $media->idmovie = $idmedia;
                        $media->save();
                        
                        if(WatchingMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = WatchingMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first();
                            $removeMedia->delete();
                        }
                        if(Planned::where('idmovie',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = Planned::where('idmovie',$idmedia)->where('iduser',$iduser)->first();
                            $removeMedia->delete();
                        }                        
                    }
                }
                else{
                    if(WatchedTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() == null){
                        $media = new WatchedTv();
                        $media->iduser = $iduser;
                        $media->idtv = $idmedia;
                        $media->save();
                        
                       if(WatchingTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = WatchingTv::where('idtv',$idmedia)->first();
                            $removeMedia->delete();
                        }
                       if(PlannedTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() != null){
                            $removeMedia = PlannedTv::where('idtv',$idmedia)->first();
                            $removeMedia->delete();
                        }                        
                    }
                }
                
            return response()->json([
                'listing' => 'Media añadida a '.$list,
            ]);                
            }   
            else if($list == 'notlisted'){
                if($mediatype == 'movie'){
                    if(WatchedMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first() != null){
                        $removeMedia = WatchedMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first();
                        $removeMedia->delete();
                    }
                    if(WatchingMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first() != null){
                        $removeMedia = WatchingMovie::where('idmovie',$idmedia)->where('iduser',$iduser)->first();
                        $removeMedia->delete();
                    }
                    if(Planned::where('idmovie',$idmedia)->where('iduser',$iduser)->first() != null){
                        $removeMedia = Planned::where('idmovie',$idmedia)->where('iduser',$iduser)->first();
                        $removeMedia->delete();
                    }                        
                    
                }
                else{
                    if(WatchedTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() != null){
                        $removeMedia = WatchedTv::where('idtv',$idmedia)->where('iduser',$iduser)->first();
                        $removeMedia->delete();
                    }
                    if(WatchingTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() != null){
                        $removeMedia = WatchingTv::where('idtv',$idmedia)->where('iduser',$iduser)->first();
                        $removeMedia->delete();
                    }
                    if(PlannedTv::where('idtv',$idmedia)->where('iduser',$iduser)->first() != null){
                        $removeMedia = PlannedTv::where('idtv',$idmedia)->where('iduser',$iduser)->first();
                        $removeMedia->delete();
                    }   
                }
            return response()->json([
                'listing' => 'Media unlisted',
            ]);                
            }               
            
        } catch(\Exception $e){
            return response()->json([
                'save' => 'error añadiendo media a la base de datos',
                'error' => $e
                
            ]);
        }
    }
    
    
    public function addFavorite(Request $request){
        $iduser = (int)$request['iduser'];
        $idmedia = (int)$request['idmedia'];
        $mediatype = $request['mediatype'];

        try{
            if($mediatype == 'movie'){
                $media = new Favorite();
                $media->iduser = $iduser;
                $media->idmovie = $idmedia;
                $media->save();
            }   
            else{
                $media = new FavoriteTv();
                $media->iduser = $iduser;
                $media->idtv = $idmedia;
                $media->save();
            }
                
            return response()->json([
                'listing' => 'Media añadida a favoritos',
            ]);
        } catch(\Exception $e){
            return response()->json([
                'save' => 'error añadiendo a favoritos',
                'error' => $e
            ]);
        }

    }
    
    
    public function deleteFavorite(Request $request){
        $iduser = (int)$request['iduser'];
        $idmedia = (int)$request['idmedia'];
        $mediatype = $request['mediatype'];
    
        try{
            if($mediatype == 'movie'){
                $borrarFav = Favorite::where('idmovie',$idmedia)->where('iduser',$iduser)->delete();
                // $borrarFav->delete();
            }
            else{
                $borrarFav = FavoriteTv::where('idtv',$idmedia)->where('iduser',$iduser)->delete();
                // $borrarFav->delete();
            }
                
            return response()->json([
                'listing' => 'Media eliminada de favoritos',
            ]);
        } catch(\Exception $e){
            return response()->json([
                'save' => 'error BORRANDO DE favoritos',
                'error' => $e
                
            ]);
        }

    }    
    
    public function saveSingle(Request $request){
        
        
        try{
            Functions::saveSingle($request['query']);
        } catch(\Exception $e){
            return response()->json([
                'save' => 'error añadiendo media a la base de datos',
                'error' => $e
                
            ]);
        }
        
        return response()->json([
            'save' => 'ok',
        ]);
    }
    
    
    public function saveEpisode(Request $request){
        
        try{
            $episode = new WatchedEpisode();
            $episode->iduser = $request['iduser'];
            $episode->idepisode = $request['idepisode'];
            $episode->idseason = $request['idseason'];
            $episode->idtv = $request['idtv'];
            $episode->save();
            
        } catch(\Exception $e){
            return response()->json([
                'save' => $e,
            ]);
        }

        return response()->json([
            'save' => 'episodio añadido a la bd',

        ]);
    }
    
    public function deleteEpisode (Request $request){
        $iduser = $request['iduser'];
        $idepisode = $request['idepisoder'];

        try{
            $episode = WatchedEpisode::where('iduser', $iduser)->where('idepisode',$idepisode)->first();
            $episode->delete();
            return response()->json([
                'save' => 'borrado completado',
            ]);
        }catch(\Exception $e){
            return response()->json([
                'save' => 'error de borrado',
            ]);
        }
    }
    
    public function saveSeason (Request $request){
        $idseason = (int) $request['idseason'];
        $iduser = (int)$request['iduser'];

        try{
            $seasonEpisodes = Episode::where('idseason',$idseason)->get();
                
                foreach($seasonEpisodes as $episode){
                    if(WatchedEpisode::where('idepisode',$episode['id'])->where('iduser',$iduser)->first() == null){
                        $savedEpisode = new WatchedEpisode();
                        $savedEpisode->iduser = $iduser;
                        $savedEpisode->idepisode = $episode['id'];
                        $savedEpisode->idseason = $idseason;
                        $savedEpisode->idtv = $episode['idtv'];
                        $savedEpisode->save();
                    }
            }
            return response()->json([
                'save' => 'Temporada añadida',
            ]);
        }catch(\Exception $e){
            return response()->json([
                'save' => $e,
                ]);
        }
    }
    
    public function deleteSeason (Request $request){
        $idseason = (int) $request['idseason'];
        $iduser = (int)$request['iduser'];

        try{
            $savedEpisode = WatchedEpisode::where('iduser',$iduser)->where('idseason',$idseason)->get();
            foreach($savedEpisode as $episode){
                $episode->delete();
            }
            return response()->json([
                'save' => 'temporada borrada',
            ]);
        }catch(\Exception $e){
            return response()->json([
                'save' => $e,
                ]);
        }
    }
}
