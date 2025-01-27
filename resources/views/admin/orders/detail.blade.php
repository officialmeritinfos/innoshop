@extends('admin.base')
@section('content')

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Order Details (Order ID: {{ $order->id }})</h4>
                <div>
                    <button class="btn btn-success btn-sm" onclick="markPayment({{ $order->id }})">
                        <i class="fa fa-check-circle"></i> Mark Paid
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteOrder({{ $order->id }})">
                        <i class="fa fa-trash"></i> Delete Order
                    </button>
                    <a href="{{ route('admin.orders.markCompleted', ['id' => $order->id]) }}" class="btn btn-info mr-2">
                        Mark as Completed
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Order Info -->
                <h5>Order Information</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Order ID</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>User</th>
                        <td>
                            @if ($order->user)
                                {{ $order->user->name }}<br>
                                <small>{{ $order->user->email }}</small>
                            @else
                                <span class="text-muted">Guest</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Total Price</th>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td>
                        <span class="badge {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Order Status</th>
                        <td>
                        <span class="badge {{ $order->status == 'completed' ? 'badge-success' : 'badge-info' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Shipping Address</th>
                        <td>{{ $order->shipping_address }}</td>
                    </tr>
                    <tr>
                        <th>Billing Address</th>
                        <td>{{ $order->billing_address ?? 'N/A' }}</td>
                    </tr>
                </table>

                <!-- Products in the Order -->
                <h5 class="mt-4">Products</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>
                                @if ($item->product && $item->product->featured_image)
                                    <img src="{{ asset('storage/' . $item->product->featured_image) }}" alt="{{ $item->product_name }}" class="img-thumbnail" style="max-height: 60px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $item->product_name }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @push('js')
        <script>
            function markPayment(orderId) {
                if (confirm('Are you sure you want to mark this order as paid?')) {
                    $.ajax({
                        url: "{{ route('admin.orders.markPayment',['id'=>$order->id]) }}",
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Payment marked as successful!');
                                location.reload();
                            } else {
                                toastr.error(response.message || 'An error occurred.');
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Failed to mark payment as successful.');
                        }
                    });
                }
            }

            function deleteOrder(orderId) {
                if (confirm('Are you sure you want to delete this order?')) {
                    $.ajax({
                        url: "{{ route('admin.orders.destroy',['id'=>$order->id]) }}",
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Order deleted successfully!');
                                window.location.href = '{{ route('admin.orders.index') }}';
                            } else {
                                toastr.error(response.message || 'An error occurred.');
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Failed to delete order.');
                        }
                    });
                }
            }
        </script>
    @endpush

@endsection
