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
                            <form class="user-form" method="post" action="{{route('auth.register')}}" >
                                @include('templates.notification')
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required data-error="Please enter your Name"
                                                   placeholder="Enter your name"
                                                   value="{{old('name')}}" name="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required data-error="Please enter your Username "
                                                   placeholder="Enter your username"
                                                   name="username" value="{{old('username')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="email" class="form-control" required data-error="Please enter your Email"
                                                   placeholder="Enter your email"
                                                   name="email" value="{{old('email')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required data-error="Please enter your Phone"
                                                   placeholder="Enter your Phone"
                                                   name="phone" value="{{old('phone')}}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control" type="password"name="password_confirmation"
                                                   placeholder="Repeat your password">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required data-error="Please enter your Phone"
                                                   placeholder="Enter your Country Name"
                                                   name="country" value="{{old('country')}}">
                                        </div>
                                    </div>




                                    <div class="col-lg-12 mt-3">
                                        <div class="form-group">
                                            <label>Street Address</label>
                                            <textarea type="text" class="form-control" name="address"
                                                      rows="5" placeholder="Delivery Address"></textarea>
                                        </div>
                                    </div>



                                    <div class="col-lg-12 ">
                                        <button type="submit" class="default-btn btn-bg-three">
                                            Register Now
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <p class="account-desc">
                                            Already have an account?
                                            <a href="{{ route('login') }}l">Login</a>
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
