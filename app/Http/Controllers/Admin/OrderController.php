<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Orders',
            'user'     =>  $user,
            'orders'   => Order::with('user')->latest()->get()
        ];

        return view('admin.orders.index',$dataView);
    }
    //order detail
    public function orderDetail($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Order Details',
            'user'     =>  $user,
            'order'   => Order::with('user')->where('id',$id)->first()
        ];

        return view('admin.orders.detail',$dataView);
    }
    //delete
    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);

            // Delete associated order items
            $order->orderItems()->delete();

            // Delete the order itself
            $order->delete();

            return response()->json(['success' => true, 'message' => 'Order deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    //mark payment
    public function markPayment($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->update(['payment_status' => 'paid']);

            return response()->json(['success' => true, 'message' => 'Payment marked as successful.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    //mark completed
    public function markCompleted($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->update([
                'status' => 'completed',
                'shipped_at' => now()
            ]);

            return back()->with('success','Order marked as completed.');
        } catch (\Exception $e) {
            logger( $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

}
