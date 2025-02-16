<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Payment::paginate(10); // Sử dụng paginate thay vì all
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Payment $order)
    {
        $orderDetails = PaymentDetail::where('payment_id', $order->id)->get();
        return view('admin.orders.show', compact('order', 'orderDetails'));
    }

    public function approve(Payment $order)
    {
        $order->approved = Payment::STATUS_APPROVED;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Hóa đơn đã được duyệt.');
    }

    public function cancel(Payment $order)
    {
        $order->approved = Payment::STATUS_CANCELLED;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã bị hủy.');
    }

    public function destroy(Payment $order)
    {
        if ($order->approved == Payment::STATUS_APPROVED) {
            return redirect()->route('orders.index')->with('error', 'Không thể xóa hóa đơn đã được duyệt.');
        }

        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Hóa đơn đã được xóa.');
    }
}