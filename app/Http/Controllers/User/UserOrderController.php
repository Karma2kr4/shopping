<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Category;

class UserOrderController extends Controller
{
    public function index()
    {
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get(); 
        $user = Auth::user();
        $orders = Payment::where('user_id', $user->id)->get();
        return view('user.order.order', compact('categorysLimit', 'orders'));
    }

    public function show($id)
    {
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        $order = Payment::with('details')->findOrFail($id);

        return view('user.order.show', compact('categorysLimit','order'));
    }

    public function markAsReceived($id)
    {
        $order = Payment::findOrFail($id);

        $order->update(['approved' => Payment::STATUS_RECEIVED]);

        return redirect()->route('user.orders')->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }

    public function cancelOrder($id)
    {
        $order = Payment::findOrFail($id);

        $order->update(['approved' => Payment::STATUS_CANCELLED]);

        return redirect()->route('user.orders')->with('success', 'Đơn hàng đã bị hủy.');
    }
}
