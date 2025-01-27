@foreach ($products as $product)
    <div class="col-lg-4 col-md-6 mix hot-sell">
        <div class="all-product-item">
            <div class="row align-items-center">
                <div class="col-lg-5 col-sm-5 pr-0">
                    <div class="all-product-img">
                        <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                            <img src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $product->name }}">
                        </a>
                        <i class="las la-heart"></i>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-7">
                    <div class="all-product-content">
                        <h3><a href="{{ route('product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h3>
                        <div class="rating">
                            <i class="las la-star"></i> ({{ number_format($product->rating ?? 0, 1) }})
                        </div>
                        <span>${{ number_format($product->discount_price??$product->price, 2) }}</span>
                        <a href="{{ route('cart.add',['id'=>$product->id]) }}" class="add-cart-btn"><i class="las la-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
