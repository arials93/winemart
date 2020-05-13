@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', [
    'main_text' => 'Sửa quốc gia', 
    'btn_url' => route('manager.countries.create'), 
    'btn_text' => 'Thêm quốc gia'])
@endsection

@section('content')
@if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
<div class="kt-portlet">
    <!--begin::Form-->

    <form class="kt-form" method="POST" action="{{ route("manager.countries.update", $data->id) }}">
        @csrf
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <h3 class="kt-section__title">Thông tin quốc gia:</h3>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tên quốc gia:</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" value="{{ old('name') ?? $data->name }}" class="form-control"
                                placeholder="Nhập tên quốc gia">
                            <span class="form-text @error('name') text-danger @enderror">
                                @error('name') {{ $message }} @else {{ 'Vui lòng nhập tên quốc gia' }} @enderror
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
                    <a href="{{ route('manager.countries') }}" class="btn btn-secondary">Hủy bỏ</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>
@endsection
