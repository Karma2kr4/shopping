@extends('layouts.admin')
 
@section('title')
<title>Danh sách người dùng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/index/index.css') }}">
@endsection
 
@section('content')

<div class="content-wrapper">
@include('partials.content-header', ['name' => 'User', 'key' => 'List'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('users.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th style="text-align: center;">Tên</th>
                                <th style="text-align: center;">Email</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td scope="row">{{ $user->id }}</td>
                                <td style="text-align: center;">{{ $user->name }}</td>
                                <td style="text-align: center;">{{ $user->email }}</td>
                                <td style="text-align: center;">{{ $user->created_at }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="" data-url="{{ route('users.delete', ['id' => $user->id]) }}" class="btn btn-danger action_delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $users->links() }}
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

