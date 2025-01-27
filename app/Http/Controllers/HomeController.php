<?php

namespace App\Http\Controllers;

use App\Mail\AdminBookingNotification;
use App\Mail\BookingReceived;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Country;
use App\Models\Delivery;
use App\Models\DeliveryStage;
use App\Models\FlightBooking;
use App\Models\FlightTicket;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Notifications\InvestmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Rules\ReCaptcha;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request  $request)
    {
        $web = GeneralSetting::find(1);

        // Fetch paginated products (12 per page)
        $products = Product::orderBy('created_at', 'desc')->paginate(12);

        if ($request->ajax()) {
            return view('home.partials.product-card', compact('products'))->render();
        }

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Home Page',
            'products'  => $products,
        ];

        return view('home.home', $dataView);
    }

    public function about()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Company Overview',
        ];

        return view('home.about',$dataView);
    }
    public function terms()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Terms and Conditions',
        ];

        return view('home.terms',$dataView);
    }
    public function privacy()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Privacy Policy',
        ];

        return view('home.privacy',$dataView);
    }
    public function faqs()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Frequently Asked Questions',
        ];

        return view('home.faq',$dataView);
    }

    public function contact()
    {
        $web = GeneralSetting::where('id',1)->first();

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => 'Contact us',
        ];

        return view('home.contact',$dataView);
    }

    //process package
    public function processPackage(Request  $request)
    {
        $request->validate([
            'tracking_id' => 'required|string|max:255',
        ]);

        $trackingId = $request->input('tracking_id');
        $package = Delivery::where('tracking_number', $trackingId)->first();

        if (!$package) {
            return redirect()->back()->with('error','Tracking ID not found. Please try again.');
        }

        return redirect(route('home.package.detail',['ref'=>$package->reference]))->with('success','Package found');
    }
    //package detail
    public function packageDetail($ref)
    {
        $package = Delivery::where('reference', $ref)->firstOrFail();

        $stages = DeliveryStage::where('delivery_id', $package->id)->orderBy('created_at', 'asc')->get();
        $web = GeneralSetting::find(1);

        return view('home.package_tracking_detail', compact('package', 'stages','web'));

    }

    public function categoryProducts(Request  $request,$id)
    {
        $web = GeneralSetting::find(1);

        $category = ProductCategory::where('slug', $id)->firstOrFail();

        // Fetch paginated products (12 per page)
        $products = Product::where('category_id',$category->id)->orderBy('created_at', 'desc')->paginate(12);

        if ($request->ajax()) {
            return view('home.partials.product-card-inner', compact('products'))->render();
        }

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => "{$category->name} Products",
            'products'  => $products,
        ];

        return view('home.category_products', $dataView);
    }
    public function shop(Request  $request)
    {
        $web = GeneralSetting::find(1);


        // Fetch paginated products (12 per page)
        $products = Product::orderBy('created_at', 'desc')->paginate(30);

        if ($request->ajax()) {
            return view('home.partials.product-card', compact('products'))->render();
        }

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => "All Products",
            'products'  => $products,
        ];

        return view('home.shop', $dataView);
    }
    public function searchResult(Request $request)
    {
        $web = GeneralSetting::find(1);

        // Retrieve the search query from the request
        $searchQuery = $request->input('q');

        // Fetch products matching the search query or return all if no query is provided
        $products = Product::when($searchQuery, function ($query, $searchQuery) {
            return $query->where('name', 'like', '%' . $searchQuery . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(20); // Adjust the number of products per page as needed

        // Handle AJAX requests for loading products
        if ($request->ajax()) {
            return view('home.partials.product-card', compact('products'))->render();
        }

        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => "Search Results",
            'products'  => $products,
            'query'     => $searchQuery, // Pass the query for use in the view
        ];

        return view('home.search-result', $dataView);
    }

    public function search(Request  $request)
    {
        $web = GeneralSetting::find(1);


        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => "Search for a product",
        ];

        return view('home.search', $dataView);
    }
    public function track(Request  $request)
    {
        $web = GeneralSetting::find(1);


        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => "Track your Order",
        ];

        return view('home.track', $dataView);
    }



    public function productDetail($id)
    {
        $web = GeneralSetting::find(1);

        $product = Product::findOrFail($id);


        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => $product->name,
            'product'   => $product,
        ];

        return view('home.product_detail', $dataView);
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        if ($request->ajax()) {

            // Check stock availability
            if ($product->stock < $request->quantity) {
                return response()->json(['success' => false, 'message' => 'Insufficient stock available.']);
            }

            // Find or create the cart
            $cart = Cart::firstOrCreate(
                ['user_id' => auth()->id(), 'session_id' => session()->getId()],
                ['created_at' => now(), 'updated_at' => now()]
            );

            // Add product to cart items
            $cart->cartItems()->updateOrCreate(
                ['product_id' => $productId],
                [
                    'quantity' => $request->quantity,
                    'price' => $product->discount_price ?? $product->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            return response()->json(['success' => true, 'message' => 'Product added to cart.']);
        }else{
            // Check stock availability
            if ($product->stock < $request->quantity) {
                return back()->with('error', 'Insufficient stock available.');
            }

            // Find or create the cart
            $cart = Cart::firstOrCreate(
                ['user_id' => auth()->id(), 'session_id' => session()->getId()],
                ['created_at' => now(), 'updated_at' => now()]
            );

            // Add product to cart items
            $cart->cartItems()->updateOrCreate(
                ['product_id' => $productId],
                [
                    'quantity' => DB::raw('quantity + ' . ($request->quantity ?? 1)),
                    'price' => $product->discount_price ?? $product->price,
                    'updated_at' => now(),
                ]
            );


            return back()->with('success', 'Product added to cart.');
        }

    }

    //cart
    public function cart()
    {
        $web = GeneralSetting::find(1);

        $cart = Cart::with('cartItems.product')->where(function ($query) {
            $query->where('user_id', auth()->id())
                ->orWhere('session_id', session()->getId());
        })->first();

        $cartItems = $cart ? $cart->cartItems : [];
        $totalAmount = $cartItems ? collect($cartItems)->sum(function ($item) {
            return $item->quantity * $item->price;
        }) : 0;


        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => "Cart",
            'cartItems' =>$cartItems,
            'totalAmount'=>$totalAmount
        ];

        return view('home.carts', $dataView);
    }

    public function removeCartItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return response()->json(['success' => true, 'message' => 'Item removed from cart.']);
    }

    //checkout
    public function checkout()
    {
        $web = GeneralSetting::find(1);


        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => "Checkout",
        ];

        return view('home.checkout', $dataView);
    }

    //checkout
    public function processCheckout(Request $request)
    {
        // Start a transaction to ensure data consistency
        DB::beginTransaction();

        try {
            // Validate the input
            $validatedData = $request->validate([
                'payment_method' => 'required|string|in:Cash Transfer',
            ]);

            // Fetch the cart for the current user or session
            $cart = Cart::with('cartItems.product')->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhere('session_id', session()->getId());
            })->first();

            // Ensure the cart exists and has items
            if (!$cart || $cart->cartItems->isEmpty()) {
                return back()->with('error', 'Your cart is empty.');
            }

            // Calculate total price and prepare order data
            $totalPrice = $cart->cartItems->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            $order = Order::create([
                'user_id'        => auth()->id(),
                'status'         => 'pending',
                'total_price'    => $totalPrice,
                'tax_amount'     => 0, // Adjust if tax logic is implemented
                'shipping_fee'   => 0, // Adjust if shipping logic is implemented
                'shipping_address' => auth()->user()->address, // Update with actual address if needed
                'billing_address'  => auth()->user()->address, // Update with actual address if needed
                'payment_method' => $validatedData['payment_method'],
                'payment_status' => 'unpaid',
                'tracking_number' => Str::random(10), // Generate a tracking number
            ]);

            // Add each cart item to order_items
            foreach ($cart->cartItems as $item) {
                $order->orderItems()->create([
                    'product_id'    => $item->product_id,
                    'product_name'  => $item->product->name,
                    'price'         => $item->price,
                    'discount_price'=> $item->product->discount_price ?? null,
                    'quantity'      => $item->quantity,
                    'tax'           => 0, // Adjust if tax logic is implemented
                ]);

                // Decrease product stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear the cart after successful checkout
            $cart->delete();

            // Commit the transaction
            DB::commit();

            // Redirect to bank instruction page
            session(['bank_message' => 'Order successfully placed. Since you selected Bank method as payment method, please contact support for the Bank Details.']);
            return redirect()->route('checkout.bank')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Return back with error message
            return back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    public function bank()
    {
        $web = GeneralSetting::find(1);


        $dataView = [
            'siteName'  => $web->name,
            'web'       => $web,
            'pageName'  => "Bank Instruction",
        ];

        return view('home.bank', $dataView);
    }
}

