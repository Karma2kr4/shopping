@extends('user.layouts.master')

@section('title')
    <title>Home Page</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('users/home/home.css') }}">
@endsection

@section('js')
    <script src="{{ asset('users/home/home.js') }}"></script>
@endsection

@section('content')
	
	<section>
		<div class="container">
			<div class="row">
				<!-- sidebar -->
                @include('user.components.sidebar')
				
				<div class="col-sm-9 padding-right">
					<div class="features_items">
						<h2 class="title text-center">Features Items</h2>
                        @foreach($products as $product)    
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ $product->feature_image_path }}" alt="" />
                                            <h2>{{ number_format( $product->price ) }} VNĐ</h2>
                                            <p>{{ $product->name }}</p>
                                            <a href="#" data-url="{{ route('addToCart', ['id' => $product->id]) }}"
                                            class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </a>
                                        </div> 
                                    </div>
                                </div>
                            </div>
						@endforeach

                        {{ $products->links() }}
                        
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

	