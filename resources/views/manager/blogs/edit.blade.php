@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', [
    'main_text' => 'Chi tiết bài viết', 
    'btn_url' => route('manager.blogs.create'),
    'btn_text' => 'Thêm bài viết'])
@endsection

@push('styles')
<link href="assets/plugins/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />   
@endpush


@section('content')
@if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
<form class="row kt-form" method="POST" enctype="multipart/form-data" action="{{ route("manager.blogs.update", $blog->id) }}">
    @csrf
    <div class="col-md-4">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-section kt-section--first">
                    <h3 class="kt-section__title">1. Chọn hình ảnh:</h3>
                    <label class="kt-section__body">
                        <img width="100%" src="{{ Storage::url($blog->image) }}" id="review-img"/>
                        <input type="file" id="take-img" name="image" hidden/>
                    </label>
                    <p class="form-text @error('image') text-danger @enderror text-center">
                        @error('image') {{ $message }} @else {{ 'Vui lòng chọn hình ảnh' }}
                        @enderror
                    </p>
                </div>
            </div>
            
            <!--end::Form-->
        </div>
    </div>
    <div class="col-md-8">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-section kt-section--first">
                    <h3 class="kt-section__title">2. Thông tin bài viết:</h3>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tên bài viết:</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" value="{{ old('name') ?? $blog->name }}" class="form-control"
                                    placeholder="Nhập tên bài viết">
                                <span class="form-text @error('name') text-danger @enderror">
                                    @error('name') {{ $message }} @else {{ 'Vui lòng nhập tên bài viết' }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Mô tả ngắn:</label>
                            <div class="col-lg-6">

                                <textarea type="text" name="sub_des" class="form-control"
                                    placeholder="Nhập mô tả ngắn">{{ old('sub_des') ?? $blog->sub_des}}</textarea>
                                <span class="form-text @error('sub_des') text-danger @enderror">
                                    @error('sub_des') {{ $message }} @else {{ 'Vui lòng nhập mô tả ngắn' }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nội dung bài viết:</label>
                            <div class="col-lg-6">

                                <textarea type="text" name="description" class="form-control summernote"
                                    placeholder="Nhập nội dung">{!! old('description') ?? $blog->description !!}</textarea>
                                <span class="form-text @error('description') text-danger @enderror">
                                    @error('description') {{ $message }} @else {{ 'Vui lòng nhập nội dung' }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Loại bài viết:</label>
                            <div class="col-lg-6">
                                <select name="cateblog_id" class="form-control">
                                    @foreach ($blog_cates as $blog_cate)
                                    <option
                                    @if(old('cateblog_id') == $blog_cate->id || $blog->cateblog_id == $blog_cate->id && !old('cateblog_id')) selected @endif
                                    value="{{$blog_cate->id}}">{{$blog_cate->name}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text @error('cateblog_id') text-danger @enderror">
                                    @error('cateblog_id') {{ $message }} @else {{ 'Vui lòng chọn loại bài viết' }} @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                            <a href="{{ route('manager.blogs') }}" class="btn btn-secondary">Hủy bỏ</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Form-->
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script src="assets/plugins/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script>
    review_img();

    $('.summernote').summernote({
        height: 150
    });
</script>
@endpush