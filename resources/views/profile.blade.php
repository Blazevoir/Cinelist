@extends('header2') @section('content')


<section class="page-header header-profile overlay-gradient backgroundd" @if($hasBackgroundPic) style="background-image: url('{{ url('assets/backgrounds/'. $user['id'] .'background.png') }}');" @else style="background-image: url('{{ url('assets/backgrounds/default.png')}}"
    @endif>
    <div class="container header-home">
        
        <div class="row position-relative">
            <div class="profile-pic col-md-2 position-absolute" @if($hasProfilePic) style="background-image: url('{{ url('assets/profilepics/'. $user['id'] .'.png') }}');" @endif>
                @if($isHome) <i class="far fa-edit text-white text-center editasion" data-toggle="modal" data-target="#editprofilemodal"></i>
                <div class="taparprofilepic"></div>
                @endif
                <!--<div class="taparprofilepic position-absolute"></div>-->
            </div>
        </div>
        
        <div class="inner col-md-9 mt-auto hello">
            @if($isHome)
            <h2 class="title">Hello, <a href="{{ url('profile/'.$user['id']) }} ">{{$user['username']}}</a></h2>
            @else
            <h2 class="title"><a href="{{ url('profile/'.$user['id']) }} ">{{$user['username']}}</a>'s profile</h2>
            @endif @isset(Auth::user()->description)
            <p class="text-justify description">{{ $user['description'] }}</p>
            @endisset
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Cinelist</a></li>
                <li>Home</li>
                @if($user['source'] == 'Twitter')
                <li><i class="fa fa-twitter pr10 text-white"></i><a href="https://twitter.com/{{$user['username']}}" class="text-white link-profile" target="_blank">{{ $user['username'] }}</a></li>
                @endif
            </ol>
            <ul class="nav tab-links pt10 links-tv links-profile">
                    <li class="nav-item nav-item-tv">
                        <a class="nav-link nav-link-tv active uppercase" id="watching-tab" data-toggle="tab" href="#watching" aria-controls="bio" aria-expanded="false">Watching</a>
                    </li>
                    <li class="nav-item nav-item-tv">
                        <a class="nav-link nav-link-tv uppercase" id="watched-tab" data-toggle="tab" href="#watched" aria-controls="filmography" aria-expanded="false">Watched</a>
                    </li>
                    <li class="nav-item nav-item-tv">
                        <a class="nav-link nav-link-tv uppercase" id="planned-tab" data-toggle="tab" href="#planned" aria-controls="filmography" aria-expanded="false">Planned to watch</a>
                    </li>
                    <li class="nav-item nav-item-tv">
                        <a class="nav-link nav-link-tv uppercase" id="favorite-tab" data-toggle="tab" href="#favorite" aria-controls="filmography" aria-expanded="false">Favorites</a>
                    </li>
                    <li class="nav-item nav-item-tv">
                        <a class="nav-link nav-link-tv uppercase" id="topratedmovies-tab" data-toggle="tab" href="#topratedmovies" aria-controls="filmography" aria-expanded="false">Top movies</a>
                    </li>      
                    <li class="nav-item nav-item-tv">
                        <a class="nav-link nav-link-tv uppercase" id="topratedtv-tab" data-toggle="tab" href="#topratedtv" aria-controls="filmography" aria-expanded="false">Top series</a>
                    </li>                          
            </ul>     
        </div>
        
    </div>
</section>
<!-- Latest Movies and TV Shows-->
<div class="col-lg-12 col-sm-12 tab-content tab-content-profile">
    <div class="tab-pane fade active show" id="watching" role="tabpanel" aria-labelledby="bio-tab" aria-expanded="false">
            <section class="latest-movies pt80 ">
                <div class="container container-profile">
        
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="title title-profile">Keep watching</h3>
                        </div>
                        <div class="col-md-4 align-self-center text-right mb5">
                                <form action="{{ url('/profile/' . $user['id'] .'/all') }}" method="post">
                                @csrf
                                    <input type="hidden" name="topic" value="watching">
                                    <input type="hidden" name="iduser" value="{{ $user['id'] }}">
                                    <input type="submit"  class="btn btn-icon btn-main btn-effect" value="view all">
                                </form>
                        </div>
                    </div>
                    <hr class="hr-profile">
                    
                        @if(isset($watching[0]))
                        <div class="owl-carousel owl-carousel-profile latest-movies-slider ">
                            @foreach($watching as $media)
                            
                                <div class="item item-profile">
                                    <div class="movie-box-1 movie-box-profile">
                                        @isset($media['poster_path'])
                                            <div class="poster">
                                                <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                                            </div>
                                        @endisset
                                        @isset($media['trailer'])
                                            <div class="buttons">
                                                <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video trailer-profile">
                                                    <i class="fa fa-play play-profile"></i>
                                                </a>
                                            </div>
                                        @endisset
                                        <div class="movie-details">
                                            @isset($media['title'])
                                            <h6 class="movie-title movie-title-profile">
                                                <a href="{{ url('movie/' . $media['id']) }}" class="link-profile">{{ $media['title'] }}</a>
                                            </h6>
                                            @endisset
                                            @isset($media['name'])
                                            <h6 class="movie-title movie-title-profile">
                                                <a href="{{ url('tv/' . $media['id']) }}" class="link-profile">{{ $media['name'] }}</a>
                                            </h6>
                                            @endisset                                    
                                        </div>
        
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        @else
                            <div class="nothingfound">
                                <h3 class="title ">Nothing found here! Explore our trending TV shows and movies <a href="{{url('/')}}" class="title-profile">here!</a></h3>
                            </div>
                        @endif
                </div>
     @isset($watchingRelated)        
        <section class="upcoming-movies parallax parallax-profile ptb100" data-background="https://image.tmdb.org/t/p/original{{ $watchingRelated[0]['backdrop_from'] }}" data-color="#3e4555" data-color-opacity="0.95">
            <div class="container">
                <div class="row mt50">
                    @foreach($watchingRelated as $media)
                    <div class="col-md-4 col-sm-12 mb50">
                        <div class="movie-box-1 movie-box-profile">
                            <div class="poster poster-profile">
                                <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                            </div>
                            <div class="buttons">
                                @isset($media['trailer'])
                                    <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video">
                                        <i class="fa fa-play"></i>
                                    </a>
                                @endisset
                            </div>
                            <div class="movie-details movie-details-profile">
                                <h4 class="movie-title">
                                    @isset($media['title'])
                                        <a href="{{ url('movie/' . $media['id']) }}">{{ $media['title'] }}</a>
                                    @endisset
                                    @isset($media['name'])
                                        <a href="{{ url('tv/' . $media['id']) }}">{{ $media['name'] }}</a>
                                    @endisset                                    
                                </h4>
                                @isset($media['release_date'])
                                    <span class="released">{{ $media['release_date'] }}</span>
                                @endisset
                                @isset($media['first_air_date'])
                                    <span class="released">{{ $media['first_air_date'] }}</span>
                                @endisset                                
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-4 col-sm-12 my-auto related-text">
                        <div class="ptb50">
                            <h2 class="title text-white">Enjoying {{ $watchingRelated[0]['comes_from'] }}?</h2>
                            <h6 class="subtitle text-light ">We think you might like these too.</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endisset
</section>
    </div>

        <div class="tab-pane fade" id="watched" role="tabpanel" aria-labelledby="bio-tab" aria-expanded="false">
                <section class="latest-movies pt80 ">
                    <div class="container container-profile">
            
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="title title-profile">Movies and series you've watched</h3>
                            </div>
                            <div class="col-md-4 align-self-center text-right mb5">
                                <form action="{{ url('/profile/' . $user['id'] .'/all') }}" method="post">
                                @csrf
                                    <input type="hidden" name="topic" value="watched">
                                    <input type="hidden" name="iduser" value="{{ $user['id'] }}">
                                    <input type="submit"  class="btn btn-icon btn-main btn-effect" value="view all">
                                </form>
                            </div>
                        </div>
                        <hr class="hr-profile">
                        
                            @if(isset($watched[0]))
                            <div class="owl-carousel owl-carousel-profile latest-movies-slider ">
                                @foreach($watched as $media)
                                
                                    <div class="item item-profile">
                                        <div class="movie-box-1 movie-box-profile">
                                            @isset($media['poster_path'])
                                                <div class="poster">
                                                    <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                                                </div>
                                            @endisset
                                            @isset($media['trailer'])
                                                <div class="buttons">
                                                    <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video trailer-profile">
                                                        <i class="fa fa-play play-profile"></i>
                                                    </a>
                                                </div>
                                            @endisset
                                            <div class="movie-details">
                                                @isset($media['title'])
                                                <h6 class="movie-title movie-title-profile">
                                                    <a href="{{ url('movie/' . $media['id']) }}" class="link-profile">{{ $media['title'] }}</a>
                                                </h6>
                                                @endisset
                                                @isset($media['name'])
                                                <h6 class="movie-title movie-title-profile">
                                                    <a href="{{ url('tv/' . $media['id']) }}" class="link-profile">{{ $media['name'] }}</a>
                                                </h6>
                                                @endisset                                    
                                            </div>
            
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            @else
                                <div class="nothingfound">
                                    <h3 class="title ">Nothing found here! Explore our trending TV shows and movies <a href="{{url('/')}}" class="title-profile">here!</a></h3>
                                </div>
                            @endif
                    </div>
        @isset($watchedRelated)        
        <section class="upcoming-movies parallax parallax-profile ptb100" data-background="https://image.tmdb.org/t/p/original{{ $watchedRelated[0]['backdrop_from'] }}" data-color="#3e4555" data-color-opacity="0.95">
            <div class="container">
                <div class="row mt50">
                    @foreach($watchedRelated as $media)
                    <div class="col-md-4 col-sm-12 mb50">
                        <div class="movie-box-1 movie-box-profile">
                            <div class="poster poster-profile">
                                <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                            </div>
                            <div class="buttons">
                                @isset($media['trailer'])
                                    <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video">
                                        <i class="fa fa-play"></i>
                                    </a>
                                @endisset
                            </div>
                            <div class="movie-details movie-details-profile">
                                <h4 class="movie-title">
                                    @isset($media['title'])
                                        <a href="{{ url('movie/' . $media['id']) }}">{{ $media['title'] }}</a>
                                    @endisset
                                    @isset($media['name'])
                                        <a href="{{ url('tv/' . $media['id']) }}">{{ $media['name'] }}</a>
                                    @endisset                                    
                                </h4>
                                @isset($media['release_date'])
                                    <span class="released">{{ $media['release_date'] }}</span>
                                @endisset
                                @isset($media['first_air_date'])
                                    <span class="released">{{ $media['first_air_date'] }}</span>
                                @endisset                                
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-4 col-sm-12 my-auto related-text">
                        <div class="ptb50">
                            <h2 class="title text-white">Because you've seen {{ $watchedRelated[0]['comes_from'] }}</h2>
                            <h6 class="subtitle text-light ">We think you might like these. Enjoy!</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endisset
                </section>
        </div>

        <div class="tab-pane fade" id="planned" role="tabpanel" aria-labelledby="bio-tab" aria-expanded="false">
                <section class="latest-movies pt80 ">
                    <div class="container container-profile">
            
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="title title-profile">Planned to watch</h3>
                            </div>
                            <div class="col-md-4 align-self-center text-right mb5">
                                <form action="{{ url('/profile/' . $user['id'] .'/all') }}" method="post">
                                @csrf
                                    <input type="hidden" name="topic" value="planned">
                                    <input type="hidden" name="iduser" value="{{ $user['id'] }}">
                                    <input type="submit"  class="btn btn-icon btn-main btn-effect" value="view all">
                                </form>
                            </div>
                        </div>
                        <hr class="hr-profile">
                        
                            @if(isset($planned[0]))
                            <div class="owl-carousel owl-carousel-profile latest-movies-slider ">
                                @foreach($planned as $media)
                                
                                    <div class="item item-profile">
                                        <div class="movie-box-1 movie-box-profile">
                                            @isset($media['poster_path'])
                                                <div class="poster">
                                                    <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                                                </div>
                                            @endisset
                                            @isset($media['trailer'])
                                                <div class="buttons">
                                                    <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video trailer-profile">
                                                        <i class="fa fa-play play-profile"></i>
                                                    </a>
                                                </div>
                                            @endisset
                                            <div class="movie-details">
                                                @isset($media['title'])
                                                <h6 class="movie-title movie-title-profile">
                                                    <a href="{{ url('movie/' . $media['id']) }}" class="link-profile">{{ $media['title'] }}</a>
                                                </h6>
                                                @endisset
                                                @isset($media['name'])
                                                <h6 class="movie-title movie-title-profile">
                                                    <a href="{{ url('tv/' . $media['id']) }}" class="link-profile">{{ $media['name'] }}</a>
                                                </h6>
                                                @endisset                                    
                                            </div>
            
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            @else
                                <div class="nothingfound">
                                    <h3 class="title ">Nothing found here! Explore our trending TV shows and movies <a href="{{url('/')}}" class="title-profile">here!</a></h3>
                                </div>
                            @endif
                    </div>
                    @isset($plannedRelated)        
        <section class="upcoming-movies parallax parallax-profile ptb100" data-background="https://image.tmdb.org/t/p/original{{ $plannedRelated[0]['backdrop_from'] }}" data-color="#3e4555" data-color-opacity="0.95">
            <div class="container">
                <div class="row mt50">
                    @foreach($plannedRelated as $media)
                    <div class="col-md-4 col-sm-12 mb50">
                        <div class="movie-box-1 movie-box-profile">
                            <div class="poster poster-profile">
                                <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                            </div>
                            <div class="buttons">
                                @isset($media['trailer'])
                                    <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video">
                                        <i class="fa fa-play"></i>
                                    </a>
                                @endisset
                            </div>
                            <div class="movie-details movie-details-profile">
                                <h4 class="movie-title">
                                    @isset($media['title'])
                                        <a href="{{ url('movie/' . $media['id']) }}">{{ $media['title'] }}</a>
                                    @endisset
                                    @isset($media['name'])
                                        <a href="{{ url('tv/' . $media['id']) }}">{{ $media['name'] }}</a>
                                    @endisset                                    
                                </h4>
                                @isset($media['release_date'])
                                    <span class="released">{{ $media['release_date'] }}</span>
                                @endisset
                                @isset($media['first_air_date'])
                                    <span class="released">{{ $media['first_air_date'] }}</span>
                                @endisset                                
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-4 col-sm-12 my-auto related-text">
                        <div class="ptb50">
                            <h2 class="title text-white">If you like {{ $plannedRelated[0]['comes_from'] }}</h2>
                            <h6 class="subtitle text-light ">We think you might like these too. Enjoy!</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endisset
                </section>
        </div>    

        <div class="tab-pane fade" id="favorite" role="tabpanel" aria-labelledby="bio-tab" aria-expanded="false">
                <section class="latest-movies pt80 ">
                    <div class="container container-profile">
            
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="title title-profile">Your favourite media</h3>
                            </div>
                            <div class="col-md-4 align-self-center text-right mb5">
                                <form action="{{ url('/profile/' . $user['id'] .'/all') }}" method="post">
                                @csrf
                                    <input type="hidden" name="topic" value="favorite">
                                    <input type="hidden" name="iduser" value="{{ $user['id'] }}">
                                    <input type="submit"  class="btn btn-icon btn-main btn-effect" value="view all">
                                </form>
                            </div>
                        </div>
                        <hr class="hr-profile">
                        
                            @if(isset($favorite[0]))
                            <div class="owl-carousel owl-carousel-profile latest-movies-slider ">
                                @foreach($favorite as $media)
                                
                                    <div class="item item-profile">
                                        <div class="movie-box-1 movie-box-profile">
                                            @isset($media['poster_path'])
                                                <div class="poster">
                                                    <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                                                </div>
                                            @endisset
                                            @isset($media['trailer'])
                                                <div class="buttons">
                                                    <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video trailer-profile">
                                                        <i class="fa fa-play play-profile"></i>
                                                    </a>
                                                </div>
                                            @endisset
                                            <div class="movie-details">
                                                @isset($media['title'])
                                                <h6 class="movie-title movie-title-profile">
                                                    <a href="{{ url('movie/' . $media['id']) }}" class="link-profile">{{ $media['title'] }}</a>
                                                </h6>
                                                @endisset
                                                @isset($media['name'])
                                                <h6 class="movie-title movie-title-profile">
                                                    <a href="{{ url('tv/' . $media['id']) }}" class="link-profile">{{ $media['name'] }}</a>
                                                </h6>
                                                @endisset                                    
                                            </div>
            
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            @else
                                <div class="nothingfound">
                                    <h3 class="title ">Nothing found here! Explore our trending TV shows and movies <a href="{{url('/')}}" class="title-profile">here!</a></h3>
                                </div>
                            @endif
                    </div>
                    @isset($favoriteRelated)        
        <section class="upcoming-movies parallax parallax-profile ptb100" data-background="https://image.tmdb.org/t/p/original{{ $favoriteRelated[0]['backdrop_from'] }}" data-color="#3e4555" data-color-opacity="0.95">
            <div class="container">
                <div class="row mt50">
                    @foreach($favoriteRelated as $media)
                    <div class="col-md-4 col-sm-12 mb50">
                        <div class="movie-box-1 movie-box-profile">
                            <div class="poster poster-profile">
                                <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                            </div>
                            <div class="buttons">
                                @isset($media['trailer'])
                                    <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video">
                                        <i class="fa fa-play"></i>
                                    </a>
                                @endisset
                            </div>
                            <div class="movie-details movie-details-profile">
                                <h4 class="movie-title">
                                    @isset($media['title'])
                                        <a href="{{ url('movie/' . $media['id']) }}">{{ $media['title'] }}</a>
                                    @endisset
                                    @isset($media['name'])
                                        <a href="{{ url('tv/' . $media['id']) }}">{{ $media['name'] }}</a>
                                    @endisset                                    
                                </h4>
                                @isset($media['release_date'])
                                    <span class="released">{{ $media['release_date'] }}</span>
                                @endisset
                                @isset($media['first_air_date'])
                                    <span class="released">{{ $media['first_air_date'] }}</span>
                                @endisset                                
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-4 col-sm-12 my-auto related-text">
                        <div class="ptb50">
                            <h2 class="title text-white">Because you've seen {{ $favoriteRelated[0]['comes_from'] }}</h2>
                            <h6 class="subtitle text-light ">We think you might like these. Enjoy!</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endisset
                </section>
        </div>     
        
        
        
        <div class="tab-pane fade" id="topratedmovies" role="tabpanel" aria-labelledby="bio-tab" aria-expanded="false">
                <section class="latest-movies pt80 ">
                    <div class="container container-profile">
            
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="title title-profile">Top rated movies</h3>
                            </div>
                            <div class="col-md-4 align-self-center text-right mb5">
                                <form action="{{ url('/profile/' . $user['id'] .'/all') }}" method="post">
                                @csrf
                                    <input type="hidden" name="topic" value="topmovies">
                                    <input type="hidden" name="iduser" value="{{ $user['id'] }}">
                                    <input type="submit"  class="btn btn-icon btn-main btn-effect" value="view all">
                                </form>
                            </div>
                        </div>
                        <hr class="hr-profile">
                        
                            @if(isset($topratedmovies[0]))
                            <div class="owl-carousel owl-carousel-profile latest-movies-slider ">
                                @foreach($topratedmovies as $media)
                                
                                    <div class="item item-profile">
                                        <div class="movie-box-1 movie-box-profile">
                                            @isset($media['poster_path'])
                                                <div class="poster">
                                                    <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                                                </div>
                                            @endisset
                                            @isset($media['trailer'])
                                                <div class="buttons">
                                                    <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video trailer-profile">
                                                        <i class="fa fa-play play-profile"></i>
                                                    </a>
                                                </div>
                                            @endisset
                                            <div class="movie-details">
                                                @isset($media['title'])
                                                <h6 class="movie-title movie-title-profile">
                                                    <a href="{{ url('movie/' . $media['id']) }}" class="link-profile">{{ $media['title'] }}</a>
                                                </h6>
                                                @endisset
                                                @isset($media['name'])
                                                <h6 class="movie-title movie-title-profile">
                                                    <a href="{{ url('tv/' . $media['id']) }}" class="link-profile">{{ $media['name'] }}</a>
                                                </h6>
                                                @endisset                                    
                                            </div>
            
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            @else
                                <div class="nothingfound">
                                    <h3 class="title ">Nothing found here! Explore our trending TV shows and movies <a href="{{url('/')}}" class="title-profile">here!</a></h3>
                                </div>
                            @endif
                    </div>
        @isset($topratedmoviesRelated)        
        <section class="upcoming-movies parallax parallax-profile ptb100" data-background="https://image.tmdb.org/t/p/original{{ $topratedmoviesRelated[0]['backdrop_from'] }}" data-color="#3e4555" data-color-opacity="0.95">
            <div class="container">
                <div class="row mt50">
                    @foreach($topratedmoviesRelated as $media)
                    <div class="col-md-4 col-sm-12 mb50">
                        <div class="movie-box-1 movie-box-profile">
                            <div class="poster poster-profile">
                                <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                            </div>
                            <div class="buttons">
                                @isset($media['trailer'])
                                    <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video">
                                        <i class="fa fa-play"></i>
                                    </a>
                                @endisset
                            </div>
                            <div class="movie-details movie-details-profile">
                                <h4 class="movie-title">
                                    @isset($media['title'])
                                        <a href="{{ url('movie/' . $media['id']) }}">{{ $media['title'] }}</a>
                                    @endisset
                                    @isset($media['name'])
                                        <a href="{{ url('tv/' . $media['id']) }}">{{ $media['name'] }}</a>
                                    @endisset                                    
                                </h4>
                                @isset($media['release_date'])
                                    <span class="released">{{ $media['release_date'] }}</span>
                                @endisset
                                @isset($media['first_air_date'])
                                    <span class="released">{{ $media['first_air_date'] }}</span>
                                @endisset                                
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-4 col-sm-12 my-auto related-text">
                        <div class="ptb50">
                            <h2 class="title text-white">Because you've seen {{ $topratedmoviesRelated[0]['comes_from'] }}</h2>
                            <h6 class="subtitle text-light ">We think you might like these. Enjoy!</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endisset
                </section>
        </div>
        
        
        <div class="tab-pane fade" id="topratedtv" role="tabpanel" aria-labelledby="bio-tab" aria-expanded="false">
                <section class="latest-movies pt80 ">
                    <div class="container container-profile">
            
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="title title-profile">Top rated series</h3>
                            </div>
                            <div class="col-md-4 align-self-center text-right mb5">
                                <form action="{{ url('/profile/' . $user['id'] .'/all') }}" method="post">
                                @csrf
                                    <input type="hidden" name="topic" value="toptv">
                                    <input type="hidden" name="iduser" value="{{ $user['id'] }}">
                                    <input type="submit"  class="btn btn-icon btn-main btn-effect" value="view all">
                                </form>
                            </div>
                        </div>
                        <hr class="hr-profile">
                        
                            @if(isset($topratedtv[0]))
                            <div class="owl-carousel owl-carousel-profile latest-movies-slider ">
                                @foreach($topratedtv as $media)
                                
                                    <div class="item item-profile">
                                        <div class="movie-box-1 movie-box-profile">
                                            @isset($media['poster_path'])
                                                <div class="poster">
                                                    <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                                                </div>
                                            @endisset
                                            @isset($media['trailer'])
                                                <div class="buttons">
                                                    <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video trailer-profile">
                                                        <i class="fa fa-play play-profile"></i>
                                                    </a>
                                                </div>
                                            @endisset
                                            <div class="movie-details">
                                                @isset($media['title'])
                                                <h6 class="movie-title movie-title-profile">
                                                    <a href="{{ url('movie/' . $media['id']) }}" class="link-profile">{{ $media['title'] }}</a>
                                                </h6>
                                                @endisset
                                                @isset($media['name'])
                                                <h6 class="movie-title movie-title-profile">
                                                    <a href="{{ url('tv/' . $media['id']) }}" class="link-profile">{{ $media['name'] }}</a>
                                                </h6>
                                                @endisset                                    
                                            </div>
            
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            @else
                                <div class="nothingfound">
                                    <h3 class="title ">Nothing found here! Explore our trending TV shows and movies <a href="{{url('/')}}" class="title-profile">here!</a></h3>
                                </div>
                            @endif
                    </div>
        @isset($topratedtvRelated)        
        <section class="upcoming-movies parallax parallax-profile ptb100" data-background="https://image.tmdb.org/t/p/original{{ $topratedtvRelated[0]['backdrop_from'] }}" data-color="#3e4555" data-color-opacity="0.95">
            <div class="container">
                <div class="row mt50">
                    @foreach($topratedtvRelated as $media)
                    <div class="col-md-4 col-sm-12 mb50">
                        <div class="movie-box-1 movie-box-profile">
                            <div class="poster poster-profile">
                                <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                            </div>
                            <div class="buttons">
                                @isset($media['trailer'])
                                    <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video">
                                        <i class="fa fa-play"></i>
                                    </a>
                                @endisset
                            </div>
                            <div class="movie-details movie-details-profile">
                                <h4 class="movie-title">
                                    @isset($media['title'])
                                        <a href="{{ url('movie/' . $media['id']) }}">{{ $media['title'] }}</a>
                                    @endisset
                                    @isset($media['name'])
                                        <a href="{{ url('tv/' . $media['id']) }}">{{ $media['name'] }}</a>
                                    @endisset                                    
                                </h4>
                                @isset($media['release_date'])
                                    <span class="released">{{ $media['release_date'] }}</span>
                                @endisset
                                @isset($media['first_air_date'])
                                    <span class="released">{{ $media['first_air_date'] }}</span>
                                @endisset                                
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-4 col-sm-12 my-auto related-text">
                        <div class="ptb50">
                            <h2 class="title text-white">Because you've seen {{ $topratedtvRelated[0]['comes_from'] }}</h2>
                            <h6 class="subtitle text-light ">We think you might like these. Enjoy!</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endisset
                </section>
        </div>        
        
    </div>
    
    
    
    
    
    
    
    
    
    
    
    <!--REVIEWS-->
    @if(isset($reviews[0]))
            <section class="blog bg-light ptb100">
            <div class="container col-md-8">
            
                <div class="row justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="title">Latest reviews</h2>
                    </div>
                </div>
                <div class="row mt50">
                
                    @foreach($reviews as $review)
                        <div class="@if(!isset($reviews[1])) offset-3 @endif col-md-6 ">
                            <div class="bloglist-post-holder shadow-hover">
                            @isset($review['idtv'])
                                <a href="{{ url('tv/' . $review['idtv']) }}" class="bloglist-thumb-link hover-link">
                            @endisset
                            @isset($review['idmovie'])
                                <a href="{{ url('movie/' . $review['idmovie']) }}" class="bloglist-thumb-link hover-link">
                            @endisset  
                            <div class="bloglist-post-thumbnail" style="background-image: url('https://image.tmdb.org/t/p/w500{{ $review['poster_path'] }}');"></div>
                                </a>
                                <div class="bloglist-text-wrapper">
                                <span class="circle-img bloglist-avatar" @if(file_exists('assets/profilepics/'. $review['iduser'] .'.png')) style="background-image: url('{{ url('assets/profilepics/'. $review['iduser'] .'.png') }}');" @endif>
                                    
                                 </span>
                                @isset($review['title'])
                                <h4 class="bloglist-title">
                                    @isset($review['idtv'])
                                        <a href="{{ url('tv/' . $review['idtv']) }}">{{$review['title'] }}</a>
                                    @endisset
                                    @isset($review['idmovie'])
                                        <a href="{{ url('movie/' . $review['idmovie']) }}" >{{$review['title'] }}</a>
                                    @endisset  
                                </h4>
                                @endisset
                                @isset($review['created_at'])
                                    <div class="bloglist-meta">
                                        <i class="fa fa-calendar"></i> {{ $review['created_at'] }}
                                    </div>
                                @endisset
                                <div class="bloglist-excerpt">
                                    @isset($review['content'])
                                        <p>{!! $review['content'] !!}</p>
                                        @isset($review['idtv'])
                                            <a href="{{ url('tv/' . $review['idtv']) }}" class="btn btn-main btn-effect">read more reviews</a>
                                        @endisset
                                        @isset($review['idmovie'])
                                            <a href="{{ url('movie/' . $review['idmovie']) }}" class="btn btn-main btn-effect">read more reviews</a>
                                        @endisset                                        
                                    @endisset
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
              
                </div>
            </div>
        </section>
      @endif
</div>
        
        
        
        
        
                        
    

<!-- Latest Movies and TV Shows-->



    @endsection
