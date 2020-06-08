<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use config\Functions;

class DiscoverController extends Controller
{
    public function discover(Request $request){
        $genre = $request['genre'];
        $year = $request['year'];
        $mediatype = $request['mediatype'];

        if($request['page'] == null)
        {
            $page = 1;
        } else {
            $page = $request['page'];
        }
        
        if($genre != null || $year != null || $mediatype != null){
            
            $trending = Functions::getCustomSearch($genre, $year, $mediatype, $page);

        } else {
            $trending = Functions::getTrending($page);
            
        }
        
        $pagination = [
            'total_pages' => $trending['total_pages'],
            'total_results' => $trending['total_results'],
            'current' => $page
            ];
            
        unset($trending['total_pages']);
        unset($trending['total_results']);
        $trending = Functions::getRows($trending,20);
        $trending = Functions::shortLengthBy($trending, 'overview',200);
        $pagination = Functions::getPagination($pagination);
        $generos = Functions::getGenres();
        
        return view('discover')->with([
            'trending' => $trending,
            'pagination' => $pagination,
            'generos' => $generos,
            'genre' => $genre,
            'year' => $year,
            'mediatype' => $mediatype
            ]);
    }
}
