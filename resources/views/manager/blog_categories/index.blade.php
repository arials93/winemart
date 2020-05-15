@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', ['main_text' => 'Danh sách loại bài viết', 'btn_url' =>
route('manager.blog-categories.create'), 'btn_text' => 'Thêm loại bài viết'])
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
                    <form method="GET" action="{{ route("manager.blog-categories") }}">
                        <div class="form-group ">
                            <div class="input-group">
                                <input name="search" value="@if (request()->search){{request()->search}}@endif" type="text" class="form-control" placeholder="Tìm loại bài viết">
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
                            <th>Tên</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $blog_cate)
                        <tr>
                            <th scope="row"> {{ $blog_cate->id }} </th>
                            <td>{{ $blog_cate->name }}</td>
                            <td>
                                <div class="kt-section__content">
                                    <a href="{{ route('manager.blog-categories.edit', $blog_cate->id) }}" class="btn btn-info"><i
                                            class="px-0 flaticon-edit"></i></a>
                                    <button data-target="#kt_modal_1_{{ $blog_cate->id }}" data-toggle="modal"
                                        class="btn btn-danger"><i class="px-0 flaticon2-trash"></i></button>

                                    <!--begin::Modal-->
                                    <div class="modal fade" id="kt_modal_1_{{ $blog_cate->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form class="modal-content" method="POST"
                                                action="{{ route("manager.blog-categories.delete", $blog_cate->id) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa loại bài viết</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <p>Bạn có chắc chắn muốn xóa loại bài viết này</p>
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
                            <td colspan="5">Không có loại sản phẩm nào<td>
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
