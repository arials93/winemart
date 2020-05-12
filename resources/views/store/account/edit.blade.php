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
                                <h3 class="mb-4">Thay đổi thông tin cá nhân</h3>
                                <form method="POST" action="{{route('store.account.update')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="name">Họ tên</label>
                                                <input type="text" autofocus class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                                placeholder="Họ tên" value="{{old("name") ? old("name") : Auth::user()->name}}">

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="email">Email</label>
                                                <input class="form-control" disabled readonly id="email"
                                                    placeholder="Email" value="{{Auth::user()->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="phone">Số điện thoại</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
                                                    placeholder="Sô điện thoại" 
                                                    value="{{old("phone") ? old("phone") : Auth::user()->phone}}">
                                                
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="address">Địa chỉ</label>
                                                <textarea name="address" class="form-control" id="address" cols="30"
                                                    rows="3" placeholder="Địa chỉ">{{old("address") ? old("address") : Auth::user()->address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="Lưu thông tin" class="btn btn-primary">
                                                <div class="submitting"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
