@extends('layouts.admin')
 
@section('title')
<title>Danh mục sản phẩm</title>
@endsection
 
@section('content')

<div class="content-wrapper">
@include('partials.content-header', ['name' => 'Category', 'key' => 'List'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                @can('category-add')
                    <a href="{{ route('categories.create') }}" class="btn btn-success float-right m-2">Add</a>
                @endcan
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tên danh mục</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td style="text-align: center;">{{ $category->created_at }}</td>
                                <td style="text-align: center;">
                                    @can('category-edit')
                                        <a href="{{ route('categories.edit', ['id' => $category->id]) }}" 
                                        class="btn btn-primary">Edit</a>
                                    @endcan
                                    @can('category-delete')
                                    <a href="{{ route('categories.delete', ['id' => $category->id]) }}" class="btn btn-danger">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



