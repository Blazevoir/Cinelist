@extends('header2') @section('content')



<section class="page-header overlay-gradient" style="background: url('{{ url('assets/img/posters/movie-collection.jpg') }}');">
    <div class="container">
        <div class="inner">
            <h2 class="title">Discover</h2>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Cinelist</a></li>
                <li>Discover</li>
            </ol>
        </div>
    </div>
</section>

@isset($trending)
<main class="pb100 pt50">
            <div class="container">
                <div class="title-advancedsearch">
                    <h2 class="title">Discover what's trending now!</h2>
                    <button type="submit" id="advancedsearchbutton" class="btn btn-icon btn-main btn-effect mt10">Advanced Search</button>
                </div>
            </div>
            <div class="container heightnone" id="multidesaparece">
                <hr class="mtb50 hrmulti">

                <form method="post" action="{{url('/discover')}}" class="centrarbotoninput">
                    <div class="row multibuscador">
                        <select class="selectmulti" name="mediatype">
                            <option value="tv" selected><span class="text-center">Tv Shows</span></option>
                            <option value="movie"><span class="text-center">Movie</span></option>
                        </select>
                        <select class="selectmulti" name="genre">
                            <option disabled selected value><span class="text-center">Select a genre</span></option>
                            @foreach($generos as $genero)
                                <option value="{{$genero['id']}}"><span class="text-center">{{$genero['name']}}</span></option>
                            @endforeach
                        </select>
                        <input type="text" class="textmulti" placeholder="Select Year" name='year'>
                    </div>
                    <input type="submit"  class="btn btn-icon btn-main btn-effect mt30" value="Apply changes">
                </form>
                <hr class="mb50 mt30 hrmulti">
            </div>
            <div class="container">
                <div class="row">
                    @foreach($trending as $media)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="movie-box-4 mb30">
                                <div class="listing-container">
                                    <div class="listing-image borderblack">
                                        @if(isset($media['poster_path']))
                                            <img src="https://image.tmdb.org/t/p/w500{{ $media['poster_path'] }}" alt="">
                                        @else
                                            <img src="{{url('assets/404/404.jpg')}}" alt="">
                                        @endif    
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
                                            @endisset                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @isset($pagination)
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <nav class="pagination" id="postpagination" @isset($genre) genre={{$genre}} @endisset @isset($year) year={{$year}} @endisset @isset($mediatype) mediatype={{$mediatype}} @endisset>
                            <ul>
                                @isset($pagination['initial'])
                                    <li><a csrf="{{ csrf_token() }}" page="{{$pagination['initial']}}" class="ti-angle-left pagination-discover"></a></li>
                                @endisset
                                @isset($pagination['prev'])
                                    <li><a csrf="{{ csrf_token() }}" page="{{$pagination['prev']}}" class="pagination-discover">{{$pagination['prev']}}</a></li>
                                @endisset
                                @isset($pagination['current'])
                                    <li><a csrf="{{ csrf_token() }}" page="{{$pagination['current']}}" class="current-page pagination-discover">{{$pagination['current']}}</a></li>
                                @endisset
                                @isset($pagination['next'])
                                    <li><a csrf="{{ csrf_token() }}" page="{{$pagination['next']}}" class="pagination-discover">{{$pagination['next']}}</a></li>
                                @endisset
                                @isset($pagination['last'])
                                    <li><a csrf="{{ csrf_token() }}" page="{{$pagination['last']}}" class="ti-angle-right pagination-discover"></a></li>
                                @endisset
                            </ul>
                        </nav>
                    </div>
                </div>
                @endisset
            </div>
        </main>
@endisset


@endsection
