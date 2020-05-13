@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', ['main_text' => 'Tạo tài khoản', 'btn_url' => '#', 'btn_text' => ''])
@endsection

@section('content')
<div class="kt-portlet">
    <!--begin::Form-->
    <form class="kt-form" method="POST" action="{{ route("manager.account.store") }}">
        @csrf
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <h3 class="kt-section__title">1. Thông tin tài khoản:</h3>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Họ & Tên:</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                placeholder="Nhập Họ & Tên">
                            <span class="form-text @error('name') text-danger @enderror">
                                @error('name') {{ $message }} @else {{ 'Vui lòng nhập họ và tên' }} @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Số điện thoại:</label>
                        <div class="col-lg-6">
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                placeholder="Nhập số điện thoại">
                            <span class="form-text @error('phone') text-danger @enderror">
                                @error('phone') {{ $message }} @else {{ 'Vui lòng nhập số điện thoại' }} @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Địa chỉ:</label>
                        <div class="col-lg-6">
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control"
                                placeholder="Nhập địa chỉ">
                            <span class="form-text text-muted">Vui lòng nhập địa chỉ</span>
                        </div>
                    </div>
                </div>
                <h3 class="kt-section__title">2. Thông tin đăng nhập:</h3>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Email:</label>
                        <div class="col-lg-6">
                            <input type="text" value="{{ old('email') }}" name="email" class="form-control"
                                placeholder="Nhập Email">
                            <span class="form-text @error('email') text-danger @enderror">
                                @error('email') {{ $message }} @else {{ 'Vui lòng nhập Email' }} @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Cấp quyền quản trị</label>
                        <div class="col-lg-6">
                            <div class="kt-radio-inline">
                                <label class="kt-radio kt-radio--bold kt-radio--success">
                                    <input type="radio" value="true" {{ old('is_Admin') == '0' ? '' : 'checked' }} checked name="is_Admin"> Quản trị viên
                                    <span></span>
                                </label>
                                <label class="kt-radio kt-radio--bold kt-radio--brand">
                                <input type="radio" value="false" {{ old('is_Admin') == '0' ? 'checked' : '' }} name="is_Admin"> Tài khoản thường
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Mật khẩu:</label>
                        <div class="col-lg-6">
                            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
                            <span class="form-text @error('password') text-danger @enderror">
                                @error('password') {{ $message }} @else {{ 'Vui lòng nhập mật khẩu' }} @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Xác nhận mật khẩu:</label>
                        <div class="col-lg-6">
                            <input type="password" name="re-password" class="form-control"
                                placeholder="Nhập lại mật khẩu">
                            <span class="form-text @error('re-password') text-danger @enderror">
                                @error('re-password') {{ $message }} @else {{ 'Vui lòng nhập lại mật khẩu' }} @enderror
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
                    <a href="{{ route('manager.account') }}" class="btn btn-secondary">Hủy bỏ</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>
@endsection
