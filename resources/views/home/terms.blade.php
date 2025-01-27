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

    <!-- Terms Conditions Area -->
    <div class="terms-conditions-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2> Terms & Conditions</h2>
            </div>
            <div class="row pt-45">
                <div class="col-lg-12">

                    <div class="single-content">
                        <!-- Introduction -->
                        <section class="mb-5">
                            <h2 class="h4 mb-3">Introduction</h2>
                            <p>Welcome to <strong>{{$siteName}}</strong>. These terms and conditions outline the rules and regulations for the use of our website and services. By accessing this website, we assume you accept these terms and conditions in full. Do not continue to use <strong>{{$siteName}}</strong>'s website if you do not accept all of the terms and conditions stated on this page.</p>
                        </section>

                        <!-- Use of Our Services -->
                        <section class="mb-5">
                            <h2 class="h4 mb-3">Use of Our Services</h2>
                            <p>You agree to use our services in compliance with all applicable laws, rules, and regulations. You are prohibited from using the site or its content:</p>
                            <ul>
                                <li>For any unlawful purpose.</li>
                                <li>To solicit others to perform or participate in any unlawful acts.</li>
                                <li>To infringe upon or violate our intellectual property rights or the intellectual property rights of others.</li>
                                <li>To harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate based on gender, religion, ethnicity, race, age, national origin, or disability.</li>
                            </ul>
                        </section>

                        <!-- Account Registration -->
                        <section class="mb-5">
                            <h2 class="h4 mb-3">Account Registration</h2>
                            <p>When you create an account with us, you must provide accurate and complete information. You are responsible for safeguarding the password that you use to access the service and for any activities or actions under your password.</p>
                        </section>


                        <!-- Payments and Refunds -->
                        <section class="mb-5">
                            <h2 class="h4 mb-3">Payments and Refunds</h2>
                            <p>All payments made on this website are subject to the following terms:</p>
                            <ul>
                                <li>Payments must be made in full before the delivery of services or products.</li>
                                <li>Refund requests will be considered on a case-by-case basis, and we reserve the right to deny any refund requests if we believe the services or products have been misused.</li>
                            </ul>
                        </section>

                        <!-- Limitation of Liability -->
                        <section class="mb-5">
                            <h2 class="h4 mb-3">Limitation of Liability</h2>
                            <p>Our liability is limited to the maximum extent permitted by applicable law. Under no circumstances shall we, our directors, employees, or affiliates be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues.</p>
                        </section>

                        <!-- Changes to Terms -->
                        <section class="mb-5">
                            <h2 class="h4 mb-3">Changes to Terms</h2>
                            <p>We reserve the right to update or modify these terms at any time without prior notice. By continuing to use our website after any changes, you agree to the updated terms and conditions.</p>
                        </section>

                        <!-- Contact Information -->
                        <section>
                            <h2 class="h4 mb-3">Contact Information</h2>
                            <p>If you have any questions about these Terms and Conditions, please contact us:</p>
                            <ul>
                                <li>Email: <a href="mailto:{{$web->email}}">{{$web->email}}</a></li>
                                @if($web->phone)
                                    <li>Phone: {{$web->phone}}</li>
                                @endif
                                <li>Address: {!! $web->address !!}</li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Terms Conditions Area End -->




@endsection
