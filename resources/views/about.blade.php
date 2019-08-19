
<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ORC About</title>
        <link rel="icon" href="{{asset('public-part/img/logos/logo_transparent.png')}}">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('public-part/css/bootstrap.min.css')}}">
        <!-- animate CSS -->
        <link rel="stylesheet" href="{{asset('public-part/css/animate.css')}}">
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="{{asset('public-part/css/owl.carousel.min.css')}}">
        <!-- themify CSS -->
        <link rel="stylesheet" href="{{asset('public-part/css/themify-icons.css')}}">
        <!-- flaticon CSS -->
        <link rel="stylesheet" href="{{asset('public-part/css/flaticon.css')}}">
        <!-- magnific popup CSS -->
        <link rel="stylesheet" href="{{asset('public-part/css/magnific-popup.css')}}">
        <!-- nice select CSS -->
        <link rel="stylesheet" href="{{asset('public-part/css/nice-select.css')}}">
        <!-- swiper CSS -->
        <link rel="stylesheet" href="{{asset('public-part/css/slick.css')}}">
        <!-- style CSS -->
        <link rel="stylesheet" href="{{asset('public-part/css/style_about.css')}}">
    </head>

    <body>
        <!--::header part start::-->
        <header class="main_menu home_menu">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="{{route('index')}}"> <img class="col-sm-3" src="{{asset('public-part/img/logos/logo_transparent.png')}}" alt="logo"> </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse main-menu-item justify-content-end"
                                 id="navbarSupportedContent">
                                <ul class="navbar-nav align-items-center">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{route('index')}}">Home</a>
                                    </li>


                                    @if (Route::has('login'))

                                    @auth
                                    @hasrole('admin')
                                    <a class="btn_1" href="{{ route('admin.index') }}">Dashboard</a>
                                    @endhasrole
                                    @hasrole('user')
                                    <a class="btn_1" href="{{ route('user.index') }}">Dashboard</a>
                                    @endhasrole                        
                                    @else
                                    <a class="btn_1" href="{{ route('login') }}">Login</a>

                                    @if (Route::has('register'))
                                    <a class="btn_1" href="{{ route('register') }}">Register</a>
                                    @endif
                                    @endauth

                                    @endif




                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header part end-->

        <!-- banner part start-->
        <section class="banner_part">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-xl-6">
                        <div class="banner_text">
                            <div class="banner_text_iner">
                                <h1>About us</h1>
                                <p>We are three students of Computer Engineering at Università
                                    degli studi of Brescia in Italy. This is our project for the
                                    course of Programmazione Web.</p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner part start-->

        <!-- feature_part start-->
        <section class="feature_part ">
            <div class="container">
                <div class="row">
                    <!--<div class="col-xl-4 col-md-4 align-self-center">
                        <div class="single_feature_text ">
                            <h2>What kind of 
                                Stimulation?
                            </h2>
                            <p>The Sensorial Analysis is a very complecated process that involves
                                one or more senses. The idea is to stimulate one of these senses throught
                                sounds, smells and tastes to valuate our own intensity of the experience.</p>
                           
                        </div>
                    </div> -->


                    <div class="col-lg-12 col-md-12">
                        <div class="feature_item">
                            <h1>Who are we?</h1>
                            <br>
                            <br>                            
                            <div class="row">

                                <div class="col-lg-4 col-sm-4">
                                    
                                    <div class="single_feature">
                                        <div class="single_feature_part">
                                            <span class="circle">
                                                <img  class="circle" src="{{asset('public-part/img/doctor/fcastel.jpg')}}"
                                                      alt="">
                                            </span>
                                            <h4>Federico Castelnovo</h4>
                                            <p>Piccola frase per descriverti</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="single_feature">
                                        <div class="single_feature_part">
                                            <span class="rounded">
                                                <img src="{{asset('public-part/img/doctor/fnico.jpg')}}"
                                                     alt="">
                                            </span>
                                            <h4>Nicholas Onger</h4>
                                            <p>Piccola frase per descriverti</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="single_feature">
                                        <div class="single_feature_part">
                                            <span class="single_feature_icon">
                                                <img src="{{asset('public-part/img/doctor/frock.jpg')}}"
                                                     alt="">
                                            </span>
                                            <h4>Matteo Rocco</h4>
                                            <p>I'm a normal student and a big NBA fan. I like pizza
                                                and nutella.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- feature_part start-->

        <!-- our_ability part start-->
        <section class="our_ability section_padding">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-3 col-lg-3 ">

                        <div class="single_blog_img">
                            <img src="{{asset('public-part/img/doctor/castel.jpg')}}" alt="doctor">

                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7">
                        <div class="our_ability_member_text">
                            <h2>DR Federico Castelnovo</h2>
                            <p>He is a very good guy and a very funny friends. He like to study
                                and when he does this obtains a very good results. He always fights with Luana
                                and sometimes he gets angry with her and do the "preso male".</p>

                        </div>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-7 col-lg-7">
                        <div class="our_ability_member_text">
                            <h2>DR Nicholas Onger</h2>
                            <p>He is a very quiet guy but a very loyal friend. He likes to play basketball 
                                and he is a very good one. His secret weapon is the unstoppable "jump-hook". No one 
                                knows but he is secretly in love with Lebron James.</p>

                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 ">

                        <div class="single_blog_img">
                            <img src="{{asset('public-part/img/doctor/nico.jpg')}}" alt="doctor">

                        </div>
                    </div>

                </div>
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-3 col-lg-3 ">

                        <div class="single_blog_img">
                            <img src="{{asset('public-part/img/doctor/rock.jpg')}}" alt="doctor">

                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7">
                        <div class="our_ability_member_text">
                            <h2>DR Matteo Rocco</h2>
                            <p>He is a very entusiastic guy and when he has his day a very moody one. He is a lifetime
                                kobe fan and always beats Nicholas at Dunkest. Retired basketball player but in his latest season
                                he won the trophy of "Seconda divisione bergamasca".</p>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- our_ability part end-->





        <!-- footer part start-->
        <footer class="footer-area">


            <div class="copyright_part">
                <div class="container">
                    <div class="row align-items-center">
                        <p class="footer-text m-0 col-lg-8 col-md-12">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="{{asset('index')}}" target="_blank">ORC</a>
                        </p>
                        <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
                            <a href="#"><i class="ti-facebook"></i></a>
                            <a href="#"> <i class="ti-twitter"></i> </a>
                            <a href="#"><i class="ti-instagram"></i></a>
                            <a href="#"><i class="ti-skype"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- jquery plugins here-->

        <script src="{{asset('public-part/js/jquery-1.12.1.min.js')}}"></script>
        <!-- popper js -->
        <script src="{{asset('public-part/js/popper.min.js')}}"></script>
        <!-- bootstrap js -->
        <script src="{{asset('public-part/js/bootstrap.min.js')}}"></script>
        <!-- easing js -->
        <script src="{{asset('public-part/js/jquery.magnific-popup.js')}}"></script>
        <!-- swiper js -->
        <script src="{{asset('public-part/js/swiper.min.js')}}"></script>
        <!-- swiper js -->
        <script src="{{asset('public-part/js/masonry.pkgd.js')}}"></script>
        <!-- particles js -->
        <script src="{{asset('public-part/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('public-part/js/jquery.nice-select.min.js')}}"></script>
        <!-- swiper js -->
        <script src="{{asset('public-part/js/slick.min.js')}}"></script>
        <script src="{{asset('public-part/js/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('public-part/js/waypoints.min.js')}}"></script>
        <!-- contact js -->
        <script src="{{asset('public-part/js/jquery.ajaxchimp.min.js')}}"></script>
        <script src="{{asset('public-part/js/jquery.form.js')}}"></script>
        <script src="{{asset('public-part/js/jquery.validate.min.js')}}"></script>
        <script src="{{asset('public-part/js/mail-script.js')}}"></script>
        <script src="{{asset('public-part/js/contact.js')}}"></script>
        <!-- custom js -->
        <script src="{{asset('public-part/js/custom.js')}}"></script>
    </body>

</html>