@extends('admin.base')

@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header">
                <h4>Product Details</h4>
                <div>
                    <!-- Activate/Deactivate Button -->
                    @if($product->is_active)
                        <button class="btn btn-sm btn-warning"
                                data-url="{{ route('admin.products.toggle-status', ['id' => $product->id]) }}"
                                data-is-active="false"
                                onclick="toggleProductStatus(this)">
                            <i class="fa fa-eye-slash"></i> Deactivate
                        </button>
                    @else
                        <button class="btn btn-sm btn-success"
                                data-url="{{ route('admin.products.toggle-status', ['id' => $product->id]) }}"
                                data-is-active="true"
                                onclick="toggleProductStatus(this)">
                            <i class="fa fa-eye"></i> Activate
                        </button>
                    @endif

                    <!-- Delete Button -->
                    <button class="btn btn-sm btn-danger"
                            data-url="{{ route('admin.products.destroy', ['id' => $product->id]) }}"
                            onclick="deleteProduct(this)">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Product Information -->
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $product->slug }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <th>Short Description</th>
                        <td>{{ $product->short_description }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>${{ number_format($product->price, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Discount Price</th>
                        <td>${{ number_format($product->discount_price, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Stock</th>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Weight</th>
                        <td>{{ $product->weight ? $product->weight . ' grams' : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Dimensions</th>
                        <td>
                            @if($product->length || $product->width || $product->height)
                                {{ $product->length ?? 0 }}cm x {{ $product->width ?? 0 }}cm x {{ $product->height ?? 0 }}cm
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Featured Image</th>
                        <td>
                            @if($product->featured_image)
                                <img src="{{ asset('storage/' . $product->featured_image) }}" class="img-thumbnail" style="max-height: 150px;">
                            @else
                                <span class="text-muted">No Featured Image</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Additional Images</th>
                        <td>
                            @if($product->images)
                                <div class="d-flex flex-wrap">
                                    @foreach(json_decode($product->images) as $image)
                                        <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail mr-2" style="max-height: 100px;">
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted">No Additional Images</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>{{ $product->is_active ? 'Active' : 'Inactive' }}</td>
                    </tr>

                    </tbody>
                </table>

                <!-- Products Sold -->
                <div class="alert alert-success mt-4">
                    <strong>Products Sold:</strong> {{ $totalSold }} units
                </div>

                <!-- Orders Table -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Orders Containing This Product</h5>
                    </div>
                    <div class="card-body">
                        @if($orders->isNotEmpty())
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer_name ?? 'Guest' }}</td>
                                        <td>{{ $order->pivot->quantity }}</td>
                                        <td>
                                            ${{ number_format($order->pivot->quantity * ($order->pivot->discount_price ?? $order->pivot->price), 2) }}
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                        <td>{{ ucfirst($order->status) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">No orders found for this product.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // Toggle Product Status
            function toggleProductStatus(button) {
                const url = button.getAttribute('data-url');
                const isActive = button.getAttribute('data-is-active') === 'true';

                if (confirm(isActive ? 'Are you sure you want to activate this product?' : 'Are you sure you want to deactivate this product?')) {
                    $.ajax({
                        url: url,
                        method: 'PUT',
                        data: {
                            is_active: isActive,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                location.reload();
                            } else {
                                toastr.error(response.message || 'An error occurred.');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            toastr.error('Failed to update product status.');
                        }
                    });
                }
            }

            // Delete Product
            function deleteProduct(button) {
                const url = button.getAttribute('data-url');

                if (confirm('Are you sure you want to delete this product?')) {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                window.location.href = '{{ route('admin.products.index') }}';
                            } else {
                                toastr.error(response.message || 'An error occurred.');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            toastr.error('Failed to delete product.');
                        }
                    });
                }
            }
        </script>
    @endpush
@endsection
