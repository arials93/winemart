@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', [
    'main_text' => 'Sửa loại sản phẩm con', 
    'btn_url' => route('manager.sub-categories.create'), 
    'btn_text' => 'Thêm loại sản phẩm con'])
@endsection

@section('content')
@if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
<form class="row kt-form" method="POST" enctype="multipart/form-data" action="{{ route("manager.sub-categories.update", $sub_category->id) }}">
    @csrf
    <div class="col-md-4">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-section kt-section--first">
                    <h3 class="kt-section__title">1. Chọn hình ảnh:</h3>
                    <label class="kt-section__body">
                        <img width="100%" src="{{ Storage::url($sub_category->image) }}" id="review-img"/>
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
                    <h3 class="kt-section__title">2. Thông tin loại sản phẩm:</h3>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tên loại sản phẩm:</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" value="{{ old('name') ?? $sub_category->name }}" class="form-control"
                                    placeholder="Nhập tên loại sản phẩm">
                                <span class="form-text @error('name') text-danger @enderror">
                                    @error('name') {{ $message }} @else {{ 'Vui lòng nhập tên loại sản phẩm' }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Loại cha:</label>
                            <div class="col-lg-6">
                                <select name="cate_id" class="form-control">
                                    @foreach ($cates as $cate)
                                        <option @if (old("cate_id") == $cate->id || $cate->id == $sub_category->cate_id) selected @endif value="{{$cate->id}}">{{$cate->name}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text @error('cate_id') text-danger @enderror">
                                    @error('cate_id') {{ $message }} @else {{ 'Vui lòng chọn loại sản phẩm' }} @enderror
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
                            <button type="submit" class="btn btn-success">Chỉnh sửa</button>
                            <a href="{{ route('manager.sub-categories') }}" class="btn btn-secondary">Hủy bỏ</a>
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
    <script>
        review_img();
    </script>
@endpush
