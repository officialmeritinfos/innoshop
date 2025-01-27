@extends('home.base')
@section('content')

    <!-- Banner Area -->
    <div class="banner-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner-slider owl-carousel owl-theme">
                        <div class="banner-item">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-sm-5">
                                    <div class="content">
                                        <span>Unleash Innovation</span>
                                        <h1>Discover Premium Tech at Unbeatable Prices</h1>
                                        <p>Where cutting-edge technology meets affordability.</p>
                                        <a href="{{ route('shop') }}" class="default-btn border-radius-5">Shop Now</a>
                                    </div>
                                </div>

                                <div class="col-lg-7 col-sm-7">
                                    <div class="banner-img">
                                        <img src="{{asset('home/images/home-one/home-one-img1.png')}}" alt="Cutting-edge Technology">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="banner-item">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-sm-5">
                                    <div class="content">
                                        <span>Exclusive Deals</span>
                                        <h1>Experience Innovation Without Breaking the Bank</h1>
                                        <p>Premium gadgets designed for your comfort and style.</p>
                                        <a href="{{ route('shop') }}" class="default-btn border-radius-5">Shop Now</a>
                                    </div>
                                </div>

                                <div class="col-lg-7 col-sm-7">
                                    <div class="banner-img">
                                        <img src="{{asset('home/images/home-one/home-one-img2.png')}}" alt="Affordable Innovation">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="banner-item">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-sm-5">
                                    <div class="content">
                                        <span>Shop Smart</span>
                                        <h1>Save More with Exclusive Discounts</h1>
                                        <p>Upgrade your tech game without compromising on value.</p>
                                        <a href="{{ route('shop') }}" class="default-btn border-radius-5">Shop Now</a>
                                    </div>
                                </div>

                                <div class="col-lg-7 col-sm-7">
                                    <div class="banner-img">
                                        <img src="{{asset('home/images/home-one/home-one-img3.png')}}" alt="Exclusive Discounts">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="banner-shape">
            <img src="{{asset('home/images/home-one/home-bg-shape.png')}}" alt="Images">
        </div>
    </div>
    <!-- Banner Area End -->

    <!-- Page Inner -->
    <div class="page-inner pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-inner-item">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-sm-6">
                                <div class="content">
                                    <h3>Sony PlayStation Vr Refurbished </h3>
                                    <span>$1200.00</span>
                                    <a href="{{ route('shop') }}" class="default-btn border-radius-5">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="page-inner-img">
                                    <img src="{{asset('home/images/page-inner-img/page-inner-img-1.png')}}" alt="Images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="page-inner-item-2">
                        <div class="row align-items-center">
                            <div class="col-lg-7 col-sm-7">
                                <div class="content">
                                    <h3>Apple New Smart Watch</h3>
                                    <span><del>$1200.00</del> $500</span>
                                    <a href="{{ route('shop') }}" class="default-btn border-radius-5">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-5">
                                <div class="page-inner-img">
                                    <img src="{{asset('home/images/page-inner-img/page-inner-img-2.png')}}" alt="Images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Inner End -->

    <!-- Best Deal Area -->
    <div class="best-deal-area pb-70">
        <div class="container">
            <div class="section-title">
                <h2>Best Deal</h2>
                <a href="{{ route('shop') }}" class="view-btn">View All</a>
            </div>

            <div class="row pt-45">
                @foreach(best_deals(8) as $product)
                    <div class="col-lg-3 col-sm-6">
                        <div class="best-deal-card">
                            <div class="best-deal-img">
                                <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                                    <img src="{{ asset('storage/' . $product->featured_image) }}"
                                         alt="{{ $product->name }}"
                                         class="best-deal-image">

                                </a>
                                <i class="las la-heart"></i>
                            </div>

                            <div class="content">
                                <h3><a href="{{ route('product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h3>
                                <div class="rating-tag">
                                    <i class="las la-star"></i>
                                    ({{ number_format($product->rating ?? 0, 1) }})
                                </div>
                                <p>{{ $product->short_description }}</p>
                                <span>${{ number_format($product->discount_price, 2) }}</span>
                                <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="add-card"><i class="las la-plus"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </div>
    <!-- Best Deal Area End -->

    <!-- Category Area -->
    <div class="category-area pb-70">
        <div class="container-fluid">
            <div class="container-max">
                <div class="container category-list">
                    <div class="row justify-content-center">
                        @foreach(product_categories() as $cate)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <a href="{{ route('products.category', ['slug' => $cate->slug]) }}" class="text-decoration-none">
                                    <div class="card h-100 shadow-sm border-0">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-dark font-weight-bold">{{ $cate->name }}</h5>
                                            <p class="card-text text-muted">
                                                {{  'Explore our wide range of products in this category.' }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Category Area End -->


    <div class="all-product-area pb-70">
        <div class="container">
            <div class="all-product-title">
                <h2>All Products</h2>
            </div>

            <!-- Container for products -->
            <div id="product-container" class="row pt-45">
                @include('home.partials.product-card', ['products' => $products])
            </div>

            <!-- Pagination Links -->
            <div class="text-center mt-4">
                <button id="loadMoreBtn" class="btn btn-primary" data-next-page="{{ $products->currentPage() + 1 }}" data-url="{{ route('home') }}">
                    Load More Products
                </button>
                <div id="loadingSpinner" class="mt-3" style="display: none;">
                    <span class="spinner-border text-primary"></span> Loading...
                </div>
            </div>
        </div>
    </div>



    <!-- Latest Product Area -->
    <div class="latest-product-area">
        <div class="latest-product-slider owl-carousel owl-theme">
            @foreach (latest_products() as $product)
                <div class="latest-product-item">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-7 col-sm-7">
                                <div class="latest-product-img">
                                    <img src="{{ asset('storage/' . $product->featured_image) }}" alt="Images">
                                </div>
                            </div>

                            <div class="col-lg-5 col-sm-5">
                                <div class="latest-product-content">
                                    <span>Latest Best Product</span>
                                    <h2>{{ $product->name }}</h2>
                                    <p>{{ Str::limit($product->description, 100, '...') }}</p>
                                    <a href="{{ route('cart.add',['id'=>$product->id]) }}" class="default-btn border-radius-5 default-btn-border">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="latest-product-shape">
            <img src="{{asset('home/images/latest-product/latest-product-shape.png')}}" alt="Images">
        </div>
    </div>
    <!-- Latest Product Area End -->

    <!-- Choose Area -->
    <div class="choose-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="choose-card">
                        <i class="flaticon-review"></i>
                        <h3>100% Satisfaction</h3>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="choose-card">
                        <i class="flaticon-shipped"></i>
                        <h3>Fast Shipment</h3>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="choose-card">
                        <i class="flaticon-money"></i>
                        <h3>30 Days Money Back</h3>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="choose-card">
                        <i class="flaticon-offer"></i>
                        <h3>Special Offer & Discount</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Choose Area End -->


@endsection
