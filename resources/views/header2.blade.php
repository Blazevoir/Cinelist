<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">

    <title>Cinelist</title>

    <link rel="shortcut icon" href="{{ url('assets/img/favicon.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('assets/img/apple-touch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/img/apple-touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('assets/img/apple-touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('assets/img/apple-touch-icon-ipad-retina.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ url('assets/img/apple-touch-icon-ipad-pro.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets/img/apple-touch-icon-iphone-6-plus.png') }}">
    <link rel="icon" sizes="192x192" href="{{ url('assets/img/icon-hd.png') }}">
    <link rel="icon" sizes="128x128" href="{{ url('assets/img/icon.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/navigation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/jquery.mmenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/gallery.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/header2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/stars.css') }}">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/801937acda.js" crossorigin="anonymous"></script>

</head>

<body>



<nav id="main-mobile-nav"></nav>


<div class="wrapper">


<header class="header">
    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg">

            
            <div class="navbar-collapse">
                <a class="navbar-brand nav-logo-2" href="{{ url('/') }}">
                    <img src="{{ url('assets/img/logo.png') }}" alt="logo" width="150" class="logo">
                    <img src="{{ url('assets/img/logo-white.png') }}" alt="white logo" width="150" class="logo-white">
                </a>
                <!--menu tradicional con hamburger-->
                <ul class="navbar-nav mx-auto menu-central-general text-dark" id="main-menu">
                
                	<li class="nav-item nav-color-purple2">
                		<a class="nav-link nav-link-padding" href="{{url('/')}}">Cinelist</a>
                	</li>
                	
                	@auth
                	<li class="nav-item nav-color-purple2">
                		<a class="nav-link nav-link-padding" href="{{url('profile/' . Auth::user()->id )}}">Home</a>
                	</li>
                	@endauth
                	
                    <li class="nav-item nav-color-purple2">
                		<a class="nav-link nav-link-padding" href="{{url('discover/')}}">Discover</a>
                	</li>
                    
                    <li class="nav-item nav-color-purple2">
                		<a class="nav-link nav-link-padding" href="{{url('/')}}#pricing-section">Pricing</a>
                	</li>
                	
                	<li class="nav-item nav-color-purple2">
                		<a class="nav-link nav-link-padding" href="{{url('/')}}#upcoming-movies">Upcoming</a>
                	</li>
                	
                	<li class="nav-item nav-color-purple2">
                		<a class="nav-link nav-link-padding" href="{{url('/contact')}}">Contact</a>
                	</li>
                </ul>
                <!--fin del menu tradicional con hamburger-->
                @guest
                <ul class="navbar-nav extra-nav nav-buscador">
                    <li class="nav-item m-auto li-header">
                        <form id="search-form-1" action="{{url('search')}}" method="post" class="searchformcine">
                            @csrf
                            <div class="form-group">
                                <div class="form-group">
                                <div class="desplegar">
                                    <a id="search-single-0">
                                        <div class="caja search-display-none" id="search-total-0">
                                            <div class="caratula"><img id="search-img-0"></div>
                                            <div class="titulo"><h6 id="search-title-0"></h6><p id="search-content-0"></p></div>
                                        </div>
                                    </a>
                                    <hr class="hrbuscador search-display-none" id="hr0">
                                    <a id="search-single-1">
                                        <div class="caja search-display-none" id="search-total-1">
                                            <div class="caratula"><img id="search-img-1"></div>
                                            <div class="titulo"><h6 id="search-title-1"></h6><p id="search-content-1"></p></div>
                                        </div>
                                    </a>
                                    <hr class="hrbuscador search-display-none" id="hr1">
                                    <a id="search-single-2">
                                        <div class="caja search-display-none" id="search-total-2">
                                            <div class="caratula"><img id="search-img-2"></div>
                                            <div class="titulo"><h6 id="search-title-2"></h6><p id="search-content-2"></p></div>
                                        </div>
                                    </a>
                                    <hr class="hrbuscador search-display-none" id="hr2">
                                    <a id="search-single-3">
                                        <div class="caja search-display-none" id="search-total-3">
                                            <div class="caratula"><img id="search-img-3"></div>
                                            <div class="titulo"><h6 id="search-title-3"></h6><p id="search-content-3"></p></div>
                                        </div>
                                    </a>
                                    <hr class="hrbuscador search-display-none" id="hr3">
                                </div>
                                <input name="search-keyword" type="text" id="search-keyword" value="@isset($query) {{$query}} @endisset" class="form-control buscador-header desplegable" placeholder="Enter Movies or Series Title" autocomplete="off">
                                <input type="submit" class="btn btn-main btn-effect popup-with-zoom-anim fa fa-search searchenviar" id="boton-header" value="&#xf002"></input>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item m-auto">
                        <a href="#login-register-popup" class="btn btn-main btn-effect login-btn popup-with-zoom-anim">
                            <i class="icon-user"></i>login
                        </a>
                    </li>
                </ul>
                @endguest
                @auth
                <ul class="navbar-nav extra-nav nav-buscador" >
                    <li class="nav-item m-auto li-header">
                        <form id="search-form-1" action="{{url('search')}}" method="post" class="searchformcine">
                            @csrf
                            <div class="form-group">
                                <div class="desplegar">
                                    <a id="search-single-0">
                                        <div class="caja search-display-none" id="search-total-0">
                                            <div class="caratula"><img id="search-img-0"></div>
                                            <div class="titulo"><h6 id="search-title-0"></h6><p id="search-content-0"></p></div>
                                        </div>
                                    </a>
                                    <a id="search-single-1">
                                        <div class="caja search-display-none" id="search-total-1">
                                            <div class="caratula"><img id="search-img-1"></div>
                                            <div class="titulo"><h6 id="search-title-1"></h6><p id="search-content-1"></p></div>
                                        </div>
                                    </a>
                                    <a id="search-single-2">
                                        <div class="caja search-display-none" id="search-total-2">
                                            <div class="caratula"><img id="search-img-2"></div>
                                            <div class="titulo"><h6 id="search-title-2"></h6><p id="search-content-2"></p></div>
                                        </div>
                                    </a>
                                    <a id="search-single-3">
                                        <div class="caja search-display-none" id="search-total-3">
                                            <div class="caratula"><img id="search-img-3"></div>
                                            <div class="titulo"><h6 id="search-title-3"></h6><p id="search-content-3"></p></div>
                                        </div>
                                    </a>
                                    
                                </div>
                                <input name="search-keyword" type="text" id="search-keyword" value="@isset($query) {{$query}} @endisset" class="form-control buscador-header desplegable" placeholder="Enter Movies or Series Title" autocomplete="off">
                                <input type="submit" class="btn btn-main btn-effect popup-with-zoom-anim fa fa-search searchenviar" id="boton-header" value="&#xf002"></input>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item m-auto">
                        <a  class="btn btn-main btn-effect login-btn popup-with-zoom-anim boton-logout" id="logout">
                            <i class="icon-user" ></i>logout
                        </a>
                    </li>
                </ul>
                <form action="{{url('/logout')}}" method="post" id="formlogout">                            
                    @csrf
                </form>
                @endauth
            </div>
        </nav>
    </div>
</header>
                    @if(Session::has('alert'))
                <div id="alertfade" class="alert alert-{{ Session::get('alert')}} alert-dismissible fade show fixed-top" role="alert" style="z-index:9999; opacity:0">
                      {{Session::get('message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @endif
            <?php Session::forget('alert');Session::forget('message'); ?>
@yield('content')

<footer class="footer1 bg-dark">
<div class="footer-widget-area ptb100">
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="widget widget-about">
        <img src="{{ url('assets/img/logo-white.png') }}" alt="white logo" class="logo-white">
        <p class="nomargin">Welcome to Cinelist, check out the latest movie and tv shows. Feel free to login and find out all the features!</p>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="widget widget-links text-center">
        <h4 class="widget-title footer-padding">Useful links</h4>
        <ul class="general-listing lista-centrar">
            <li><a href="{{url('/')}}" class="a-lista-footer">Cinelist</a></li>
            @auth
            <li><a href="{{url('profile/' . Auth::user()->id )}}">Home</a></li>
            @endauth
            <li><a href="{{url('/')}}#pricing-section">Pricing</a></li>
            <li><a href="{{url('/')}}#upcoming-movies">Upcoming</a></li>
            <li><a href="{{url('/contact')}}">Contact</a></li>
        </ul>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="widget widget-social ">
        <h4 class="widget-title footer-padding">follow us</h4>
        <p>We mainly manage Twitter to guide our features but you can follow us here!.</p>
        <ul class="social-btns">
            <li>
                <a href="https://www.facebook.com/alfredo.cinelist.1" class="social-btn-roll facebook">
                    <div class="social-btn-roll-icons social-padding">
                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="https://twitter.com/Cinelist_En" class="social-btn-roll twitter">
                    <div class="social-btn-roll-icons social-padding">
                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/cinelist_en/" class="social-btn-roll instagram">
                    <div class="social-btn-roll-icons social-padding">
                        <i class="social-btn-roll-icon fa fa-instagram"></i>
                        <i class="social-btn-roll-icon fa fa-instagram"></i>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
</div>
</div>
</div>


<div class="footer-copyright-area ptb30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex">
                    <div class="copyright ml-auto">All Rights Reserved by <a href="{{url('/')}}">Cinelist</a>.</div>
                </div>
            </div>
        </div>
    </div>
</div>

</footer>

</div>

    <!--Login/register modal-->
<div id="login-register-popup" class="small-dialog zoom-anim-dialog mfp-hide">
    <div class="signin-wrapper">
        <div class="small-dialog-headline">
            <h4 class="text-center">Sign in</h4>
        </div>
        <div class="small-dialog-content">
            <form id="cariera_login" method="post" action="login">
                @csrf
                <p class="status"></p>
                <!--<div class="form-group">-->
                <!--    <label for="email">Username or Email *</label>-->
                <!--    <input type="email" class="form-control" id="email" name="email" placeholder="Your Username or Email *" />-->
                <!--</div>-->
                
                <div class="form-group">
                    <label for="email">Username or Email *</label>
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" 
                    name="email" value="{{ old('email') }}" required autofocus placeholder="Your Username or Email *">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                        
                        
                <!--<div class="form-group">-->
                <!--    <label for="password">Password *</label>-->
                <!--    <input type="password" class="form-control" id="password" name="password" placeholder="Your Password *" />-->
                <!--</div>-->
                
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                    name="password" value="{{ old('password') }}" required autocomplete="password" placeholder="Your Password *">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <div class="checkbox pad-bottom-10">
                        <input id="check1" type="checkbox" name="remember" value="yes">
                        <label for="check1">Keep me signed in</label>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <input type="submit" value="Sign in" class="btn btn-main btn-effect nomargin" />
                    <button type="button" id="twitter twitter-button" class="btn btn-main btn-effect nomargin" onclick="redirect()">Twitter Login</button>
                </div>
                
                
            </form>
            <div class="bottom-links">
                <span>
                    Not a member?
                    <a class="signUpClick">Sign up</a>
                </span>
                <a class="forgetPasswordClick pull-right">Forgot Password</a>
            </div>
        </div>
    </div>

    <div class="signup-wrapper">
        <div class="small-dialog-headline">
            <h4 class="text-center">Sign Up</h4>
        </div>
        <div class="small-dialog-content">
    
            <form id="cariera_registration" action="{{ url('/register') }}" method="POST" autocomplete="off">
                @csrf
                <p class="status"></p>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" id="name" class="form-control" type="text"  minlength="2" required pattern="[A-Za-z0-9]+" />
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" id="username" class="form-control" type="text" minlength="2" required pattern="[A-Za-z0-9]+"/>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" id="email-signup" class="form-control" type="email" required/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" id="password-signup" class="form-control" type="password" required />
                </div>
                <div class="form-group">
                    <label for="repeat-password">Repeat Password</label>
                    <input name="repeat-password" id="repeat-password" class="form-control" type="password" required/>
                </div>
                <input type="hidden" id="source" name="source" value="normal">
                <div class="form-group">
                    <input type="submit" class="btn btn-main btn-effect nomargin" value="Register" />
                </div>
            </form>
            <div class="bottom-links">
                <span>
                    Already have an account?
                    <a class="signInClick">Sign in</a>
                </span>
                <a class="forgetPasswordClick pull-right">Forgot Password</a>
            </div>
        </div>
    </div>

    <div class="forgetpassword-wrapper">
        <div class="small-dialog-headline">
            <h4 class="text-center">Forgotten Password</h4>
        </div>
        <div class="small-dialog-content">

            <form id="forget_pass_form" action="{{url('forgot')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="password">Email Address *</label>
                    <input type="email" name="email_forgot" class="form-control" id="email3" placeholder="Email Address *" />
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Get New Password" class="btn btn-main btn-effect nomargin" />
                </div>
            </form>

            <div class="bottom-links">
                <a class="cancelClick">Cancel</a>
            </div>
        </div>
    </div>
</div>
<!--Login/register modal end-->
<!--Modal edit profilepic-->
@auth
<div class="modal"  role="dialog" id="editprofilemodal">
  <div class="modal-dialog" role="alert">
    <div class="modal-content">
              
                <div class="small-dialog-headline">
                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    <h4 class="text-center">Edit profile</h4>
                       
                </div>
           
              
                      <div class="modal-body">
                                <form id="edit-profile" method="post" action="{{url('changeProfile')}}" enctype="multipart/form-data">
                                    @csrf
                                    <p class="status">Empty fields will not be edited</p>
                         
                                    <div class="form-group">
                                        <label for="name">Change name</label>
                                        <input id="name" type="text" name="name" class="form-control" placeholder="Change your name" value="{{ Auth::user()->name }}">
                                    </div>
                                    @if(Auth::user()->source == 'traditional')
                                        <div class="form-group">
                                            <label for="username">Change username</label>
                                            <input id="username" type="text" name="username" class="form-control" placeholder="Change your username" value="{{ Auth::user()->username }}">
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="backgroundpic">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" placeholder="Change your email" value="{{ Auth::user()->email }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="backgroundpic">Description</label>
                                        <textarea id="description" type="textarea" class="form-control" name="description" placeholder="Change your description" maxlength="300">{{ Auth::user()->description }}</textarea>
                                    </div>    
                                    
                                    <div class="form-group">
                                        <label for="profilepic">Profile pic</label>
                                        <input type="hidden" id="iduser" value="{{Auth::user()->id}}" name="iduser">
                                        <input id="profilepic" type="file" class="form-control" name="profilepic" placeholder="Change your profile pic" accept="image/*">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="backgroundpic">Background pic</label>
                                        <input id="backgroundpic" type="file" class="form-control" name="backgroundpic" placeholder="Change your background pic"  accept="image/*">
                                    </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-main btn-effect">Save changes</button>
                <button type="button" class="btn btn-main btn-effect" data-dismiss="modal">Close</button>
              </div>
                                </form>
                      </div>

    </div>
  </div>
</div>
<!--Modal edit profilepic-->
@endauth

    <div id="backtotop">
        <a href="#"></a>
    </div>


    <script src="{{ url('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.ajaxchimp.js') }}"></script>
    <script src="{{ url('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.mmenu.js') }}"></script>
    <script src="{{ url('assets/js/jquery.inview.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.countTo.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ url('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('assets/js/imgloaded.pkgd.min.js') }}"></script>
    <script src="{{ url('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ url('assets/js/headroom.js') }}"></script>
    <script src="{{ url('assets/js/custom.js') }}"></script>
    
    
    <script type="text/javascript" src="{{ url('assets/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/jquery.themepunch.revolution.min.js') }}"></script>
    
    <script type="text/javascript" src="{{ url('assets/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ url('assets/js/scripts.js') }}"></script>
    <script src="{{ url('assets/js/saveMedia.js') }}"></script>
</body>
</html>
