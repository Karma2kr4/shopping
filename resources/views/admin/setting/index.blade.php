@extends('layouts.admin')
 
@section('title')
<title>Settings</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/setting/index/index.css') }}">
@endsection
 
@section('content')

<div class="content-wrapper">
@include('partials.content-header', ['name' => 'Settings', 'key' => 'List'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group float-right">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Add Setting
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('settings.create') . '?type=Text' }}">Text</a>
                            <a class="dropdown-item" href="{{ route('settings.create') . '?type=Textarea' }}">Textarea</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Key</th>
                                <th>Value</th>
                                <th style="text-align: center;">Created Date</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($settings as $setting)
                            <tr>
                                <td scope="row">{{ $setting->id }}</td>
                                <td>{{ $setting->config_key }}</td>
                                <td>{{ $setting->config_value }}</td>
                                <td style="text-align: center;">{{ $setting->created_at }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('settings.edit', ['id' => $setting->id]) . '?type=' . $setting->type }}" class="btn btn-primary">Edit</a>
                                    <a href="" data-url="{{ route('settings.delete', ['id' => $setting->id]) }}" class="btn btn-danger action_delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $settings->links() }}
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