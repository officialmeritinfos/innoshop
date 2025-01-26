@extends('user.base')
@section('content')
@inject('injected','App\Defaults\Custom')




    <div class="today-card-area pt-24" style="margin-top:-3rem;">
        <div class="container-fluid">
            @include('templates.notification')

            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-today-card d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="today">Account Balance</span>
                            <h6>${{number_format($user->profit,2)}}</h6>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <img src="{{asset('dashboard/user/images/icon/user.png')}}" alt="Images">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
