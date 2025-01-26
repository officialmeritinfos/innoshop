<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $customers = User::whereHas('orders')
        ->withCount('orders')
        ->withSum('orders', 'total_price')
        ->get()
            ->map(function ($customer) {
                $customer->orders_total = $customer->orders_sum_total_price ?? 0; // Alias for better readability
                return $customer;
            });

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'pageName'=>'Customers',
            'siteName'=>$web->name,
            'customers' => $customers,
        ];

        return view('admin.users.index',$dataView);
    }
    //details
    public function details($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $customer = User::with(['orders' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'pageName'=>'Customer Detail',
            'siteName'=>$web->name,
            'customer' => $customer,
        ];

        return view('admin.users.details',$dataView);
    }
}
