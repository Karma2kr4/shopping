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
        <h2>Chi tiết hóa đơn #{{ $order->id }}</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->details as $detail)
                    <tr>
                        <td>{{ $detail->product_name }}</td>
                        <td><img src="{{ $detail->product_image }}" alt="{{ $detail->product_name }}" width="50"></td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->price) }} VNĐ</td>
                        <td>{{ number_format($detail->quantity * $detail->price) }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('user.orders') }}" style="margin-bottom: 20px;" class="btn btn-info">Quay lại</a>
    </div>
</section>
@endsection






	


	



