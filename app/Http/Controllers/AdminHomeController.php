<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;

class AdminHomeController extends Controller
{
    public function index()
    {
        // Lấy tổng số hóa đơn
        $totalOrders = Payment::count();

        // Lấy doanh thu hôm nay
        $todayRevenue = Payment::whereDate('created_at', Carbon::today())->sum('total_price');

        return view('home', compact('totalOrders', 'todayRevenue'));
    }
}
