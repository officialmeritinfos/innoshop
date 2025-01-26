@extends('admin.base')

@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header">
                <h4>Edit Product</h4>
            </div>
            <div class="card-body">
                <form id="editProductForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                    </div>

                    <!-- Slug -->
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ $product->slug }}">
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
                    </div>

                    <!-- Short Description -->
                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <textarea class="form-control" id="short_description" name="short_description" rows="2">{{ $product->short_description }}</textarea>
                    </div>

                    <!-- Price and Discount Price -->
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="discount_price">Discount Price</label>
                        <input type="number" step="0.01" class="form-control" id="discount_price" name="discount_price" value="{{ $product->discount_price }}">
                    </div>

                    <!-- Stock -->
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="" disabled>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Featured Image -->
                    <div class="form-group">
                        <label for="featured_image">Featured Image</label>
                        @if($product->featured_image)
                            <div id="featuredImagePreviewContainer" class="mb-2">
                                <img id="featuredImagePreview" src="{{ asset('storage/' . $product->featured_image) }}" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @else
                            <div class="text-muted mb-2">No featured image uploaded</div>
                        @endif
                        <input type="file" class="form-control-file" id="featured_image" name="featured_image" onchange="previewFeaturedImage(event)">
                    </div>

                    <!-- Additional Images -->
                    <div class="form-group">
                        <label for="images">Additional Images</label>
                        @if($product->images)
                            <div id="additionalImagesPreviewContainer" class="d-flex flex-wrap mb-2">
                                @foreach(json_decode($product->images) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail mr-2" style="max-height: 100px;">
                                @endforeach
                            </div>
                        @else
                            <div class="text-muted mb-2">No additional images uploaded</div>
                        @endif
                        <input type="file" class="form-control-file" id="images" name="images[]" multiple onchange="previewAdditionalImages(event)">
                    </div>

                    <!-- Dimensions and Weight -->
                    <div class="form-row">
                        <div class="col">
                            <label for="weight">Weight (grams)</label>
                            <input type="number" class="form-control" id="weight" name="weight" value="{{ $product->weight }}">
                        </div>
                        <div class="col">
                            <label for="length">Length (cm)</label>
                            <input type="number" class="form-control" id="length" name="length" value="{{ $product->length }}">
                        </div>
                        <div class="col">
                            <label for="width">Width (cm)</label>
                            <input type="number" class="form-control" id="width" name="width" value="{{ $product->width }}">
                        </div>
                        <div class="col">
                            <label for="height">Height (cm)</label>
                            <input type="number" class="form-control" id="height" name="height" value="{{ $product->height }}">
                        </div>
                    </div>

                    <!-- SKU and Barcode -->
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku" value="{{ $product->sku }}" required>
                    </div>
                    <div class="form-group">
                        <label for="barcode">Barcode</label>
                        <input type="text" class="form-control" id="barcode" name="barcode" value="{{ $product->barcode }}">
                    </div>

                    <!-- Tax -->
                    <div class="form-group">
                        <label for="tax">Tax (%)</label>
                        <input type="number" step="0.01" class="form-control" id="tax" name="tax" value="{{ $product->tax }}">
                    </div>

                    <!-- Active Status -->
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ $product->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success btn-block">Update Product</button>
                </form>
            </div>
        </div>
    </div>

   @push('js')
       <script>
           // Preview for Featured Image
           function previewFeaturedImage(event) {
               const file = event.target.files[0];
               const previewContainer = document.getElementById('featuredImagePreviewContainer');
               const previewImage = document.getElementById('featuredImagePreview');

               if (file) {
                   const reader = new FileReader();
                   reader.onload = function (e) {
                       if (previewImage) {
                           // Update existing preview
                           previewImage.src = e.target.result;
                       } else {
                           // Add new preview if it doesn't exist
                           const img = document.createElement('img');
                           img.id = 'featuredImagePreview';
                           img.src = e.target.result;
                           img.className = 'img-thumbnail';
                           img.style.maxHeight = '150px';
                           previewContainer.innerHTML = '';
                           previewContainer.appendChild(img);
                       }
                   };
                   reader.readAsDataURL(file);
               }
           }

           // Preview for Additional Images
           function previewAdditionalImages(event) {
               const files = event.target.files;
               const previewContainer = document.getElementById('additionalImagesPreviewContainer');

               previewContainer.innerHTML = ''; // Clear existing previews
               for (const file of files) {
                   const reader = new FileReader();
                   reader.onload = function (e) {
                       const img = document.createElement('img');
                       img.src = e.target.result;
                       img.className = 'img-thumbnail mr-2';
                       img.style.maxHeight = '100px';
                       previewContainer.appendChild(img);
                   };
                   reader.readAsDataURL(file);
               }
           }

           // AJAX for updating product
           $('#editProductForm').on('submit', function (e) {
               e.preventDefault();

               const formData = new FormData(this);
               const actionUrl = '{{ route('admin.products.update', ['id' => $product->id]) }}';

               $.ajax({
                   url: actionUrl,
                   type: 'POST',
                   data: formData,
                   contentType: false,
                   processData: false,
                   success: function (response) {
                       if (response.success) {
                           toastr.success(response.message || 'Product updated successfully.');
                           window.location.href = '{{ route('admin.products.index') }}';
                       } else {
                           toastr.error(response.message || 'Failed to update product.');
                       }
                   },
                   error: function (xhr) {
                       // Show error messages returned from the server
                       const response = xhr.responseJSON;
                       if (response && response.message) {
                           toastr.error(response.message);
                       } else {
                           toastr.error('An unknown error occurred.');
                       }
                   },
               });
           });

       </script>
   @endpush
@endsection
