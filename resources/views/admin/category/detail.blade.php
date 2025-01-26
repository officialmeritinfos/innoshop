@extends('admin.base')
@section('content')
    <div class="container mt-4">
        <!-- Category Details -->
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Category: {{ $category->name }}</h4>
                <p class="card-text">Description: {{ $category->description }}</p>
                <button class="btn btn-primary" data-toggle="modal" data-target="#editCategoryModal">Edit Category</button>
                <button class="btn btn-danger" onclick="deleteCategory({{ $category->id }})">Delete Category</button>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Products in Category</h6>
                <a href="{{ route('admin.products.new') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa fa-plus-square"></i> Add New
                </a>
            </div>
            <div class="card-body">
                @include('templates.notification')
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category->products as $product)
                            <tr id="product-{{ $product->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>${{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm">
                        @csrf
                        <input type="hidden" id="editCategoryId" value="{{ $category->id }}">
                        <div class="form-group">
                            <label for="editCategoryName">Name</label>
                            <input type="text" class="form-control" id="editCategoryName" value="{{ $category->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="editCategoryDescription">Description</label>
                            <textarea class="form-control" id="editCategoryDescription" rows="3">{{ $category->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

 @push('js')
     <script>
         // Edit Category Form Submission
         $('#editCategoryForm').on('submit', function (e) {
             e.preventDefault();

             const categoryId = $('#editCategoryId').val();
             const formData = {
                 name: $('#editCategoryName').val(),
                 description: $('#editCategoryDescription').val(),
                 _token: '{{ csrf_token() }}',
             };

             $.ajax({
                 url: "{{ route('admin.categories.update',['id'=>$category->id]) }}",
                 method: 'PUT',
                 data: formData,
                 success: function (response) {
                     if (response.success) {
                         toastr.success('Category updated successfully!');
                         location.reload(); // Reload the page to reflect changes
                     } else {
                         toastr.error(response.message || 'An error occurred.');
                     }
                 },
                 error: function () {
                     toastr.error('Failed to update category.');
                 }
             });
         });

         // Delete Category
         function deleteCategory(categoryId) {
             if (confirm('Are you sure you want to delete this category?')) {
                 $.ajax({
                     url: "{{ route('admin.categories.destroy',['id'=>$category->id]) }}",
                     method: 'DELETE',
                     data: {
                         _token: '{{ csrf_token() }}',
                     },
                     success: function (response) {
                         if (response.success) {
                             toastr.success('Category deleted successfully!');
                             window.location.href = '/categories'; // Redirect to categories list
                         } else {
                             toastr.error(response.message || 'An error occurred.');
                         }
                     },
                     error: function () {
                         toastr.error('Failed to delete category.');
                     }
                 });
             }
         }

         // Add Product (redirect to add product page)
         function addProduct() {
             window.location.href = `/products/create?category_id={{ $category->id }}`;
         }

         // Edit Product
         function editProduct(productId) {
             window.location.href = `/products/${productId}/edit`;
         }

         // Delete Product
         function deleteProduct(productId) {
             if (confirm('Are you sure you want to delete this product?')) {
                 $.ajax({
                     url: `/products/${productId}`,
                     method: 'DELETE',
                     data: {
                         _token: '{{ csrf_token() }}',
                     },
                     success: function (response) {
                         if (response.success) {
                             toastr.success('Product deleted successfully!');
                             $(`#product-${productId}`).remove(); // Remove product row from table
                         } else {
                             toastr.error(response.message || 'An error occurred.');
                         }
                     },
                     error: function () {
                         toastr.error('Failed to delete product.');
                     }
                 });
             }
         }
     </script>
 @endpush
@endsection
