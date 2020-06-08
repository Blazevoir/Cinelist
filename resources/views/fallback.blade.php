@extends('header2')
@section('content')
<section class="page-header overlay-gradient" style="background: url('{{ url('assets/img/posters/movie-collection.jpg') }}');">
    <div class="container">
        <div class="inner">
            <h2 class="title">404 Page</h2>
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Cinelist</a></li>
                <li>404 Page</li>
            </ol>
        </div>
    </div>
</section>

<main class="page-not-found ptb100">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <h2>404</h2>
            <h3>Page Not Found!</h3>
            <p>We're sorry, but the page you were looking for doesn't exist.</p>
            <form id="search-form-1" action="{{url('search')}}" method="post">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8 col-sm-10 col-12">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="desplegar">
                                    <a id="search-single-0">
                                        <div class="caja search-display-none" id="search-total-0">
                                            <div class="caratula"><img id="search-img-0"></div>
                                            <div class="titulo"><h4 id="search-title-0"></h4></div>
                                        </div>
                                    </a>
                                    <a id="search-single-1">
                                        <div class="caja search-display-none" id="search-total-1">
                                            <div class="caratula"><img id="search-img-1"></div>
                                            <div class="titulo"><h4 id="search-title-1"></h4></div>
                                        </div>
                                    </a>
                                    <a id="search-single-2">
                                        <div class="caja search-display-none" id="search-total-2">
                                            <div class="caratula"><img id="search-img-2"></div>
                                            <div class="titulo"><h4 id="search-title-2"></h4></div>
                                        </div>
                                    </a>
                                    <a id="search-single-3">
                                        <div class="caja search-display-none" id="search-total-3">
                                            <div class="caratula"><img id="search-img-3"></div>
                                            <div class="titulo"><h4 id="search-title-3"></h4></div>
                                        </div>
                                    </a>
                                </div>
                            <input name="search-keyword" type="text" id="search-keyword" value="" class="form-control desplegablefall" placeholder="Enter Movies or Series Title" autocomplete="off">
                            <input type="submit" style="height:55px !important" class="btn btn-main btn-effect popup-with-zoom-anim fa fa-search searchenviar" id="boton-header" value="&#xf002"></input>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</main>
@endsection