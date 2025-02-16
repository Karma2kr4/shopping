@extends('layouts.admin')
 
@section('title')
<title>Slider</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/index/index.css') }}">
@endsection
 
@section('content')

<div class="content-wrapper">
@include('partials.content-header', ['name' => 'Slider', 'key' => 'List'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('slider.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th style="text-align: center;">Tên slider</th>
                                <th style="text-align: center;">Mô tả</th>
                                <th style="text-align: center;">Hình ảnh</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td scope="row">{{ $slider->id }}</td>
                                <td style="text-align: center;">{{ $slider->name }}</td>
                                <td style="text-align: center;">{{ $slider->description }}</td>
                                <td style="text-align: center;">
                                <img class="image_slider_150_100" src="{{ $slider->image_path }}" alt="">
                                    
                                </td>
                                <td style="text-align: center;">{{ $slider->created_at }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('slider.edit', ['id' => $slider->id]) }}" class="btn btn-primary">Edit</a>
                                    <a href="" data-url="{{ route('slider.delete', ['id' => $slider->id]) }}" class="btn btn-danger action_delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $sliders->links() }}
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

