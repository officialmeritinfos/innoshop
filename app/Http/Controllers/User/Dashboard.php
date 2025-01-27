<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\User;
use App\Notifications\InvestmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $completedOrdersCount = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $pendingOrdersCount = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'User Dashboard',
            'user' => $user,
            'web' => $web,
            'completedOrders' =>$completedOrdersCount,
            'pendingOrders' =>$pendingOrdersCount,
            'orders' => Order::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10),
        ];

        return view('user.dashboard',$dataView);
    }
    public function orders()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Your Orders',
            'user' => $user,
            'web' => $web,
        ];

        return view('user.orders',$dataView);
    }


}
