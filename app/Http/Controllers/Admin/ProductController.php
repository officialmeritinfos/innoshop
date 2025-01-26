<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //=landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Product',
            'user'     =>  $user,
            'products' => Product::with('category')->orderBy('id', 'desc')->get(),
        ];

        return view('admin.product.index',$dataView);
    }
    //new product
    public function newProduct()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'New Product',
            'user'     =>  $user,
            'categories' => ProductCategory::all(),
        ];

        return view('admin.product.new',$dataView);
    }
    //edit product
    public function editProduct($id)
    {
        try {
            // Fetch the product and its category
            $product = Product::with('category')->findOrFail($id);

            // Fetch all categories for the dropdown
            $categories = ProductCategory::all();

            $web = GeneralSetting::find(1);
            $user = Auth::user();

            $dataView =[
                'siteName' => $web->name,
                'pageName' => 'Edit Product',
                'user'     =>  $user,
                'categories' => ProductCategory::all(),
                'product' =>$product,
            ];

            return view('admin.product.edit',$dataView);
        } catch (\Exception $e) {
            // Handle the exception and redirect back with an error message
            return redirect()->route('admin.products.index')->with('error', 'Failed to load product details: ' . $e->getMessage());
        }
    }
    //product detail
    public function productDetail($id)
    {
        $web = GeneralSetting::find(1);
        // Fetch the product details along with its category
        $product = Product::with('category')->findOrFail($id);

        // Fetch orders containing this product and include pivot data
        $orders = $product->orders()->get();

        // Calculate the total quantity of products sold
        $totalSold = $orders->sum('pivot.quantity');

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Product Detail',
            'user'     =>  Auth::user(),
            'orders'   =>  $orders,
            'product'  =>  $product,
            'totalSold'  =>  $totalSold,
        ];

        return view('admin.product.details',$dataView);


    }
    //process New product
    public function processNewProduct(Request  $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:product_categories,id',
            'featured_image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
            'sku' => 'required|string|max:255|unique:products,sku',
            'barcode'=>['nullable','string','max:255','unique:products,barcode'],
            'weight' => 'nullable|integer|min:0',
            'length' => 'nullable|integer|min:0',
            'width' => 'nullable|integer|min:0',
            'height' => 'nullable|integer|min:0',
        ]);

        try {
            $featuredImagePath = $request->file('featured_image') ? $request->file('featured_image')->store('products', 'public') : null;

            $additionalImages = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $additionalImages[] = $image->store('products', 'public');
                }
            }

            Product::create([
                'name' => $request->name,
                'slug' => $request->slug ?: Str::slug($request->name),
                'description' => $request->description,
                'short_description' => $request->short_description,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                'featured_image' => $featuredImagePath,
                'images' => json_encode($additionalImages),
                'sku' => $request->sku,
                'barcode' => $request->barcode,
                'tax' => $request->tax,
                'is_active' => $request->has('is_active') ?? false,
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            logger('error adding product: '.$e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

    }
    //process product edit
    public function updateProduct(Request  $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $id,
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:product_categories,id',
            'featured_image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
            'sku' => 'required|string|max:255|unique:products,sku,' . $id,
            'weight' => 'nullable|integer|min:0',
            'length' => 'nullable|integer|min:0',
            'width' => 'nullable|integer|min:0',
            'height' => 'nullable|integer|min:0',
        ]);

        try {
            $product = Product::findOrFail($id);

            // Update the featured image if a new one is uploaded
            if ($request->hasFile('featured_image')) {
                if ($product->featured_image && Storage::disk('public')->exists($product->featured_image)) {
                    Storage::disk('public')->delete($product->featured_image);
                }
                $product->featured_image = $request->file('featured_image')->store('products', 'public');
            }

            // Update additional images
            $additionalImages = json_decode($product->images) ?? [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $additionalImages[] = $image->store('products', 'public');
                }
            }
            $product->images = json_encode($additionalImages);

            // Update other fields
            $product->update([
                'name' => $request->name,
                'slug' => $request->slug ?: Str::slug($request->name),
                'description' => $request->description,
                'short_description' => $request->short_description,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                'sku' => $request->sku,
                'barcode' => $request->barcode,
                'tax' => $request->tax,
                'is_active' => $request->has('is_active'),
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
            ]);

            return response()->json(['success' => true, 'message' => 'Product updated successfully.']);
        } catch (\Exception $e) {
            // Log the full error for debugging
            Log::error('Product update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return the full error message for debugging in development
            return response()->json(['success' => false, 'message' => 'Failed to update product: ' . $e->getMessage()], 500);
        }
    }
    public function deleteProduct($id){
        try {
            $product = Product::with('orders')->findOrFail($id);

            // Check if the product has any orders
            if ($product->orders()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete this product because it has associated orders.'
                ]);
            }

            $product->delete();

            return response()->json(['success' => true, 'message' => 'Product deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete product: ' . $e->getMessage()]);
        }
    }
    public function toggleStatus(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->is_active = $request->is_active=='true';
            $product->save();

            return response()->json([
                'success' => true,
                'message' => $product->is_active
                    ? 'Product activated successfully.'
                    : 'Product deactivated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update product status: ' . $e->getMessage()]);
        }
    }

}
