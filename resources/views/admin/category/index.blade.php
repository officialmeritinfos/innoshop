@extends('admin.base')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{$pageName}}</h6>
            <a href="#newCategory" data-toggle="modal" class="btn btn-outline-primary btn-sm">
                <i class="fa fa-plus-square"></i> Add New
            </a>
        </div>
        <div class="card-body">
            @include('templates.notification')
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                {{ $category->slug??'N/A' }}
                            </td>
                            <td>
                                {{ $category->description??'N/A' }}
                            </td>
                            <td>{{ $category->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.category.details', ['id' => $category->id]) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i>
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

    <!-- Modal -->
    <div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" method="post" action="{{ route('admin.category.new.process') }}">
                        <!-- CSRF Token -->
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="name" placeholder="Enter category name" required>
                        </div>

                        <!-- Slug -->
                        <div class="form-group">
                            <label for="categorySlug">Slug</label>
                            <input type="text" class="form-control" id="categorySlug" name="slug" placeholder="Enter slug (auto-generated if empty)">
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="categoryDescription">Description</label>
                            <textarea class="form-control" id="categoryDescription" name="description" rows="3" placeholder="Enter category description"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success btn-block">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function () {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                // Handle Form Submission
                $('#addCategoryForm').on('submit', function (e) {
                    e.preventDefault();

                    // Get the action URL from the form
                    const actionUrl = $(this).attr('action');

                    // Collect form data
                    const formData = {
                        name: $('#categoryName').val(),
                        slug: $('#categorySlug').val(),
                        description: $('#categoryDescription').val(),
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    };

                    // AJAX request to store category
                    $.ajax({
                        url: actionUrl,
                        type: "POST",
                        data: formData,
                        success: function (response) {
                            if (response.success) {
                                toastr.success('Category added successfully!');
                                $('#addCategoryForm')[0].reset();
                                $('#addCategoryModal').modal('hide');
                                // Optionally reload the categories list or update the UI
                            } else {
                                toastr.error('Error: ' + response.message);
                            }
                        },
                        error: function (xhr) {
                            console.error(xhr.responseText);
                            toastr.error('An error occurred while adding the category.');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
