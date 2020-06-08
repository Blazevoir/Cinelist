@extends('main') @section('content')
<section class="celeb-detail-intro overlay-gradient ptb100 fondo-default" @isset($backdrop) style="background: url(https://image.tmdb.org/t/p/w500{{ $backdrop }});" @endisset>
</section>


<section class="celeb-detail pb100">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-12">
                @isset($person['profile_path'])
                    <div class="celeb-img">
                        <img src="https://image.tmdb.org/t/p/original{{ $person['profile_path'] }}" alt="">
                    </div>
                @endisset
            </div>
            <div class="col-md-8 col-12">
                <div class="celeb-details">
                    @isset($person['name'])
                            <h3 class="title">{{ $person['name'] }}</h3>
                    @endisset
                    @isset($person['known_for_department'])
                        <span class="profession">Known for {{ $person['known_for_department'] }}</span>
                    @endisset
                    <ul class="nav tab-links">
                        @isset($person['biography'])
                            <li class="nav-item">
                                <a class="nav-link active" id="bio-tab" data-toggle="tab" href="#bio" aria-controls="bio" aria-expanded="false">biography</a>
                            </li>
                        @endisset
                        @isset($filmography)
                            <li class="nav-item">
                                <a class="nav-link" id="film-tab" data-toggle="tab" href="#filmography" aria-controls="filmography" aria-expanded="false">filmography</a>
                            </li>
                        @endisset
                    </ul>

                    <div class="tab-content mt70">
                        <div class="tab-pane fade active show" id="bio" role="tabpanel" aria-labelledby="bio-tab" aria-expanded="false">
                            <div class="bio-description">
                                @if($person['biography'] != '')
                                    <p>{{ $person['biography'] }}</p>
                                @else
                                    <p>There is no biography yet!</p>
                                @endif
                            </div>
                            <div class="bio-details">
                                <ul class="bio-wrapper">
                                    @isset($person['birthdate'])
                                        <li>
                                            <h6>Date of Birth:</h6> {{ $person['birthdate'] }}
                                        </li>
                                    @endisset
                                    @if($person['gender'] == 1)
                                        <li>
                                            <h6>Gender:</h6>Female
                                        </li>
                                    @elseif($person['gender'] == 2)
                                        <li>
                                            <h6>Gender:</h6>Male
                                        </li>
                                    @else
                                        <li>
                                            <h6>Gender:</h6>Unknown
                                        </li>
                                    @endif                                    
                                    @isset($person['place_of_birth'])
                                        <li>
                                            <h6>Place of birth:</h6> {{ $person['place_of_birth'] }}
                                        </li>
                                    @endisset
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        @isset($filmography)
                            <div class="tab-pane fade" id="filmography" role="tabpanel" aria-labelledby="film-tab" aria-expanded="false">
                                <ul class="film-list">
                                    
                                        @foreach($filmography as $media)
                                            @isset($media['title'])
                                                <li><a href="{{ url('movie/' . $media['id']) }}">{{ $media['title'] }}</a>
                                                    @isset($media['release_date'])
                                                        <span class="year">{{ $media['release_date'] }}</span>
                                                     @endisset
                                                </li>
                                            @endisset
                                            @isset($media['name'])
                                                <li><a href="{{ url('tv/' . $media['id']) }}">{{ $media['name'] }}</a>
                                                    @isset( $media['first_air_date'])
                                                        <span class="year">{{ $media['first_air_date'] }}</span>
                                                    @endisset
                                                </li>
                                            @endisset                                        
                                        @endforeach
                                    
                                </ul>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
