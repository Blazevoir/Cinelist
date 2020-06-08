<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use config\Functions;


class SearchController extends Controller
{
    
    public function search(Request $request){
        $query = $request['search-keyword'];
        if(trim($query) == '')
        {
            $request->session()->put('alert','danger');
            $request->session()->put('message','You cant leave search form in blank.');
            return redirect('/');
        }
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', "https://api.themoviedb.org/3/search/multi?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=es&query=$query&include_adult=false&page=1&language=en-US");
        $search = json_decode($res->getBody(), true);
        $search = $search['results'];

        $search = Functions::filterQuery($search);
        $search = Functions::setTrailer($search, $client);
        $search = Functions::setBiography($search, $client);
        $search = Functions::shortLength($search, 'biography');
        $search = Functions::shortLength($search, 'overview');
        $search = array_values($search);
        
        if( count($search) == 0 )
        {
            return redirect("search-$query");
        }
        

        return view('searchList')->with([
                'search' => $search,
                'query' => $query,
                    ]);
    }
    
    public function searchCasting(Request $request)
    {
        $id = $request['id'];
        $media_type = $request['media_type'];
        $query = null;
        $client = new \GuzzleHttp\Client();
        
        $cast = Functions::getActors($media_type, $id, 20, $client);
        foreach($cast as $key => $actor)
        {
            $cast[$key]['media_type'] = 'person';
        }
        $cast = Functions::setBiography($cast,$client );
        $cast = Functions::shortLength($cast, 'biography');
        
        return view('searchList')->with([
                'search' => $cast,
                'query' => $query,
                    ]);
    }

    
}
