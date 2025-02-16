@extends('layouts.admin')
 
@section('title')
<title>Trang chủ</title>
@endsection
<!-- css -->
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/role/add/add.css') }}">
@endsection
 
@section('content') 

<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Roles', 'key' => 'Add'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data" style="width: 100%;">
                    <div class="col-md-12">
                        @csrf
                        <div class="form-group">
                            <label>Tên vai trò</label>
                            <input type="text" name="name" 
                            class="form-control" 
                            placeholder="Nhập tên vai trò"
                            value="{{ old('name') }}">
                            
                        </div>   
                        
                        <div class="form-group">
                            <label>Mô tả vai trò</label>
                            <input type="text" name="display_name" 
                            class="form-control" 
                            placeholder="Nhập mô tả slider"
                            value="{{ old('display_name') }}">
                            <!-- <textarea 
                                name="description" 
                                class="form-control  @error('description') is-invalid @enderror" row="4">
                                {{ old('description') }}
                            </textarea> -->
                            
                        </div> 
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    <input type="checkbox" class="checkall">
                                    Check All
                                </label>
                            </div>
                            @foreach($permissionsParent as $permissionsParentItem)
                            <div class="card border-info mb-3 col-md-12">
                                <div class="card-header">
                                    <label>
                                        <input type="checkbox" value="" class="checkbox_wrapper">
                                    </label>
                                    Module {{ $permissionsParentItem->name }}
                                </div>
                                <div class="row">
                                @foreach($permissionsParentItem->permissionChildrent as $permissionChildrentItem)
                                    <div class="card-body text-info col-md-3">
                                        <h5 class="card-title">
                                            <label>
                                                <input type="checkbox" class="checkbox_childrent" name="permission_id[]" value="{{ $permissionChildrentItem->id }}">
                                            </label>
                                            {{ $permissionChildrentItem->name }}
                                        </h5>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-md">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- js -->
@section('js')
<script src="{{ asset('admins/role/add/add.js') }}"></script>
@endsection