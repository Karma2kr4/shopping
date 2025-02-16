@extends('layouts.admin')
 
@section('title')
<title>Trang chủ</title>
@endsection
 
@section('content')

<div class="content-wrapper">
@include('partials.content-header', ['name' => 'Home', 'key' => ''])
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $totalOrders }}</h3>
              <p>Tổng số hóa đơn</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-6">
        <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ number_format($todayRevenue) }} VNĐ</h3>
              <p>Doanh thu hôm nay</p>
          </div>
          <div class="icon">
              <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection



