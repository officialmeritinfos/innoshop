@extends('home.base')
@section('content')
    @inject('injected','App\Defaults\Custom')
    <!-- Start Page-title Area -->
    <div class="page-title-area bg-black">
        <div class="container">
            <div class="page-title-content">
                <h2>{{$pageName}}</h2>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>{{$pageName}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page-title Area -->

    <!-- Start Services Details Area -->
    <div class="services-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="services-details-desc">
                        <h3>{{$service->title}}</h3>
                        <p>{{$service->short}}</p>
                        <img src="{{asset('home/serv/'.$service->photo)}}" alt="image">
                        <p>
                            {!! str_replace('MYSITE',$siteName,$service->content) !!}
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </div>


    @if($service->id ==2)
        <div class="container-fluid">
            <h3 class="text-center">Real Estate properties</h3>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($injected->getEstates() as $key => $estate)
                    <div class="col">
                        <div class="card">
                            <img src="{{asset('home/estate/'.$estate->photo)}}" class="card-img-top"
                                 alt="Hollywood Sign on The Hill"/>
                            <div class="card-body">
                                <h5 class="card-title">${{number_format($estate->price,2)}}</h5>
                                <p class="card-text">
                                    {{$estate->description}}
                                </p>
                                <a href="mailto:{{$web->email}}" class="btn btn-primary">
                                    Make an Offer
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

@endsection
