@extends('main')

@section('content')

<div class="loading">
    <div class="loading-inner">
        <div class="loading-effect">
            <div class="object"></div>
        </div>
    </div>
</div>
<section id="slider" class="hero-slider" >
    
    <div class="rev-slider-wrapper fullwidthbanner-container overlay-gradient" id="estoyindex" @auth iduser="{{Auth::user()->id}}"  @endauth>
        
        <div id="hero-slider" class="rev_slider fullwidthabanner" style="display:none" data-version="5.4.1">
            @if(Session::has('alert'))
                <div id="alertfade" class="alert alert-{{ Session::get('alert')}} alert-dismissible fade show fixed-top" role="alert" style="z-index:9999; opacity:0">
                      {{Session::get('message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @endif
            <?php Session::forget('alert');Session::forget('message'); ?>
            <ul>
                <li data-transition="fade">
                    
                    <img src="{{ url('assets/img/posters/movie-collection.jpg') }}" alt="Image" title="slider-bg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina="">
                    <div class="tp-caption tp-resizeme" data-x="center" data-hoffset="" data-y="middle" data-voffset="['-80','-80','-80','-80']" data-responsive_offset="on" data-fontsize="['60','50','40','30']" data-lineheight="['60','50','40','30']" data-whitespace="nowrap"
                        data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                        style="z-index: 5; color: #fff; font-weight: 900;">WELCOME TO CINELIST
                    </div>
                    <div class="tp-caption tp-resizeme" data-x="center" data-hoffset="" data-y="middle" data-voffset="[0]" data-width="[1200, 992, 768, 98%]" data-responsive_offset="on" data-whitespace="nowrap" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                        style="z-index: 5; color: #fff; font-weight: 900;">

                        <form id="search-form-1" action="{{url('search')}}" method="post">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-sm-10 col-12">
                                    <div class="form-group">
                                        <input name="search-keyword" type="text" id="search-keyword" value="" class="form-control" placeholder="Enter Movies or Series Title">
                                        <button id="search-submit" type="submit" class="btn btn-main btn-effect"><i class="fa fa-search" ></i></button><br>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tp-caption tp-resizeme text-center" data-x="center" data-hoffset="" data-y="middle" data-voffset="['100','100','80','80']" data-responsive_offset="on" data-fontsize="['16']" data-lineheight="['22']" data-whitespace="nowrap" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                        style="z-index: 5; color: #fff; font-weight: 400;">
                        Search any movie or TV show and <br />let's see what we've got!
                    </div>
                    <div class="tp-caption tp-resizeme" data-x="[730, 630, 520, 370]" data-hoffset="" data-y="middle" data-voffset="['115','115','90','500']" data-responsive_offset="on" data-fontsize="['16']" data-lineheight="['22']" data-whitespace="nowrap" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                        style="z-index: 5; color: #fff; font-weight: 400;">
                        <img src="{{ url('assets/img/other/banner-arrow.png') }}" alt="">
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<!--Header search-->
<section class="top-movies2">
    <div class="container">
        <div class="row">
            <!--searched movies-->
            @isset($trending)
                @foreach ($trending as $key => $media)
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="search-total-{{$key}}">
                    <div class="movie-box-4">
                        <div class="listing-container">
                            <div class="listing-image">
                                <div class="buttons">
                                    @auth
                                    <a class="like ">
                                        <i class="icon-heart favorite-index" id="favorite-index-{{$media['id']}}" data-original-title="Favorite" data-toggle="tooltip" data-placement="top" iduser="{{ Auth::user()->id }}" @isset($media['id']) idmedia="{{$media['id']}}" @endisset @isset($media['title']) mediatype="movie" @endisset @isset($media['name']) mediatype="tv" @endisset faved='false'></i>
                                    </a>
                                    <a class="share ">
                                        <i class="fa fa-twitter share-index" aria-hidden="true" data-original-title="Tweet" data-toggle="tooltip" data-placement="top" @isset($media['id']) idmedia="{{$media['id']}}" @endisset @isset($media['title']) mediatype="movie" @endisset @isset($media['name']) mediatype="tv" @endisset></i>
                                    </a>
                                    @endauth

                                </div>
                                @auth
                                @endauth
                                @isset($media['poster_path'])
                                    <img id="search-img-{{$key}}"src="https://image.tmdb.org/t/p/original{{ $media['poster_path'] }}" alt="">
                                @endisset
                            </div>
                            <div class="listing-content">
                                <div class="inner">
                                    @isset($media['title'])
                                        <h2 id="search-title-{{$key}}" class="title">{{ $media['title'] }}</h2>
                                        <a id="search-single-{{$key}}"href="{{ url('movie/' . $media['id']) }}" class="btn btn-main btn-effect">details</a>
                                    @endisset
                                    @isset($media['name'])
                                        <h2 id="search-title-{{$key}}" class="title">{{ $media['name'] }}</h2>
                                        <a id="search-single-{{$key}}" href="{{ url('tv/' . $media['id']) }}" class="btn btn-main btn-effect">details</a>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endisset
        </div>
    </div>
</section>

<section style="background-color:white !important" class="latest-releases bg-light ptb100">
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-7 text-center">
            <h2 class="title">Latest Movies & TV Shows</h2>
        </div>
    </div>

</div>


<div class="owl-carousel latest-releases-slider">
<!--Latest movies loop-->
@foreach($latestMedia as $media)
<div class="item">
    <div class="movie-box-1">
        <div class="poster">
            <img src="https://image.tmdb.org/t/p/original{{ $media['poster_path'] }}" alt="">
        </div>
        @isset($media['trailer'])
            <div class="buttons">
                <a href="https://www.youtube.com/watch?v={{ $media['trailer'] }}" class="play-video">
                    <i class="fa fa-play"></i>
                </a>
            </div>
        @endisset
        <div class="movie-details">
                <a href="{{ url($media['media_type'] . '/' . $media['id']) }}" class="btn btn-main btn-effect" style="margin-bottom:20px">details</a>

                <h4 class="movie-title">
                    @isset($media['title'])
                        <a href="{{ url($media['media_type'] . '/' . $media['id']) }}">{{ $media['title'] }}</a>
                    @endisset
                    @isset($media['name'])
                        <a href="{{ url($media['media_type'] . '/' . $media['id']) }}">{{ $media['name'] }}</a>
                    @endisset
                </h4>
                @isset($media['release_date'])
                    <span class="released">{{ $media['release_date'] }}</span>
                @endisset
                @isset($media['first_air_date'])
                    <span class="released">{{ $media['first_air_date'] }}</span>
                @endisset
        </div>
        @auth
        <div class="stars">
            @isset($media['notamedia'])
                <h4 class="movie-title text-white">{{ $media['notamedia'] }}/10 out of {{$media['totalvotes'] }} votes</h4>
            @endisset
        </div>
        @endauth
    </div>
</div>
@endforeach
</div>
</section>



<section class="features">
    <div class="row">
        <div  class="col-md-6 col-sm-12 with-bg overlay-gradient" style="background: url({{ url('assets/img/other/features2.jpg)') }}"></div>
        <div class="col-md-6 col-sm-12 bg-light">
            <div class="features-wrapper">
                <h3 class="title">Watch all Movies & TV Shows once they get released!</h3>
                <p>Cinelist provides information about any tv show or movie at the moment they go live. Don't miss anything and join us.</p>
                   <a href="#login-register-popup" class="btn btn-main btn-effect login-btn popup-with-zoom-anim">
                        register
                    </a>
            </div>
        </div>
    </div>
</section>

<section class="counter bg-main-gradient ptb50 text-center">
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-12">
                <span class="counter-item" data-from="0" data-to="964">0</span>
                <h4>Movies</h4>
            </div>

            <div class="col-md-4 col-sm-12">
                <span class="counter-item" data-from="0" data-to="743">0</span>
                <h4>TV Shows</h4>
            </div>

            <div class="col-md-4 col-sm-12">
                <span class="counter-item" data-from="0" data-to="1207">0</span>
                <h4>Users</h4>
            </div>
        </div>
    </div>
</section>
<!--Know more of the cast of media-->
@isset($castLastMedia)
    <section class="top-movies ptb100">
        <div class="container">
            <div class="row">
                
                <div class="col-md-10">
                    @isset($latestMedia[0]['title'])
                        <h2 class="title">Know more about the cast of {{ $latestMedia[0]['title'] }}</h2>
                    @endisset
                    @isset($latestMedia[0]['name'])
                        <h2 class="title">Know more about the cast of {{ $latestMedia[0]['name'] }}</h2>
                    @endisset                    
                </div>
                <div class="col-md-2 align-self-center text-right">
                    <form action="{{url('search/casting')}}" method = "post">
                        @csrf
                        <input type="hidden" name="id" value="{{$latestMedia[0]['id']}}">
                        <input type="hidden" name="media_type" value="{{$latestMedia[0]['media_type']}}">
                        <input type="submit" class="btn btn-icon btn-main btn-effect" value="View All">
                    </form>
                </div>
            </div>
            
            <div class="row mt20">
                @foreach($castLastMedia as $actor)
                <div class="col-md-12 col-sm-12">
                    <div class="movie-list-1 mb30">
                        <div class="listing-container">
                            <div class="listing-image">
                                <img src="https://image.tmdb.org/t/p/original{{ $actor['profile_path'] }}" alt="">
                            </div>
    
                            <div class="listing-content">
                                <div class="inner">
                                    <h2 class="title">{{ $actor['name'] }}</h2>
                                    <p>{{ $actor['biography'] }}</p>
                                    <a href="{{ url('person/' . $actor['id']) }}" class="btn btn-main btn-effect">details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endisset
<!--FIN DE TRENDING-->



        
<section class="subscribe bg-light2 ptb100">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="img-box overlay-gradient mr30">
                    <img src="{{ url('assets/img/other/landscape.jpg') }}" alt="" class="img-resonsive img-shadow">
                </div>
            </div>
            <div class="col-md-6 col-12 mt50">
                <h2 class="title">Invite your friends to Cinelist!</h2>
                <form action="invite" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter the Email here ..." autocomplete="off" required>
                            <label for="mc-email"></label>
                            <input type="submit" class="btn btn-main btn-effect" value="Suscribe"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<!--******************************************** PRICING ****************************************-->
<section class="become-premium3 ptb100" id="pricing-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="title">Reviews is not enough?</h2>
                <h6 class="subtitle">Become a partner and gain extra functionallity.</h6>
            </div>
        </div>
        <div class="row mt80">
            <div class="col-md-12">
                <div class="pricing-table-2">
                    <div class="plan">
                        <div class="plan-price">
                            <h3>Basic</h3>
                            <span class="value">Free</span>
                            <span class="period">Try Cinelist for FREE, you can upgrade anytime.</span>
                        </div>
                        <div class="plan-features">
                            <ul>
                                <li>365 days per year</li>
                                <li>All movies</li>
                                <li>Reviews</li>
                                <li>Comments</li>
                            </ul>
                            <a class="btn btn-main btn-effect mt30" href="#">Join now</a>
                        </div>
                    </div>
                    <div class="plan featured">
                        <div class="plan-price">
                            <h3>Netflix Partner</h3>
                            <span class="value">$19</span>
                            <span class="period">Watch any netflix show from our webpage.</span>
                        </div>
                        <div class="plan-features">
                            <ul>
                                <li>1 Month</li>
                                <li>Full HD</li>
                                <li>All tv and movies from Netflix</li>
                                <li>TV & Desktop</li>
                                <li>24/7 Support</li>
                            </ul>
                            <a class="btn btn-main btn-effect mt30" href="#">Join now</a>
                        </div>
                    </div>
                    <div class="plan">
                        <div class="plan-price">
                            <h3>Cinematic</h3>
                            <span class="value">$39</span>
                            <span class="period">Watch your favorite movies anywhere and anytime with all subcriptions.</span>
                        </div>
                        <div class="plan-features">
                            <ul>
                                <li>1 Months</li>
                                <li>Ultra HD</li>
                                <li>Any Device</li>
                                <li>24/7 Support</li>
                            </ul>
                            <a class="btn btn-main btn-effect mt30" href="#">Join now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- **********************************  PRICING ********************************-->

<!--********************** UPCOMING MOVIES   ************************************-->
        
        <section class="upcoming-movies parallax ptb100" id="upcoming-movies" data-background="{{ url('assets/img/posters/movie-collection.jpg') }}" data-color="#3e4555" data-color-opacity="0.95">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 text-center">
                        <h2 class="title text-white">Upcoming Movies</h2>
                    </div>
                </div>
                <div class="row mt50">
                    <div class="col-md-8">
                        <div class="movie-box-1 upcoming-featured-item">
                            @if(!isset($coming_soon[0]['backdrop_path']))
                                <div class="poster">
                                    <img src="https://image.tmdb.org/t/p/original{{ $coming_soon[0]['poster_path'] }}" alt="">
                                </div>  
                            @else
                                <div class="poster">
                                    <img src="https://image.tmdb.org/t/p/original{{ $coming_soon[0]['backdrop_path'] }}" alt="">
                                </div>
                            @endif
                            @isset($coming_soon[0]['trailer'])
                                <div class="buttons">
                                    <a href="https://www.youtube.com/watch?v={{$coming_soon[0]['trailer']}}" class="play-video">
                                        <i class="fa fa-play"></i>
                                    </a>
                                </div>
                            @endisset
                            @isset($coming_soon[0]['title'])
                            <div class="movie-details">
                                <h4 class="movie-title">
                                    <a href="{{ url('movie/' . $coming_soon[0]['id']) }}">{{ $coming_soon[0]['title']}}</a>
                                </h4>   
                                @isset($coming_soon[0]['release_date'])
                                    <span class="released">Release Date: {{ $coming_soon[0]['release_date']}}</span>
                                @endisset
                            </div>
                            @endisset
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="movie-box-1 upcoming-item">
                            @if(!isset($coming_soon[1]['backdrop_path']))
                                <div class="poster">
                                    <img src="https://image.tmdb.org/t/p/original{{ $coming_soon[1]['poster_path'] }}" alt="">
                                </div>  
                            @else
                                <div class="poster">
                                    <img src="https://image.tmdb.org/t/p/original{{ $coming_soon[1]['backdrop_path'] }}" alt="">
                                </div>
                            @endif
                            @isset($coming_soon[1]['trailer'])
                                <div class="buttons">
                                    <a href="https://www.youtube.com/watch?v={{$coming_soon[1]['trailer']}}" class="play-video">
                                        <i class="fa fa-play"></i>
                                    </a>
                                </div>
                            @endisset
                            @isset($coming_soon[1]['title'])
                            <div class="movie-details">
                                <h4 class="movie-title">
                                    <a href="{{ url('movie/' . $coming_soon[1]['id']) }}">{{ $coming_soon[1]['title']}}</a>
                                </h4>   
                                @isset($coming_soon[1]['release_date'])
                                    <span class="released">Release Date: {{ $coming_soon[1]['release_date']}}</span>
                                @endisset
                            </div>
                            @endisset
                        </div>
                        <div class="movie-box-1 upcoming-item mt20">
                            @if(!isset($coming_soon[2]['backdrop_path']))
                                <div class="poster">
                                    <img src="https://image.tmdb.org/t/p/original{{ $coming_soon[2]['poster_path'] }}" alt="">
                                </div>  
                            @else
                                <div class="poster">
                                    <img src="https://image.tmdb.org/t/p/original{{ $coming_soon[2]['backdrop_path'] }}" alt="">
                                </div>
                            @endif
                            @isset($coming_soon[2]['trailer'])
                                <div class="buttons">
                                    <a href="https://www.youtube.com/watch?v={{$coming_soon[2]['trailer']}}" class="play-video">
                                        <i class="fa fa-play"></i>
                                    </a>
                                </div>
                            @endisset
                            @isset($coming_soon[2]['title'])
                            <div class="movie-details">
                                <h4 class="movie-title">
                                    <a href="{{ url('movie/' . $coming_soon[2]['id']) }}">{{ $coming_soon[2]['title']}}</a>
                                </h4>   
                                @isset($coming_soon[2]['release_date'])
                                    <span class="released">Release Date: {{ $coming_soon[2]['release_date']}}</span>
                                @endisset
                            </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!--************************ UPCOMING MOVIES **************************-->
@endsection