@extends('layouts.admin')
 
@section('title')
<title>Danh sách người dùng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/index/index.css') }}">
@endsection
 
@section('content')

<div class="content-wrapper">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" style="margin: 20px 5px;">
                    <h2>Chi tiết hóa đơn #{{ $order->id }}</h1>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderDetails as $detail)
                                <tr>
                                    <td>{{ $detail->product_name }}</td>
                                    <td><img src="{{ $detail->product_image }}" alt="{{ $detail->product_name }}" style="width: 150px;
    height: 100px;
    object-fit: cover;"></td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ number_format($detail->price) }} VNĐ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 

                    <a href="{{ route('orders.index') }}" class="btn btn-primary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

