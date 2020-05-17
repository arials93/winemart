@extends('manager.layout.master')

@php
    $route = '';
    if(!$data->comfirm) {
        $route = route("manager.orders.confirm", $data->id);
    }elseif($data->comfirm && !$data->delivery_date) {
        $route = route("manager.orders.delivery", $data->id);
    } elseif ($data->delivery_date) {
        $route = route("manager.orders.received", $data->id);
    }

@endphp

@section('content_head')
@include('manager.layout.component.subheader', [
    'main_text' => 'Chi tiết đơn hàng', 
    'btn_url' => '', 
    'btn_text' => ''])
@endsection

@section('content')
@if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
<div class="kt-portlet">
    <!--begin::Form-->

    <form class="kt-form" method="POST" action="{{ $route }}">
        @csrf
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <h3 class="kt-section__title">Chi tiết đơn hàng:</h3>
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Khách hàng: </label>
                        <div class="col-lg-6">
                            <input type="text" readonly disabled value="{{ $data->name  }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Số điện thoại: </label>
                        <div class="col-lg-6">
                            <input type="text" readonly disabled value="{{ $data->phone  }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Email: </label>
                        <div class="col-lg-6">
                            <input type="text" readonly disabled value="{{ $data->email  }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Địa chỉ: </label>
                        <div class="col-lg-6">
                            <textarea type="text" readonly disabled class="form-control">{{ $data->email  }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Ghi chú: </label>
                        <div class="col-lg-6">
                            <textarea type="text" readonly disabled class="form-control">{{ $data->note  }}</textarea>
                        </div>
                    </div>

                    @if ($data->delivery_date)
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Chọn ngày nhận hàng:</label>
                        <div class="col-lg-6">
                            <input type="date" name="receiving_date" @if($data->receiving_date) readonly disabled @endif
                                value="{{ $data->receiving_date ? $data->receiving_date->format('Y-m-d') : '' }}" class="form-control"
                                placeholder="Nhập Tên loại sản phẩm">
                            @if(!$data->receiving_date)
                            <span class="form-text @error('receiving_date') text-danger @enderror">
                                @error('receiving_date') {{ $message }} @else {{ 'Vui lòng chọn ngày nhận hàng' }} @enderror
                            </span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <h3 class="kt-section__title">2. Chi tiết đơn hàng:</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Barcode</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->details as $item)
                    <tr>
                        <th scope="row"> {{ $item->product->id }} </th>
                        <td><img width="120px" src="{{ Storage::url($item->product->image) }}"/></td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->product->barcode }}</td>
                        <td><a class="btn btn-info" href="{{ route('manager.products.edit', $item->product->id) }}"><i class="px-0 
                            flaticon-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-12">
                        @if($data->comfirm)
                            <a href="#" disabled class="btn btn-success disabled">Đơn hàng đã được xác nhận</a>    
                        @else
                            <button type="submit" class="btn btn-success">Xác nhận đơn hàng</button>
                        @endif

                        @if($data->delivery_date)
                            <a href="#" disabled class="btn btn-success disabled">Ngày giao hàng: {{$data->delivery_date->format('d-m-Y')}}</a>    
                        @elseif($data->comfirm)
                            <button type="submit" class="btn btn-success">Lập ngày giao</button>
                        @endif

                        @if($data->receiving_date && $data->delivery_date)
                            <a href="#" disabled class="btn btn-success disabled">Đơn hàng đã hoàn thành vào ngày: {{$data->receiving_date->format('d-m-Y')}}</a>    
                        @elseif(!$data->receiving_date && $data->delivery_date)
                            <button type="submit" class="btn btn-success">Lập ngày nhận hàng</button>
                        @endif

                        @if(!$data->receiving_date)
                            <a href="{{ route('manager.orders.delete', $data->id) }}" class="btn btn-secondary">Hủy đơn hàng</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>
@endsection
