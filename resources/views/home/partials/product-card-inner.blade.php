@forelse($products as $product)
    <div class="col-lg-6 col-sm-6">
        <div class="product-card">
            <div class="product-card-img">
                <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                    <img src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $product->name }}">
                </a>
            </div>

            <div class="content">
                <h3><a href="{{ route('product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h3>
                <div class="rating-tag">
                    <i class="las la-star"></i>
                    ({{ number_format($product->rating ?? 0, 1) }})
                </div>
                <p>{{ $product->category->name ?? 'Product' }}</p>
                <span>${{ number_format($product->discount_price??$product->price, 2) }}</span>
                <a href="{{ route('cart.add',['id'=>$product->id]) }}" class="add-card"><i class="las la-plus"></i></a>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <p class="text-center">No products available at the moment.</p>
    </div>
@endforelse
