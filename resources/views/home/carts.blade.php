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


    <!-- Start Cart Area -->
    <section class="cart-wraps-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <form>
                        <div class="cart-wraps">
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse ($cartItems as $item)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#">
                                                    <img src="{{ asset('storage/' . $item->product->featured_image) }}" alt="{{ $item->product->name }}">
                                                </a>
                                            </td>

                                            <td class="product-name">
                                                <a href="#">{{ $item->product->name }}</a>
                                            </td>

                                            <td class="product-price">
                                                <span class="unit-amount">${{ number_format($item->price, 2) }}</span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="input-counter">
                                                            <span class="minus-btn">
                                                                <i class="las la-minus"></i>
                                                            </span>
                                                    <input type="text" value="{{ $item->quantity }}">
                                                    <span class="plus-btn">
                                                                <i class="las la-plus"></i>
                                                            </span>
                                                </div>
                                            </td>

                                            <td class="product-subtotal">

                                                <span class="subtotal-amount">${{ number_format($item->quantity * $item->price, 2) }}</span>
                                                <a href="#" class="remove" data-id="{{ $item->id }}"
                                                   data-url="{{ route('cart.item.remove', ['id' => $item->id]) }}">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Your cart is empty.</td>
                                        </tr>
                                    @endforelse


                                    </tbody>
                                </table>
                            </div>

                            <div class="cart-buttons">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-sm-7 col-md-7">
                                        <div class="continue-shopping-box">
                                            <a href="{{ route('shop') }}" class="default-btn">
                                                Continue Shopping
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @if(!empty($cartItems))
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="cart-totals">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li>Subtotal <span>${{ number_format($totalAmount, 2) }}</span></li>
                                        <li>Total <span><b>${{ number_format($totalAmount , 2) }}</b></span></li>
                                    </ul>

                                        <a href="{{ route('checkout') }}" class="default-btn btn-bg-three">
                                            Proceed To Checkout
                                        </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Cart Area -->

    @push('js')
        <script>
            $(document).ready(function () {
                // Handle delete item
                $('.remove').on('click', function (e) {
                    e.preventDefault();

                    const url = $(this).data('url'); // Fetch the URL dynamically
                    const row = $(this).closest('tr'); // Get the row to remove

                    if (confirm('Are you sure you want to remove this item from the cart?')) {
                        $.ajax({
                            url: url, // Use the dynamic URL from the data-url attribute
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function (response) {
                                if (response.success) {
                                    toastr.success(response.message);
                                    row.remove(); // Remove the row from the table

                                    // Recalculate totals
                                    let total = 0;
                                    $('.subtotal-amount').each(function () {
                                        total += parseFloat($(this).text().replace('$', ''));
                                    });
                                    $('.cart-totals ul li span').first().text('$' + total.toFixed(2));
                                } else {
                                    toastr.error('Failed to remove item.');
                                }
                            },
                            error: function (xhr) {
                                toastr.error('An error occurred while removing the item.');
                                console.error(xhr.responseText);
                            },
                        });
                    }
                });
            });

        </script>
    @endpush

@endsection
