@extends('header2') @section('content')


<section class="page-header header-profile overlay-gradient backgroundd" @if(file_exists('assets/backgrounds/'. $user['id'] .'background.png')) style="background-image: url('{{ url('assets/backgrounds/'. $user['id'] .'background.png') }}');" @else style="background-image: url('{{ url('assets/backgrounds/default.png')}}"
    @endif>
    <div class="container header-home">
        
        <div class="row position-relative">
            <div class="profile-pic col-md-2 position-absolute" @if(file_exists('assets/profilepics/'. $user['id'] .'.png')) style="background-image: url('{{ url('assets/profilepics/'. $user['id'] .'.png') }}');" @endif>
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
    
        </div>
        
    </div>
</section>

@isset($allmedia)
<main class="ptb100">
            <div class="container">
            @if(isset($allmedia[0]))
                @if($topic == 'watching')
                    <h2 class="title text-center">Content <a href="{{ url('profile/'.$user['id']) }} "class="thumbs-purple">{{$user['name']}}</a>  is currently watching</h2>
                @elseif($topic == 'watched')
                    <h2 class="title text-center">Watched by <a href="{{ url('profile/'.$user['id']) }} "class="thumbs-purple">{{$user['name']}}</a></h2>
                @elseif($topic == 'planned')
                    <h2 class="title text-center">Content <a href="{{ url('profile/'.$user['id']) }} "class="thumbs-purple">{{$user['name']}}</a> is planning to watch</h2>
                @elseif($topic == 'favorite')
                    <h2 class="title text-center">Favorited by <a href="{{ url('profile/'.$user['id']) }} " class="thumbs-purple">{{$user['name']}}</a></h2>
                @elseif($topic == 'toptv')
                    <h2 class="title text-center">Check <a href="{{ url('profile/'.$user['id']) }} " class="thumbs-purple">{{$user['name']}}</a>'s top rated series</h2>
                @elseif($topic == 'topmovies')
                    <h2 class="title text-center">Check <a href="{{ url('profile/'.$user['id']) }} " class="thumbs-purple">{{$user['name']}}</a>'s top rated movies</h2>                    
                @endif
            @else
                <div class="nothingfound">
                    @if($isHome)
                        <h2 class="title ">Nothing found here! Explore our trending TV shows and movies <a href="{{url('/')}}" class="title-profile">here</a> or go back to your
                        <a href="{{ url('profile/'.$user['id']) }} " class="title-profile">profile</a></h2>
                    @else
                        <h2 class="title ">Nothing found here! Go back to 
                        <a href="{{ url('profile/'.$user['id']) }} " class="title-profile">{{$user['username']}}</a>'s profile</h2>
                    @endif
                </div>
            @endif
                <div class="row">
                    @foreach($allmedia as $media)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="movie-box-4 mb30">
                                <div class="listing-container">
                                    <div class="listing-image borderblack">
                                        @isset($media['poster_path'])
                                            <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                                        @endisset                                    
                                    </div>
    
                                    <div class="listing-content">
                                        <div class="inner inner-viewall">
                                            @isset($media['title'])
                                                <a href="{{ url('movie/' . $media['id']) }}" class="link-profile"><h2 class="title link-profile">{{ $media['title'] }}</h2></a>
                                            @endisset
                                            @isset($media['name'])
                                                <a href="{{ url('tv/' . $media['id']) }}" class="link-profile"><h2 class="title link-profile">{{ $media['name'] }}</h2></a>
                                            @endisset                                            
                                            @isset($media['overview'])
                                                <p class="text-white text-justify">{{ $media['overview'] }}</p>
                                            @endisset
                                            @isset($media['title'])
                                                <a href="{{ url('movie/' . $media['id']) }}" class="btn btn-main btn-effect">details</a>
                                            @endisset
                                            @isset($media['name'])
                                                <a href="{{ url('tv/' . $media['id']) }}" class="btn btn-main btn-effect">details</a>
                                            @endisset  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
@endisset


@endsection