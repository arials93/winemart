@extends('store.layout.master')

@section('content')

@include('store.layout.component.wrap-page')

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper px-md-4">
                    
                    <div class="row no-gutters">
                        <div class="col-md-7">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Thông tin cá nhân</h3>                                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="name">Họ tên</label>
                                                <p>{{Auth::user()->name}}</p>
                                                
                                                {{-- <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Name"> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="email">Email</label>
                                                {{-- <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Email"> --}}
                                                <p>{{Auth::user()->email}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="#">Số điện thoại</label>
                                                {{-- <textarea name="message" class="form-control" id="message" cols="30"
                                                    rows="4" placeholder="Message"></textarea> --}}
                                                <p>
                                                    @if (is_null(Auth::user()->phone))
                                                        Chưa có
                                                    @else
                                                        {{Auth::user()->phone}}
                                                    @endif
                                                    
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="subject">Địa chỉ</label>
                                                {{-- <input type="text" class="form-control" name="subject" id="subject"
                                                    placeholder="Subject"> --}}
                                                <p>
                                                    @if (is_null(Auth::user()->phone))
                                                        Chưa có
                                                    @else
                                                        {{Auth::user()->phone}}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div>
                                                    @if (Route::has('password.request'))
                                                    <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                                        Đổi mật khẩu
                                                    </a>
                                                    @endif
                                                </div>   
                                                
                                                <a class="btn btn-primary" href="{{ route('store.account.edit') }}">
                                                    Đổi thông tin
                                                </a>
                                                <div class="submitting"></div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <div class="col-md-5 order-md-first d-flex align-items-stretch">
                            <div id="map" class="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
