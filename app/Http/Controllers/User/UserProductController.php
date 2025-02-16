<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\CartDeleteModelTrait;
use App\Traits\CartUpdateModelTrait;

class UserProductController extends Controller
{
    use CartDeleteModelTrait;
    use CartUpdateModelTrait;
    public function addToCart($id)
    {
        $user = Auth::user(); // Lấy người dùng đã đăng nhập
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại.'], 404);
        }

        if ($user) {
            // Kiểm tra xem sản phẩm đã có trong giỏ hàng của người dùng chưa
            $cartItem = CartItem::where('user_id', $user->id)
                                ->where('product_id', $id)
                                ->first();

            if ($cartItem) {
                // Nếu có thì tăng số lượng sản phẩm
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                // Nếu chưa có thì thêm sản phẩm mới
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $id,
                    'quantity' => 1,
                ]);
            }

            // Lấy tổng số lượng và giá trị giỏ hàng
            $cart = CartItem::where('user_id', $user->id)->get();
            $totalQuantity = $this->calculateTotalQuantity($cart);
            $totalPrice = $this->calculateTotalPrice($cart);

            return response()->json([
                'code' => 200,
                'message' => 'success',
                'totalQuantity' => $totalQuantity,
                'totalPrice' => $totalPrice,
            ], 200);
        } else {
            return response()->json(['message' => 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.'], 401);
        }
    }

    //show cart
    public function showCart()
    {
        if (!Auth::check()) {
            // Nếu chưa đăng nhập, chuyển hướng đến giao diện thông báo yêu cầu đăng nhập
            return view('user.cart.guest_cart'); 
        }

        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        $user = Auth::user();

        $carts = CartItem::where('user_id', $user->id)->with('product')->get();
        $total = $this->calculateTotalPrice($carts); // Tính toán tổng tiền giỏ hàng

        return view('user.cart.cart', compact('categorysLimit', 'carts', 'total')); // Truyền biến total vào view
    }


    //update cart
    public function updateCart(Request $request) {
        try {
            $cartItems = $request->input('cartItems');
            $totalQuantity = 0;
    
            foreach ($cartItems as $item) {
                // Lấy sản phẩm từ cơ sở dữ liệu
                $cartItem = CartItem::find($item['id']);
                if ($cartItem) {
                    // Cập nhật số lượng sản phẩm
                    $cartItem->quantity = $item['quantity'];
                    $cartItem->save();
    
                    $totalQuantity += $item['quantity'];
                }
            }
    
            // Render lại giao diện component giỏ hàng
            $carts = CartItem::all();
            $cartComponent = view('user.cart.components.cart_component', compact('carts'))->render();
    
            return response()->json([
                'code' => 200,
                'totalQuantity' => $totalQuantity,
                'cart_component' => $cartComponent
            ]);
    
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
    
            return response()->json([
                'code' => 500,
                'message' => 'Có lỗi xảy ra khi cập nhật giỏ hàng.'
            ]);
        }
    }
    

    // Phương thức deleteCart
    public function deleteCart($id)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Vui lòng đăng nhập để xóa sản phẩm khỏi giỏ hàng.',
                'code' => 401
            ], 401);
        }

        $user = Auth::user(); // Lấy thông tin người dùng hiện tại
        
        if ($user) {
            // Tìm sản phẩm trong giỏ hàng của người dùng
            $cartItem = CartItem::where('id', $id)->where('user_id', $user->id)->first();

            if (!$cartItem) {
                return response()->json([
                    'message' => 'Sản phẩm không thuộc giỏ hàng của bạn hoặc không tồn tại.',
                    'code' => 404
                ], 404);
            }

            try {
                // Xóa sản phẩm khỏi giỏ hàng
                $cartItem->delete();

                // Lấy danh sách giỏ hàng còn lại
                $carts = CartItem::where('user_id', $user->id)->with('product')->get();

                // Tính toán lại tổng tiền và số lượng
                $totalQuantity = $carts->sum('quantity');
                $totalPrice = $carts->sum(function ($item) {
                    return $item->product ? $item->product->price * $item->quantity : 0;
                });

                // Render lại view cart_information
                $cartComponent = view('user.cart.components.cart_component', compact('carts', 'totalPrice', 'totalQuantity'))->render();

                return response()->json([
                    'cart_component' => $cartComponent,
                    'totalQuantity' => $totalQuantity,
                    'totalPrice' => $totalPrice,
                    'code' => 200,
                ], 200);

            } catch (\Exception $e) {
                \Log::error('Message: ' . $e->getMessage() . ' --- Line: ' . $e->getLine());
                return response()->json([
                    'message' => 'Có lỗi xảy ra trong quá trình xóa sản phẩm.',
                    'code' => 500
                ], 500);
            }
        }

        return response()->json([
            'message' => 'Người dùng không tồn tại.',
            'code' => 404
        ], 404);
    }

    // Hàm tính tổng số lượng sản phẩm trong giỏ hàng
    private function calculateTotalQuantity($cart)
    {
        return $cart->sum('quantity');
    }

    private function calculateTotalPrice($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->product->price * $item->quantity; // Lấy giá sản phẩm từ quan hệ
        }
        return $total;
    }
}
