<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Plant Nest @if(auth()->user()) | {{auth()->user()->name}}@endif</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('web/img/core-img/favicon.ico')}}">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{asset('web/style.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    .classycloseIcon .cross-wrap{
        right: 20px !important
    }
    .breakpoint-on .classynav {
    padding-right: 25px;
    padding-top: 70px;
}
</style>
<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-circle"></div>
        <div class="preloader-img">
            <img src="{{asset('web/img/core-img/leaf.png')}}" alt="">
        </div>
    </div>
<style>
    /* .mfp-bg{
        display:none !important;
    }
    .mfp-preloader{
        display:none !important;
    }
    .mfp-container{
        display: none !important;
    }.mfp-wrap{
        display: none !important;
    } */
</style>

    @if($errors->has('Auth'))
        <input id="Auth" type="hidden" value="{{$errors->first('Auth')}}" >
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Authentication Error</h5>
                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button> -->
                            </div>
                            <div class="modal-body">
                                {{$errors->first('Auth')}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn alazea-btn ml-15" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                <script>
                    $(document).ready(function(){
                        $('#Auth').val(function(){
                            $('#exampleModalCenter1').modal('show');
                        })
                    })
                </script>
    @endif

    @if($errors->has('notAuth'))
        <input id="notAuth" type="hidden" value="{{$errors->first('notAuth')}}" >
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Authentication Error</h5>
                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button> -->
                            </div>
                            <div class="modal-body">
                                {{$errors->first('notAuth')}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn alazea-btn ml-15" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                <script>
                    $(document).ready(function(){
                        $('#notAuth').val(function(){
                            $('#exampleModalCenter').modal('show');
                        })
                    })
                </script>
    @endif
    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- ***** Top Header Area ***** -->
        <div class="top-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="top-header-content d-flex align-items-center justify-content-between">
                            <!-- Top Header Content -->
                            <div class="top-header-meta">
                                <a href="#" data-toggle="tooltip" data-placement="bottom" ><i class="fa fa-envelope-o" aria-hidden="true"></i> <span>Email: {{$comp->email}}</span></a>
                                <a href="#" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-phone" aria-hidden="true"></i> <span>Call Us: {{$comp->phone}}</span></a>
                            </div>

                            <!-- Top Header Content -->
                            <div class="top-header-meta d-flex">
                                <!-- Login -->
                                @if(!auth()->user())
                                <div class="login">
                                    <a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> <span>Login</span></a>
                                </div>

                                <div class="login">
                                    <a href="{{ route('register') }}"><i class="fa fa-users" aria-hidden="true"></i> <span>Register</span></a>
                                </div>
                                @endif
                                @if(auth()->user())
                                    @if(auth()->user()->is_admin == 0)
                                    <div class="login">
                                        <a href="{{ route('userProfile',auth()->user()->id) }}" ><i class="fa fa-user" aria-hidden="true"></i> <span>Profile</span></a>
                                    </div>
                                    @endif
                                <div class="login">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @endif
                                    <!-- Cart -->
                                <div class="cart">
                                    <a href="{{ route('cart') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Cart <span class="cart-quantity">( {{$cart_count}} )</span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ***** Navbar Area ***** -->
        <div class="alazea-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="alazeaNav">

                        <!-- Nav Brand -->
                        <a href="{{ route('home') }}" class="nav-brand"><img width="180" src="{{asset('web/img/core-img/plant-nest1.png')}}" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
<style>
    .active{
        color:  #70c745 !important;
    }
</style>
<!-- Navbar Start -->
                            <div class="classynav">
                                <ul>
                                    <li ><a class="{{ Request::is('home') ? 'active' : '' }}" href="{{route('home')}}">Home</a></li>
                                    <li><a class="{{ Request::is('about') ? 'active' : '' }}"  href="{{route('about')}}">About</a></li>
                                    <li><a href="#">Shop</a>
                                        <ul class="dropdown">
                                            <li><a class="{{ Request::is('shop-plants') ? 'active' : '' }}" href="{{route('shop.plants')}}">Plants</a></li>
                                            <li><a class="{{ Request::is('shop-tools') ? 'active' : '' }}" href="{{route('shop.tools')}}">Tools & Accessories</a></li>
                                            <!-- <li><a href="shop.html">Shop</a>
                                                <ul class="dropdown">
                                                    <li><a href="shop.html">Shop</a></li>
                                                    <li><a href="shop-details.html">Shop Details</a></li>
                                                    <li><a href="cart.html">Shopping Cart</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="portfolio.html">Portfolio</a>
                                                <ul class="dropdown">
                                                    <li><a href="portfolio.html">Portfolio</a></li>
                                                    <li><a href="single-portfolio.html">Portfolio Details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="blog.html">Blog</a>
                                                <ul class="dropdown">
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="single-post.html">Blog Details</a></li>
                                                </ul>
                                            </li> -->
                                            <li><a class="{{ Request::is('cart') ? 'active' : '' }}" href="{{ route('cart') }}">Shopping Cart</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="{{ Request::is('portfolio') ? 'active' : '' }}" href="{{route('portfolio')}}">Portfolio</a></li>
                                    <li><a class="{{ Request::is('contact') ? 'active' : '' }}" href="{{route('contact')}}">Contact</a></li>
                                </ul>

                                <!-- Search Icon -->
                                <div id="searchIcon">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>

                            </div>
                            <!-- Navbar End -->
                        </div>
                    </nav>

                    <!-- Search Form -->
                    <div class="search-form">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type keywords">
                            <button type="submit" class="d-none"></button>
                            <div style="max-height: 300px; overflow-y: auto;" class="text-center mt-2" id="search-results">

                            </div>
                        </form>
                        <!-- Close Icon -->
                        <div class="closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->








    @yield('content')









    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area bg-img" style="background-image: url({{asset('web/img/bg-img/3.jpg')}});">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row">

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <div class="footer-logo mb-30">
                                <a href="#"><img width="150" src="{{asset('web/img/core-img/plant-nest1.png')}}" alt=""></a>
                            </div>
                            <p>Plant Nest: Cultivate serenity and beauty in your space through our innovative plant-focused web application.</p>
                            <div class="social-info">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <div class="widget-title">
                                <h5>QUICK LINK</h5>
                            </div>
                            <nav class="widget-nav">
                                <ul>
                                    <li><a href="#">Purchase</a></li>
                                    <li><a href="#">FAQs</a></li>
                                    <li><a href="#">Payment</a></li>
                                    <li><a href="#">News</a></li>
                                    <li><a href="#">Return</a></li>
                                    <li><a href="#">Advertise</a></li>
                                    <li><a href="#">Shipping</a></li>
                                    <li><a href="#">Career</a></li>
                                    <li><a href="#">Orders</a></li>
                                    <li><a href="#">Policities</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <div class="widget-title">
                                <h5>BEST SELLER</h5>
                            </div>

                            <!-- Single Best Seller Products -->
                            <div class="single-best-seller-product d-flex align-items-center">
                                <div class="product-thumbnail">
                                    <a href="shop-details.html"><img src="{{asset('web/img/bg-img/4.jpg')}}" alt=""></a>
                                </div>
                                <div class="product-info">
                                    <a href="shop-details.html">Cactus Flower</a>
                                    <p>$10.99</p>
                                </div>
                            </div>

                            <!-- Single Best Seller Products -->
                            <div class="single-best-seller-product d-flex align-items-center">
                                <div class="product-thumbnail">
                                    <a href="shop-details.html"><img src="{{asset('web/img/bg-img/5.jpg')}}" alt=""></a>
                                </div>
                                <div class="product-info">
                                    <a href="shop-details.html">Tulip Flower</a>
                                    <p>$11.99</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <div class="widget-title">
                                <h5>CONTACT</h5>
                            </div>

                            <div class="contact-information">
                                <p><span>Address:</span> {{$comp->address}}</p>
                                <p><span>Phone:</span> {{$comp->phone}}</p>
                                <p><span>Email:</span> {{$comp->email}}</p>
                                <p><span>Open hours:</span> {{$comp->open_hours}}</p>
                                <p><span>Happy hours:</span> {{$comp->happy_hours}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom Area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="border-line"></div>
                    </div>
                    <!-- Copywrite Text -->
                    <div class="col-12 col-md-6">
                        <div class="copywrite-text">
                            <p> <a style="cursor:pointer;" >Made By Sarim Khan</a></p>
                        </div>
                    </div>
                    <!-- Footer Nav -->
                    <div class="col-12 col-md-6">
                        <div class="footer-nav">
                            <nav>
                                <ul>
                                    <li><a href="{{route('home')}}">Home</a></li>
                                    <li><a href="{{route('contact')}}">About</a></li>
                                    {{-- <li><a href="#">Service</a></li> --}}
                                    <li><a href="{{route('portfolio')}}">Portfolio</a></li>
                                    {{-- <li><a href="{{route('home')}}">Blog</a></li> --}}
                                    <li><a href="{{route('contact')}}">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                let searchQuery = $('#search').val();

                $.ajax({
                    url: '/search', // Replace with your route URL
                    method: 'GET',
                    data: { query: searchQuery },
                    success: function(data) {
                        $('#search-results').html(data);
                    }
                });
            });
        });
    </script>

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{asset('web/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('web/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('web/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{asset('web/js/plugins/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('web/js/active.js')}}"></script>
</body>

</html>
