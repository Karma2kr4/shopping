@extends('layouts.admin')
 
@section('title')
<title>Thêm Setting</title>
@endsection
 
@section('css')
<style>
    
</style>
@endsection

@section('content') 

<div class="content-wrapper">
@include('partials.content-header', ['name' => 'Settings', 'key' => 'Add'])
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('settings.store') . '?type=' . request()->type }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label>Key</label>
                            <input type="text" name="config_key" class="form-control @error('config_key') is-invalid @enderror" 
                            placeholder="Nhập tên key">
                            @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(request()->type === 'Text')
                            <div class="form-group">
                                <label>Value</label>
                                <input type="text" name="config_value" class="form-control @error('config_value') is-invalid @enderror" 
                                placeholder="Nhập tên value">
                                @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @elseif(request()->type === 'Textarea')
                            <div class="form-group">
                                <label>Value</label>
                                <textarea
                                    name="config_value" 
                                    class="form-control @error('config_value') is-invalid @enderror" 
                                    row="5">
                                </textarea>
                                @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                        @endif
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



