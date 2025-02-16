@extends('layouts.admin')
 
@section('title')
<title>Danh sách hóa đơn</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/index/index.css') }}">
@endsection
 
@section('content')

<div class="content-wrapper">
@include('partials.content-header', ['name' => 'Danh sách', 'key' => 'hóa đơn'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mã hóa đơn</th>
                                <th>Ngày đặt</th>
                                <th style="text-align: center;">Tổng tiền</th>
                                <th style="text-align: center;">Trạng thái</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td style="text-align: center;">{{ number_format($order->total_price) }} VNĐ</td>
                                    <td style="text-align: center;">{{ \App\Models\Payment::getStatusText($order->approved) }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">Chi tiết</a>
                                        @if($order->approved == \App\Models\Payment::STATUS_PENDING)
                                            <form action="{{ route('orders.approve', $order->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Duyệt</button>
                                            </form>
                                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hủy</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
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

