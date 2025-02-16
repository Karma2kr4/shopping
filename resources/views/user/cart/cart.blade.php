@extends('user.layouts.master')

@section('title')
    <title>Home Page</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('users/home/home.css') }}">
@endsection

@section('js')
    <script src="{{ asset('users/home/home.js') }}"></script>
	<script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
	<script type="text/javascript" src="{{ asset('users/cart/cart.js') }}"></script>
@endsection


@section('content')
	<div class="cart-wrapper">
		@include('user.cart.components.cart_component')
	</div>
@endsection 

	