@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', [
    'main_text' => 'Tạo kích cỡ', 
    'btn_url' => '#', 
    'btn_text' => ''])
@endsection

@section('content')
<div class="kt-portlet">
    <!--begin::Form-->
    <form class="kt-form" method="POST" action="{{ route("manager.sizes.store") }}">
        @csrf
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <h3 class="kt-section__title">1. Thông tin kích cỡ:</h3>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Kích cỡ:</label>
                        <div class="col-lg-6">
                            <input type="text" name="capacity" value="{{ old('capacity') }}" class="form-control"
                                placeholder="Nhập kích cỡ sản phẩm">
                            <span class="form-text @error('capacity') text-danger @enderror">
                                @error('capacity') {{ $message }} @else {{ 'Vui lòng nhập kích cỡ sản phẩm' }} @enderror
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
                        <button type="submit" class="btn btn-success">Tạo</button>
                    <a href="{{ route('manager.sizes') }}" class="btn btn-secondary">Hủy bỏ</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>
@endsection
