@extends('layouts.admin')
 
@section('title')
<title>Trang chủ</title>
@endsection
 
@section('content') 

<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Permission', 'key' => 'Add'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('permissions.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Chọn tên Module</label>
                            <select name="module_parent" class="form-control">
                                <option value="">Chọn tên Module</option>
                                @foreach(config('permissions.table_module') as $moduleItem)
                                    <option value="{{ $moduleItem }}">{{ $moduleItem }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                @foreach(config('permissions.module_childrent') as $moduleItemChildrent)
                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox"  value="{{ $moduleItemChildrent }}" name="module_chilrent[]">
                                            {{ $moduleItemChildrent }}
                                        </label>
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
</div>
@endsection