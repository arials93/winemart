@extends('manager.layout.master')

@section('content_head')
    @include('manager.layout.component.subheader', [
            'main_text' => 'Nhật ký hoạt động', 
            'btn_url' => '#', 
            'btn_text' => ''
            ])
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
                    <form method="GET" action="{{ route("manager.activities") }}">
                        <div class="form-group ">
                            <div class="input-group">
                                <input name="search" value="@if (request()->search){{request()->search}}@endif" type="text" class="form-control" placeholder="Tìm nhật ký hoạt động">
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
                            <th>Tài khoản</th>
                            <th>Ngày hoạt động</th>
                            <th>Nội dung hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $activity)
                        <tr>
                            <th scope="row"> {{ $activity->id }} </th>
                            <td>{{ $activity->user->name }}</td>
                            <td>{{date_format($activity->created_at,'d/m/Y | H:i:s')}}</td>
                            <td>{!! $activity->content !!}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">Không có nhật ký hoạt động nào<td>
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
