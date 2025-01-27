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

    <div class="bakery-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>{{$pageName}}</h2>
            </div>

           <div class="mt-5">
               <form class="nav-bottom-form" method="get" action="{{ route('search.result') }}">
                   <div class="row">
                       <div class="col-lg-8">
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
    </div>



@endsection
