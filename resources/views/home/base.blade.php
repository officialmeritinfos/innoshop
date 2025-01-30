<!doctype html>
<html lang="zxx" >
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('home/css/bootstrap.min.css')}}">
    <!-- Animate Min CSS -->
    <link rel="stylesheet" href="{{asset('home/css/animate.min.css')}}">
    <!-- Line Awesome Min CSS -->
    <link rel="stylesheet" href="{{asset('home/css/line-awesome.min.css')}}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('home/fonts/flaticon.css')}}">
    <!-- Owl Carousel Min CSS -->
    <link rel="stylesheet" href="{{asset('home/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('home/css/owl.theme.default.min.css')}}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{asset('home/css/magnific-popup.css')}}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('home/css/nice-select.min.css')}}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{asset('home/css/slick.min.css')}}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('home/css/meanmenu.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('home/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('home/css/responsive.css')}}">

    <title>{{$pageName}} - {{$siteName}}</title>
    <!-- Favicon Link -->
    <link rel="icon" type="image/png" href="{{asset('home/images/'.$web->logo)}}">
    @stack('css')
    <style>
        .watkey {
            z-index: 9;
            position: fixed;
            bottom: 15px;
            left: 15px;
            padding: 4px;
            border: 1px solid #0d9f16;
            border-radius: 50%;
        }
    </style>
    <style>
        .best-deal-image {
            width: 100%; /* Ensures the image takes the full width of its container */
            height: 200px; /* Set a fixed height */
            object-fit: cover; /* Ensures the image maintains aspect ratio while filling the container */
            border-radius: 8px; /* Optional: adds rounded corners */
        }

    </style>

    <style>
        /* Custom CSS for the Float widget */
        .telegram-float-widget {
            position: fixed;
            left: 10px;
            /* Adjust the left positioning as needed */
            bottom: 10rem;
            /* Adjust the bottom positioning as needed */
            z-index: 9999;
        }

        .whatsapp-float-widget {
            position: fixed;
            left: 70px;
            /* Adjust the left positioning as needed */
            bottom: 10px;
            /* Adjust the bottom positioning as needed */
            z-index: 9999;
        }
    </style>
</head>
<body>
<!-- Pre Loader -->
<div class="preloader">
    <div class="d-table">
        <div class="d-table-cell">
            <img src="{{asset('home/images/preloder-img.png')}}" alt="Images">
        </div>
    </div>
</div>
<!-- End Pre Loader -->

<!-- Top Header Start -->
<div class="top-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8">
                <div class="top-header-right">

                    <div class="language-list">
                        <div id="google_translate_element"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Header End -->

<!-- Start Navbar Area -->
<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{asset('home/images/'.$web->logo)}}" alt="Logo">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{asset('home/images/'.$web->logo)}}" alt="Logo">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('search') }}" class="nav-link">
                                Search Product
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Categories
                                <i class="las la-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach(product_categories() as $category)
                                    <li class="nav-item">
                                        <a href="{{ route('products.category',['slug'=>$category->slug]) }}" class="nav-link">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('tracking')}}" class="nav-link">
                                Track My Order
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('contact')}}" class="nav-link">
                                Contact
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('terms')}}" class="nav-link">
                                Terms/Policy
                            </a>
                        </li>
                    </ul>

                    <div class="nav-side d-display">
                        <ul class="nav-side-item">
                            <li>
                                <a href="{{ route('carts') }}" class="cart-btn">
                                    <i class="flaticon-shopping-bag"></i>
                                    <span class="cart">{{cart_item_count()}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="side-nav-responsive">
        <div class="container">
            <div class="dot-menu">
                <div class="circle-inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>

            <div class="container">
                <div class="side-nav-inner">
                    <div class="side-nav justify-content-center align-items-center">
                        <div class="side-nav-item">
                            <ul class="nav-side-item">
                                <li>
                                    <a href="{{ route('carts') }}" class="cart-btn">
                                        <i class="flaticon-shopping-bag"></i>
                                        <span class="cart">{{cart_item_count()}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Navbar Area -->

<!-- Nav Bottom Area -->
<div class="nav-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="navbar-category">
                    <ul class="navbar-nav">
                        <li class="nav-item-link">
                            <a href="#" class="nav-link-item">
                                <i class="las la-bars"></i>
                                All Categories
                                <i class="las la-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach(product_categories() as $categ)
                                    <li class="nav-item-link">
                                        <a href="{{ route('products.category',['slug'=>$categ->slug]) }}" class="nav-link-item">
                                            {{$categ->name}}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-7">
                <div class="top-header-form">
                    <form class="nav-bottom-form" method="get" action="{{ route('search.result') }}">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="form-group search-form">
                                    <input type="text" class="form-control" placeholder="Search product by name" name="q"
                                           value="{{ request()->input('q') }}">
                                </div>
                            </div>

                            <div class="col-lg-1">
                                <button type="submit">
                                    <i class="flaticon-searching"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="nav-user">
                    <ul>
                        <li class="user-icon"><i class="lar la-user"></i></li>
                        @auth
                            <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Log In</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Nav Bottom Area End -->

@yield('content')

<!-- Footer Area -->
<footer class="footer-area footer-bg">
    <div class="container">
        <div class="footer-top pt-100 pb-70">
            <div class="row justify-content-end">
                <div class="col-lg-6 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{asset('home/images/'.$web->logo)}}" alt="Images">
                            </a>
                        </div>
                        <p>
                            {{ $siteName }} is the fastest e-commerce platform to buy all you will ever need, and have
                            them delivered to your doorstep in a matter of days.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="footer-widget pl-5">
                        <h3>Contact Us</h3>
                        <ul class="footer-address">
                            <li>
                                <i class="las la-map-marker"></i>
                                <div class="content">
                                    <h3>
                                        {!! $web->address !!}
                                    </h3>
                                    <span>Our Location</span>
                                </div>
                            </li>
                            @if($web->phone)
                                <li>
                                    <i class="las la-phone"></i>
                                    <div class="content">
                                        <h3><a href="tel:{{$web->phone}}">{{ $web->phone }}</a></h3>
                                        <span>Phone Number</span>
                                    </div>
                                </li>
                            @endif

                            <li>
                                <i class="lar la-envelope"></i>
                                <div class="content">
                                    <h3><a href="mailto:{{$web->email}}">{{ $web->email }}</a></h3>
                                    <span>Our Email</span>
                                </div>
                            </li>

                            <li>
                                <i class="las la-clock"></i>
                                <div class="content">
                                    <h3>9 AM - 5 PM (7 Days)</h3>
                                    <span>Open Hour</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="copy-right-area">
            <div class="copy-right-text">
                <p>
                    Copyright ©2021 - {{date('Y')}} {{$siteName}}. All Rights Reserved.</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->

<!-- Jquery Min JS -->
<script src="{{asset('home/js/jquery-3.5.1.slim.min.js')}}"></script>
<!-- Bootstrap Bundle Min JS -->
<script src="{{asset('home/js/bootstrap.bundle.min.js')}}"></script>
<!-- Owl Carousel Min JS -->
<script src="{{asset('home/js/owl.carousel.min.js')}}"></script>
<!-- Magnific Popup Min JS -->
<script src="{{asset('home/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Nice Select Min JS -->
<script src="{{asset('home/js/jquery.nice-select.min.js')}}"></script>
<!-- Wow Min JS -->
<script src="{{asset('home/js/wow.min.js')}}"></script>
<!-- Meanmenu JS -->
<script src="{{asset('home/js/meanmenu.js')}}"></script>
<!-- Slick JS -->
<script src="{{asset('home/js/slick.min.js')}}"></script>
<!-- Ajaxchimp Min JS -->
<script src="{{asset('home/js/jquery.ajaxchimp.min.js')}}"></script>
<!-- Form Validator Min JS -->
<script src="{{asset('home/js/form-validator.min.js')}}"></script>
<!-- Contact Form JS -->
<script src="{{asset('home/js/contact-form-script.js')}}"></script>
<!-- Jquery Ui Min JS -->
<script src="{{asset('home/js/jquery-ui.min.js')}}"></script>
<!-- Mixitup Min JS -->
<script src="{{asset('home/js/mixitup.min.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('home/js/custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script type="text/javascript">
    window.onload = function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@stack('js')
<script>
    $(document).ready(function () {
        $('#loadMoreBtn').on('click', function () {
            const btn = $(this);
            const nextPage = btn.data('next-page'); // Get the next page
            const url = btn.data('url'); // URL for pagination
            const spinner = $('#loadingSpinner');

            // Show spinner and disable button
            btn.hide();
            spinner.show();

            $.ajax({
                url: url,
                method: 'GET',
                data: { page: nextPage },
                success: function (response) {
                    if (response.trim().length > 0) {
                        $('#product-container').append(response); // Append new products
                        btn.data('next-page', nextPage + 1).show(); // Update to next page
                    } else {
                        btn.remove(); // No more products
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred while loading products.');
                },
                complete: function () {
                    spinner.hide();
                }
            });
        });
    });

</script>
<script>
    $(window).on('load', function () {
        $('.preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });
</script>
@include('noti_js')

<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = '6d7f6837f799bebdefc90d9c8a984455e2b8c640';
    window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);
</script>
<noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>
</body>
</html>
