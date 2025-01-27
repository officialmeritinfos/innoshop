@extends('home.base')
@section('content')

    <!-- Inner Banner -->
    <div class="inner-banner">
        <div class="container">
            <div class="inner-title text-center">
                <h3>{{ $pageName }}</h3>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        <i class="las la-angle-right"></i>
                    </li>
                    <li>{{ $pageName }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- User Area -->
    <div class="user-area pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="user-img">
                        <img src="{{asset('home/images/user-img.jpg')}}" alt="Images">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="user-form">
                        <div class="contact-form">
                            <h2>Log In</h2>
                            <form class="user-form" method="post" action="{{route('auth.login')}}">
                                @include('templates.notification')
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required data-error="Please enter your Username or Email"
                                                   placeholder="Enter your username"
                                                   name="email" value="{{old('email')}}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="password" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 form-condition">
                                        <div class="agree-label">
                                            <input type="checkbox" id="chb1" name="remember">
                                            <label for="chb1">
                                                Remember Me <a class="forget" href="{{route('forgotPassword')}}">Forgot My Password?</a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 ">
                                        <button type="submit" class="default-btn btn-bg-three">
                                            Log In Now
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <p class="account-desc">
                                            Do not have an account?
                                            <a href="{{ route('register') }}">Create Account</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- User Area End -->

@endsection
