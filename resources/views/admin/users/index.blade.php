@extends('admin.base')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Customers</h6>
        </div>
        <div class="card-body">
            @include('templates.notification')
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Orders</th>
                        <th>Spent</th>
                        <th>Status</th>
                        <th>Registered Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $index => $customer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $customer->name }}<br>
                                <small>{{ $customer->phone ?? 'No Phone' }}</small>
                            </td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->orders_count }}</td>
                            <td>${{ number_format($customer->orders_total, 2) }}</td>
                            <td>
                                <span class="badge {{ $customer->is_active ? 'badge-success' : 'badge-danger' }}">
                                    {{ $customer->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $customer->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.users.detail', ['id' => $customer->id]) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.users.edit', ['id' => $customer->id]) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
