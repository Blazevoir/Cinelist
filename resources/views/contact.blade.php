@extends('header2')
@section('content')



<section class="page-header overlay-gradient" style="background: url('{{ url('assets/img/posters/movie-collection.jpg') }}');">
    <div class="container">
        <div class="inner">
            <h2 class="title">Contact Us</h2>
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Cinelist</a></li>
                <li>Contact Us</li>
            </ol>
        </div>
    </div>
</section>


<main class="contact-page ptb100">
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <h3 class="title">Info</h3>
                <div class="details-wrapper">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                    <ul class="contact-details">
                        <li><i class="icon-phone"></i><strong>Phone:</strong><span>(+34) 954-589 </span></li>
                        <li><i class="icon-phone"></i><strong>Phone2:</strong><span>(+34) 954-589 </span></li>
                        <li><i class="icon-globe"></i><strong>Web:</strong><span><a href="#">www.cinelist.com</a></span></li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><strong>E-Mail:</strong><span><a href="#"><span class="__cf_email__" data-cfemail="650c0b030a25080a130c031c4b060a08">[email&#160;protected]</span></a></span></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-8 col-sm-12">
                @if(Session::has('alert'))
                <div id="alertfade" class="alert alert-{{ Session::get('alert')}} alert-dismissible fade show" role="alert" style="z-index:9999; opacity:0">
                      {{Session::get('message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                <?php Session::forget('alert');Session::forget('message'); ?>
                <h3 class="title">Contact Form</h3>
                <form  action="{{url('contact/form')}}" method="post">
                    @csrf
                    <div id="contact-result"></div>
                    
                    <div class="form-group">
                        <input class="form-control input-box" type="text" name="name" placeholder="Your Name" autocomplete="off" minlength="2" required pattern="[A-Za-z0-9]+" >
                    </div>
                    
                    <div class="form-group">
                        <input class="form-control input-box" type="email" name="email" placeholder="your-email@movify.com" autocomplete="off" required >
                    </div>
                    
                    <div class="form-group">
                        <input class="form-control input-box" type="text" name="subject" placeholder="Subject" autocomplete="off" required>
                    </div>
                    
                    <div class="form-group mb20">
                        <textarea class="form-control textarea-box" rows="8" name="message" placeholder="Type your message..." required ></textarea>
                    </div>

                    <div class="form-group text-center">
                        <input class="btn btn-main btn-effect" type="submit" value="Send Message">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>



<section class="how-it-works bg-light ptb100">
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="title">How it works?</h2>
                <h6 class="subtitle">We will show you step by step how to start watching your favorite movies & tv shows starting now!</h6>
            </div>
        </div>
        
        <div class="timeline">
            <span class="main-line"></span>
            
            <div class="timeline-step row">
                <span class="timeline-step-btn">Step 1</span>
                <div class="col-md-6 col-sm-12 timeline-text-wrapper">
                    <div class="timeline-text">
                        <h3>Create an account</h3>
                        <p>You can use Cinelist for free but the membership experience only gets better! Discover new tv shows or movies that your friends like or share social media content in your prefered sites!.</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 timeline-image-wrapper">
                    <div class="timeline-image">
                        <img src="{{url('assets/img/other/signup.png')}}" alt="">
                    </div>
                </div>
            </div>
            
            
            <div class="timeline-step row">
                <span class="timeline-step-btn" style="color: #2a7bc2; background: #c1ddf5;">Step 2</span>
                <div class="col-md-6 col-sm-12 timeline-image-wrapper">
                    <div class="timeline-image">
                        <img src="{{url('assets/img/other/pricing.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 timeline-text-wrapper">
                    <div class="timeline-text-right">
                        <h3>Choose your Plan</h3>
                        <p>Start using Cinelist the way better fits to you! Share social as free content or take Netflix or Cinematic Pack and enjoy all the media! Its up to you!.</p>
                    </div>
                </div>
            </div>
            
            
            <div class="timeline-step row">
                <span class="timeline-step-btn" style="color: #eb305f; background: #f9c8d4;">Step 3</span>
                <div class="col-md-6 col-sm-12 timeline-text-wrapper">
                    <div class="timeline-text">
                        <h3>Enjoy Cinelist</h3>
                        <p>The best part about have Cinelist account is that you can share with your friends every movie or show and make list that allow you to dont forget anything in the future!.</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 timeline-image-wrapper">
                    <div class="timeline-image">
                        <img src="{{url('assets/img/other/enjoy-movify.png')}}" alt="">
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

@endsection