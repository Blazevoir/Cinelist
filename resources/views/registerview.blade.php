





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
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .small-dialog-content {
            padding-top: 1px;
        }
        .formregisterview{
            margin-top:0px;
        }
        div.small-dialog {
            max-width:670px;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <main class="login-register-page" style="background-image: url( {{ url('assets/img/posters/movie-collection.jpg') }} )">
        <div class="container">
            <div class="small-dialog login-register">
                <div class="signin-wrapper">
                    <div class="small-dialog-headline">
                        <h4 class="text-center">You have been invited to Cinelist!</h4>
                    </div>
                    <div class="small-dialog-content">
                        <div class="formregisterview">
                            <form id="cariera_registration" action="{{url('/register')}}" method="post">
                                @csrf
                                <p class="status"></p>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" id="name" class="form-control" type="text" minlength="5" required pattern="[A-Za-z0-9]+" />
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input name="username" id="username" class="form-control" type="text" minlength="5" required pattern="[A-Za-z0-9]+" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" id="email" class="form-control" type="email" required/>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input name="password" id="password" class="form-control" type="password" />
                                </div>
                                <div class="form-group">
                                    <label for="repeat-password">Repeat Password</label>
                                    <input name="repeat-password" id="repeat-password" class="form-control" type="password" required/>
                                </div>
                                <input type="hidden" id="source" name="source" value="normal">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-main btn-white nomargin" value="Register" required/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="{{url('/')}}" class="text-white">Go to Cinelist</a>
            
            </div>
        </div>
    </main>
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
</body>
</html>
