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


    <!-- Map Area -->
    <div class="map-area">
        <div class="container-fluid m-0 p-0">
           <iframe src="https://www.google.com/maps/embed?pb=!3m2!1sen!2sng!4v1738240328761!5m2!1sen!2sng!6m8!1m7!1sCuDqhKmyEJbeI40fyQ_4MQ!2m2!1d40.77313255401796!2d-73.9064873336389!3f38.05902199244463!4f29.202152211592562!5f0.7820865974627469" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <!-- Map Area End -->

@endsection
