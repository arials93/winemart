@extends('store.layout.master')

@push('styles')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
@endpush

@section('content')

@include('store.layout.component.wrap-page',['page' => 'Thanh toán'])

<section class="ftco-section">
<form action="{{ route('store.cart.order') }}" method="POST" class="billing-form" class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 ftco-animate">
                <div class="billing-form" >
                    @csrf
                    <h3 class="mb-4 billing-heading">Chi tiết hóa đơn</h3>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Tên</label>
                                <input type="text" name="name" class="form-control"
                                value="@if(old('name')) {{old('name')}} @elseif(Auth::check()) {{ Auth::user()->name }} @endif"/>
                                <span class="form-text @error('name') text-danger @enderror">
                                    @error('name') {{ $message }} @else {{ 'Nhập họ tên' }} @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" 
                                value="@if(old('phone')) {{old('phone')}} @elseif(Auth::check()) {{ Auth::user()->phone }} @endif">
                                <span class="form-text @error('phone') text-danger @enderror">
                                    @error('phone') {{ $message }} @else {{ 'Nhập số điện thoại' }} @enderror
                                </span>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="emailaddress">Địa chỉ Email</label>
                                <input name="email" type="text" class="form-control" 
                                value="@if(old('email')) {{old('email')}} @elseif(Auth::check()) {{ Auth::user()->email }} @endif">
                                <span class="form-text @error('email') text-danger @enderror">
                                    @error('email') {{ $message }} @else {{ 'Nhập số địa chỉ email' }} @enderror
                                </span>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">Địa chỉ</label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <input type="text" name="address" class="form-control"
                                    value="@if(old('address')) {{old('address')}} @elseif(Auth::check()) {{ Auth::user()->address }} @endif">
                                    <span class="form-text @error('address') text-danger @enderror">
                                        @error('address') {{ $message }} @else {{ 'Nhập địa chỉ' }} @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea name="note" class="form-control"></textarea>
                                <span class="form-text @error('note') text-danger @enderror">
                                    @error('note') {{ $message }} @else {{ 'Nhập ghi chú' }} @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- END -->



                <div class="row mt-5 pt-3 d-flex">
                    <div class="col-md-6 d-flex">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Tổng thanh toán</h3>
                            <p class="d-flex">
                                <span>Phi giao hàng</span>
                                <span>0 VND</span>
                            </p>

                            <hr>
                            <p class="d-flex total-price">
                                <span>Tổng tiền</span>
                                <span>{{ number_format(\Cart::getTotal())}} VND</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Phương thức thanh toán</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            Hiện tải của hàng chỉ hỗ trợ thanh toán:
                                            <br/>
                                            - Thanh toán qua tài khoản khi nhân viên gọi xác nhận đơn hàng.
                                            <br/>
                                            - Thanh toán tại cửa hàng.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <p><button type="submit" class="btn btn-primary py-3 px-4">Đặt hàng</button></p>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-md-8 -->
        </div>
    </form>
</section>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endpush
