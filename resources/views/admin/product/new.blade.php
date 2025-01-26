@extends('admin.base')
@section('content')

    <div class="container card mt-4">
        <div class="card-header">
            <h4>Add New Product</h4>
        </div>
        <div class="card-body">
            <form id="addProductForm" action="{{ route('admin.products.new.process') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <!-- Slug -->
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug">
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <!-- Short Description -->
                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <textarea class="form-control" id="short_description" name="short_description" rows="2"></textarea>
                </div>

                <!-- Price and Discount -->
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="discount_price">Discount Price</label>
                    <input type="number" step="0.01" class="form-control" id="discount_price" name="discount_price">
                </div>

                <!-- Stock -->
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>

                <!-- Category -->
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="" disabled selected>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Featured Image -->
                <div class="form-group">
                    <label for="featured_image">Featured Image</label>
                    <input type="file" class="form-control-file" id="featured_image" name="featured_image" onchange="previewImage(event, '#featuredImagePreview')">
                    <img id="featuredImagePreview" class="img-thumbnail mt-2" style="max-height: 150px;">
                </div>

                <!-- Additional Images -->
                <div class="form-group">
                    <label for="images">Additional Images</label>
                    <input type="file" class="form-control-file" id="images" name="images[]" multiple onchange="previewImages(event, '#additionalImagesPreview')">
                    <div id="additionalImagesPreview" class="d-flex flex-wrap mt-2"></div>
                </div>

                <!-- Dimensions and Weight -->
                <div class="form-row">
                    <div class="col">
                        <label for="weight">Weight (grams)</label>
                        <input type="number" class="form-control" id="weight" name="weight">
                    </div>
                    <div class="col">
                        <label for="length">Length (cm)</label>
                        <input type="number" class="form-control" id="length" name="length">
                    </div>
                    <div class="col">
                        <label for="width">Width (cm)</label>
                        <input type="number" class="form-control" id="width" name="width">
                    </div>
                    <div class="col">
                        <label for="height">Height (cm)</label>
                        <input type="number" class="form-control" id="height" name="height">
                    </div>
                </div>

                <!-- SKU and Barcode -->
                <div class="form-group">
                    <label for="sku">SKU</label>
                    <input type="text" class="form-control" id="sku" name="sku" required>
                </div>
                <div class="form-group">
                    <label for="barcode">Barcode</label>
                    <input type="text" class="form-control" id="barcode" name="barcode">
                </div>

                <!-- Tax and Active Status -->
                <div class="form-group">
                    <label for="tax">Tax (%)</label>
                    <input type="number" step="0.01" class="form-control" id="tax" name="tax">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-success btn-block">Add Product</button>

            </form>
        </div>
    </div>

    @push('js')
        <script>
            // Image Preview Function
            function previewImage(event, previewId) {
                const reader = new FileReader();
                reader.onload = function(){
                    const output = document.querySelector(previewId);
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }

            function previewImages(event, previewContainerId) {
                const files = event.target.files;
                const previewContainer = document.querySelector(previewContainerId);
                previewContainer.innerHTML = '';
                for (let i = 0; i < files.length; i++) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        const img = document.createElement('img');
                        img.src = reader.result;
                        img.classList.add('img-thumbnail', 'm-1');
                        img.style.maxHeight = '100px';
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(files[i]);
                }
            }

            // AJAX Form Submission
            $('#addProductForm').on('submit', function (e) {
                e.preventDefault();

                const actionUrl = $(this).attr('action'); // Get the action URL from the form
                const formData = new FormData(this);

                $.ajax({
                    url: actionUrl, // Dynamically use the form's action attribute
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success) {
                            toastr.success('Product added successfully!');
                            window.location.href = '{{ route('admin.products.index') }}';
                        } else {
                            toastr.error(response.message || 'An error occurred.');
                        }
                    },
                    error: function (xhr) {
                        console.error('Error Status:', xhr.status);
                        console.error('Response:', xhr.responseText);
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = 'Validation Errors:\n';
                            for (const [field, messages] of Object.entries(errors)) {
                                errorMessage += `- ${messages.join(', ')}\n`;
                            }
                            toastr.error(errorMessage);
                        } else {
                            console.error(xhr.responseText);
                            toastr.error('Failed to add product.');
                        }
                    }

                });
            });
        </script>
    @endpush
@endsection
