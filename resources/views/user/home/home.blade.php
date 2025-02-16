@extends('user.layouts.master')

@section('title')
    <title>Home Page</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('users/home/home.css') }}">
@endsection

@section('js')
	<!-- call ajax giỏ hàng -->
	<script src="{{ asset('users/cart/cart.js') }}"></script>
    <script src="{{ asset('users/home/home.js') }}"></script>
@endsection

@section('content')

	<!--slider-->
	@include('user.home.components.slider')
    
	<section>
		<div class="container">
			<div class="row">
            @include('user.components.sidebar')
				
				<div class="col-sm-9 padding-right">

					<!--features_items-->
					@include('user.home.components.feature_product')

					<!--category-tab-->
					@include('user.home.components.category_tab')

					<!--recommended_items-->
					@include('user.home.components.recommend_product')

				</div>
			</div>
		</div>
	</section>
	
	
@endsection




