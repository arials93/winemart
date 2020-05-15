@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', [
    'main_text' => 'Danh sách bài viết',
    'btn_url' => route('manager.blogs.create'),
    'btn_text' => 'Thêm bài viết']
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
                <div class="float-right">
                    <form method="GET" action="{{ route("manager.blogs") }}">
                        <div class="form-group ">
                            <div class="input-group" data-toggle="kt-tooltip"
                            data-original-title="Tìm kiếm bài viết theo tên, mô tả ngắn, nội dung, tác giả, loại bài viết">
                                <input name="search" value="@if (request()->search){{request()->search}}@endif" type="text" class="form-control" placeholder="Tìm bài viết">
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
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th>Mô tả ngắn</th>
                            <th>Loại bài viết</th>
                            <th>Tác giả</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $blog)
                        <tr>
                            <th scope="row"> {{ $blog->id }} </th>
                            <td>
                                <img width="120px" src="{{ Storage::url($blog->image) }}"/>
                            </td>
                            <td>{{ $blog->name }}</td>
                            <td>{{ $blog->sub_des }}</td>
                            <td>{{ $blog->blog_category->name }}</td>
                            <td>{{ $blog->user->name }}</td>
                            <td>
                                <div class="kt-section__content">
                                    <a href="{{ route('manager.blogs.edit', $blog->id) }}" class="btn btn-info"><i
                                            class="px-0 flaticon-edit"></i></a>
                                    <button data-target="#kt_modal_1_{{ $blog->id }}" data-toggle="modal"
                                        class="btn btn-danger"><i class="px-0 flaticon2-trash"></i></button>

                                    <!--begin::Modal-->
                                    <div class="modal fade" id="kt_modal_1_{{ $blog->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form class="modal-content" method="POST"
                                                action="{{ route("manager.blogs.delete", $blog->id) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa bài viết</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <p>Bạn có chắc chắn muốn xóa bài viết này</p>
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
                            <td colspan="6">Không có bài viết nào<td>
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
