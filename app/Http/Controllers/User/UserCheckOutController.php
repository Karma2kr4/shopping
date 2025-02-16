<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Payment;
use App\Models\PaymentDetail;

class UserCheckOutController extends Controller
{
    public function checkOut() 
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thực hiện thanh toán.');
        }
    
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        $user = Auth::user();
        $carts = CartItem::where('user_id', $user->id)->with('product')->get();
    
        return view('user.checkout.checkout', compact('categorysLimit', 'carts'));
    }

    public function processPayment(Request $request)
    {
        $user = Auth::user();
        $carts = CartItem::where('user_id', $user->id)->with('product')->get();
        $totalPrice = 0;

        foreach ($carts as $cartItem) {
            $totalPrice += $cartItem->product->price * $cartItem->quantity;
        }

        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->total_price = $totalPrice;
        $payment->name = $request->name;
        $payment->address = $request->address;
        $payment->phone = $request->phone;
        $payment->message = $request->message;
        $payment->save();

        foreach ($carts as $cartItem) {
            $paymentDetail = new PaymentDetail();
            $paymentDetail->payment_id = $payment->id;
            $paymentDetail->product_name = $cartItem->product->name;
            $paymentDetail->product_image = $cartItem->product->feature_image_path;
            $paymentDetail->quantity = $cartItem->quantity;
            $paymentDetail->price = $cartItem->product->price;
            $paymentDetail->save();
        }

        // Clear the cart after payment
        CartItem::where('user_id', $user->id)->delete();

        return redirect()->route('home')->with('success', 'Đặt hàng thành công.');
    }
}