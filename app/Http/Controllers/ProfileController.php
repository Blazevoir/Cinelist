<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use config\Functions;
use App\User;

class ProfileController extends Controller
{
    public function index($id){
        
        //basico para que funcionen los perfiles
        $isHome = false;
        if(Auth::check() && $id == Auth::user()->id){
            $isHome = true;
        }
        //coge el user del perfil
        $user = User::find($id);
        if(!isset($user) || $user == null){
            return redirect('UnkownProfile');
        }
        
        //Enviamos datos sobre el encabezado y la foto de perfil del usuario
        $hasProfilePic = false;
        if(file_exists('assets/profilepics/' . $id .'.png')){
            $hasProfilePic = true;
        }
        $hasBackgroundPic = false;
        if(file_exists('assets/backgrounds/' . $id .'background.png')){
            $hasBackgroundPic = true;
        }
        

        //para las listas 1.WATCHING
        $watching = Functions::getWatching($id);
        $watching = Functions::getRows($watching,20);
        $watchingRelated = Functions::getRandomRelated($watching);
        //2.watched
        $watched = Functions::getWatched($id);
        $watched = Functions::getRows($watched,20);
        $watchedRelated = Functions::getRandomRelated($watched);
        //3.planned
        $planned = Functions::getPlanned($id);
        $planned = Functions::getRows($planned,20);
        $plannedRelated = Functions::getRandomRelated($planned);
        //4.favorite
        $favorite = Functions::getFavorites($id);
        $favorite = Functions::getRows($favorite,20);
        $favoriteRelated = Functions::getRandomRelated($favorite);
        //5.topratedMovies
        $topratedMovies = Functions::getTopRatedMovies($id);
        $topratedMovies = Functions::getRows($topratedMovies,20);
        $topratedMoviesRelated = Functions::getRandomRelated($topratedMovies);
        //6.topratedTv
        $topratedTv = Functions::getTopRatedSeries($id);
        $topratedTv = Functions::getRows($topratedTv,20);
        $topratedTvRelated = Functions::getRandomRelated($topratedTv);
        //reviews
        $reviews = Functions::getReviews($id);
        // dd($topratedTv);
        return view('profile')->with([
            'user' => $user,
            'isHome' => $isHome,
            'hasProfilePic' => $hasProfilePic,
            'hasBackgroundPic' => $hasBackgroundPic,
            'watching' => $watching,
            'watchingRelated' => $watchingRelated,
            'watched' => $watched,
            'watchedRelated' => $watchedRelated,
            'planned' => $planned,
            'plannedRelated' => $plannedRelated,
            'favorite' => $favorite,
            'favoriteRelated' => $favoriteRelated,
            'topratedmovies' => $topratedMovies,
            'topratedmoviesRelated' => $topratedMoviesRelated,
            'topratedtv' => $topratedTv,
            'topratedtvRelated' => $topratedTvRelated,
            'reviews' => $reviews,
            ]);
        
    }
    
    
    
    public function changeProfile(Request $request){
        
        $valid_extensions = ['jpg','png','jpeg','gif'];
    
        $name = $request['name'];
        $username = $request['username'];
        $email = $request['email'];
        $description = $request['description'];
        $iduser = $request['iduser'];
        $user = User::where('id',$iduser)->first();
        
        if($username != null){
            $user['username'] = $username;
        }
        if($email != null){
            $user['email'] = $email;
        }
        if($username != null){
            $user['username'] = $username;
        }
        if($name != null){
            $user['name'] = $name;
        }
        if($description != null){
            $user['description'] = $description;
        }
        try{
            $user->save();
        }catch(\Exception $e){
            $request->session()->put('alert','danger');
            $request->session()->put('message','Error updating your profile.');
            return back();
        }
        
        if($request->hasFile('profilepic')) {
            $profilepic = $request->file('profilepic');
            $target = 'assets/profilepics/';
            $name = $iduser . '.png';
            $profilepic->move($target, $name);
        }
        if($request->hasFile('backgroundpic')) {
            $profilepic = $request->file('backgroundpic');
            $target = 'assets/backgrounds/';
            $name = $iduser . 'background.png';
            $profilepic->move($target, $name);
        }
        
        $request->session()->put('alert','success');
        $request->session()->put('message','Profile updated correctly');
        return back();
            
    }
    
    public function allmedia(Request $request){
        $id = $request['id'];
        $topic = $request['topic'];
        $user = User::find($id);
        
        //basico para que funcionen los perfiles
        $isHome = false;
        if(Auth::check() && $id == Auth::user()->id){
            $isHome = true;
        }
        
        if($topic == 'favorite'){
            $lista = Functions::getFavorites($id);
        } else if ($topic == 'watched'){
            $lista = Functions::getWatched($id);
        } else if ($topic == 'watching'){
            $lista = Functions::getWatching($id);
        } else if($topic == 'planned'){
            $lista = Functions::getPlanned($id);
        } else if($topic = 'topmovies'){
            $lista = Functions::getTopRatedMovies($id);
        } else if($topic = 'toptv'){
            $lista = Functions::getTopRatedSeries($id);
        }
        $lista = Functions::shortLengthBy($lista, 'overview',200);

        return view('allmedia')->with([
            'isHome' => $isHome,
            'user' => $user,
            'allmedia' => $lista,
            'topic' => $topic,
            ]);
    }
}
