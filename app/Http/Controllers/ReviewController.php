<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\ReviewTv;
use App\Tv;
use App\Movie;
use App\UserLikedTv;
use App\UserLikedMovie;
use config\Functions;

class ReviewController extends Controller
{
    public function crearReview(Request $request){

        if($request['content'] != ''){
            
            if($request['mediatype'] == 'movie'){
                try{
                    $review = new Review();
                    
                    $review->iduser = $request['iduser'];
                    $review->idmovie = $request['idmedia'];
                    $review->content = $request['content'];
                    $review->save();
                
                }catch(\Exception $e){
                    $request->session()->put('alert','danger');
                    $request->session()->put('message','Error posting your review');
                    
                    return back();
                }
          
            }else {
                try{
                    $review = new ReviewTv();
                    
                    $review->iduser = $request['iduser'];
                    $review->idtv = $request['idmedia'];
                    $review->content = $request['content'];
                    $review->save();
                
                }catch(\Exception $e){
                    $request->session()->put('alert','danger');
                    $request->session()->put('message','Error posting your review');
                    return back();
                }
            }
            $request->session()->put('alert','success');
            $request->session()->put('message','Review posted');
            
        }
        return back();
        
        
    }
    
    public function deleteReview(Request $request ){
        $mediatype = $request['mediatype'];
        $id = $request['reviewid'];
        if($mediatype == 'movie'){
            $review = Review::where('id',$request['reviewid'])->first();
            $idmedia = $review['idmovie'];
            $review->delete();
        }else if($mediatype == 'tv'){
            $review = ReviewTv::where('id',$request['reviewid'])->first();
            $idmedia = $review['idtv'];
            $review->delete();
        }
        
        $request->session()->put('alert','success');
        $request->session()->put('message','Review deleted correctly');
        
        return redirect($mediatype . '/' . $idmedia);
    }
    
    public function report(Request $request){
        $idreview = $request['idreview'];
        $content = $request['content'];
        $mediatype = $request['mediatype'];
        if($mediatype == 'tv'){
            try{
                $review = ReviewTv::find($idreview);
                $review->reports = $review->reports + 1;
                $review->save();
            } catch(\Exception $e){
                return response()->json([
                    'report' => 'error',
                    'tipe' => $e,
                ]);
            }
            return response()->json([
                'report' => 'ok',
            ]);
        } else if($mediatype == 'movie'){
            try{
                $review = Review::find($idreview);
                $review->reports = $review->reports + 1;
                $review->save();
            } catch(\Exception $e){
                return response()->json([
                    'report' => 'error',
                    'tipe' => $e,
                ]);
            }
            return response()->json([
                'report' => 'ok',
            ]);
        }
        return response()->json([
                'report' => 'fatalerror',
            ]);
    }
    
    public function reviewList(Request $request){
        
        if($request['mediatype'] == 'movie'){
            $reviews = Review::where('idmovie',$request['idmedia'])->get();
            $title = Movie::select('title')->where('id',$request['idmedia'])->first();
        }
        else if($request['mediatype'] == 'tv'){
            $reviews = ReviewTv::where('idtv',$request['idmedia'])->get();
            $title = Tv::select('title')->where('id',$request['idmedia'])->first();
        }
        $reviews = Functions::checkProfilePic($reviews);
        $reviews = Functions::getReviewer($reviews);
        return view('reviewlist')->with([
                        'reviews' => $reviews,
                        'title' => $title,
                        'mediatype' => $request['mediatype'],
                        'idmedia' => $request['idmedia'],
                        ]);
        
    }
    
    public function positive(Request $request)
    {
        $id = $request['id'];
        $mediatype = $request['mediatype'];
        $userid = $request['userid'];
        $mediaid = $request['mediaid'];
        if($mediatype == 'tv'){
            try{
                $review = ReviewTv::find($id);
                $review->upvotes = $review->upvotes+1;
                $review->save();
                $like = new UserLikedTv();
                $like->iduser = $userid;
                $like->idreviewtv = $id;
                $like->tipo = true;
                $like->idtv = $mediaid;
                $like->save();
            }catch(\Exception $e){
                return response()->json([
                    'error' => 'upvote error tv',
                    'tipò' => $e,
                ]);
            }

            
        } else if($mediatype == 'movie'){
            try{
                $review = Review::find($id);
                $review->upvotes = $review->upvotes+1;
                $review->save();
                $like = new UserLikedMovie();
                $like->iduser = $userid;
                $like->idreviewmovie = $id;
                $like->tipo = true;
                $like->idmovie = $mediaid;
                $like->save();
            }catch(\Exception $e){
                return response()->json([
                    'error' => 'upvote error ',
                ]);
            }
        }
        return response()->json([
            'upvote' => 'ok',
        ]);
    }
    
    public function negative(Request $request)
    {
        $id = $request['id'];
        $mediatype = $request['mediatype'];
        $userid = $request['userid'];
        $mediaid = $request['mediaid'];

        if($mediatype == 'tv'){
            try{
                $review = ReviewTv::find($id);
                $review->downvotes = $review->downvotes+1;
                $review->save();
                $like = new UserLikedTv();
                $like->iduser = $userid;
                $like->idreviewtv = $id;
                $like->tipo = false;
                $like->idtv = $mediaid;
                $like->save();

            }catch(\Exception $e){
                return response()->json([
                    'error' => 'downvote error tv',
                ]);
            }

            
        } else if($mediatype == 'movie'){
            try{
                $review = Review::find($id);
                $review->downvotes = $review->downvotes+1;
                $review->save();
                $like = new UserLikedMovie();
                $like->iduser = $userid;
                $like->idreviewmovie = $id;
                $like->tipo = false;
                $like->idmovie = $mediaid;
                $like->save();
            }catch(\Exception $e){
                return response()->json([
                    'error' => 'downvote error ',
                ]);
            }
        }
        return response()->json([
            'downvote' => 'ok',
        ]);
    }
    
    public function removePositive(Request $request){
        $id = $request['id'];
        $mediatype = $request['mediatype'];
        $userid = $request['userid'];
        if($mediatype == 'tv'){
            try{
                $review = ReviewTv::find($id);
                $review->upvotes = $review->upvotes-1;
                $review->save();
                if(UserLikedTv::where('iduser', $userid)->where('idreviewtv',$id)->where('tipo',true)->first()!=null){
                    UserLikedTv::where('iduser', $userid)->where('idreviewtv',$id)->where('tipo',true)->first()->delete();
                }    
                
            }catch(\Exception $e){
                return response()->json([
                    'error' => 'restar upvotes error tv',
                    'tipo' => $e
                ]);
            }

            
        } else if($mediatype == 'movie'){
            try{
                $review = Review::find($id);
                $review->upvotes = $review->upvotes-1;
                $review->save();
                if(UserLikedMovie::where('iduser', $userid)->where('idreviewmovie',$id)->where('tipo',true)->first()!=null){
                    UserLikedMovie::where('iduser', $userid)->where('idreviewmovie',$id)->where('tipo',true)->first()->delete();
                }              }catch(\Exception $e){
                return response()->json([
                    'error' => 'restar upvotes error ',
                ]);
            }
        }
        return response()->json([
            'restarupvote' => 'ok',
        ]);
    }
    
    public function removeNegative(Request $request){
        $id = $request['id'];
        $mediatype = $request['mediatype'];
        $userid = $request['userid'];
        if($mediatype == 'tv'){
            try{
                $review = ReviewTv::find($id);
                $review->downvotes = $review->downvotes-1;
                $review->save();

                if(UserLikedTv::select('id')->where('iduser', $userid)->where('idreviewtv',$id)->where('tipo', false)->first()!=null){

                    UserLikedTv::select('id')->where('iduser', $userid)->where('idreviewtv',$id)->where('tipo', false)->first()->delete();
                } else {
                    return response()->json([
                        'error' => $delete,
                    ]);
                }  
            }catch(\Exception $e){
                return response()->json([
                    'error' => 'restar downvotes error tv',
                    'mensaje' => $e,
                ]);
            }

            
        } else if($mediatype == 'movie'){
            try{
                $review = Review::find($id);
                $review->downvotes = $review->downvotes-1;
                $review->save();
                if(UserLikedMovie::where('iduser', $userid)->where('idreviewmovie',$id)->where('tipo',false)->first()!=null){
                    UserLikedMovie::where('iduser', $userid)->where('idreviewmovie',$id)->where('tipo',false)->first()->delete();
                }              
                
            }catch(\Exception $e){
                return response()->json([
                    'error' => 'restar downvotes error ',
                ]);
            }
        }
        return response()->json([
            'restardownvote' => 'ok',
        ]);      
    }
    
    
    public function checkVotes(Request $request){
        
        $iduser = $request['iduser'];
        $mediaid = $request['idmedia'];
        $mediatype = $request['mediatype'];
        
        if($mediatype == 'tv'){
            try{
                $votos = UserLikedTv::where('iduser', $iduser)->where('idtv', $mediaid)->get();
            } catch(\Exception $e){
                return response()->json([
                    'votos' => 'error',
                ]);     
            }
            return response()->json([
                'votos' => $votos,
            ]); 
            
        } else if ($mediatype == 'movie'){
            try{
                $votos = UserLikedMovie::where('iduser', $iduser)->where('idmovie', $mediaid)->get();
            } catch(\Exception $e){
                return response()->json([
                    'votos' => 'error',
                ]);     
            }
            return response()->json([
                'votos' => $votos,
            ]); 
            
        }
    }
}
