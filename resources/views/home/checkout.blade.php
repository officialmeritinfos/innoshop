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

    <!-- Checkout Area -->
    <div class="checkout-area pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6">
                    <div class="checkout-form">
                        <div class="contact-form">
                            <h2>Billing Information</h2>
                            <form action="{{ route('checkout.process') }}" method="post">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Payment Method</label>
                                            <select class="form-control" name="payment_method">
                                                <option value="">Select an option to proceed</option>
                                                <option>Cash Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-bg-three">
                                            Proceed
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
