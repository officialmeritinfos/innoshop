@extends('home.base')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- Analytics Section -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Completed Orders</h5>
                                <p class="card-text display-6">{{ $completedOrders }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Pending Orders</h5>
                                <p class="card-text display-6">{{ $pendingOrders }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="card">
                    <div class="card-header">
                        <h4>My Orders</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Total Price</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($orders as $index => $order)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ ucfirst($order->status) }}</td>
                                        <td>{{ ucfirst($order->payment_status) }}</td>
                                        <td>${{ number_format($order->total_price, 2) }}</td>
                                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No orders found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </main>
        </div>
    </div>

@endsection
