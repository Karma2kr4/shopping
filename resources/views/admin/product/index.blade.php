@extends('layouts.admin')
 
@section('title')
<title>Danh sách sản phẩm</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/product/index/list.css') }}">
<link rel="stylesheet" href="{{ asset('admins/main.css') }}">
@endsection

 
@section('content') 

<div class="content-wrapper">
@include('partials.content-header', ['name' => 'Product', 'key' => 'List'])
    <div  class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('product.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th style="text-align: center;">Tên sản phẩm</th>
                                <th style="text-align: center;">Hình ảnh</th>
                                <th style="text-align: center;">Giá</th>
                                <th style="text-align: center;">Danh mục</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $productItem)
                            <tr>
                                <td scope="row">{{ $productItem->id }}</td> 
                                <td >{{ $productItem->name }}</td>
                                <td style="text-align: center;"><img class="product_image_150_100" src="{{ $productItem->feature_image_path }}" alt=""></td>
                                <td style="text-align: center;">{{ number_format($productItem->price) }}</td>
                                <td style="text-align: center;">{{ optional($productItem->category)->name }}</td> <!-- optional thêm vào để trả về null khi không có danh mục đó -->
                                <td style="text-align: center;">{{ $productItem->created_at }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('product.edit', ['id' => $productItem->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="" data-url="{{ route('product.delete', ['id' => $productItem->id]) }}" class="btn btn-danger action_delete">Delete</a> 
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12" >
                    {{ $products->links() }}
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


