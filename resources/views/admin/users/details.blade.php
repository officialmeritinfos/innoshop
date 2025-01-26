@extends('admin.base')
@section('content')

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Customer Details</h4>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back to Customers
                </a>
            </div>
            <div class="card-body">
                <h5>Personal Details</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $customer->phone ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $customer->address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                        <span class="badge {{ $customer->status==1 ? 'badge-success' : 'badge-danger' }}">
                            {{ $customer->status==1 ? 'Active' : 'Inactive' }}
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Registered Date</th>
                        <td>{{ $customer->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                </table>

                <h5 class="mt-4">Order History</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Total Price</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer->orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <span class="badge {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $order->status == 'completed' ? 'badge-success' : 'badge-info' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.detail', ['id' => $order->id]) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
