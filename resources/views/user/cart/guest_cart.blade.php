@extends('user.layouts.master')

@section('title')
    <title>Giỏ hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('users/home/home.css') }}">
@endsection

@section('content')
<div class="container text-center" style="padding: 50px 0;">
    <h2>Bạn cần đăng nhập để xem giỏ hàng</h2>
    <p>Vui lòng nhấn vào nút bên dưới để đăng nhập.</p>
    <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
</div>
@endsection
