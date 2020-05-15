@extends('manager.layout.master')

@section('content_head')
@include('manager.layout.component.subheader', [
    'main_text' => 'Sửa sản phẩm', 
    'btn_url' =>  route('manager.products.create'), 
    'btn_text' => 'Thêm sản phẩm'])
@endsection

@section('content')
@if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
<form class="row kt-form" method="POST" enctype="multipart/form-data" action="{{ route("manager.products.update", $product->id) }}">
    @csrf
    <div class="col-md-4">
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-section kt-section--first">
                    <h3 class="kt-section__title">1. Chọn hình ảnh:</h3>
                    <label class="kt-section__body">
                        <img width="100%" src="{{ Storage::url($product->image) }}" id="review-img"/>
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
                    <h3 class="kt-section__title">2. Thông tin loại sản phẩm:</h3>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tên loại sản phẩm:</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" value="{{ old('name') ?? $product->name }}" class="form-control"
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
                                <input type="text" name="barcode" value="{{ old('barcode') ?? $product->barcode }}" class="form-control"
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
                                <input type="text" name="abv" value="{{ old('abv') ?? $product->abv }}" class="form-control"
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
                                <input type="text" name="vintage" value="{{ old('vintage') ?? $product->vintage }}" class="form-control"
                                    placeholder="Nhập năm sản xuất">
                                <span class="form-text @error('vintage') text-danger @enderror">
                                    @error('vintage') {{ $message }} @else {{ 'Vui lòng năm sản xuất' }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Đơn giá:</label>
                            <div class="col-lg-6">
                                <input type="text" name="price" value="{{ old('price') ?? $product->price }}" class="form-control"
                                    placeholder="Nhập giá sản phẩm">
                                <span class="form-text @error('price') text-danger @enderror">
                                    @error('price') {{ $message }} @else {{ 'Vui lòng nhập giá sản phẩm' }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tỉ lệ giảm giá:</label>
                            <div class="col-lg-6">
                                <input type="text" name="sale" value="{{ old('sale') ?? $product->sale }}" class="form-control"
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
                                <input type="text" name="instock" value="{{ old('instock') ?? $product->instock }}" class="form-control"
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
                                        <input type="radio" value="true" @if ($product->bestseller) checked @endif checked name="bestseller"> 
                                        Sản phẩm bán chạy
                                        <span></span>
                                    </label>
                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                        <input type="radio" value="false" @if ($product->bestseller) checked @endif name="bestseller">
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
                                        <option @if (old("size_id") == $size->id || $size->id == $product->size_id && !old("size_id")) selected @endif 
                                            value="{{$size->id}}">{{$size->capacity}}</option>
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
                                        <option @if (old("subcate_id") == $subcate->id || $subcate->id == $product->subcate_id && !old("subcate_id")) selected @endif 
                                            value="{{$subcate->id}}">{{$subcate->name}}</option>
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
                                        <option @if (old("brand_id") == $brand->id || $brand->id == $product->brand_id && !old("brand_id")) selected @endif 
                                            value="{{$brand->id}}">{{$brand->name}}</option>
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
                                        <option @if (old("country_id") == $country->id || $country->id == $product->country_id && !old("country_id")) selected @endif 
                                            value="{{$country->id}}">{{$country->name}}</option>
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
                            <button type="submit" class="btn btn-success">Chỉnh sửa</button>
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

