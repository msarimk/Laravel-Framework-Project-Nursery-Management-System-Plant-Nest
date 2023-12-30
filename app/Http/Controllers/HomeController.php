<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentMonthFirstDay = Carbon::now()->startOfMonth();
        $currentMonthLastDay = Carbon::now()->endOfMonth();
        $previousMonth = Carbon::now()->subMonth()->format('Y-m');
        $previousYear = $currentMonthFirstDay->copy()->subYear();
        $currentYear = Carbon::now();
        $currentYear = $currentYear->startOfYear();

        $previousYearAsOnlyYear = $previousYear->format('Y');
        $currentYearAsOnlyYear = $currentYear->format('Y');

        $previousYearTotal = (int) DB::table('orders')->where('is_delivered',1)
            ->whereYear('updated_at', $previousYear->year)->sum('total_amount');

        $currentYearTotal = (int) DB::table('orders')->where('is_delivered',1)
            ->whereYear('updated_at', $currentYear)->sum('total_amount');

        // dd($currentYearTotal);

        $previousMonthTotal = (int) DB::table('orders')->where('is_delivered',1)
            ->where(DB::raw('DATE_FORMAT(updated_at, "%Y-%m")'), $previousMonth)
            ->sum('total_amount');

        $currentMonthTotal = (int) Order::where('is_delivered',1)->whereBetween('updated_at', [$currentMonthFirstDay, $currentMonthLastDay])->sum('total_amount');
            // dd($currentMonthSale);
        $growthPercentage = ($previousMonthTotal != 0) ? round((($currentMonthTotal - $previousMonthTotal) / $previousMonthTotal) * 100) : 0;
            // dd($growthPercentage);
        $orders = Order::whereBetween('order_date', [$currentMonthFirstDay, $currentMonthLastDay])->count();
        $all_orders = Order::count();
        $sales = (int) Order::where('is_delivered',1)->sum('total_amount');
        $delivered_orders = Order::where('is_delivered',1)->count();
        $users = User::where('is_admin',0)->count();

        // dd($orders);

        // dd($orders);
        return view('admin.dashboard',compact(
            'orders',
            'all_orders',
            'sales',
            'delivered_orders',
            'users',
            'growthPercentage',
            'previousYearAsOnlyYear',
            'currentYearAsOnlyYear',
            'previousYearTotal',
            'currentYearTotal'
        ));
    }
}
