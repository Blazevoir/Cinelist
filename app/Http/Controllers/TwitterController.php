<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocialTwitterAccount;
use App\ReviewTv;
use App\Review;
use App\Tv;
use App\Movie;
use App\Functions;
use App\User;
use App\ScoreTv;
use App\ScoreMovie;
use Abraham\TwitterOAuth\TwitterOAuth;


class TwitterController extends Controller
{
    public function tuitvago(Request $request){
        
        //vars
        $id = $request['userid'];
        $mediatype = $request['mediatype'];
        $mediaid = $request['mediaid'];
        $url = $request['url'];
        $reviewid = $request['reviewid'];
        $auth = $request['auth'];
        $tuit = $request['content'];
 
        //keys
        $oauth = SocialTwitterAccount::where('user_id',$id)->first();
        $consumer = $oauth['token'];
        $consumer_secret = $oauth['tokenSecret'];
        $access_token = 'ip5fywhAehCzhIJ8ot5fuBCZe';
        $access_secret = 'oSYHXdNDvc2PaSMQEOwzK1hySMxpxL78fbTkJx4ClafYLAd7eq';
            
        if($mediatype == 'tv'){
            if(isset($reviewid) && $reviewid != null){
                if(!isset($tuit) || $tuit==null || trim($tuit) == ''){
                    $tuit = ReviewTv::select('iduser','content')->where('id',$reviewid)->first();
                    $idreviewer = $tuit['iduser'];
                    $tuit = $tuit['content'];
                    $reviewer = User::find($idreviewer);
                    $tag = null;
                    if($reviewer['source']=='Twitter') 
                    {
                        $tag = $reviewer->username;
                    }                    
                }
                $idtuit = ReviewTv::select('iduser')->where('id',$reviewid)->first();
                $nombretuit = User::select('name')->where('id', $idtuit['iduser'])->first();
            }
            $media = Tv::find($mediaid);
            $media_path = $media->thumbnail;
            if($auth){
                $score = ScoreTv::where('iduser', $id)->where('idtv', $mediaid)->first();
                if($score == null){
                    $score = '?';
                } else {
                    $score = $score->score;
                }
            }
        } else if ($mediatype == 'movie'){
            if(isset($reviewid) && $reviewid != null){
                if(!isset($tuit) || $tuit==null || trim($tuit) == ''){
                    $tuit = Review::select('iduser','content')->where('id',$reviewid)->first();
                    $idreviewer = $tuit['iduser'];
                    $tuit = $tuit['content'];
                    $reviewer = User::find($idreviewer);
                    $tag = null;
                    if($reviewer['source']=='Twitter') 
                    {
                        $tag = $reviewer->username;
                    }
                }
                $idtuit = Review::select('iduser')->where('id',$reviewid)->first();
                $nombretuit = User::select('name')->where('id', $idtuit['iduser'])->first();
            }
            $media = Movie::find($mediaid);
            $media_path = $media->thumbnail;
            if($auth){
                $score = ScoreMovie::where('iduser', $id)->where('idmovie', $mediaid)->first();
                if($score == null){
                    $score = '?';
                } else {
                    $score = $score->score;
                }
            }
        }
        if(strlen($tuit)<120){
            $tuit = substr($tuit,0,strlen($tuit)-4);
        }
        
        $connection = new TwitterOAuth($access_token, $access_secret, $consumer, $consumer_secret);
        
        $urlMedia = 'https://image.tmdb.org/t/p/original' .  $media_path;
        $img = 'tuitmedia.jpg';
        file_put_contents($img, file_get_contents($urlMedia));

        $media1 = $connection->upload('media/upload', array('media' => "/var/www/html/Cinelist/public/tuitmedia.jpg"));

        
        
        if(isset($auth) && $auth){
            $new_status = $connection->post("statuses/update", ["status" => "Review: " . $media['title']   
            . PHP_EOL . "Score: " . $score . "/10."
            . PHP_EOL . substr($tuit, 3, 120) . '...' 
            . PHP_EOL . $url]);
        } else {
            if(isset($tag))
            {
                $contenidoTuit =  "Check out this " . $media['title'] . " review by @" . $tag . PHP_EOL 
                . substr($tuit, 3, 120) . '...' 
                . PHP_EOL . $url;
                
            } else {
                $contenidoTuit = "Check out this " . $media['title'] . " review by " . $nombretuit['name'] . "." . PHP_EOL 
                . substr($tuit, 3, 120) . '...' 
                . PHP_EOL . $url;
            }

        }
        $parameters = [
            'status' => $contenidoTuit,
            'media_ids' => $media1->media_id_string
        ];
        $result = $connection->post('statuses/update', $parameters);

        if ($connection->getLastHttpCode() == 200) {
            return response()->json([
                'tuit' => 'sent',
            ]); 
        } else {
            return response()->json([
                'tuit' => 'error',
                'code' => getLastHttpCode(),
            ]); 
        }
    }
    
    public function checkUserLogin(Request $request){
        
        $userid = $request['userid'];
        $oauth = SocialTwitterAccount::where('user_id',$userid)->first();
        
        if($oauth != null){
            return response()->json([
                'login' => 'twitter',
            ]); 
        } else {
            return response()->json([
                'login' => 'notwitter',
            ]); 
        }

    }
    
    public function tuitMedia(Request $request){
        
        $id = $request['userid'];
        $url = $request['url'];
        $idmedia = $request['idmedia'];
        $mediatype = $request['mediatype'];

        //client
        $client = new \GuzzleHttp\Client();
        
        //keys
        $oauth = SocialTwitterAccount::where('user_id',$id)->first();
        $consumer = $oauth['token'];
        $consumer_secret = $oauth['tokenSecret'];
        $access_token = 'ip5fywhAehCzhIJ8ot5fuBCZe';
        $access_secret = 'oSYHXdNDvc2PaSMQEOwzK1hySMxpxL78fbTkJx4ClafYLAd7eq';
        //connection
        $connection = new TwitterOAuth($access_token, $access_secret, $consumer, $consumer_secret);
        
        if($mediatype == 'tv'){
            $res = $client->request('GET', "https://api.themoviedb.org/3/tv/" . $idmedia . "?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $media = json_decode($res->getBody(), true);
            $nombre = $media['name'];
            $tipo = 'tv show';
        } else if($mediatype == 'movie'){
            $res = $client->request('GET', "https://api.themoviedb.org/3/movie/" . $idmedia . "?api_key=6fb7fb3f5df55b004eb01d9e4b6438d1&language=en-US");
            $media = json_decode($res->getBody(), true);
            $nombre = $media['title'];
            $tipo = 'movie';
        }
        
        $url = 'https://image.tmdb.org/t/p/original' . $media['backdrop_path'];
        $img = 'tuitmedia.jpg';
        file_put_contents($img, file_get_contents($url));


        $media1 = $connection->upload('media/upload', array('media' => "/var/www/html/Cinelist/public/tuitmedia.jpg"));
        $parameters = [
            'status' => "Here's a " . $tipo . " for you  . . .  (づ｡◕‿‿◕｡)づ" 
            . PHP_EOL . $nombre
            . PHP_EOL . $url . $mediatype . '/' . $idmedia,
            
            'media_ids' => $media1->media_id_string
        ];
        $result = $connection->post('statuses/update', $parameters);
        
        return response()->json([
            'tuit' => 'sent'
        ]); 

    }
}
