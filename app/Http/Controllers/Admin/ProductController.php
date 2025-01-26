<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    }
    //product detail
    public function productDetail($id)
    {

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

    }
    public function deleteProduct($id){

    }
}
