@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', [
    'main_text' => 'Tạo sản phẩm', 
    'btn_url' => '#',
    'btn_text' => ''])
@endsection

@section('content')
<form class="row kt-form" method="POST" enctype="multipart/form-data" action="{{ route("manager.products.store") }}">
    @csrf
    <div class="col-md-4">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-section kt-section--first">
                    <h3 class="kt-section__title">1. Chọn hình ảnh:</h3>
                    <label class="kt-section__body">
                        <img width="100%" src="{{ asset('manager/assets/media/sample.jpg') }}" id="review-img"/>
                        <input type="file" id="take-img" name="image" hidden/>
                    </label>
                    <p class="form-text @error('image') text-danger @enderror text-center">
                        @error('image') {{ $message }} @else {{ 'Vui lòng chọn hình ảnh' }}
                        @enderror
                    </p>
                </div>
            </div>
            
            <!--end::Form-->
        </div>
    </div>
    <div class="col-md-8">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-section kt-section--first">
                    <h3 class="kt-section__title">2. Thông tin sản phẩm:</h3>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tên sản phẩm:</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    placeholder="Nhập tên sản phẩm">
                                <span class="form-text @error('name') text-danger @enderror">
                                    @error('name') {{ $message }} @else {{ 'Vui lòng nhập tên sản phẩm' }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Mã vạch:</label>
                            <div class="col-lg-6">
                                <input type="text" name="barcode" value="{{ old('barcode') }}" class="form-control"
                                    placeholder="Nhập mã vạch">
                                <span class="form-text @error('barcode') text-danger @enderror">
                                    @error('barcode') {{ $message }} @else {{ 'Vui lòng nhập mã vạch' }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nồng độ:</label>
                            <div class="col-lg-6">
                                <input type="text" name="abv" value="{{ old('abv') }}" class="form-control"
                                    placeholder="Nhập nồng độ">
                                <span class="form-text @error('abv') text-danger @enderror">
                                    @error('abv') {{ $message }} @else {{ 'Vui lòng nhập nồng độ' }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Năm sản xuất:</label>
                            <div class="col-lg-6">
                                <input type="text" name="vintage" value="{{ old('vintage') }}" class="form-control"
                                    placeholder="Nhập năm sản xuất">
                                <span class="form-text @error('vintage') text-danger @enderror">
                                    @error('vintage') {{ $message }} @else {{ 'Vui lòng nhập năm sản xuất' }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Đơn giá:</label>
                            <div class="col-lg-6">
                                <input type="text" name="price" value="{{ old('price') }}" class="form-control"
                                    placeholder="Nhập giá sản phẩm">
                                <span class="form-text @error('price') text-danger @enderror">
                                    @error('price') {{ $message }} @else {{ 'Vui lòng nhập giá sản phẩm' }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tỉ lệ gỉam giá:</label>
                            <div class="col-lg-6">
                                <input type="text" name="sale" value="{{ old('sale') ?? '0'}}" class="form-control"
                                    placeholder="Nhập tỉ lệ giảm giá">
                                <span class="form-text @error('sale') text-danger @enderror">
                                    @error('sale') {{ $message }} @else {{ 'Vui lòng nhập tỉ lệ giảm giá' }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Số lượng trong kho:</label>
                            <div class="col-lg-6">
                                <input type="text" name="instock" value="{{ old('instock') }}" class="form-control"
                                    placeholder="Nhập số lượng tồn">
                                <span class="form-text @error('instock') text-danger @enderror">
                                    @error('instock') {{ $message }} @else {{ 'Vui lòng nhập số lượng tồn' }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Sản phẩm thuộc:</label>
                            <div class="col-lg-6">
                                <div class="kt-radio-inline">
                                    <label class="kt-radio kt-radio--bold kt-radio--success">
                                        <input type="radio" value="true" {{ old('bestseller') == '0' ? '' : 'checked' }} checked name="bestseller"> 
                                        Sản phẩm bán chạy
                                        <span></span>
                                    </label>
                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                        <input type="radio" value="false" {{ old('bestseller') == '0' ? 'checked' : '' }} name="bestseller">
                                        Sản phẩm thường
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Dung tích chai:</label>
                            <div class="col-lg-6">
                                <select name="size_id" class="form-control">
                                    @foreach ($sizes as $size)
                                    <option value="{{$size->id}}">{{$size->capacity}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text @error('size_id') text-danger @enderror">
                                    @error('size_id') {{ $message }} @else {{ 'Vui lòng chọn dung tích' }} @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Loại sản phẩm:</label>
                            <div class="col-lg-6">
                                <select name="subcate_id" class="form-control">
                                    @foreach ($subcates as $subcate)
                                    <option value="{{$subcate->id}}">{{$subcate->name}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text @error('subcate_id') text-danger @enderror">
                                    @error('subcate_id') {{ $message }} @else {{ 'Vui lòng chọn loại sản phẩm' }} @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nhãn hiệu:</label>
                            <div class="col-lg-6">
                                <select name="brand_id" class="form-control">
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text @error('brand_id') text-danger @enderror">
                                    @error('brand_id') {{ $message }} @else {{ 'Vui lòng chọn nhãn hiệu' }} @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Quốc gia:</label>
                            <div class="col-lg-6">
                                <select name="country_id" class="form-control">
                                    @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text @error('country_id') text-danger @enderror">
                                    @error('country_id') {{ $message }} @else {{ 'Vui lòng chọn quốc gia' }} @enderror
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
                            <a href="{{ route('manager.products') }}" class="btn btn-secondary">Hủy bỏ</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Form-->
        </div>
    </div>
</form>

@endsection

@push('scripts')
    <script>
        review_img();
    </script>
@endpush
