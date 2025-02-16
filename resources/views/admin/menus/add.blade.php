@extends('layouts.admin')
 
@section('title')
<title>Thêm menu</title>
@endsection
 
@section('content') 

<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Menus', 'key' => 'Add'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('menus.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Tên menus</label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên menu">
                        </div>    
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">Chọn menu</option>
                                {!! $optionSelect !!}
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-info btn-md">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection