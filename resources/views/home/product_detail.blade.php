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


    <!-- Shop Details Area -->
    <div class="shop-details-area pt-100 pb-70">
        <div class="container">
            <div class="shop-details-desc">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="shop-details-image">
                            <ul class="shop-details-image-slides">
                                @if ($product->images)
                                    @foreach (json_decode($product->images) as $image)
                                        <li>
                                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}">
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="slick-thumbs">
                                <ul class="shop-details-image-slides">
                                    @if ($product->images)
                                        @foreach (json_decode($product->images) as $image)
                                            <li>
                                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}">
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="shop-desc-content">
                            <span>{{ $product->category->name ?? 'Category Unavailable' }}</span>
                            <h3>{{ $product->name }}</h3>
                            <div class="shop-desc-list">
                                <div class="shop-desc-review">
                                    <div class="rating">
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star-half-alt"></i>
                                    </div>
                                    <a href="#" class="rating-count">No Ratings</a>
                                </div>
                            </div>
                            <div class="brand-name">
                                <span class="brand-text">Brand: <b>{{ $product->attributes->brand ?? 'Unknown' }}</b></span>
                                <span class="brand-text">Color: <b>{{ $product->attributes->color ?? 'Varied' }}</b></span>
                            </div>
                            <ul class="shop-desc-content-list">
                                <li>SKU: {{ $product->sku }}</li>
                                <li>Weight: {{ $product->weight ?? 'N/A' }} grams</li>
                                <li>Dimensions:
                                    {{ $product->length ?? 'N/A' }} x {{ $product->width ?? 'N/A' }} x {{ $product->height ?? 'N/A' }} cm
                                </li>
                                <li>Tax: {{ $product->tax ?? 0 }}%</li>
                                <li>Stock: {{ $product->stock}}</li>
                            </ul>
                            <h4>
                                ${{ number_format($product->discount_price ?? $product->price, 2) }}
                                @if ($product->discount_price)
                                    <span class="text-muted"><del>${{ number_format($product->price, 2) }}</del></span>
                                @endif
                            </h4>

                            <div class="input-count-area">
                                <h3>Quantity</h3>
                                <div class="input-counter">
                                    <span class="minus-btn"><i class="las la-minus"></i></span>
                                    <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}">
                                    <span class="plus-btn"><i class="las la-plus"></i></span>
                                </div>
                            </div>

                            <div class="shop-add-btn">
                                <button id="addToCart" class="default-btn border-radius-5"
                                        data-url="{{ route('cart.add', $product->id) }}">
                                    Add To Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Details Area End -->

    <!-- Product Tab -->
    <div class="product-tab pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="tab products-details-tab">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <ul class="tabs">
                                    <li>
                                        <a href="#">
                                            Description
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Specifications
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Reviews
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="tab_content current active pt-45">
                                        <div class="tabs_item current">
                                            <div class="products-tabs-decs">
                                                <p>{{ $product->description }}</p>
                                            </div>
                                        </div>

                                        <div class="tabs_item">
                                            <div class="products-tabs-specifications">
                                                <ul>
                                                    <li>Dimensions: {{ $product->length ?? 'N/A' }} x {{ $product->width ?? 'N/A' }} x {{ $product->height ?? 'N/A' }} cm</li>
                                                    <li>Weight: {{ $product->weight ?? 'N/A' }} grams</li>
                                                    <li>Tax: {{ $product->tax ?? 0 }}%</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="tabs_item">
                                            <div class="tab-reviews">
                                                <div class="row align-items-center">
                                                    <p>No reviews available for this product.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Tab End -->

    @push('js')
        <script>
            $(document).ready(function () {
                $('#addToCart').on('click', function (e) {
                    e.preventDefault();

                    const url = $(this).data('url');
                    const quantity = $('#quantity').val();

                    // Show a loading spinner or disable the button
                    const button = $(this);
                    button.prop('disabled', true);
                    button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...');

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            quantity: quantity,
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message);
                                setTimeout(() => {
                                    location.reload(); // Reload the page on success
                                }, 1000);
                            } else {
                                toastr.error(response.message || 'Failed to add product to the cart.');
                            }
                        },
                        error: function (xhr) {
                            let errorMessage = 'Failed to add product to the cart.';

                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.responseText) {
                                errorMessage = xhr.responseText;
                            }

                            toastr.error(errorMessage);
                            console.error(xhr.responseText);
                        },
                        complete: function () {
                            // Re-enable the button and reset its text
                            button.prop('disabled', false);
                            button.html('Add To Cart');
                        }
                    });
                });
            });
        </script>

    @endpush
@endsection
