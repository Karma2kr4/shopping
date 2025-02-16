@extends('layouts.admin')
 
@section('title')
<title>Menu</title>
@endsection
 
@section('content')

<div class="content-wrapper">
@include('partials.content-header', ['name' => 'Menus', 'key' => 'List'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('menus.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th style="text-align: center;">Tên menu</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td scope="row">{{ $menu->id }}</td>
                                <td >{{ $menu->name }}</td>
                                <td style="text-align: center;">{{ $menu->created_at }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('menus.edit', ['id' => $menu->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('menus.delete', ['id' => $menu->id]) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $menus->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


