@extends('header2') @section('content')



<section class="page-header overlay-gradient" style="background: url('{{ url('assets/img/posters/movie-collection.jpg') }}');">
    <div class="container">
        <div class="inner">
            <h2 class="title">Custom Search</h2>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Cinelist</a></li>
                <li>Custom Search</li>
            </ol>
        </div>
    </div>
</section>


<main class="ptb100">
    <div class="container" id="estoyindex" @auth iduser="{{Auth::user()->id}}"  @endauth>
        <div class="row">
        @isset($search)    
            @foreach($search as $key => $media)
            
                @if($media['media_type'] == 'movie')
                <!--Movies-->
                    <div class="col-md-12 col-sm-12 @if($key > 9) hiddenMedia showMedia @endif">
                        <div class="movie-list-2">
                            <div class="listing-container">
                                <div class="listing-image">
                                    <div class="img-wrapper removeBackground">
                                        @isset($media['trailer'])
                                            <div class="play-btn">
                                                <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video"><i class="fa fa-play"></i></a>
                                            </div>
                                        @endisset                            
                                        @isset($media['poster_path'])
                                            <img   src="https://image.tmdb.org/t/p/original/{{$media['poster_path']}}" alt="">
                                        @endisset
                                       
                                    </div>
                                </div>
                                <div class="listing-content">
                                    <div class="inner">
                                        @isset($media['title'])
                                            <h2 class="title">{{ $media['title'] }}</h2>
                                        @endisset
                                        @isset($media['overview'])
                                            <p>{{ $media['overview'] }}</p>
                                        @endisset
                                            <a href="{{ url($media['media_type'] . '/' . $media['id']) }}" class="btn btn-main btn-effect">details</a>
                                    </div>
                                    @auth
                                        <div class="buttons">
                                            <i class="fas fa-heart favorite-index" id="favorite-index-{{$media['id']}}" data-original-title="Favorite" data-toggle="tooltip" data-placement="top" iduser="{{ Auth::user()->id }}" @isset($media['id']) idmedia="{{$media['id']}}" @endisset @isset($media['title']) mediatype="movie" @endisset @isset($media['name']) mediatype="tv" @endisset faved='false'></i>
                                            <i class="fa fa-twitter share-index" aria-hidden="true" data-original-title="Tweet" data-toggle="tooltip" data-placement="top" @isset($media['id']) idmedia="{{$media['id']}}" @endisset @isset($media['title']) mediatype="movie" @endisset @isset($media['name']) mediatype="tv" @endisset></i>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if($media['media_type'] == 'tv')
                <!--TV Shows-->
                    <div class="col-md-12 col-sm-12 @if($key > 9) hiddenMedia showMedia @endif">
                        <div class="movie-list-2">
                            <div class="listing-container">
                                <div class="listing-image">
                                    <div class="img-wrapper removeBackground">
                                        @isset($media['trailer'])
                                            <div class="play-btn">
                                                <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video"><i class="fa fa-play"></i></a>
                                            </div>
                                        @endisset                            
                                        @isset($media['poster_path'])
                                            <img   src="https://image.tmdb.org/t/p/original/{{$media['poster_path']}}" alt="">
                                        @endisset
                                       
                                    </div>
                                </div>
                                <div class="listing-content">
                                    <div class="inner">
                                        @isset($media['name'])
                                            <h2 class="title">{{ $media['name'] }}</h2>
                                        @endisset
                                        @isset($media['overview'])
                                            <p>{{ $media['overview'] }}</p>
                                        @endisset
                                            <a href="{{ url($media['media_type'] . '/' . $media['id']) }}" class="btn btn-main btn-effect">details</a>
                                    </div>
                                    @auth
                                        <div class="buttons">
                                            <i class="fas fa-heart favorite-index" id="favorite-index-{{$media['id']}}" data-original-title="Favorite" data-toggle="tooltip" data-placement="top" iduser="{{ Auth::user()->id }}" @isset($media['id']) idmedia="{{$media['id']}}" @endisset @isset($media['title']) mediatype="movie" @endisset @isset($media['name']) mediatype="tv" @endisset faved='false'></i>
                                            <i class="fa fa-twitter share-index" aria-hidden="true" data-original-title="Tweet" data-toggle="tooltip" data-placement="top" @isset($media['id']) idmedia="{{$media['id']}}" @endisset @isset($media['title']) mediatype="movie" @endisset @isset($media['name']) mediatype="tv" @endisset></i>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endif     
                
                
                @if($media['media_type'] == 'person')
                <!--People-->
                    <div class="col-md-12 col-sm-12 @if($key > 9) hiddenMedia showMedia @endif">
                        <div class="movie-list-2">
                            <div class="listing-container">
                                <div class="listing-image">
                                    <div class="img-wrapper removeBackground">
                                        @isset($media['trailer'])
                                            <div class="play-btn">
                                                <a href="https://www.youtube.com/watch?v={{$media['trailer']}}" class="play-video"><i class="fa fa-play"></i></a>
                                            </div>
                                        @endisset                            
                                        @isset($media['profile_path'])
                                            <img src="https://image.tmdb.org/t/p/original/{{$media['profile_path']}}" alt="">
                                        @endisset
                                       
                                    </div>
                                </div>
                                <div class="listing-content">
                                    <div class="inner">
                                        @isset($media['name'])
                                            <h2 class="title">{{ $media['name'] }}</h2>
                                        @endisset
                                        @isset($media['biography'])
                                            <p>{{ $media['biography'] }}</p>
                                        @endisset
                                            <a href="{{ url($media['media_type'] . '/' . $media['id']) }}" class="btn btn-main btn-effect">details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif                
            @endforeach
            @endisset
            @isset($search[10])
                <div class="col-md-12 text-center" id="DiviewMore">
                    <button href="#" class="btn btn-main btn-effect col-md-2 ml-auto mr-auto " id="viewMore">View More</button>
                </div>
            @endisset

    </div>
</main>

@endsection
