@extends('main') @section('content')

<section class="movie-detail-intro overlay-gradient-2 ptb100 fondo-default" @isset($media['backdrop_path']) style="background: url('https://image.tmdb.org/t/p/original{{ $media['backdrop_path'] }}');" @endisset>
</section>
<section class="movie-detail-intro2" id="tvinfo" @auth userid="{{ Auth::user()->id}}"   @endauth     @isset($media['id']) mediaId = "{{$media['id']}}"@endisset  @isset($mediatype) mediaType = "{{$mediatype}}"@endisset>
            @if(Session::has('alert'))
                <div id="alertfade" class="alert alert-{{ Session::get('alert')}} alert-dismissible fade show fixed-top" role="alert" style="z-index:9999; opacity:0">
                      {{Session::get('message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @endif
            <?php Session::forget('alert');Session::forget('message'); ?>
    <div class="container" id="estoyindex" @auth iduser="{{Auth::user()->id}}"  @endauth>
        <div class="row">
            <div class="col-md-12">
                <div class="movie-poster">
                    <img src="https://image.tmdb.org/t/p/w300{{ $media['poster_path'] }}" alt=""> 
                    @isset($media['trailer'])
                        <a href="https://www.youtube.com/watch?v={{ $media['trailer'] }}" class="play-video">
                            <i class="fa fa-play"></i>
                        </a> 
                    @endisset
                </div>
                <div class="movie-details media-details-margin">
                    @isset($media['title'])
                    <h3 class="title">{{ $media['title'] }}</h3>
                    @endisset @isset($media['name'])
                    <h3 class="title">{{ $media['name'] }}</h3>
                    @endisset
                    <ul class="movie-subtext cursor-media">
                        @isset($media['runtime'])
                        <li class="cursor-media" data-original-title="Duration" data-toggle="tooltip" data-placement="top">{{ $media['runtime'] }} min</li>
                        @endisset @isset($genres)
                        <li class="cursor-media" data-original-title="Genres" data-toggle="tooltip" data-placement="top">
                            @foreach($genres as $genre) {{ $genre['name'] }}, @endforeach
                        </li>
                        @endisset @isset($media['release_date'])
                        <li class="cursor-media" data-original-title="Release date" data-toggle="tooltip" data-placement="top">{{ $media['release_date'] }}</li>
                        @endisset @isset($media['first_air_date'])
                        <li class="cursor-media" data-original-title="Air date" data-toggle="tooltip" data-placement="top">{{ $media['first_air_date'] }}</li>
                        @endisset
                        @isset($media['notamedia'])
                            <li class="cursor-media" >{{ $media['notamedia'] }}/10 out of {{$media['totalvotes'] }} votes</li>
                        @endisset
                    </ul>
                    @isset($media['trailer'])
                        <a href="https://www.youtube.com/watch?v={{ $media['trailer'] }}" class="play-video btn btn-main btn-effect play-trailer ">trailer</a>
                    @endisset
                    @auth
                        <select name="list-media" class="btn btn-main btn-effect" id="list-media" @isset($media['id']) idmedia="{{ $media['id'] }}" @endisset @auth iduser="{{ Auth::user()->id }}" @endauth @isset($mediatype) mediatype="{{ $mediatype }}" @endisset>
                              <option value="notlisted">Movie not listed</option>
                              <option value="planned">Planned to watch</option>
                              <option value="watching">Watching</option>
                              <option value="watched">Watched</option>
                        </select>
                        <a class="btn" data-original-title="Add to favorite" data-toggle="tooltip" data-placement="top"><i class="far fa-heart favorito fa-10x" id="favorito" faved = false @isset($media['id']) idmedia="{{ $media['id'] }}" @endisset @auth iduser="{{ Auth::user()->id }}" @endauth @isset($mediatype) mediatype="{{ $mediatype }}" @endisset></i></a>
                        <i class="fa fa-twitter fa-lg share-index" aria-hidden="true" data-original-title="Tweet" data-toggle="tooltip" data-placement="top" @isset($media['id']) idmedia="{{$media['id']}}" @endisset @isset($media['title']) mediatype="movie" @endisset @isset($media['name']) mediatype="tv" @endisset></i>
                    @endauth
                    @auth
                        <fieldset class="rating stars">
                            <input type="radio" id="star5" name="rating" value="10" /><label class = "full estrella-single" for="star5" title="10/10"></label>
                            <input type="radio" id="star4half" name="rating" value="9" /><label class="half estrella-single" for="star4half" title="9/10"></label>
                            <input type="radio" id="star4" name="rating" value="8" /><label class = "full estrella-single" for="star4" title="8/10"></label>
                            <input type="radio" id="star3half" name="rating" value="7" /><label class="half estrella-single" for="star3half" title="7/10"></label>
                            <input type="radio" id="star3" name="rating" value="6" /><label class = "full estrella-single" for="star3" title="6/10"></label>
                            <input type="radio" id="star2half" name="rating" value="5" /><label class="half estrella-single" for="star2half" title="5/10"></label>
                            <input type="radio" id="star2" name="rating" value="4" /><label class = "full estrella-single" for="star2" title="4/10"></label>
                            <input type="radio" id="star1half" name="rating" value="3" /><label class="half estrella-single" for="star1half" title="3/10"></label>
                            <input type="radio" id="star1" name="rating" value="2" /><label class = "full estrella-single" for="star1" title="2/10"></label>
                            <input type="radio" id="starhalf" name="rating" value="1" /><label class="half estrella-single" for="starhalf" title="1/10"></label>
                        </fieldset>
                    @endauth

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>


<section class="movie-detail-main ptb30">
    <div class="container">
        <div class="row position-relative">
            @if($mediatype == 'movie')
            <div class="col-lg-8 col-sm-12">
                <div class="inner pr50">
                    <div class="storyline">
                        <h3 class="title">Storyline</h3>
                        <p>{{ $media['overview'] }}</p>
                    </div>
                </div>
                
                <div class="container-gallery movie-media">
                @isset($images)
                    <h3 class="title text-center title-gallery">Have a look!</h3>
                    <div class="container container-gallery">
                        <div class="gallery image-gallery isotope">
                        @foreach($images as $image)
                    		<div class="gallery-item element">
                                <a href="https://image.tmdb.org/t/p/original{{ $image }}">
                    			    <img class="gallery-image img-responsive" src="https://image.tmdb.org/t/p/w500{{ $image }}" alt="forest">
                    			</a>
                    		</div>
                       	@endforeach
                    	</div>
                    	
                    	<!--Reviews section-->

                    	
                    </div>
                @endisset
                </div>


            </div>
            @elseif($mediatype == 'tv')
                    <div class="col-lg-8 col-sm-12 tab-content">
                        <ul class="nav tab-links pt10 links-tv">
                                <li class="nav-item nav-item-tv">
                                    <a class="nav-link nav-link-tv active" id="bio-tab" data-toggle="tab" href="#bio" aria-controls="bio" aria-expanded="false">overview</a>
                                </li>
                                @foreach($seasons as $key => $season)
                                        <li class="nav-item nav-item-tv">
                                            <a class="nav-link nav-link-tv uppercase" id="{{$key}}tab-tab" data-toggle="tab" href="#{{$key}}tabepisodes" aria-controls="filmography" aria-expanded="false">{{ $season['name'] }}</a>
                                        </li>
                                @endforeach
                        </ul>     
                        
                        <div class="tab-pane fade active show" id="bio" role="tabpanel" aria-labelledby="bio-tab" aria-expanded="false">
                            <div class="inner pr50">
                                <div class="storyline mt20">
                                    <h3 class="title">Storyline</h3>
                                    <p>{{ $media['overview'] }}</p>
                                </div>
                            </div>
                            <div class="container-gallery movie-media">
                            @isset($images)
                                <h3 class="title text-center title-gallery">Have a look!</h3>
                                <div class="container container-gallery">
                                    <div class="gallery image-gallery isotope">
                                    @foreach($images as $image)
                                		<div class="gallery-item element">
                                            <a href="https://image.tmdb.org/t/p/original{{ $image }}">
                                			    <img class="gallery-image img-responsive" src="https://image.tmdb.org/t/p/w500{{ $image }}" alt="forest">
                                			</a>
                                		</div>
                                   	@endforeach
                                	</div>
                                </div>
                            @endisset
                            </div>
                    
                        </div>
                        @isset($seasons)
                                @foreach($seasons as $key => $season)
                                     <div class="tab-pane fade col-md-12" id="{{$key}}tabepisodes" role="tabpanel" aria-labelledby="film-tab" aria-expanded="false">
                                         @auth
                                         <div class="col-md-6 mr-auto ml-auto text-center">
                                             <button class="btn season-no-vista season-vista ver-season" @auth iduser="{{ Auth::user()->id }}" @endauth @isset($season['id']) idseason="{{ $season['id'] }}" @endisset watched="false">Watched season</button>
                                         </div>
                                         @endauth
                                         <ul class="film-list  mt20">
                                       
                                             <div class="panel-group{{$key}}" id="accordion" role="tablist" aria-multiselectable="true">
                                            @foreach($season['episodes'] as $key2 => $episode)
                                                      <div class="panel panel-default ">
                                                        <div class="panel-heading" role="tab" id="heading-{{$key}}-{{$key2}}">
                                                          <h6 class="title panel-fontsize nav-item dropdown">
                                                            @auth
                                                             <i class="fa fa-eye-slash ojo ojo-no-visto"  iduser="{{ Auth::user()->id }}" idepisode="{{ $episode['id'] }}"  idseason="{{ $season['id'] }}" watched="false"></i>
                                                            @endauth
                                                            <a class="dropdown-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$key}}-{{$key2}}" aria-expanded="true" aria-controls="collapse-{{$key}}-{{$key2}}">
                                                              {{$key2 +1}} - {{ $episode['name'] }}
                                                            </a>
                                                            @isset( $episode['air_date'])
                                                                <span class="year-tv">{{ $episode['air_date'] }}</span>
                                                            @endisset
                                                          </h6>
                                                        </div>
                                                    </div>
                                                @if($key2 == 0)
                                                    <div id="collapse-{{$key}}-{{$key2}}" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="heading-{{$key}}-{{$key2}}">
                                                @else
                                                    <div id="collapse-{{$key}}-{{$key2}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-{{$key}}-{{$key2}}">
                                                @endif
                                                  <div class="panel-body">
                                                     @isset( $episode['overview'])
                                                        <p>{{ $episode['overview'] }}</p>
                                                    @endisset   
                                                  </div>
                                                </div>
                                            @endforeach
                                         </ul>
                                     </div>
                                   
                                @endforeach                                        
                        @endisset
                    </div>
            @endif

            <div class="col-lg-4 col-sm-12 position-relative">
                <div class="sidebar ">

                    <aside class="widget widget-movie-details">
                        <h3 class="title">Details</h3>
                        <ul>
                            @isset($media['release_date'])
                            <li><strong>Release date: </strong>{{ $media['release_date'] }}</li>
                            @endisset @isset($director['name'])
                            <li><strong>Director: </strong><a href="{{ url('person/' . $director['id']) }}">{{ $director['name'] }}</a></li>
                            @endisset @isset($media['budget']) @if($media['budget'] != 0)
                            <li><strong>Budget: </strong>{{ $media['budget'] }} USD</li>
                            @else
                            <li><strong>Budget: </strong>Unknown</li>
                            @endif @endisset @isset($media['original_language'])
                            <li><strong>Language: </strong>{{ $media['original_language'] }}</li>
                            @endisset @isset($companies)
                            <li><strong>Production Co: </strong>
                                <ul>
                                    @foreach($companies as $company)
                                    <li>-{{ $company['name'] }}</li>
                                    @endforeach
                                </ul>
                            </li>
                            @endisset
                        </ul>
                    </aside>

                    <aside class="widget widget-movie-cast ">
                        <h3 class="title">Cast</h3>
                        <ul class="cast-wrapper">
                            @isset($actors) @foreach($actors as $actor)
                            <li>
                                <a href="{{ url('person/' . $actor['id']) }}">
                                        <span class="circle-img">
                                        <img src="https://image.tmdb.org/t/p/w300{{ $actor['profile_path'] }}" alt="">
                                        </span>
                                        <h6 class="name">{{ $actor['name'] }}</h6>
                                        </a>
                            </li>
                            @endforeach @endisset
                        </ul>
                        <form action="{{url('search/casting')}}" method = "post">
                            @csrf
                            <input type="hidden" name="id" value="{{$media['id']}}">
                            <input type="hidden" name="media_type" value=" @isset($media['name']) tv @endisset @isset($media['title']) movie @endisset ">
                            <input type="submit" class="btn btn-icon btn-main btn-effect" value="View All">
                        </form>
                    </aside>

                </div>
            </div>

        </div>
        
        <div class="row">
            <div class="col-md-12 mt60 flechas">
                @isset($reviews[0])
                <div class="titulo-reviews">
                    <h3 class="ml100">Check reviews</h3>
                        <form action="{{url('review/' . $media['id'])}}" method = "post" class="review-boton">
                            @csrf
                            <input type="hidden" name="idmedia" value="{{$media['id']}}">

                            <input type="hidden" name="mediatype" value=" @isset($media['name']) tv @endisset @isset($media['title']) movie @endisset">
                            <input type="submit" class="btn btn-icon btn-main btn-effect" value="View All">
                        </form>
                </div>
                @endisset
                <div class="owl-carousel testimonial-slider">
                    @isset($reviews)
                        @foreach($reviews as $review)
                            <div class="item">
                                <div class="testimonial-content testimonial-padding" id="reviewId" reviewid="{{$review['id']}}">
                                    <a data-original-title="Share" data-toggle="tooltip" data-placement="top" class="share buttonabsolute2 button sharereview" id="sharereview" reviewid="{{$review['id']}}" @auth  auth="@if(Auth::user()->id == $review['iduser'])true @endif"@endauth>
                                        <i class="fab fa-twitter fa-2x"></i>
                                    </a>
                                        @isset(Auth::user()->id)
                                            @if(Auth::user()->id == $review['iduser'])
                                                <div class="buttons buttonabsolutedelete deletesingle">
                                                    <form action="{{ url('deletereview') }}" method="post" id="deleteReviewForm">
                                                        @csrf
                                                        <input type="hidden" name="reviewid" id="reviewid" value="{{ $review['id'] }}">
                                                        <input type="hidden" name="mediatype" id="mediatype" value="{{ $mediatype }}">
                                                        <button type="submit" data-original-title="Delete review" data-toggle="tooltip" data-placement="top" class="buttonsinestilo"><i class="fas fa-times"></i></button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endisset
                                    <div class="testimonial-pic ml-auto mr-auto" @if(file_exists('assets/profilepics/'. $review['iduser'] .'.png')) style="background-image: url('{{ url('assets/profilepics/'. $review['iduser'] .'.png') }}');" @endif></div>
                                        <!--<img src="{{ url('assets/profilepics/'. $review['iduser'] . '.jpg') }}" alt="">-->
                                    <div class="testimonial-comment text-justify">
                                        @isset($review['userName'])
                                           <a href="{{ url('profile/'.$review['iduser']) }} "><h4 class="text-center">{{ $review['userName'] }}</h4></a> 
                                        @endisset
                                        <!--<span class="testimonial-info">CEO, Google</span>-->
                                        @isset($review['content'])
                                            {!! $review['content'] !!}
                                        @endisset
                                       <div class="resto">
                                           @auth
                                               <div class="votes">
                                                   <i class="far fa-thumbs-up fa-2x fa-hetero" id="upvote-{{$review['id']}}"></i>
                                                   <i class="far fa-thumbs-up fa-2x fa-invertido" id="downvote-{{$review['id']}}"></i>
                                               </div>
                                           @endauth
                                           <div class="reportar">
                                                <form method = "post" class="reportReview">
                                                    @csrf
                                                    <input type="hidden" name="idreview" value="{{$review['id']}}">
                                                    <input type="hidden" name="content" value="{{$review['content']}}">
                                                    <input type="submit" class="btn btn-icon btn-main btn-effect" value="Report Review">
                                                </form>
                                           </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
            @auth
                <div class="container">
                    <h3 class="title text-center title-gallery">Write a review!</h3>
                    <form action="{{ url('postreview') }}" method="post" id="reviewform" @auth  userid="{{ Auth::user()->id}}" auth="true"  @endauth>
                    @csrf
                       <div class="form-group">
                         <input type="hidden" class="form-control" id="iduser" name="iduser" value="{{ Auth::user()->id }}">
                         <input type="hidden" class="form-control" id="idmedia" name="idmedia" value="{{ $media['id'] }}">
                         <input type="hidden" class="form-control" id="mediatype" name="mediatype" value="{{ $mediatype }}">
                       </div>
                       <!--<div class="form-group">-->
                         <textarea  class="ckeditor" name="content" id="content" rows="10" cols="80">
                        </textarea>
                       <!--</div>-->
                      <button type="submit" class="btn btn-main btn-effect" >Submit</button>
                    </form>
                </div>
        	@endauth
            
        </div>
    </div>
</section>

@isset($alsoLiked)
<section class="recommended-movies bg-light ptb100">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <h2 class="title">People who liked this also liked...</h2>
            </div>
        </div>
        <div class="row mt20">

            <div class="col-md-12 col-sm-12">
                <div class="movie-list-1 mb30">
                    <div class="listing-container">
                        <div class="listing-image">
                            <div class="play-btn">
                                @isset($alsoLiked['trailer'])
                                    <a href="https://www.youtube.com/watch?v={{$alsoLiked['trailer']}}" class="play-video">
                                        <i class="fa fa-play"></i>
                                    </a>
                                @endisset
                            </div>
                            @auth
                            <div class="buttons">
                                <a class="share ">
                                    <i class="fa fa-twitter share-index" aria-hidden="true" data-original-title="Tweet" data-toggle="tooltip" data-placement="top" @isset($alsoLiked['id']) idmedia="{{$alsoLiked['id']}}" @endisset @isset($alsoLiked['title']) mediatype="movie" @endisset @isset($alsoLiked['name']) mediatype="tv" @endisset></i>
                                </a>
                            </div>
                            @endauth
                            <img src="https://image.tmdb.org/t/p/w500{{ $alsoLiked['poster_path'] }}" alt="">
                        </div>

                        <div class="listing-content">
                            <div class="inner">
                                @isset($alsoLiked['name'])
                                <h2 class="title">{{ $alsoLiked['name'] }}</h2>
                                @endisset @isset($alsoLiked['title'])
                                <h2 class="title">{{ $alsoLiked['title'] }}</h2>
                                @endisset
                                <p>{{ $alsoLiked['overview'] }}</p>
                                <a href="{{ url( $mediatype . '/' . $alsoLiked['id']) }}" class="btn btn-main btn-effect">details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
    </div>
</section>
<div id="estoyensingle"></div>
  @endisset
@endsection
