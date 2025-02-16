@extends('layouts.admin')
 
@section('title')
<title>Thêm danh mục</title>
@endsection
 
@section('content') 

<div class="content-wrapper">
@include('partials.content-header', ['name' => 'Category', 'key' => 'Add'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" name="name" class="form-control" 
                            placeholder="Nhập tên danh mục">
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">Chọn danh mục</option>
                                {!! $htmlOption !!}
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



