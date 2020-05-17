@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', [
    'main_text' => 'Danh sách đơn hàng',
    'btn_url' => '',
    'btn_text' => '']
)
@endsection

@section('content')
@if (session('msg'))
<div class="alert alert-success">
    {{ session('msg') }}
</div>
@endif
<div class="kt-portlet">
    <div class="kt-portlet__body">

        <!--begin::Section-->
        <div class="kt-section">
            <div class="kt-section__content">
                <div class="float-left">
                    <a href="{{route('manager.orders', 'new')}}" class="btn btn-outline-brand btn-square @if (Str::contains(url()->current(), '/new')) active @endif">Đơn hàng chờ xác nhận</a>
                    <a href="{{route('manager.orders', 'confirmed')}}" class="btn btn-outline-brand btn-square @if (Str::contains(url()->current(), '/confirmed')) active @endif">Đơn hàng đã xác nhận</a>
                    <a href="{{route('manager.orders', 'delivery')}}" class="btn btn-outline-brand btn-square @if (Str::contains(url()->current(), '/delivery')) active @endif">Đơn hàng đang giao</a>
                    <a href="{{route('manager.orders', 'received')}}" class="btn btn-outline-brand btn-square @if (Str::contains(url()->current(), '/received')) active @endif">Đơn hàng đã hoàn thành</a>
                </div>
                <div class="float-right">
                    <form method="GET" action="{{ route("manager.orders.search") }}">
                        <div class="form-group ">
                            <div class="input-group" data-toggle="kt-tooltip"
                            data-original-title="Tìm kiếm đơn theo tên khách hàng, email khách hàng, sđt khách hàng">
                                <input name="search" value="@if (request()->search){{request()->search}}@endif" type="text" class="form-control" placeholder="Tìm đơn hàng">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit"><i class="px-0 flaticon-search-1"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                        <tr>
                            <th scope="row"> {{ $item->id }} </th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <div class="kt-section__content">
                                    <a href="{{ route('manager.orders.edit', $item->id) }}" class="btn btn-info"><i
                                            class="px-0 flaticon-eye"></i></a>

                                    @if (!$item->receiving_date)
                                    <button data-target="#kt_modal_1_{{ $item->id }}" data-toggle="modal"
                                        class="btn btn-danger"><i class="px-0 flaticon-close"></i></button>

                                    <!--begin::Modal-->
                                    <div class="modal fade" id="kt_modal_1_{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form class="modal-content" method="POST"
                                                action="{{ route("manager.orders.delete", $item->id) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hủy đơn hàng</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <p>Bạn có chắc chắn muốn hủy đơn hàng này</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Không</button>
                                                    <button type="submit" class="btn btn-primary">Hủy</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!--end::Modal-->
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Không có đơn hàng nào<td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="float-right">{{ $data->appends(request()->query())->links() }}</div>
            </div>
        </div>
        <!--end::Section-->
    </div>
    <!--end::Form-->
</div>
@endsection
