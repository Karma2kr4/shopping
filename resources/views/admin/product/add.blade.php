@extends('layouts.admin')
 
@section('title')
<title>Thêm sản phẩm</title>
@endsection
 
@section('css')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style>
    .note-editable {
        font-family: 'Times New Roman', serif !important; /* Ghi đè font chữ */
        font-size: 15px !important; /* Ghi đè kích thước font chữ */
    }
</style>
@endsection

@section('content') 

<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Product', 'key' => 'Add'])
    <!-- <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div> -->
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" 
                                    name="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Nhập tên sản phẩm"
                                    value="{{ old('name') }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input type="text" 
                                    name="price" 
                                    class="form-control @error('price') is-invalid @enderror" 
                                    placeholder="Nhập giá sản phẩm"
                                    value="{{ old('price') }}">
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" 
                                    name="feature_image_path" 
                                    class="form-control-file">
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh chi tiết</label>
                            <input type="file" 
                                    multiple 
                                    name="image_path[]" 
                                    class="form-control-file">
                        </div>

                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="category_id" class="form-control select2_init @error('category_id') is-invalid @enderror" >
                                <option value="">Chọn danh mục</option>
                                {!! $htmlOption !!}
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Nhập tag cho sản phẩm</label>
                            <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                
                            </select>
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nhập nội dung</label>
                            <div class="summernote-wrapper @error('contents') is-invalid @enderror">
                                <div id="summernote"></div>
                                <input type="hidden" name="contents" id="content">
                            </div>
                            @error('contents')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>

<script src="{{ asset('admins/product/add/add.js') }}"></script>
<!-- Summer note -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Nhập nội dung vào đây...',
            tabsize: 2,
            height: 200,
            styleTags: [
                { tag: 'p', title: 'Paragraph' },
                { tag: 'blockquote', title: 'Quote' },
                { tag: 'h1', title: 'Header 1' },
                { tag: 'h2', title: 'Header 2' },
                { tag: 'h3', title: 'Header 3' }
            ],
            callbacks: {
                onInit: function() {
                    $('.note-editable').css({
                        'font-family': 'Times New Roman, serif',
                        'font-size': '15px'
                    });
                }
            }
        });

        // Thiết lập nội dung cũ nếu có
        var oldContent = @json(old('contents'));
        if (oldContent) {
            $('#summernote').summernote('code', oldContent);
        }

        // Lưu nội dung vào hidden input trước khi gửi form
        $('form').on('submit', function() {
            var markup = $('#summernote').summernote('code');
            $('#content').val(markup);
        });
    });
</script>

@endsection
