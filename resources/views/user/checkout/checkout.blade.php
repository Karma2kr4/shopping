@extends('user.layouts.master')

@section('title')
    <title>Home Page</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('users/home/home.css') }}">
@endsection

@section('js')
    <script src="{{ asset('users/home/home.js') }}"></script>
	<script src="{{ asset('users/cart/cart.js') }}"></script>
@endsection

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="review-payment">
            <h2>Xem lại và thanh toán</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image" style="text-align: center;">Ảnh </td>
                        <td class="description" style="text-align: center;">Tên sản phẩm</td>
                        <td class="price" style="text-align: center;">Price</td>
                        <td class="quantity" style="text-align: center;">Quantity</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPrice = 0; 
                    @endphp
                    @foreach($carts as $cartItem)
                        @php
                            $totalPrice += $cartItem->product->price * $cartItem->quantity;
                        @endphp
                        <tr>
                            <td class="cart_product">
                                <a href="">
                                    <img src="{{ $cartItem->product->feature_image_path }}" 
                                        style="width: 150px; height: 100px; object-fit: cover;" 
                                        alt="{{ $cartItem->product->name }}">
                                </a>
                            </td>
                            <td class="cart_description" style="text-align: center;">
                                <h4>{{ $cartItem->product->name }}</h4>
                            </td>
                            <td class="cart_price" style="text-align: center;">
                                <p>{{ number_format($cartItem->product->price) }} VNĐ</p>
                            </td>
                            <td class="cart_quantity" style="text-align: center;">
                                <p>{{ $cartItem->quantity }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ route('processPayment') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại:</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Ghi chú vận chuyển:</label>
                            <textarea class="form-control" id="message" name="message" placeholder="Ghi chú về đơn hàng của bạn, yêu cầu giao hàng đặc biệt" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Phương thức thanh toán:</label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="cod">Tiền mặt (COD)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default check_out">Thanh toán ngay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection






	


	



