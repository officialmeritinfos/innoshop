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
            @if (session('bank_message'))
                <div class="card my-4">
                    <div class="card-header bg-primary text-white">
                        <h5>Important Notice</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ session('bank_message') }}</p>
                        <p>
                            <strong>Next Steps:</strong>
                        <ul>
                            <li>Contact our support team for bank details.</li>
                            <li>Ensure you reference your order ID during payment.</li>
                            <li>Send proof of payment to our support email once completed.</li>
                        </ul>
                        </p>
                        <p>If you have any questions or need assistance, feel free to reach out to us via the <a href="{{ route('contact') }}" class="text-primary">Contact Us</a> page.</p>
                    </div>
                    <div class="card-footer text-muted">
                        Thank you for shopping with us.
                    </div>
                </div>
                {{ session()->forget('bank_message') }}
            @endif

        </div>
    </div>

@endsection
