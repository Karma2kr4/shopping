<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol> 
        </div>
        
        <div class="table-responsive cart_info" >
            <table class="table table-condensed update_cart_url" data-url="{{ route('updateCart') }}">
                <thead>
                    <tr class="cart_menu">
                        <td style="text-align: center;" class="image">Ảnh</td>
                        <td style="text-align: center;" class="description">Tên sản phẩm</td>
                        <td style="text-align: center;" class="price">Price</td>
                        <td style="text-align: center;" class="quantity">Quantity</td>
                        <td style="text-align: center;" class="total">Total</td>
                        <td style="text-align: center;">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0; // Tính tổng số tiền một lần
                    @endphp

                    @foreach($carts as $cartItem)
                        @php
                            $total += $cartItem->product->price * $cartItem->quantity;
                        @endphp

                        <tr>
                            <td class="cart_product">
                                <a href="">
                                    <img src="{{ $cartItem->product->feature_image_path }}" 
                                        style="width: 150px; height: 100px; object-fit: cover;" 
                                        alt="">
                                </a>
                            </td>
                            <td style="text-align: center;" class="cart_description">
                                <h4><a href="">{{ Str::limit($cartItem->product->name, 18) }}</a></h4>
                                <p>{{ Str::limit($cartItem->product->name, 18) }}</p>
                            </td>
                            <td style="text-align: center;" class="cart_price">
                                <p>{{ number_format($cartItem->product->price) }} VNĐ</p>
                            </td>
                            <td class="cart_quantity" style="text-align: center;">
                                <div class="cart_quantity_button" style="display: inline-block;">
                                    <a class="cart_quantity_down" href=""> - </a>
                                    <input class="cart_quantity_input quantity" type="text" name="quantity" value="{{ $cartItem->quantity }}" data-id="{{ $cartItem->id }}" autocomplete="off" size="2">
                                    <a class="cart_quantity_up" href=""> + </a>
                                </div>
                            </td>
                            <td style="text-align: center;" class="cart_total">
                                <p class="cart_total_price">{{ number_format($cartItem->product->price * $cartItem->quantity) }} VNĐ</p>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                    <a href="javascript:void(0);" data-url="{{ route('deleteCart', ['id' => $cartItem->id]) }}"
                                    class="btn btn-danger action_delete">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <!-- Thêm nút Update ở cuối -->
            <div class="update-cart-btn" style="text-align: center; margin: 20px;">
                <button class="btn btn-info" id="updateCartBtn">Update Cart</button>
            </div>
        </div> 
    </div>
</section>
@include('user.cart.components.cart_information')
