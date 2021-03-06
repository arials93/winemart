@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', [
    'main_text' => 'Sửa loại bài viết', 
    'btn_url' => route('manager.blog-categories.create'), 
    'btn_text' => 'Thêm loại bài viết'])
@endsection

@section('content')
@if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
<div class="kt-portlet">
    <!--begin::Form-->

    <form class="kt-form" method="POST" action="{{ route("manager.blog-categories.update", $data->id) }}">
        @csrf
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <h3 class="kt-section__title">Thông tin loại bài viết:</h3>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tên loại bài viết:</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" value="{{ old('name') ?? $data->name }}" class="form-control"
                                placeholder="Nhập loại bài viết">
                            <span class="form-text @error('name') text-danger @enderror">
                                @error('name') {{ $message }} @else {{ 'Vui lòng nhập tên loại bài viết' }} @enderror
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
                    <a href="{{ route('manager.blog-categories') }}" class="btn btn-secondary">Hủy bỏ</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>
@endsection
