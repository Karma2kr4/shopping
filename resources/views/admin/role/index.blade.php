@extends('layouts.admin')
 
@section('title')
<title>Danh sách vai trò</title>
@endsection

@section('css')

@endsection
 
@section('content')

<div class="content-wrapper">
@include('partials.content-header', ['name' => 'Roles', 'key' => 'List'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('roles.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th style="text-align: center;">Tên vai trò</th>
                                <th style="text-align: center;">Mô tả vai trò</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td scope="row">{{ $role->id }}</td>
                                <td style="text-align: center;">{{ $role->name }}</td>
                                <td style="text-align: center;">{{ $role->display_name }}</td>
                                <td style="text-align: center;">{{ $role->created_at }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('roles.edit', ['id' => $role->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="" data-url="{{ route('roles.delete', ['id' => $role->id]) }}" class="btn btn-danger action_delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $roles->links() }}
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

