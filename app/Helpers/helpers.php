<?php

if (!function_exists('product_categories')) {
    /**
     * Fetch all product categories from the database, ordered alphabetically by name.
     *
     * @return \Illuminate\Support\Collection
     */
    function product_categories()
    {
        return \App\Models\ProductCategory::orderBy('name')->get();
    }
}

if (!function_exists('best_deals')) {
    /**
     * Retrieve the best deal products (products with the highest discount prices).
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    function best_deals($limit = 8)
    {
        return \App\Models\Product::whereNotNull('discount_price') // Only products with a discount
        ->where('discount_price', '>', 0) // Ensure the discount price is greater than zero
        ->orderByRaw('(price - discount_price) DESC') // Sort by the highest discount amount
        ->take($limit) // Limit the number of products retrieved
        ->get();
    }
}

if (!function_exists('latest_products')) {
    /**
     * Retrieve the 3 latest products.
     *
     * @return \Illuminate\Support\Collection
     */
    function latest_products()
    {
        return \App\Models\Product::orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }
}

if (!function_exists('cart_item_count')) {
    /**
     * Get the total number of items in a cart.
     *
     * @return int
     */
    function cart_item_count()
    {
        if (auth()->check()) {
            // For authenticated users
            return \App\Models\CartItem::whereHas('cart', function ($query) {
                $query->where('user_id', auth()->id());
            })->count();
        } else {
            // For guest users using session_id
            $sessionId = session()->getId(); // Get the current session ID
            return \App\Models\CartItem::whereHas('cart', function ($query) use ($sessionId) {
                $query->where('session_id', $sessionId);
            })->count();
        }
    }
}

