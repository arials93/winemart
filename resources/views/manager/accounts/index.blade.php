@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', ['main_text' => 'Danh sách tài khoản', 'btn_url' =>
route('manager.account.create'), 'btn_text' => 'Thêm tài khoản mới'])
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
                <div class="float-right">
                    <form method="GET" action="{{ route("manager.account") }}">
                        <div class="form-group ">
                            <div class="input-group">
                                <input name="search" value="@if (request()->search){{request()->search}}@endif" type="text" class="form-control" placeholder="Tìm tài khoản">
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
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>                            
                        @forelse ($users as $user)
                        <tr>
                            <th scope="row"> {{ $user->id }} </th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <div class="kt-section__content">
                                    <a href="{{ route('manager.account.edit', $user->id) }}" class="btn btn-info"><i
                                            class="px-0 flaticon-edit"></i></a>
                                    <button data-target="#kt_modal_1_{{ $user->id }}" data-toggle="modal"
                                        class="btn btn-danger"><i class="px-0 flaticon2-trash"></i></button>

                                    <!--begin::Modal-->
                                    <div class="modal fade" id="kt_modal_1_{{ $user->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form class="modal-content" method="POST"
                                                action="{{ route("manager.account.delete", $user->id) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa tài khoản</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <p>Bạn có chắc chắn muốn xóa tài khoản này</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Hủy bỏ</button>
                                                    <button type="submit" class="btn btn-primary">Xóa</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!--end::Modal-->
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">Không có tài khoản nào<td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="float-right">{{ $users->appends(request()->query())->links() }}</div>
            </div>
        </div>
        <!--end::Section-->
    </div>
    <!--end::Form-->
</div>
@endsection
