@extends('admin.base')
@section('content')

    <div class="container card">
        <div class="card-header">
            <h4 class="mt-4 text-center">{{ $pageName }}</h4>
        </div>
        <div class="card-body">
            <form id="deliveryForm" action="{{ route('admin.delivery.new.process') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- User Selection -->
                <div class="mb-3">
                    <label for="user_id" class="form-label">User</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" data-url="{{ route('admin.delivery.user.detail', ['id' => $user->id]) }}">
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">If the receiver is the user, select the user; otherwise, leave blank.</small>
                </div>

                <!-- Order Selection -->
                <div class="mb-3">
                    <label for="order_id" class="form-label">Order</label>
                    <select name="order_id" id="order_id" class="form-control">
                        <option value="">Select Order</option>
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}">Order #{{ $order->id }} ({{ $order->created_at->format('d M Y') }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Option to Use User Data -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="use_user_data" id="use_user_data" class="form-check-input">
                    <label for="use_user_data" class="form-check-label">Use user data as receiver details</label>
                </div>

                <h4>Sender Information</h4>
                <div class="mb-3">
                    <label for="sender_name" class="form-label">Sender Name</label>
                    <input type="text" name="sender_name" id="sender_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="sender_address" class="form-label">Sender Address</label>
                    <input type="text" name="sender_address" id="sender_address" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="sender_phone" class="form-label">Sender Phone</label>
                    <input type="text" name="sender_phone" id="sender_phone" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="sender_email" class="form-label">Sender Email</label>
                    <input type="email" name="sender_email" id="sender_email" class="form-control">
                </div>

                <h4>Receiver Information</h4>
                <div class="mb-3">
                    <label for="receiver_name" class="form-label">Receiver Name</label>
                    <input type="text" name="receiver_name" id="receiver_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="receiver_address" class="form-label">Receiver Address</label>
                    <input type="text" name="receiver_address" id="receiver_address" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="receiver_phone" class="form-label">Receiver Phone</label>
                    <input type="text" name="receiver_phone" id="receiver_phone" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="receiver_email" class="form-label">Receiver Email</label>
                    <input type="email" name="receiver_email" id="receiver_email" class="form-control">
                </div>

                <!-- Delivery Details -->
                <div class="mb-3">
                    <label for="origin" class="form-label">Origin</label>
                    <input type="text" name="origin" id="origin" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="destination" class="form-label">Destination</label>
                    <input type="text" name="destination" id="destination" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="service" class="form-label">Service</label>
                    <input type="text" name="service" id="service" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="package_description" class="form-label">Package Description</label>
                    <textarea name="package_description" id="package_description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="package_fee" class="form-label">Package Fee</label>
                    <input type="number" step="0.01" name="package_fee" id="package_fee" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="total_weight" class="form-label">Total Weight</label>
                    <input type="number" step="0.01" name="total_weight" id="total_weight" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="shipment_date" class="form-label">Shipment Date</label>
                    <input type="date" name="shipment_date" id="shipment_date" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="delivery_date" class="form-label">Delivery Date</label>
                    <input type="date" name="delivery_date" id="delivery_date" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="shipment_mode" class="form-label">Shipment Mode</label>
                    <input type="text" name="shipment_mode" id="shipment_mode" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="in-transit">In-Transit</option>
                        <option value="on-hold">On-Hold</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Delivery</button>
                </div>
            </form>
        </div>
    </div>


    @push('js')
        <script>
            $(document).ready(function () {
                // Populate receiver fields when user changes
                $('#user_id').on('change', function () {
                    const userOption = $(this).find(':selected');
                    const useUserData = $('#use_user_data').is(':checked');
                    const url = userOption.data('url');

                    if (useUserData && url) {
                        $.get(url, function (response) {
                            $('#receiver_name').val(response.name || '');
                            $('#receiver_address').val(response.address || '');
                            $('#receiver_phone').val(response.phone || '');
                            $('#receiver_email').val(response.email || '');
                        }).fail(function () {
                            alert('Failed to fetch user details.');
                        });
                    }
                });

                // AJAX submission for the form
                $('#deliveryForm').on('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(this);

                    $.ajax({
                        url: '{{ route("admin.delivery.new.process") }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message || 'Delivery added successfully.');
                                window.location.href = '{{ route("admin.delivery.index") }}';
                            } else {
                                toastr.error(response.message || 'An error occurred.');
                            }
                        },
                        error: function (xhr) {
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                toastr.error(xhr.responseJSON.message); // Show server error message
                            } else if (xhr.responseText) {
                                toastr.error(xhr.responseText); // Show raw error text
                            } else {
                                toastr.error('An unknown error occurred. Please try again.');
                            }
                            console.error(xhr.responseText); // Log the full error in console
                        }
                    });
                });
            });
        </script>

    @endpush
@endsection
