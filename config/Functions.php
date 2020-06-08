<?php

namespace config;

use App\User;
use App\Movie;
use App\Tv;
use App\GenreMovie;
use App\Company;
use App\CompanyMovie;
use App\Actor;
use App\ActorMovie;
use App\ImageMovie;
use App\GenreTv;
use App\Genre;
use App\CompanyTv;
use App\ActorTv;
use App\ImageTv;
use App\Season;
use App\Episode;
use App\ScoreMovie;
use App\ScoreTv;
use App\WatchingMovie;
use App\WatchingTv;
use App\WatchedMovie;
use App\WatchedTv;
use App\Planned;
use App\PlannedTv;
use App\Favorite;
use App\FavoriteTv;
use App\Review;
use App\ReviewTv;
use Carbon\Carbon;

use Stevebauman\Location\Facades\Location;

class Functions 
{
    
    
    
    
    public static function checkProfilePic($array)
    {
        foreach($array as $key => $item)
        {
            $id = $item['iduser'];

            if( file_exists('assets/profilepics/' . $id . '.jpg')){
                
                $array[$key]['profilepic'] = $id;
                
            }
        }
        return $array;
    }
    
    /**
     * 
     * 
     */ 
    public static function doListQuery($mediatype,$array)
    {
        $client = new \GuzzleHttp\Client();
        $result = [];
        foreach ($array as $media){
            
            if($mediatype == 'movie')
            {
                $id = $media['idmovie'];
            }
            else 
            {
                $id = $media['idtv'];
            }
            
            $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $body = json_decode($res->getBody(), true);
            $body['media_type'] = $mediatype;
            $result[] = $body;
        }
        return $result;
    }
    
    /**
     * 
     * 
     */
    public static function filterQuery(array $array)
    {
        foreach($array as $key => $item)
        {
            $mediatype = $item['media_type'];
            
            if($mediatype == 'movie' || $mediatype == 'tv')
            {
                if( !isset($item['poster_path']))
                {
                    unset($array[$key]);
                }
                if( !isset($item['overview']))
                {
                    $array[$key]['overview'] = 'there is no overview yet!';
                }

            } else if ($mediatype = 'person'){
                
                if( !isset($item['profile_path']) && !isset($item['biography']) )
                {
                    unset($array[$key]);
                } else {
                    
                    if(!isset($item['profile_path'])){
                        $array[$key]['profile_path'] = '1RH7LHBQnMRH3v7RztpxjQ1VtQ9.jpg';
                    }
                }
                
            }
        }
        return $array;
    }
    
    /**
     * 
     * 
     */
    public static function filterTrailer(array $array)
    {
        foreach($array as $key => $item)
        {
            if(!isset($item['trailer'])){
                unset($array[$key]);
            }
        }
        return $array;
    }
    
    /**
     * 
     * 
     */
    public static function getActors($mediatype,$id,$n,$client)
    {
       
        //registrarr los actores que producen la pelicula 
        // para ello, hacemos la peticion de los actores de esta pelicula
        $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/credits?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1");
        $cast = json_decode($res->getBody(), true);
        //recorremos los actores y los guardamos 
        $actors = [];
        foreach($cast['cast'] as $actor)
        {
            $actors[] = $actor;
        }
        return self::getRows($actors,$n);
    }
    
    /**
     * 
     * 
     */
    public static function getActorsAndSetBiography(array $array, $client)
    {
        $nuevoarray = [];
            foreach($array as $key => $cast)
            {
                $id = $cast['id'];
                $res = $client->request('GET', "https://api.themoviedb.org/3/person/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
                $castDetails = json_decode($res->getBody(), true);
                if($cast['profile_path'] != null)
                {
                    $array[$key]['biography'] = $castDetails['biography'];
                    array_push($nuevoarray, $array[$key]);
                }
    
            }
        return $nuevoarray;
    }
    
    /**
     * 
     * 
     */
    public static function getCustomSearch($genre, $year, $mediatype, $page)
    {
        $client = new \GuzzleHttp\Client();
        
        if(isset($genre) && $genre != null){
            $genreb = "&with_genres=$genre";
        } else {
            $genreb = '';
        }
        
        if(isset($year) && $year != null){
            if($mediatype == 'movie'){
                $yearb = "&primary_release_year=$year";
            } else if($mediatype == 'tv'){
                $yearb = "&first_air_date_year=$year";
            }
        } else {
            $yearb = '';
        }
        // dd("https://api.themoviedb.org/3/discover/$mediatype?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=1$yearb$genreb$keywordb");
        $res = $client->request('GET', "https://api.themoviedb.org/3/discover/$mediatype?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=$page$yearb$genreb");
        $trending = json_decode($res->getBody(), true);
        $trending['results']['total_pages'] = $trending['total_pages'];
        $trending['results']['total_results'] = $trending['total_results'];
        return $trending['results'];
    }
    
    /**
     * 
     * 
     */
    public static function getDirector($mediatype,$id,$client)
    {
       
        //registrarr los actores que producen la pelicula 
        // para ello, hacemos la peticion de los actores de esta pelicula
        $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/credits?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1");
        $crew = json_decode($res->getBody(), true);
        if(!empty($crew['crew'])){
            return $crew['crew'][0];    
        }
        else return null;
        
    }
    
        
    /**
     * 
     * 
     */
    public static function getFavorites($userid)
    {
        $pelis = Favorite::where('iduser', $userid)->orderby('created_at', 'desc')->get();
        $series = FavoriteTv::where('iduser', $userid)->orderby('created_at', 'desc')->get();
        //montamos array de busqueda
        $busqueda = [];
        foreach($pelis as $peli){
            array_push($busqueda, ['mediatype' => 'movie', 'id' => $peli['idmovie']]);
        }
        foreach($series as $serie){
            array_push($busqueda, ['mediatype' => 'tv', 'id' => $serie['idtv']]);
        }
        //montamos array de salida
        $client = new \GuzzleHttp\Client();
        $favorites = [];
        foreach($busqueda as $item){
            $id = $item['id'];
            $mediatype = $item['mediatype'];
            $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $body = json_decode($res->getBody(), true);
            $body['media_type'] = $mediatype;
            array_push($favorites, $body);
        }
        $favorites = self::setTrailer($favorites, $client);
        return $favorites;
    }
    /**
     * 
     * 
     */
    public static function getGenres()
    {
        $generos = Genre::all();
        return $generos->toArray();
    }
    
    /**
     * 
     * 
     */
    public static function getImages($mediatype,$id,$client)
    {
        $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/images?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1");
        $images = json_decode($res->getBody(), true);
        if(!empty($images['backdrops'])){
            $results;
            foreach($images['backdrops'] as $image)
            {
                $results[] = $image['file_path'];
            }
            shuffle($results);
            return array_slice($results,0,9);
        } else return null;
        
    }
    
    /**
     * 
     * 
     */
    public static function getNotaMedia($mediatype, $id)
    {   
        if($mediatype == 'tv'){
            $notamedia = ScoreTv::where('idtv', $id)->avg('score');
            return $notamedia;
        } else if($mediatype == 'movie'){
            $notamedia = ScoreMovie::where('idmovie', $id)->avg('score');
            return $notamedia;
        }
    }
    
    /**
     * 
     * 
     */
    public static function getNotaMediaArray($array)
    {   
        foreach($array as $key => $item)
        {
            if(isset($item['name'])){
                $array[$key]['notamedia'] = ScoreTv::where('idtv', $item['id'])->avg('score');
            } else if(isset($item['title'])){
                $array[$key]['notamedia'] = ScoreMovie::where('idmovie', $item['id'])->avg('score');
            }
        }

        return $array;
    }
    
    /**
     * 
     * 
     */
    public static function getPagination($array)
    {
        
        $current = $array['current'];
        if($current+1 < $array['total_pages']+1){
            $next = $current+1;
        } else {
            $next = null;
        }
        
        if($current-1 > 0){
            $prev = $current - 1;
        } else {
            $prev = null;
        }
        
        if($current > 2){
            $initial = 1;
        } else {
            $initial = null;
        }    
        
        if($current < $array['total_pages'] && $next != $array['total_pages']){
            $last = $array['total_pages'];
        } else {
            $last = null;
        }   


        $pagination = [
            'current' => $array['current'],
            'prev' => $prev,
            'next' => $next,
            'initial' => $initial,
            'last' => $last,
            ];
        
        return $pagination; 
    }
    
    /**
     * 
     * 
     */
    public static function getPlanned($userid)
    {
        $pelis = Planned::where('iduser', $userid)->orderby('created_at', 'desc')->get();
        $series = PlannedTv::where('iduser', $userid)->orderby('created_at', 'desc')->get();
        //montamos array de busqueda
        $busqueda = [];
        foreach($pelis as $peli){
            array_push($busqueda, ['mediatype' => 'movie', 'id' => $peli['idmovie']]);
        }
        foreach($series as $serie){
            array_push($busqueda, ['mediatype' => 'tv', 'id' => $serie['idtv']]);
        }
        //montamos array de salida
        $client = new \GuzzleHttp\Client();
        $planned = [];
        foreach($busqueda as $item){
            $id = $item['id'];
            $mediatype = $item['mediatype'];
            $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $body = json_decode($res->getBody(), true);
            $body['media_type'] = $mediatype;
            array_push($planned, $body);
        }
        $planned = self::setTrailer($planned, $client);
        return $planned;
    }
    
    /**
     * 
     * 
     */
    public static function getRandomRelated($array)
    {
        if($array == null || empty($array)){
            return null;
        }
        $client = new \GuzzleHttp\Client();

        shuffle($array);
        $elegida[0] = $array[0];
        
        if(isset($array[0]['name'])){
            $nombre = $array[0]['name'];
            $fondo = $array[0]['backdrop_path'];
        } else {
            $nombre = $array[0]['title'];
            $fondo = $array[0]['backdrop_path'];
        }
        $related = self::getSeveralRelated($elegida);
        

        foreach($related as $key => $media){
            if(isset($media['title'])){
                $related[$key]['media_type'] = 'movie';
            } else if(isset($media['name'])){
                $related[$key]['media_type'] = 'tv';
            }
        }
        
        shuffle($related);
        $related = self::filterQuery($related);
        $related = array_values($related);
        $related = self::getRows($related,2);
        // dd($related, $nombre, $fondo);
        $related[0]['comes_from'] = $nombre;
        $related[0]['backdrop_from'] = $fondo;
        $related = self::setTrailer($related, $client);
        return $related;
    }
    
    /**
     * 
     * 
     */
    public static function getRelated($media, $mediatype, $client)
    {
     
        //Recogemos la ID de la media
        $id = $media['id'];
        //Cnsultamos de qué media se trata a través de la api
        $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/similar?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
        $body = json_decode($res->getBody(), true);
        //Devolvemos las líneas deseadas
        
        if(empty($body['results'])){
            return null;
        } else {
            $body['results'][0]['overview'] = substr($body['results'][0]['overview'],0,300). '...';
            return self::getRows($body['results'],1);
        }
    }
        
    /**
     * 
     * 
     */
    public static function getReviewer($array)
    {
        $nuevoarray = [];
        foreach($array as $key => $item)
        {
        array_push($nuevoarray, $item);
            try{
                $user = User::find($item['iduser']);
                $nuevoarray[$key]['userName'] = $user->name;
            } catch(\Exception $e){
                $nuevoarray[$key]['userName'] = null;
            }
        }
            return $nuevoarray;
    }
    
     
    /**
     * 
     * 
     */
    public static function getReviews($userid)
    {
        $pelis = Review::where('iduser', $userid)->orderby('created_at', 'desc')->get();
        $series = ReviewTv::where('iduser', $userid)->orderby('created_at', 'desc')->get();
        $pelis = $pelis->toArray();
        $series = $series->toArray();
        //montamos array de busqueda
        $reviews = [];
        foreach($pelis as $peli){
            array_push($reviews,  $peli);
        }
        foreach($series as $serie){
            array_push($reviews,  $serie);
        }
        
        foreach($reviews as $key => $media)
        {
            if( isset($media['idmovie']) ){
                
                $media = Movie::find($media['idmovie']);
            
            }else if( isset($media['idtv']) )
            {
                $media = Tv::find($media['idtv']);
            }
            $reviews[$key]['title'] = $media['title'];
            $reviews[$key]['poster_path'] = $media['thumbnail'];
            $reviews[$key]['created_at'] = substr($reviews[$key]['created_at'],0,10);
        }
        $reviews = self::getRows($reviews,2);
        return $reviews;
    }
    
    /**
     * 
     * 
     */
    public static function getRows(array $array, int $n)
    {
        $salida = [];
        if( sizeof($array)>$n )
        {
            for($i = 0; $i < $n; $i++)
            {
                array_push( $salida, $array[$i] );
            }
            
        } else {
            
            for($i = 0; $i<sizeof($array); $i++)
            {
                array_push( $salida, $array[$i] );
            }
        }
        return $salida;
    }
    
    /**
     * 
     * 
     */
    public static function getSeveralRelated($array)
    {
        $client = new \GuzzleHttp\Client();
        $results = [];
        foreach($array as $media){
            if(array_key_exists('title',$media)){
                $mediatype = 'movie';    
            }
            else
            {
                $mediatype = 'tv';
            }
            $id = $media['id'];
              
            $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/similar?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $body = json_decode($res->getBody(), true);
            $result[] = self::getRows($body['results'],8);
        }
        //dd($result);
        foreach($result as $res){
            foreach($res as $r){
                $salida[] = $r;    
            }
        }
        return $salida;
    }
    
    /**
     * 
     * 
     */
    public static function getTrailer($mediatype,$id,$client)
    {
        
        $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/videos?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
        
        //cambiamos el formato json a array
        $videos = json_decode($res->getBody(), true);
        foreach($videos['results'] as $video)
        {
            if( strtolower($video['type']) == 'trailer' && strtolower($video['site']) == 'youtube' )
            {
                return $video['key'];
            }
        }    
        return null;
        
    }
    
    /**
     * 
     * 
     */
    public static function getToken()
    {
        return 'ip5fywhAehCzhIJ8ot5fuBCZe';        
    }
    
    /**
     * 
     * 
     */
    public static function getSecretToken()
    {
        return 'oSYHXdNDvc2PaSMQEOwzK1hySMxpxL78fbTkJx4ClafYLAd7eq';
    }
    
    /**
     * 
     * 
     */
    public static function getTopRatedMovies($userid)
    {
        $pelis = ScoreMovie::where('iduser', $userid)->orderby('score', 'desc')->get();

        //montamos array de salida
        $client = new \GuzzleHttp\Client();
        $top = [];
        foreach($pelis as $item){
            $id = $item['idmovie'];
            $res = $client->request('GET', "https://api.themoviedb.org/3/movie/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $body = json_decode($res->getBody(), true);
            $body['media_type'] = 'movie';
            array_push($top, $body);
        }
        $top = self::setTrailer($top, $client);
        return $top;
    }
    
    /**
     * 
     * 
     */
    public static function getTopRatedSeries($userid)
    {
        $series = ScoreTv::where('iduser', $userid)->orderby('score', 'desc')->get();

        //montamos array de salida
        $client = new \GuzzleHttp\Client();
        $top = [];
        foreach($series as $item){
            $id = $item['idtv'];
            $res = $client->request('GET', "https://api.themoviedb.org/3/tv/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $body = json_decode($res->getBody(), true);
            $body['media_type'] = 'tv';
            array_push($top, $body);
        }
        $top = self::setTrailer($top, $client);
        return $top;
    }
    
    /**
     * 
     * 
     */
    public static function getTrending($page = 1)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', "https://api.themoviedb.org/3/trending/all/week?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&page=$page");
        $trending = json_decode($res->getBody(), true);
        $trending['results']['total_pages'] = $trending['total_pages'];
        $trending['results']['total_results'] = $trending['total_results'];
        return $trending['results'];
    }
    
    /**
     * 
     * 
     */
    public static function getVotes($mediatype, $id)
    {
        if($mediatype == 'tv'){
            
            $count = ScoreTv::where('idtv',$id)->count();
            return $count;
            
        } else if($mediatype == 'movie'){
            
            $count = ScoreMovie::where('idmovie',$id)->count();
            return $count;
        }
    }
    
    /**
     * 
     * 
     */
    public static function getVotesArray($array)
    {
        foreach($array as $key => $item)
        {
            if(isset($item['name'])){
                $array[$key]['totalvotes'] = ScoreTv::where('idtv',$item['id'])->count();
            } else if(isset($item['title'])){
                $array[$key]['totalvotes'] = ScoreMovie::where('idmovie',$item['id'])->count();
            }
        } 
        return $array;

    }
    
    /**
     * 
     * 
     */
    public static function getWatched($userid)
    {
        $pelis = WatchedMovie::where('iduser', $userid)->orderby('created_at', 'desc')->get();
        $series = WatchedTv::where('iduser', $userid)->orderby('created_at', 'desc')->get();
        //montamos array de busqueda
        $busqueda = [];
        foreach($pelis as $peli){
            array_push($busqueda, ['mediatype' => 'movie', 'id' => $peli['idmovie']]);
        }
        foreach($series as $serie){
            array_push($busqueda, ['mediatype' => 'tv', 'id' => $serie['idtv']]);
        }
        //montamos array de salida
        $client = new \GuzzleHttp\Client();
        $watched = [];
        foreach($busqueda as $item){
            $id = $item['id'];
            $mediatype = $item['mediatype'];
            $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $body = json_decode($res->getBody(), true);
            $body['media_type'] = $mediatype;
            array_push($watched, $body);
        }
        $watched = self::setTrailer($watched, $client);
        return $watched;
    }
    
    /**
     * 
     * 
     */
    public static function getWatching($userid)
    {
        $pelis = WatchingMovie::where('iduser', $userid)->orderby('created_at', 'desc')->get();
        $series = WatchingTv::where('iduser', $userid)->orderby('created_at', 'desc')->get();
        //montamos array de busqueda
        $busqueda = [];
        foreach($pelis as $peli){
            array_push($busqueda, ['mediatype' => 'movie', 'id' => $peli['idmovie']]);
        }
        foreach($series as $serie){
            array_push($busqueda, ['mediatype' => 'tv', 'id' => $serie['idtv']]);
        }
        //montamos array de salida
        $client = new \GuzzleHttp\Client();
        $watching = [];
        foreach($busqueda as $item){
            $id = $item['id'];
            $mediatype = $item['mediatype'];
            $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $body = json_decode($res->getBody(), true);
            $body['media_type'] = $mediatype;
            array_push($watching, $body);
        }
        $watching = self::setTrailer($watching, $client);
        return $watching;
    }
    
    /**
     * 
     * 
     */
    public static function saveActor($actor)
    {
        if(!(Actor::find($actor['id'])))
        {
            
            $newActor = new Actor();
            $actorid = $actor['id'];
            //para guardar los datos personales del actor, necesitamos crear una llamada a la api con el id del actor
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', "https://api.themoviedb.org/3/person/$actorid?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            //pasamos los datos a array
            $actorDetails = json_decode($res->getBody(), true);
            $newActor->id = $actorDetails['id'];
            $newActor->gender = $actorDetails['gender'];
            $newActor->name = $actorDetails['name'];
            $newActor->biography = $actorDetails['biography'];
            $newActor->birth_date = $actorDetails['birthday'];
            $newActor->death_date = $actorDetails['deathday'];
            $newActor->profile_pic = $actorDetails['profile_path'];
            $newActor->save();
            return $actor['id'];
        } else {
            return 0;
        }
    }
    
    /**
     * 
     * 
     */
    public static function saveCompany($company)
    {
        if(!(Company::find($company['id'])))
        {
            $newCompany = new Company();
            $newCompany->id = $company['id'];
            $newCompany->name = $company['name'];
            $newCompany->logo = $company['logo_path'];
            $newCompany->save();
            return $company['id'];
        } else {
            return 0;
        }
    }
    
    /**
     * 
     * 
     */
    public static function saveMedia(array $array)
    {
        foreach($array as $item)
        {
            $media_type = $item['media_type'];
            
            if($media_type == 'tv' && !(Tv::find($item['id'])) )
            {
                 self::saveTv($item);
                
            } else if ($media_type == 'movie' && !(Movie::find($item['id'])))
            {
                self::saveMovie($item);

            } else if ($media_type == 'person' && !(Actor::find($item['id'])))
            {
                self::saveActor($item); 
            }
        }
    }
    
    /**
     * 
     * 
     */
    public static function saveSingle(array $item)
    {

            $media_type = $item['media_type'];
            
            if($media_type == 'tv' && !(Tv::find($item['id'])) )
            {
                 self::saveTv($item);
                
            } else if ($media_type == 'movie' && !(Movie::find($item['id'])))
            {
                self::saveMovie($item);

            } else if ($media_type == 'person' && !(Actor::find($item['id'])))
            {
                self::saveActor($item); 
            }
    
    }
    
    /**
     * 
     * 
     */
    public static function saveMovie(array $item)
    {
        //crear y rellenar movie con lo que tenemos
        $movie = new Movie();
        $id = $item['id'];
        
        //creamos un cliente para conseguir details de la pelicula y poder guardarla
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', "https://api.themoviedb.org/3/movie/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=En");
        
        //cambiamos el formato json a array
        $details = json_decode($res->getBody(), true);
        //declaramos las propiedades
        $movie->id = $details['id'];
        $movie->imdbid = $details['imdb_id'];
        $movie->title = $details['title'];
        $movie->original_title = $details['original_title'];
        $movie->original_language = $details['original_language'];
        if( trim($details['release_date']) == '')
        {
            $details['release_date'] = null;
        }
        $movie->release_date = $details['release_date'];
        $movie->tagline = $details['tagline'];
        $movie->description = $details['overview'];
        $movie->duration = $details['runtime'];
        $movie->thumbnail = $details['backdrop_path'];
        $movie->poster = $details['poster_path'];
        $movie->budget = $details['budget'];
        $movie->revenue = $details['revenue'];
        $movie->web = $details['homepage'];
        $movie->status = $details['status'];

        //creamos una peticion al cliente para conseguir el trailer
        $res = $client->request('GET', "https://api.themoviedb.org/3/movie/$id/videos?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
        
        //cambiamos el formato json a array
        $videos = json_decode($res->getBody(), true);
        foreach($videos['results'] as $video)
        {
            if( strtolower($video['type']) == 'trailer' && strtolower($video['site']) == 'youtube' )
            {
                $movie->trailer = $video['key'];
                break;
            }
        }
        
        //guardar la pelicula
        $movie->save();
        
        //registrar los generos de la pelicula
        foreach($details['genres'] as $genre)
        {
            $genreMovie = new GenreMovie();
            $genreMovie->idgenre = $genre['id'];
            $genreMovie->idmovie = $id;
            $genreMovie->save();
        }
        
        //registrar las compañias que producen la pelicula
        foreach($details['production_companies'] as $company)
        {
            //guardar compañia
            self::saveCompany($company);
            //registrar las compañias de la peli
            $companyMovie = new CompanyMovie();
            $companyMovie->idcompany = $company['id'];
            $companyMovie->idmovie = $id;
            $companyMovie->save();
        }
        
        //registrarr los actores que producen la pelicula 
        // para ello, hacemos la peticion de los actores de esta pelicula
        $res = $client->request('GET', "https://api.themoviedb.org/3/movie/$id/credits?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1");
        
        //cambiamos el formato json a array
        $cast = json_decode($res->getBody(), true);
        //recorremos los actores y los guardamos 
        foreach($cast['cast'] as $actor)
        {
            //guardar actor
            self::saveActor($actor);
            $actorMovie = new ActorMovie();
            $actorMovie->idactor = $actor['id'];
            $actorMovie->idmovie = $id;
            $actorMovie->character = $actor['character'];
            $actorMovie->save();
        }
        
        //por ultimo, registramos las imagenes de la peli.
        $res = $client->request('GET', "https://api.themoviedb.org/3/movie/$id/images?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1");
        $images = json_decode($res->getBody(), true);
        foreach($images['backdrops'] as $image)
        {
            $newimage = new ImageMovie();
            $newimage->idmovie = $id;
            $newimage->url = $image['file_path'];
            $newimage->height = $image['height'];
            $newimage->width = $image['width'];
            $newimage->save();
        }
        foreach($images['posters'] as $image)
        {
            $newimage = new ImageMovie();
            $newimage->idmovie = $id;
            $newimage->url = $image['file_path'];
            $newimage->height = $image['height'];
            $newimage->width = $image['width'];
            $newimage->save();
        }
        
    }
    
    /**
     * 
     * 
     */
    public static function saveTv(array $item)
    {
        //crear y rellenar tv con lo que tenemos
        $tv = new Tv();
        $id = $item['id'];
        
        //creamos un cliente para conseguir details de la serie y poder guardarla
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', "https://api.themoviedb.org/3/tv/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=En");
        
        //cambiamos el formato json a array
        $details = json_decode($res->getBody(), true);
        
        //declaramos las propiedades
        $tv->id = $details['id'];
        $tv->title = $details['name'];
        $tv->original_title = $details['original_name'];
        $tv->original_language = $details['original_language'];
        if( trim($details['first_air_date']) == '')
        {
            $details['first_air_date'] = null;
        }
        $tv->release_date = $details['first_air_date'];
        $tv->description = $details['overview'];
        $tv->thumbnail = $details['backdrop_path'];
        $tv->poster = $details['poster_path'];
        $tv->web = $details['homepage'];
        $tv->status = $details['status'];
        $tv->in_production = $details['in_production'];
        $tv->next_episode = $details['next_episode_to_air']['air_date'];
        $tv->total_episodes = $details['number_of_episodes'];
        $tv->total_seasons = $details['number_of_seasons'];
        
        //creamos una peticion al cliente para conseguir el trailer
        $res = $client->request('GET', "https://api.themoviedb.org/3/tv/$id/videos?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
        
        //cambiamos el formato json a array
        $videos = json_decode($res->getBody(), true);
        foreach($videos['results'] as $video)
        {
            if( strtolower($video['type']) == 'trailer' && strtolower($video['site']) == 'youtube' )
            {
                $tv->trailer = $video['key'];
                break;
            }
        }

        //guardar la pelicula
        $tv->save();

        //guardamos las temporadas que tiene
        for($i=1; $i<$tv->total_seasons+1; $i++)
        {
            $res = $client->request('GET', "https://api.themoviedb.org/3/tv/$id/season/$i?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $season = json_decode($res->getBody(), true);
            $temporada = new Season();
            $temporada->id = $season['id'];
            $temporada->idtv = $id;
            if( trim($season['air_date']) == '')
            {
                $season['air_date'] = null;
            }
            $temporada->release_date = $season['air_date'];
            $temporada->title = $season['name'];
            $temporada->number = $season['season_number'];
            $temporada->total_episodes = sizeof($season['episodes']);
            $temporada->description = $season['overview'];
            $temporada->poster = $season['poster_path'];
            $temporada->save();
            
            //para cada temporada, registrar los capitulos
            for($j = 1; $j<$temporada->total_episodes+1; $j++)
            {
                $res = $client->request('GET', "https://api.themoviedb.org/3/tv/$id/season/$i/episode/$j?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
                $capitulo = json_decode($res->getBody(), true);
                
                $cap = new Episode();
                $cap->id = $capitulo['id'];
                $cap->idseason = $season['id'];
                $cap->idtv = $id;
                
                if( trim($capitulo['air_date']) == '')
                {
                    $capitulo['air_date'] = null;
                }
                $cap->release_date = $capitulo['air_date'];
                $cap->title = $capitulo['name'];
                $cap->number = $j;
                $cap->description = $capitulo['overview'];
                $cap->season_from = $i;
                $cap->thumbnail = $capitulo['still_path'];
                
                $cap->save();
            }
        }
        
        //registrar los generos de la pelicula
        foreach($details['genres'] as $genre)
        {
            $genreTv = new GenreTv();
            $genreTv->idgenre = $genre['id'];
            $genreTv->idtv = $id;
            $genreTv->save();
        }
        
        //registrar las compañias que producen la pelicula
        foreach($details['production_companies'] as $company)
        {
            //guardar compañia
            self::saveCompany($company);
            //registrar las compañias de la peli
            $companyTv = new CompanyTv();
            $companyTv->idcompany = $company['id'];
            $companyTv->idTv = $id;
            $companyTv->save();
        }
        
        //registrarr los actores que producen la pelicula 
        // para ello, hacemos la peticion de los actores de esta pelicula
        $res = $client->request('GET', "https://api.themoviedb.org/3/tv/$id/credits?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1");
        
        //cambiamos el formato json a array
        $cast = json_decode($res->getBody(), true);
        //recorremos los actores y los guardamos 
        foreach($cast['cast'] as $actor)
        {
            //guardar actor
            self::saveActor($actor);
            $actorTv = new ActorTv();
            $actorTv->idactor = $actor['id'];
            $actorTv->idTv = $id;
            $actorTv->character = $actor['character'];
            $actorTv->save();
        }
        
        //por ultimo, registramos las imagenes de la peli.
        $res = $client->request('GET', "https://api.themoviedb.org/3/tv/$id/images?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1");
        $images = json_decode($res->getBody(), true);
        foreach($images['backdrops'] as $image)
        {
            $newimage = new ImageTv();
            $newimage->idTv = $id;
            $newimage->url = $image['file_path'];
            $newimage->height = $image['height'];
            $newimage->width = $image['width'];
            $newimage->save();
        }
        foreach($images['posters'] as $image)
        {
            $newimage = new ImageTv();
            $newimage->idTv = $id;
            $newimage->url = $image['file_path'];
            $newimage->height = $image['height'];
            $newimage->width = $image['width'];
            $newimage->save();
        }
        
    }
    
    /**
     * 
     * 
     */
    public static function setBiography(array $array, $client)
    {
        
        foreach($array as $key => $cast)
        {
            if($cast['media_type'] == 'person')
            {
                $id = $cast['id'];
                $res = $client->request('GET', "https://api.themoviedb.org/3/person/$id?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
                $castDetails = json_decode($res->getBody(), true);
                if($castDetails['biography'] != '')
                {
                    $array[$key]['biography'] = $castDetails['biography'];
                } else {
                    $array[$key]['biography'] = 'There is no biography yet!';
                } 
            }
            
        }
        
        return $array;
    }
    
    /**
     * 
     * 
     */
    public static function setMediaType(array $array, string $media_type)
    {
        foreach($array as $key => $media)
        {
            $array[$key]['media_type'] = $media_type;
        }
        return $array;
    }
    
    /**
     * 
     * 
     */
    public static function setTrailer(array $array, $client)
    {
        
        foreach($array as $key => $media)
        {
            $id = $media['id'];
            $mediatype = $media['media_type'];
            if($mediatype != 'person')
            {
                
                $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/videos?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
                
                $videos = json_decode($res->getBody(), true);
                
                foreach($videos['results'] as $video)
                {
                    if( strtolower($video['type']) == 'trailer' && strtolower($video['site']) == 'youtube' )
                    {
                        $array[$key]['trailer'] = $video['key'];
                    }
                } 
            }
        }
        return $array;
    }
    
    
    public static function setTrailerHome(array $array, $client,$mediatype)
    {
        
        foreach($array as $key => $media)
        {
            $id = $media['id'];
            if($mediatype != 'person')
            {
                
                $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/videos?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
                
                $videos = json_decode($res->getBody(), true);
                
                foreach($videos['results'] as $video)
                {
                    if( strtolower($video['type']) == 'trailer' && strtolower($video['site']) == 'youtube' )
                    {
                        $array[$key]['trailer'] = $video['key'];
                    }
                } 
            }
        }
        return $array;
    }    
    /**
     * 
     * 
     */
    public static function shortLength(array $array, string $thing)
    {
        foreach($array as $key => $item)
        {
            if(isset($item[$thing]))
            {
                if( strlen($item[$thing]) > 300)
                {
                    $array[$key][$thing] = substr($item[$thing], 0 , 300) . ' ...';
                }
            }
        }
        return $array;
    }
    
    /**
     * 
     * 
     */
    public static function shortLengthBy(array $array, string $thing, $n)
    {
        foreach($array as $key => $item)
        {
            if(isset($item[$thing]))
            {
                if( strlen($item[$thing]) > $n)
                {
                    $array[$key][$thing] = substr($item[$thing], 0 , $n) . ' ...';
                }
            }
        }
        return $array;
    }
    
    /**
     * 
     * 
     */
    public static function TrailerBorrador(array $array, $client)
    {
        foreach($array as $key => $media)
        {
            $id = $media['id'];
            if(array_key_exists('title',$media)){
                $mediatype = 'movie';
            } else $mediatype = 'tv';
            
            $res = $client->request('GET', "https://api.themoviedb.org/3/$mediatype/$id/videos?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $videos = json_decode($res->getBody(), true);
            
            foreach($videos['results'] as $video)
            {
                if( strtolower($video['type']) == 'trailer' && strtolower($video['site']) == 'youtube' )
                {
                    $array[$key]['trailer'] = $video['key'];
                    $array[$key]['media_type'] = $mediatype;
                }
            } 
            
        }
        return $array;
    }

}

