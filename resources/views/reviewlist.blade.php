@extends('header2') @section('content')

<section class="page-header overlay-gradient" style="background: url('{{ url('assets/img/posters/movie-collection.jpg') }}');" id="tvinfo" @auth userid="{{ Auth::user()->id}}"   @endauth     @isset($idmedia) mediaId = "{{$idmedia}}" @endisset  @isset($mediatype) mediaType = "{{$mediatype}}"@endisset>
    <div class="container">
        <div class="inner">
            @isset($title)
                <h2 class="title">Review list for <a href="{{url($mediatype .'/'. $idmedia)}}">{{$title['title']}}</a></h2>
            @endisset
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Cinelist</a></li>
                <li><a href="{{url($mediatype .'/'. $idmedia)}}">{{$title['title']}}</a></li>
                <li>Review list</li>
            </ol>
        </div>
    </div>
</section>

<main class="ptb100">
    <div class="container">
        <div class="row">
        @isset($reviews)    
            @foreach($reviews as $key => $review)
                
                    <div class="col-md-12 col-sm-12">
                        <div class="movie-list-2">
                            <div class="listing-container reviewlisting review-container">
                                
                                    <div class="testimonial-pic ml-auto mr-auto" @isset($review['profilepic']) style="background-image:url('{{ url('assets/profilepics/'. $review['iduser'] . '.jpg') }}');" @endisset></div>
                                    
                                    <div class="inner text-center">
                                        @isset($review['userName'])
                                            <h4 class="reviewer">{{ $review['userName'] }}</h4>
                                        @endisset
                                        @isset($review['content'])
                                            <p>{!! $review['content'] !!}</p>
                                        @endisset
                                    </div>
                                    @auth
                                        <div class="buttons buttonabsolute buttontwitter">
                                             <a data-original-title="Share" data-toggle="tooltip" data-placement="bottom" class="share button sharereview" id="sharereview" reviewid="{{$review['id']}}" @auth  auth="@if(Auth::user()->id == $review['iduser'])true @endif"@endauth>
                                                <i class="fab fa-twitter fa-2x"></i>
                                            </a>
                                        </div>
                                        @isset(Auth::user()->id)
                                            @if(Auth::user()->id == $review['iduser'])
                                                <div class="buttons buttonabsolutedelete">
                                                    <form action="{{ url('deletereview') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="reviewid" id="reviewid" value="{{ $review['id'] }}">
                                                        <input type="hidden" name="mediatype" id="mediatype" value="{{ $mediatype }}">
                                                        <button type="submit" data-original-title="Delete review" data-toggle="tooltip" data-placement="bottom" class="buttonsinestilo"><i class="fas fa-times"></i></button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endisset
                                    @endauth
                                
                            </div>
                        </div>
                    </div>
                
                
            @endforeach
            @endisset


    </div>
</main>

@endsection
