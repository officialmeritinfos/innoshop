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
                <a href="{{ route('shop') }}" class="view-btn">View All</a>
            </div>

            <div id="product-container" class="row pt-45">
                @include('home.partials.product-card-inner', ['products' => $products])
            </div>

            <!-- Pagination Links -->
            @if ($products->currentPage() < $products->lastPage())
                <div class="text-center mt-4">
                    <button id="loadMoreBtn" class="btn btn-primary" data-next-page="{{ $products->currentPage() + 1 }}" data-url="{{ request()->url() }}">
                        Load More Products
                    </button>
                    <div id="loadingSpinner" class="mt-3" style="display: none;">
                        <span class="spinner-border text-primary"></span> Loading...
                    </div>
                </div>
            @endif

        </div>
    </div>


@endsection
