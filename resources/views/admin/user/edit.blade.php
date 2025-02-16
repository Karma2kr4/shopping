@extends('layouts.admin')
 
@section('title')
<title>Sửa người dùng</title>
@endsection
<!-- css -->
@section('css')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins/user/add/add.css') }}" rel="stylesheet" />
@endsection
 
@section('content') 

<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'User', 'key' => 'Edit'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('users.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" name="name" 
                            class="form-control " 
                            placeholder="Nhập tên"
                            value="{{ $user->name }}">
                            
                        </div>   

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" 
                            class="form-control " 
                            placeholder="Nhập email"
                            value="{{ $user->email }}">
                            
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" 
                            class="form-control " 
                            placeholder="Nhập mật khẩu"
                            >
                            
                        </div>

                        <div class="form-group">
                            <label>Chọn chức năng</label>
                            <select name="role_id[]" class="form-control select2_init" multiple="multiple">
                                <option value=""></option>

                                @foreach($roles as $role)
                                    <option {{ $rolesOfUser->contains('id', $role->id) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
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
<!-- js -->
@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/user/add/add.js') }}"></script>
@endsection