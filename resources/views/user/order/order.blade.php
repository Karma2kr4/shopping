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
        <h2>Hóa đơn của bạn</h2>
        @if($orders->isEmpty())
            <p>Bạn chưa có hóa đơn nào.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ number_format($order->total_price) }} VNĐ</td>
                            <td>{{ \App\Models\Payment::getStatusText($order->approved) }}</td>
                            <td style="text-align: center;">
                            <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-info">Chi tiết</a>
                            @if($order->approved == \App\Models\Payment::STATUS_PENDING)
                                <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Hủy đơn hàng</button>
                                </form>
                            @elseif($order->approved == \App\Models\Payment::STATUS_APPROVED)
                                <form action="{{ route('user.orders.received', $order->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Đã nhận</button>
                                </form>
                                <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Hủy đơn hàng</button>
                                </form>
                            @endif
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</section>
@endsection






	


	



