<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use config\Functions;
use App\Review;
use App\ReviewTv;

class MediaController extends Controller
{

   
    function index($mediatype,$id){
        $client = new \GuzzleHttp\Client();
        //este trycatch se asegura de que todo lo que de error de api por fallo de datos caiga en callback y no aparezca error en pantalla.
        try{
            $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
        } catch(\Exception $e){
            return redirect('MediaError');
        }
        
        $media = json_decode($res->getBody(), true);
        $seasons = null;
        $reviews = null;
        
        if($mediatype == 'person'){
            
            //Buscamos la filmografía del actor o director que hayamos encontrado (movies y tvs)
            $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/movie_credits?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $ActorMovies = json_decode($res->getBody(), true);
            
            $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/tv_credits?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $ActorTv = json_decode($res->getBody(), true); 
            
            //elegimos una foto de fondo para el actor; elegimos entre sus peliculas y series
            $backdrop = null;
            for ($i = 0; $i < count($ActorMovies['cast']); $i++) {
                 $backdrop = $ActorMovies['cast'][$i]['backdrop_path'];
                 
                 if($backdrop != null){
                     break;
                 }
            }

            if($backdrop == null){
                 for ($i = 0; $i < count($ActorTv['cast']); $i++) {
                     $backdrop = $ActorTv['cast'][$i]['backdrop_path'];
                     
                     if($backdrop != null){
                         break;
                     }
                }
            }

            
            //Juntamos el resultado en un solo array
            $filmography = array_merge($ActorTv['cast'],$ActorMovies['cast']);
            return view('actor')->with(['person' => $media,
                                        'filmography' => $filmography,
                                        'backdrop' => $backdrop,
                                        'mediatype' => $mediatype,
                                        ]);
                                        
        } else if($mediatype == 'tv'){
            
            for ($i = 1; $i <= $media['number_of_seasons']; $i++) {
                $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/season/$i?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
                $season = json_decode($res->getBody(), true);
                $seasons[] = $season;
            }
            $reviews = ReviewTv::where('idtv',$id)->orderBy('upvotes','desc')->get();
        }
        
        
        //Buscamos una media relacionada con la busqueda
        $alsoLiked = Functions::getRelated($media, $mediatype,$client);
        
        if($alsoLiked != null){
            //sacamos el media type de la media relacionada
            if(isset($alsoLiked[0]['title'])){
                $relatedMediaType = 'movie';
            } else{
              $relatedMediaType = 'tv';  
            } 
            //Asignamos el trailer a la media relacionada
            $alsoLiked[0]['trailer'] = Functions::getTrailer($relatedMediaType,$alsoLiked[0]['id'], $client);
            $alsoLiked = $alsoLiked[0];
        }
        
        //asignamos el trailer, actores y director a nuestra media
        $media['trailer'] = Functions::getTrailer($mediatype, $id, $client);
        
        $media['notamedia'] = Functions::getNotaMedia($mediatype,$id);


        $media['totalvotes'] = Functions::getVotes($mediatype,$id);
        
        $actors = Functions::getActors($mediatype,$id,4,$client);
        $director = Functions::getDirector($mediatype,$id,$client);
        
        //guardamos las compañias, los géneros y las imágenes en una variable aparte
        $companies = $media['production_companies'];
        $genres = $media['genres'];
        $images = Functions::getImages($mediatype,$id,$client);
        
        if($reviews == null){
            $reviews = Review::where('idmovie',$id)->orderBy('upvotes','desc')->get();
        }
        
        $reviews = Functions::getReviewer($reviews);
        $reviews = Functions::getRows($reviews,9);
        $reviews = Functions::checkProfilePic($reviews);

        //mandamos todos los datos para rellenar la plantilla "single" con cualquier tipo de media que busquemos
        return view('single')->with(['media' => $media,
                                    'mediatype' => $mediatype,
                                    'alsoLiked' => $alsoLiked,
                                    'actors' => $actors,
                                    'genres' => $genres,
                                    'companies' => $companies,
                                    'director' => $director,
                                    'images' => $images,
                                    'seasons' => $seasons,
                                    'reviews' => $reviews,
                                    ]);
    }
    
    
}
