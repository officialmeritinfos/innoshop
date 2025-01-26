<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Product Categories',
            'user'     =>  $user,
            'categories' => ProductCategory::orderBy('id', 'desc')->get(),
        ];

        return view('admin.category.index',$dataView);
    }
    //category detail
    public function categoryDetail($id)
    {
        // Retrieve the category with its associated products
        $category = ProductCategory::with('products')->findOrFail($id);
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Category Detail',
            'user'     =>  $user,
            'category' => $category,
        ];

        return view('admin.category.detail',$dataView);
    }
    //process new category
    public function addCategory(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug',
            'description' => 'nullable|string',
        ]);

        try {
            // Generate slug if not provided
            $slug = $request->slug ?: Str::slug($request->name);

            // Create the category
            $category = ProductCategory::create([
                'name' => $request->name,
                'slug' => $slug,
                'description' => $request->description,
            ]);

            return response()->json(['success' => true, 'data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

    }
    //Update category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = ProductCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['success' => true, 'data' => $category]);
    }
    //delete category
    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);

        // Optional: Check if the category has products before deleting
        if ($category->products()->exists()) {
            return response()->json(['success' => false, 'message' => 'Cannot delete category with products.']);
        }

        $category->delete();

        return response()->json(['success' => true]);
    }

}
